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
$_user = new RegUser($db);


$error = false;
$result = array();
$insertResult = "";

// $_username = trim($_POST['username']);
// $_email = trim($_POST['mail']);
// $_password = trim($_POST['passwort']);
// $passwort2 = $_POST['passwort2'];
// $_firstName = trim($_POST['vorname']);
// $_name = trim($_POST['nachname']);
// $_gender = trim($_POST['gender']);
// $_street = trim($_POST['street']) . ' ' . trim($_POST['streetnumber']);
// $_birthday = trim($_POST['birthday']);

// $_city = trim($_POST['aaaa']); //SQL Statement
// $_zip = trim($_POST['aaaa']); //SQL Statement


$_username = "test";
$_email = "test@mail.com";
$_password = "123456";
$passwort2 = "123456";
$_firstName = "testfirstname";
$_name = "testname";
$_gender = "m";
$_street = "test street 3";
$_birthday = "1990-10-19";

$_city = "Frankfurt am Main"; //SQL Statement
$_zip = 60639; //SQL Statement


if(empty($_firstName) || empty($_name) || empty($_username)) {
    $error = true;
}

if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
} 	
if(strlen($_password) == 0) {

    $error = true;
}
if($_password != $passwort2) {
    $error = true;
}



//Check Email exist
if(!$error) { 
    $error = $_user->checkEmail($_email); 
}

 

//Check location exist. If not create Location and set ID into Object
if(!$error) { 
    
    //$error = $_user->checkLocation($_zip);

    if(!$_user->checkLocation($_zip)){
        //Create City Entry
        $_user->createLocation($_zip, $_city);
    }
}



//If still no errors, register can be create
if(!$error) {	
    //Fill object with missing informations
    $_user->setUsername($_username);
    $_user->setEmail($_email);
    $_user->setPassword($_password);
    $_user->setFirstname($_firstName);
    $_user->setName($_name);
    $_user->setGender($_gender);
    $_user->setStreet($_street);
    $_user->setBirthday($_birthday);
    $_user->setLocation($_city);
    $_user->setPostcode($_zip);

    //Call Insert
    $insertResult = $_user->createUser( 
        $_email, 
        $_username, 
        $_password, 
        $_firstName,
        $_name, 
        $_gender, 
        $_street,
        $_birthday,
        $_user->getCityId());
}

if($insertResult !== "201"){
    $error = true;
}

//Prepare and set json 
if(!$error){

    $result["user"] =array(
        'id' => $_user->getId(), 
        'username' => $_user->getUsername(),
        'email' => $_user->getEmail(), 
        'firstname' => $_user->getFirstname(), 
        'name' => $_user->getName(), 
        'birthday' => $_user->getBirthday(),
        'gender' => $_user->getGender(), 
        'street' => $_user->getStreet(),
        'cityId' => $_user->getCityId(),
        'postcode' => $_user->getPostcode(),
        'city' => $_user->getLocation(),
    );

    // set response code - 201 OK
    http_response_code(201);

    // show result data in json format
    echo json_encode($result);
}else{
    // set response code - 404 Not found
    http_response_code(500);

    // tell the user no result found
    echo json_encode(
        array("message" => "Internal Server Error")
    );
}






?>