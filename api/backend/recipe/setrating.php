<?php 
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/rating.php';

//Database connection
$database = new Connection();
$db = $database->connection();


//Incomming data DUMMY
$userID = $_GET['userId'];
$recipeID = $_GET['recipeId'];
$comment = $_GET['comment'];
$rating = $_GET['rating'];




//Return
$resultArr["message"] = "";

if($userID != "" || $recipeID != "" || $rating != ""){

    //Instance of object
    $rating = new Rating($userID, $rating, $comment);
    $rating->connection($db);
    $checkRating = $rating->createRating($recipeID);

    if($checkRating === "200"){
        // set response code - 200
        http_response_code(200);

        // tell the user no result found
        $resultArr["message"] = "Rating created";
        echo json_encode($resultArr);
    }else{
        // set response code - 500
        http_response_code(500);

        // tell the user no result found
        $resultArr["message"] = "Cant create rating";
        echo json_encode($resultArr);
    }
}else{
    // set response code - 403 Not found
    http_response_code(403);

    // tell the user no result found
    $resultArr["message"] = "Wrong Username or Password";
    echo json_encode($resultArr);
}


?>