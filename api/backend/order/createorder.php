<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/order.php';

// instantiate database and product object
$database = new Connection();
$db = $database->connection();


//Input needed from Angular
$userId = 15;
$cbId = 4; //need Select for get Cookbooks
$cbTitle = "Test Cookbook";
$cbDedication = "for tests";
$giftStatus = true; //0 or 1 (false or true)
$amount = 2;
$orderStatus = "created";
$timestamp = "2020-06-11 15:16:00";
$recipient = "Natalia Pfening";
$street = "Städter Weg 12";
$cityId = 27834; //with api getcitties.php
$paymentMethodId = 4; //with api payment.php

//create objects for response
$resultArr = array();
$resultArr["message"] = "";
$order = new Order();
$order->connection($db);

//crete order
$result = $order->createOrder($userId, $cbId, $cbTitle,$cbDedication, $giftStatus,$amount,$orderStatus,$timestamp,$recipient,$street,$cityId,$paymentMethodId);

if(strcmp($result, "200") == 0){
    // set response code - 200 OK
    http_response_code(200);

    // show result data in json format
    $resultArr["message"] = "Creation done";
    echo json_encode($resultArr);
}else if(strcmp($result, "403") == 0){
    // set response code - 403 Not found
    http_response_code(403);

    // tell the user no result found
    $resultArr["message"] = "Wrong or missing data";
    echo json_encode($resultArr);
}else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no result found
    $resultArr["message"] = $result;
    echo json_encode($resultArr);
}

//echo "ok";

?>