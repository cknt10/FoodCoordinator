<?php 
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");   
  
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





$postdata = file_get_contents("php://input");


// Extract the data.
$request = json_decode($postdata);
$request1 = $request->picture;

$ingredinetsFrontend = $request->ingredients;
$keywordsFrontend =  explode("|", $request->keywords);

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


// //Create return 
// $recipeArray = array();
// $recipeArray["message"] = "";

// //Check recipe exists

// $checkRecipe = $recipe->fetchRecipe($dummyarray['creationDate'], $dummyarray['userId']);
// if($checkRecipe == -1){
//     //Create Recipe
//     $checkRecipeCreated = $recipe->createRecipe($dummyarray['title'], 
//                                                 $dummyarray['picture'], 
//                                                 $dummyarray['servings'], 
//                                                 $dummyarray['description'], 
//                                                 $dummyarray['instruction'],
//                                                 $dummyarray['creationDate'],
//                                                 $dummyarray['duration'],
//                                                 $dummyarray['difficulty'],
//                                                 $dummyarray['certified'],
//                                                 $dummyarray['lastChange'],
//                                                 $dummyarray['userId']);


//     sleep(3);
//     if(strcmp($checkRecipeCreated, "200")){
//         //get created recipe id
//         $recipeId = $recipe->fetchRecipe($dummyarray['creationDate'], $dummyarray['userId']);

//         //Ingredient

//         //Insert recipe id to ingredients
//         for($_i = 0; $_i < count($dummyarray['ingredients']); $_i++){
//             $dummyarray['ingredients'][$_i]->r_id= strval($recipeId);
//         }

//         $checkIngredient = $ingredient->createIngredients($dummyarray['ingredients']);
//         if($checkIngredient === "200"){
//             //Keywords
//             $checkKeywords = $recipe->createKeywords($recipeId, $dummyarray['keywords']);
//             if($checkKeywords === "200"){
//                 // set response code - 200
//                 http_response_code(200);

//                 $recipeArray["message"] = "Recipe created";
//                 echo json_encode($recipeArray);
//             }else{
//                 // set response code - 500
//                 http_response_code(500);
                
//                 $recipeArray["message"] = "Cant create keywords";
//                 echo json_encode($recipeArray);
//             }
//         }else{
//             // set response code - 500
//             http_response_code(500);

//             $recipeArray["message"] = "Cant create ingredient";
//             echo json_encode($recipeArray);
//         }
//     }
//     else{
//         // set response code - 500
//         http_response_code(500);
        
//         $recipeArray["message"] = "Cant create recipe";
//         echo json_encode($recipeArray);
//     }
// }else{
//    // set response code - 404
//    http_response_code(404);
// //    $recipeArray["data"] = $dummyarray;
// //    $recipeArray["keywords"] = $keywordsFrontend;
// //    $recipeArray["ingredients"] = $ingredinetsFrontend;
//    $recipeArray["message"] = "Recipe allready exits";
//    echo json_encode($recipeArray);
// }

$recipeArray["ingredient"] = $dummyarray['ingredients'];
$recipeArray["keywords"] = $keywordsFrontend;
$recipeArray["ingredients"] = $ingredinetsFrontend;
$recipeArray["postdata"] =$postdata;
$recipeArray["data"] = $dummyarray;

$recipeArray["message"] = "Recipe already exits";
echo json_encode($recipeArray);
?>