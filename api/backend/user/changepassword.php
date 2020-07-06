<?php 
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/reguser.php';

$database = new Connection();
$db = $database->connection();


$user = new RegUser();
$user->connection($db);


$result = array();
$result["message"] = "";
$result["user"] = array();


//DUMMY data

//user
$userId = "15";
$password = "123456";


if($userId != "" || $password != ""){
    $result["user"] = $user->changePassword($userId, $password);
    
    if($result["user"] === "200"){
        // set response code - 200 OK
        http_response_code(200);

        // show result data in json format
        echo json_encode($result);
    }else{
        // set response code - 500 Not found
        http_response_code(500);

        // tell the user no result found
        $result["message"] = "Cant change password";
        echo json_encode($result);
    }


}else{
        // set response code - 404 Not found
        http_response_code(404);

        // tell the user no result found
        $result["message"] = "Missing password";
        echo json_encode($result);
}



?>