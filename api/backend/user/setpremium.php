<?php 
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/premiumuser.php';

$database = new Connection();
$db = $database->connection();


$user = new PremiumUser();
$user->connection($db);

//Dummy Data

$premiumId = "5";
$userId = "25";
$paymentMethodId = "4";
$date = "2020-06-28 16:10:20";


$result = array();
$result["message"] = "";

if($premiumId != "" && $userId != "" && $paymentMethodId != "" && $date != ""){
    $resultPremium = $user->createPremium($premiumId, $userId, $paymentMethodId, $date);
    
    if($resultPremium === "201"){
        // set response code - 201 OK
        http_response_code(200);

        // show result data in json format
        $result["message"] = "Premium user created";
        echo json_encode($result);
    }else{
        // set response code - 404 Not found
        http_response_code(404);

        // tell the user no result found
        $result["message"] = "Couldnt set premium";
        $result["error"] = $resultPremium;
        echo json_encode($result);
    }


}else{
        // set response code - 403 Not found
        http_response_code(403);

        // tell the user no result found
        $result["message"] = "Missing data";
        echo json_encode($result);
}



?>