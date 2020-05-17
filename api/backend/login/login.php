<?php 
    require_once('../sql/coni.php');
    session_start();
    $pdoclass = new Connection();
    $pdo = $pdoclass->connection();

    $UName = 'dsone';

    $statement = $pdo->prepare("SELECT * FROM users WHERE UName = :UName");
    $result = $statement->execute(array('UName' => $UName));
    $user = $statement->fetch();
    //Überprüfung des Passworts
    if ($user !== false) {
        $_SESSION['userid'] = $user['UName'];
        $_SESSION['uid'] = $user['UID'];
        
        echo $user['UName'];
    } else {
        $errorMessage = "E-Mail oder Passwort war ung&uuml;ltig<br>";
    }

?>