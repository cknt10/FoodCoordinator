<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/recipe.php';
include_once '../../classes/ingredient.php';

// instantiate database and product object
$database = new Connection();
$db = $database->connection();

$recipe = new Recipe();
$recipe->connection($db);
$ingredient = new Ingredient();
$ingredient->connection($db);



//Dummy data

$dummyarray = array(
    "title" => "Test Titel",
    "picture" => "images/myId/aaa/kuchenTest.png",
    "servings" => "3",
    "description" => "Test Discription",
    "instruction" => "Einmal testen",
    "creationDate" => "2020-06-20 15:36:02",
    "duration" => "60",
    "difficulty" => "easy",
    "certified" => "0",
    "lastChange" => null,
    "userId" => "15",
    "keywords" => "",
    "ingredients" => ""
);

$singlearray = array(
    "f_id" => "2",
    "r_id" => "1",
    "amount" => "3",
    "unit" => "Stk"
);

$multiarray = array();

array_push($multiarray, array(
    "f_id" => "3",
    "amount" => "4",
    "unit" => "Stk"
));
array_push($multiarray, array(
    "f_id" => "4",
    "amount" => "1",
    "unit" => "Stk"
));


$dummyarray['ingredients'] = $multiarray;

$dummyarray['keywords'] = array("3", "4");


//Create return 
$recipeArray = array();
$recipeArray["message"] = "";

//Check recipe exists

$checkRecipe = $recipe->fetchRecipe($dummyarray['creationDate'], $dummyarray['userId']);
if($checkRecipe == -1){
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
        $recipeId = $recipe->fetchRecipe($dummyarray['creationDate'], $dummyarray['userId']);

        //Ingredient

        //Insert recipe id to ingredients
        for($_i = 0; $_i < count($dummyarray['ingredients']); $_i++){
            $dummyarray['ingredients'][$_i]['r_id']= strval($recipeId);
        }

        $checkIngredient = $ingredient->createIngredients($dummyarray['ingredients']);
        if($checkIngredient === "200"){
            //Keywords
            $checkKeywords = $recipe->createKeywords($recipeId, $dummyarray['keywords']);
            if($checkKeywords === "200"){
                // set response code - 500
                http_response_code(200);

                $recipeArray["message"] = "Recipe created";
                echo json_encode($recipeArray);
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
}else{
   // set response code - 403
   http_response_code(403);

   $recipeArray["message"] = "Recipe allready exits";
   echo json_encode($recipeArray);
}


?>