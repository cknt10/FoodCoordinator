<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';

//Input needed from Angular
$userId = "15";
$cbId = ""; //need Select for get Cookbooks
$cbTitle = "";
$cbDedication = "";
$giftStatus = ""; //0 or 1 (false or true)
$amount = "";
$orderStatus ="";
$timestamp = "";
$recipient = "";
$street = "";
$cityId = ""; //with api getcitties.php
$paymentMethodId = ""; //with api payment.php






?>