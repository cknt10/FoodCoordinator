<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/reguser.php';
  
// instantiate database and product object
$database = new Connection();
$db = $database->connection();
  
// initialize object
$_user = new RegUser($db);
$_user->setUsername("dsone");
// query products
$stmt = $_user->login();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    //user array
    $result_arr=array();
    $_wrongPassword = "";
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $result_arr["user"] =array(
            'id' => $U_ID, 
            'username' => $Username,
            'email' => $Mail, 
            'firstname' => $FirstName, 
            'name' => $Name, 
            'birthday' => $Birthdady,
            'gender' => $Gender, 
            'street' => $Street
        );
        $_wrongPassword = $Password;

    }
    //Check Password
    //TODO
    if (password_verify($passwort, $_wrongPassword)) {
        $_SESSION['userid'] = $result_arr["user"]['id'];

        // set response code - 200 OK
        http_response_code(200);
    
        // show result data in json format
        echo json_encode($result_arr);
    } else {
        // set response code - 404 Not found
        http_response_code(403);
    
        // tell the user no result found
        echo json_encode(
            array("message" => "Wrong Username or Password")
        );
    }

}else{ // no result found will be here
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no result found
    echo json_encode(
        array("message" => "No User found.")
    );
}



?>