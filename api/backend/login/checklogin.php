<?php
session_start();
if(!isset($_SESSION['userid'])) {
// set response code - 403
   http_response_code(403);
  
   // tell the user no result found
   $result["message"] = "Please login";
   echo json_encode($result);
}else{
   // set response code - 200
   http_response_code(200);
  
   // tell the user no result found
   $result["message"] = "User logged";
   echo json_encode($result);
}
 

?>