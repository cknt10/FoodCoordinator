<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/reguser.php';
  
// instantiate database and product object
$database = new Connection();
$db = $database->connection();
$user = new RegUser();
$user->connection($db);

$error = false;
$mailError = false;
$result = array();
$insertResult = "";

// $username = trim($_POST['username']);
// $email = trim($_POST['mail']);
// $password = trim($_POST['passwort']);
// $passwort2 = $_POST['passwort2'];
// $firstName = trim($_POST['vorname']);
// $name = trim($_POST['nachname']);
// $gender = trim($_POST['gender']);
// $street = trim($_POST['street']) . ' ' . trim($_POST['streetnumber']);
// $birthday = trim($_POST['birthday']);

// $city = trim($_POST['aaaa']); //SQL Statement
// $zip = trim($_POST['aaaa']); //SQL Statement


$username = "test";
$email = "test@mail.com";
$password = "123456";
$passwort2 = "123456";
$firstName = "testfirstname";
$name = "testname";
$gender = "m";
$street = "test street 3";
$birthday = "1990-10-19";

$city = "Frankfurt am Main"; //SQL Statement
$zip = 60639; //SQL Statement


if(empty($firstName) || empty($name) || empty($username)) {
    $error = true;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
} 	
if(strlen($password) == 0) {

    $error = true;
}
if($password != $passwort2) {
    $error = true;
}



//Check Email exist
if(!$error) { 
    $error = $user->checkUserExist($email, $username); 
    if($error){$mailError = true;}
}

 

//Check location exist. If not create Location and set ID into Object
if(!$error) { 
    
    //$error = $user->checkLocation($zip);

    if(!$user->checkLocation($zip, $city)){
        //Create City Entry
        $user->createLocation($zip, $city);
    }
}



//If still no errors, register can be create
if(!$error) {	
    //Fill object with missing informations
    $user->setUsername($username);
    $user->setEmail($email);
    $user->setPassword($password);
    $user->setFirstname($firstName);
    $user->setName($name);
    $user->setGender($gender);
    $user->setStreet($street);
    $user->setBirthday($birthday);
    $user->setLocation($city);
    $user->setPostcode($zip);

    //Call Insert
    $insertResult = $user->createUser( 
        $email, 
        $username, 
        $password, 
        $firstName,
        $name, 
        $gender, 
        $street,
        $birthday,
        $user->getCityId());
}

if($insertResult !== "201"){
    $error = true;
}

//Prepare and set json 
if(!$error){

    $result["user"] =array(
        'id' => $user->getId(), 
        'username' => $user->getUsername(),
        'email' => $user->getEmail(), 
        'firstname' => $user->getFirstname(), 
        'name' => $user->getName(), 
        'birthday' => $user->getBirthday(),
        'gender' => $user->getGender(), 
        'street' => $user->getStreet(),
        'cityId' => $user->getCityId(),
        'postcode' => $user->getPostcode(),
        'city' => $user->getLocation(),
    );

    // set response code - 201 OK
    http_response_code(201);

    // show result data in json format
    echo json_encode($result);
}else{

    if($mailError){
        // set response code - 500 Not found
        http_response_code(401);

        // tell the user no result found
        echo json_encode(
            array("message" => "Email or Username already exits")
        );

    }else{
            // set response code - 500 Not found
    http_response_code(500);

    // tell the user no result found
    echo json_encode(
        array("message" => "Internal Server Error")
    );
    }


}






?>