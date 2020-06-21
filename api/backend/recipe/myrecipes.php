<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/recipe.php';
// include_once '../../classes/ingredient.php';
// include_once '../../classes/nutrient.php';
// include_once '../../classes/favourite.php';
include_once '../../classes/rating.php';
// include_once '../../classes/keywords.php';


// instantiate database and product object
$database = new Connection();
$db = $database->connection();


$userId = "15";

//Intitiate classes
$recipe = new Recipe();
$recipe->connection($db);
$rating = new Rating();
$rating->connection($db);


//return
$result = array();

$result['message'] = "";
$result['recipes'] = array();


$recipies = $recipe->fetchAllRecipe($userId);

if($recipies->rowCount() > 0){
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($_row = $recipies->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($_row);

        $recipe->setId($R_ID);
        $recipe->setTitle($Title);
        $recipe->setPicture($Picture);
        $recipe->setServings($Servings);
        $recipe->setDescription($R_Descr);
        $recipe->setInstruction($Instruction);
        $recipe->setCreationDate($CreationDate);
        $recipe->setDuration($Duration);
        $recipe->setDifficulty($Difficulty);
        $recipe->setCertified($Certified);
        $recipe->setLastChange($LastChange);
        $recipe->setCreatedUser($U_ID);

        $ratings = $rating->fetchRatings($R_ID, $U_ID);

        if($ratings != null && $R_ID === $ratings[0]['recipeId']){
            $recipe->setRatings($ratings);
        }else{
            $recipe->setRatings(array());
        }
        //$recipe->setRatings($ratings);

        array_push($result['recipes'], $recipe->getObjectAsArray());

    }

    if(count($result['recipes']) > 0){
        // set response code - 200
        http_response_code(200);

        $result["message"] = "";
        echo json_encode($result);
    }
}else{
    // set response code - 404
    http_response_code(404);

    $result["message"] = "No recipe found";
    echo json_encode($result);
}



?>