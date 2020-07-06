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

$postdata = file_get_contents("php://input");


// Extract the data.
$userData = json_decode($postdata);


$result = array();
$result["message"] = "";
$result["user"] = array();


//DUMMY data

//user
$userId = $userData->id;
$mail = $userData->email;
$username = $userData->username;
$firstName = $userData->firstname;
$name = $userData->name;
$gender = $userData->gender;
$street = $userData->street . ' ' . $userData->houseNumber;
$birthday = $userData->birthday;
$cityId =""; //will be set after check if location exists
$userImg = $userData->picture;

//Need to get the cityId
$zip = $userData->postalCode;
$city = $userData->city;

//Check location exist. If not create Location and set ID into Object

if(!$user->checkLocation($zip, $city)){
    //Create City Entry
    $user->createLocation($zip, $city);
}else{
    $cityId = $user->getCityId();
}



if($mail != "" || $userId != "" || $username != "" || $firstName != ""){
    $result["user"] = $user->changeUser($userId, $mail, $username, $firstName, $name, $gender, $street, $birthday, $cityId, $userImg);
    sleep(2);
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


        // // TEST
        // $test = array(
        //     "userId" => $userId,
        //     "mail" => $mail,
        //     "username" => $username,
        //     "firstname" => $firstName,
        //     "name" => $name,
        //     "gender" => $gender,
        //     "street" => $street,
        //     "birthday" => $birthday,
        //     "cityId" => $cityId,
        //     "userImg" => $userImg
        // );

        // $result["message"] = $test;
        // echo json_encode($result);

?>