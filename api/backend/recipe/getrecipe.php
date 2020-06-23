<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../sql/coni.php';
include_once '../../classes/recipe.php';
include_once '../../classes/ingredient.php';
include_once '../../classes/keywords.php';

// instantiate database and product object
$database = new Connection();
$db = $database->connection();

$recipe = new Recipe();
$recipe->connection($db);
$ingredient = new Ingredient();
$ingredient->connection($db);



?>