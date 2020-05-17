<?php 
    require_once('../sql/coni.php');
    session_start();
    header("Content-Type: application/json; charset=UTF-8");


    try {

        $pdoclass = new Connection();
        $pdo = $pdoclass->connection();

        $_userArray = array();
    
        $_statement = $pdo->prepare("SELECT * FROM user WHERE Username = ?");
        $_statement->execute(array($_username));

        $result = $_statement->fetchAll(PDO::FETCH_ASSOC);       

        //Format DATA
        for($_i = 0; $_i < sizeof($result); $_i++){
            $_userArray = array(
                'id' => $result[$_i]['U_ID'], 
                'email' => $result[$_i]['Mail'], 
                'name' => $result[$_i]['Username'], 
                'firstname' => $result[$_i]['FirstName'], 
                'name' => $result[$_i]['Name'], 
                'gender' => $result[$_i]['Gender'], 
                'street' => $result[$_i]['Street']
            );
        }
        
        echo json_encode($_userArray) . "\n";
        //echo json_encode($result) . "\n";
    } catch (\PDOException $e) {
        echo($e->getMessage());
    }


?>