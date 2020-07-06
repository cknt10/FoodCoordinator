<?php
require_once('recipe.php');

class Newcomer{
    /**
     * @var PDO
     */

    private $conn;
    /**
     * @var Recipe[]
     */
    private array $recipes;


    public function __construct(){
        
    }

    /**
     * creates connection in class to database
     *
     * @param $conn PDO
     */
    public function connection($_conn)
    {
        $this->conn = $_conn;
    }

    /**
     * Get the value of recipes
     *
     * @return  Recipe[]
     */ 
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
     * Set the value of recipes
     *
     * @param  Recipe[]  $recipes
     *
     * @return  self
     */ 
    public function setRecipes(array $recipes)
    {
        $this->recipes = $recipes;

        return $this;
    }

        /**
     * Get this Object as Array for JSON import
     *
     * @return array
     */
    public function getObjectAsArray()
    {
        //TODOs
        //order ratings by Creation Date
        //order keywords
        //calculate ratins for this recipe
        return array(
            "id" => emtpy($this->recipes) ? null : $this->recipes
          );
    }
}

?>