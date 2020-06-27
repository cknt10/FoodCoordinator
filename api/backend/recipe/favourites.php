<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/favourite.php';

$database = new Connection();
$db = $database->connection();


$user = new Favourite();
$user->connection($db);


$result = array();
$result["message"] = "";
$result["favourites"] = array();

if($postcode != ""){
    $result["favourites"] = $user->fetchLocations($postcode);
    
    if($result["cities"] != null){
        // set response code - 200 OK
        http_response_code(200);

        // show result data in json format
        echo json_encode($result);
    }else{
        // set response code - 404 Not found
        http_response_code(404);

        // tell the user no result found
        $result["message"] = "City not exits";
        echo json_encode($result);
    }


}else{
        // set response code - 404 Not found
        http_response_code(404);

        // tell the user no result found
        $result["message"] = "City not exits";
        echo json_encode($result);
}



?>