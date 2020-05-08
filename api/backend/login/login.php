<?php 
require_once('../sql/coni.php');
session_start();
$pdo = new Connection();


class Login{

    public function login()
    {
        if(isset($_GET['login'])) {
            $email = $_POST['email'];
            $passwort = $_POST['passwort'];
            
            $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $result = $statement->execute(array('email' => $email));
            $user = $statement->fetch();
                
            //Überprüfung des Passworts
            if ($user !== false && password_verify($passwort, $user['passwort'])) {
                $_SESSION['userid'] = $user['id'];
                return json_encode($user);
            } else {
                return http_response_code(404);
            }
    }

}

    
}

$LOGIN = new Login;
header('Content-Type: application/json');
echo $LOGIN->login();


?>