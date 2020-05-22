<?php

class Connection{


/**
 * Create an connection 
 */
public function connection()
{
    $this->conn = null;
    
    try {
        $this->conn =  new PDO('mysql:host=localhost;dbname=FoodCoordinator', 'usr4FC', 'Usr4FC#20!',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ));
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    return $this->conn;
}



}


?>