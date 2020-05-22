<?php
require_once('recipe.php');

class Newcomer{
    /**
     * @var Recipe[]
     */
    private array $recipes;


    public function __construct(){
        
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
}

?>