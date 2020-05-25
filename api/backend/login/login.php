<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/reguser.php';
include_once '../../classes/premiumuser.php';
  
// instantiate database and product object
$database = new Connection();
$db = $database->connection();
  
// initialize object
$_user = new PremiumUser($db);
$_user->setUsername("test");
$passwort = "123456";
// query products
$num = $_user->login();
  
// check if more than 0 record found
if($num>0){
    //user array
    $result_arr=array();
    $_wrongPassword = "";
    
  
  
    $result_arr["user"] =array(
        'id' => $_user->getId(), 
        'username' => $_user->getUsername(),
        'email' => $_user->getEmail(), 
        'firstname' => $_user->getFirstname(), 
        'name' => $_user->getName(), 
        'birthday' => $_user->getBirthday(),
        'gender' => $_user->getGender(), 
        'street' => $_user->getStreet(),
        'postalCode' => $_user->getPostcode(),
        'city' => $_user->getLocation(),
        'isPremium' => ''
    );


    $_wrongPassword = $_user->getPassword();

    //Check for Premium
    $result_arr["user"]['isPremium'] = $_user->isPremium($result_arr["user"]['id'], "") ? true : false;



    //Check Password
    //TODO
    if (password_verify($passwort, $_wrongPassword)) {
        $_SESSION['userid'] = $result_arr["user"]['id'];

        // set response code - 200 OK
        http_response_code(200);
    
        // show result data in json format
        echo json_encode($result_arr);
    } else {
        // set response code - 404 Not found
        http_response_code(403);
    
        // tell the user no result found
        echo json_encode(
            array("message" => "Wrong Username or Password")
        );
    }

}else{ // no result found will be here
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no result found
    echo json_encode(
        array("message" => "No User found.")
    );
}



?>