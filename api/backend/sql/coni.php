<?php

class Connection{


/**
 * Create an connection 
 */
public function connection()
{
    try {
        return new PDO('mysql:host=localhost;dbname=fluid_challenge', 'dsone', 'dsmSQL_19!');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}



}


?>