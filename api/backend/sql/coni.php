<?php

class Connection extends POD{


/**
 * Create an connection 
 */
public function __construct()
{
    parant::__construct('mysql:host=localhost;dbname=FoodCoord', 'usr4FC', 'Usr4FC#20!');

}



}


?>