<?php
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/format.php';

//TODO Dustin: Erstelle einen API Call inkl. Antwort für die Formate mit Aufruft der Funktion fetchFormats
//ein Beispiel findest du in /search/getkeywords

$database = new Connection();
$db = $database->connection();

$postcode = "";

$format = new Format();
$format -> connection ($db);
$result["message"] = "";
$result["format"] = array();

$result["format"] = $format -> fetchFormats();

if($result["format"] != null){
  http_response_code(200);
  echo json_encode($result);
}
else{
  http_response_code(404);
  $result ["message"] = "Format not exists";
  echo json_encode($result);
}

?>
