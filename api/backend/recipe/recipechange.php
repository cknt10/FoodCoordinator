<?php 
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';

include_once '../../classes/recipe.php';
include_once '../../classes/ingredient.php';

// instantiate database and product object
$database = new Connection();
$db = $database->connection();


$postdata = file_get_contents("php://input");


// Extract the data.
$request = json_decode($postdata);
$request1 = $request->picture;

$ingredinetsFrontend = $request->ingredients;
$keywordsFrontend =  explode("|", $request->keywords);

$oldRecipeId = $request->id;
$recipeId = -1;
$recipeStatus = "";
$recipe = new Recipe();
$recipe->connection($db);
$ingredient = new Ingredient();
$ingredient->connection($db);



//Overwrite old recipe id
function overwriteRecipeId($_oldId, $_newId, $_conn)
{
    $_query = null;
    $_stmt = null;
    $_result = "";

    $_tableUpdates = array("favourites", "rating", "orderRecipeList");
    try{

        for($_i = 0; $_i < count($_tableUpdates); $_i++){
            //Check for entries

            try{
                //Basic Recipe Search
                $_query = 'SELECT * FROM ' . $_tableUpdates[$_i] . ' WHERE R_ID = :R_ID ';

                // prepare query statement
                $_stmt = $_conn->prepare($_query);

                //bind
                $_stmt->bindParam(":R_ID", $_oldId);  

                // execute query
                $_stmt->execute();

            }catch(Eception $_e){
                $_result = $_e->getMessage();
            }

            $_num = $_stmt->rowCount();

            if($_num > 0){
                //Basic Recipe Search
                $_query = 'UPDATE ' . $_tableUpdates[$_i] . ' SET R_ID = :NR_ID WHERE R_ID = :OR_ID ';

                // prepare query statement
                $_stmt = $_conn->prepare($_query);

                //bind
                $_stmt->bindParam(":NR_ID", $_newId);
                $_stmt->bindParam(":OR_ID", $_oldId);  

                // execute query
                $_stmt->execute();
            }

        }
        $_result = "200";
    }catch(Eception $_e){
            $_result = $_e->getMessage();
    }

      return $_result;
}

//Drop old recipe id
function dropOldRecipe($_oldId, $_conn)
{
    $_query = null;
    $_stmt = null;
    $_result = "";
    $_tableUpdates = array("recipeHasKeywords", "ingredient", "recipe");

    try{
        for($_i = 0; $_i < count($_tableUpdates); $_i++){
            //Basic Recipe Search
            $_query = 'DELETE FROM ' . $_tableUpdates[$_i] . ' WHERE R_ID = :R_ID';

            // prepare query statement
            $_stmt = $_conn->prepare($_query);

            //bind
            $_stmt->bindParam(":R_ID", $_oldId);

            // execute query
            $_stmt->execute();
        }
        

        $_result = "200";
    }catch(Eception $_e){
            $_result = $_e->getMessage();
    }

      return $_result;
}


//Dummy data

$dummyarray = array(
    "title" => "Changetest Title",
    "picture" => "images/myId/aaa/kuchenTest.png",
    "servings" => "3",
    "description" => "Test Discription",
    "instruction" => "Einmal testen",
    "creationDate" => "2020-06-20 15:36:02",
    "duration" => "60",
    "difficulty" => "easy",
    "certified" => "0",
    "lastChange" => "2020-06-21 08:59:02",
    "userId" => "15",
    "keywords" => "",
    "ingredients" => ""
);


//Get data from frontend

$dummyarray['title'] =  $request->title;
$dummyarray['picture'] =  $request->picture === null ? "no pic" : $request->picture;
$dummyarray['servings'] = $request->servings;
$dummyarray['description'] = $request->description;
$dummyarray['instruction'] = $request->instruction;
$dummyarray['creationDate'] = $request->creationDate;
$dummyarray['duration'] = $request->duration;
$dummyarray['difficulty'] = $request->difficulty;
$dummyarray['certified'] = $request->certified;
$dummyarray['lastChange'] = $request->lastChangen === "null" ? null :$request->lastChangen;
$dummyarray['userId'] = $request->userId;


$dummyarray['ingredients'] = $ingredinetsFrontend === "" ? aray() : $ingredinetsFrontend;

$dummyarray['keywords'] = empty($keywordsFrontend) ? array() : $keywordsFrontend;



//Create return 
$recipeArray = array();
$recipeArray["message"] = "";

if($postdata === ''){
    // set response code - 400
    http_response_code(400);
 
    $recipeArray["message"] = "Missing data";
    echo json_encode($recipeArray);
 }else{

    //Create Recipe
    $checkRecipeCreated = $recipe->createRecipe($dummyarray['title'], 
                                                $dummyarray['picture'], 
                                                $dummyarray['servings'], 
                                                $dummyarray['description'], 
                                                $dummyarray['instruction'],
                                                $dummyarray['creationDate'],
                                                $dummyarray['duration'],
                                                $dummyarray['difficulty'],
                                                $dummyarray['certified'],
                                                $dummyarray['lastChange'],
                                                $dummyarray['userId']);

    if(strcmp($checkRecipeCreated, "200")){
        //get created recipe id
        $recipeId = $recipe->fetchRecipe($dummyarray['creationDate'], $dummyarray['userId'], $dummyarray['lastChange']);

        //Ingredient
        //Insert recipe id to ingredients
        for($_i = 0; $_i < count($dummyarray['ingredients']); $_i++){
            $dummyarray['ingredients'][$_i]->r_id= strval($recipeId);
        }

        $checkIngredient = $ingredient->createIngredients($dummyarray['ingredients']);
        if($checkIngredient === "200"){
            //Keywords
            $checkKeywords = $recipe->createKeywords($recipeId, $dummyarray['keywords']);
            if($checkKeywords === "200"){
                $recipeStatus = "200";
            }else{
                // set response code - 500
                http_response_code(500);
                
                $recipeArray["message"] = "Cant create keywords";
                echo json_encode($recipeArray);
            }
        }else{
            // set response code - 500
            http_response_code(500);

            $recipeArray["message"] = "Cant create ingredient";
            echo json_encode($recipeArray);
        }
    }else{
        // set response code - 500
        http_response_code(500);
        
        $recipeArray["message"] = "Cant create recipe";
        echo json_encode($recipeArray);
    }


    //Start overwrite 
    $overwriteResult = overwriteRecipeId($oldRecipeId,$recipeId, $db);
    if($overwriteResult === "200"){
        //Drop old id
        $dropResult = dropOldRecipe($oldRecipeId, $db);
        if($dropResult === "200"){
            // set response code - 200
            http_response_code(200);

            $recipeArray["message"] = "Recipe changed";
            echo json_encode($recipeArray);
        }else{
            // set response code - 500
            http_response_code(500);
            
            $recipeArray["message"] = "Cant drop old recipe";
            echo json_encode($recipeArray);
        }
    }else{
        // set response code - 500
        http_response_code(500);

        $recipeArray["message"] = "Cant overwrite recipe connection";
        echo json_encode($recipeArray);
    }

 }




?>