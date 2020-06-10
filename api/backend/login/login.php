<?php 
// required headers
//header("Access-Control-Allow-Origin: http://xcsd.ddns.net/");
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
$user = new PremiumUser($db);
$user->setUsername($_GET['username']);
$passwort = $_GET['password'];
// query products
$num = $user->login($_GET['username'], "");
  
// check if more than 0 record found
if($num>0){
    //user array
    $resultArr=array();
    $wrongPassword = "";
    
    $resultArr["message"] = "";
    $resultArr["user"] =array(
        'id' => $user->getId(), 
        'username' => $user->getUsername(),
        'email' => $user->getEmail(), 
        'firstname' => $user->getFirstname(), 
        'name' => $user->getName(), 
        'birthday' => $user->getBirthday(),
        'gender' => $user->getGender(), 
        'street' => $user->getStreet(),
        'postalCode' => $user->getPostcode(),
        'city' => $user->getLocation(),
        'isPremium' => ''
    );


    $wrongPassword = $user->getPassword();

    //Check for Premium
    $resultArr["user"]['isPremium'] = $user->isPremium($resultArr["user"]['id'], "") ? true : false;



    //Check Password
    //TODO
    if (password_verify($passwort, $wrongPassword)) {
        $_SESSION['userid'] = $resultArr["user"]['id'];

        // set response code - 200 OK
        http_response_code(200);
    
        // show result data in json format
        echo json_encode($resultArr);
    } else {
        // set response code - 404 Not found
        http_response_code(403);
    
        // tell the user no result found
        $resultArr["message"] = "Wrong Username or Password";
        echo json_encode($resultArr);
    }

}else{ // no result found will be here
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no result found
    $resultArr["message"] = "No User found.";
    echo json_encode($resultArr);
}



?>