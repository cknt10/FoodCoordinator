<?php 
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/favourite.php';

$database = new Connection();
$db = $database->connection();


$user = new Favourite();
$user->connection($db);



?>