<?php 
// required headers
header("Access-Control-Allow-Origin: http://xcsd.ddns.net/");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/reguser.php';
include_once '../../classes/premiumuser.php';
  
// instantiate database and product object
$database = new Connection();
$db = $database->connection();

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
    $request = json_decode($postdata);
  //echo $request . '\n';
}else{ 
    $request = "Daten leer";
}
// initialize object
$_user = new PremiumUser($db);
$_user->setUsername("test");
$passwort = '123456';
// query products
$num = $_user->login("test", "");
  
// check if more than 0 record found
if($num>0){
    //user array
    $resultArr=array();
    $_wrongPassword = "";
    
    $resultArr["eure Daten"] = $request;
    $resultArr["message"] = "";
    $resultArr["user"] =array(
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
    $resultArr["user"]['isPremium'] = $_user->isPremium($resultArr["user"]['id'], "") ? true : false;



    //Check Password
    //TODO
    if (password_verify($passwort, $_wrongPassword)) {
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