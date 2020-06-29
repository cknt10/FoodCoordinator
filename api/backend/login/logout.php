<?php
session_start();
session_destroy();
 
// set response code - 200
http_response_code(200);

// tell the user no result found
$result["message"] = "User loggedout";
echo json_encode($result);
?>