<?php 
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/paymentmethod.php';

// instantiate database and product object
$database = new Connection();
$db = $database->connection();


$payment = new PaymentMethod();
$payment->connection($db);
$result = array();
$result["message"] = "";
$result["payments"] = array();


$result["payments"] = $payment->fetchPayment();

if($result["payments"] != null){
    // set response code - 200 OK
    http_response_code(200);

    // show result data in json format
    echo json_encode($result);
}else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the payment no result found
    $result["message"] = "Payments not exits";
    echo json_encode($result);
}




?>