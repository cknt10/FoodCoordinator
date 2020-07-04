<?php 
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/order.php';

// instantiate database and product object
$database = new Connection();
$db = $database->connection();


//Input needed from Angular
$userId = $_GET['userId'];
$cbId = $_GET['cbId']; //need Select for get Cookbooks
$cbTitle = $_GET['title'];
$cbDedication = $_GET['dedication'];
$giftStatus = $_GET['giftstatus'] === "0" ? false : true; //0 or 1 (false or true)
$amount = $_GET['amount'];
$orderStatus = $_GET['orderStatus'];
$timestamp = $_GET['creationDate'];
$recipient = $_GET['recipient'];
$street = $_GET['street'] . ' ' . $_GET['housenumber'];
$cityId = $_GET['cityId']; //with api getcitties.php
$paymentMethodId = $_GET['paymentMethod']; //with api payment.php


$recipeIds = explode("|", $_GET["recipeId"]);


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

    $orderId = $order->fetchOrder($timestamp, $userId);

    $orderRecipe = $order->createOrderRecipe($orderId, $recipeIds);
    
    if($orderRecipe === "200"){
        http_response_code(200);
        // show result data in json format
        $resultArr["message"] = "Creation done";
    echo json_encode($resultArr);
    }else{
        http_response_code(404);
        // show result data in json format
        $resultArr["message"] = "Cant create recipe to order";
        echo json_encode($resultArr);
    }


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