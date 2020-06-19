<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/recipe.php';

// instantiate database and product object
$database = new Connection();
$db = $database->connection();


$postcode = "";

$recipe = new Recipe();
$recipe->connection($db);
$result = array();
$result["message"] = "";
$result["keywords"] = array();


$result["keywords"] = $recipe->fetchKeywords();

if($result["keywords"] != null){
    // set response code - 200 OK
    http_response_code(200);

    // show result data in json format
    echo json_encode($result);
}else{
    // set response code - 404 Not found
    http_response_code(403);

    // tell the user no result found
    $result["message"] = "Keywords not exits";
    echo json_encode($result);
}






?>