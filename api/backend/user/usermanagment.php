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
$mail = "test@mail.com";
$username = "test";
$firstName = "SergejTest";
$name = "SergejTeeeest";
$gender = "m";
$street = "Street Test 22";
$birthday = "1990-10-19";
$cityId = "27834";
$userImg = "";

// $username = trim($_GET['username']);
// $email = trim($_GET['email']);
// $password = trim($_GET['password']);
// $firstName = trim($_GET['firstname']);
// $name = trim($_GET['name']);
// $gender = trim($_GET['gender']);
// $street = trim($_GET['street']) . ' ' . trim($_GET['houseNumber']);
// $birthday = trim($_GET['birthday']);


if($mail != "" || $userId != "" || $username != "" || $firstName != ""){
    $result["user"] = $user->changeUser($userId, $mail, $username, $firstName, $name, $gender, $street, $birthday, $cityId, $userImg);
    
    if($result["user"] === "200"){
        // set response code - 200 OK
        http_response_code(200);

        // show result data in json format
        echo json_encode($result);
    }else{
        // set response code - 500 Not found
        http_response_code(500);

        // tell the user no result found
        $result["message"] = "Cant change user";
        echo json_encode($result);
    }


}else{
        // set response code - 404 Not found
        http_response_code(404);

        // tell the user no result found
        $result["message"] = "Missing user data";
        echo json_encode($result);
}



?>