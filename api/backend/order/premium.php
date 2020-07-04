<?php 
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/premium.php';

// instantiate database and product object
$database = new Connection();
$db = $database->connection();


$premium = new Premium();
$premium->connection($db);
$result = array();
$result["message"] = "";
$result["premium"] = array();


$result["premium"] = $premium->fetchPremium();

if($result["premium"] != null){
    // set response code - 200 OK
    http_response_code(200);

    // show result data in json format
    echo json_encode($result);
}else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the premium no result found
    $result["message"] = "Premium not exits";
    echo json_encode($result);
}




?>