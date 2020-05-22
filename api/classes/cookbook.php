<?php
require_once('format.php');
require_once('recipe.php');


class Cookbook extends Format{

    /**
     * @var array $recipes;
     */
    private array $recipes;

    /**
     * @var string
     */
    private string $dedication;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var float
     */
    private float $price;

    


    /**
     * Get $recipe;
     *
     * @return  array
     */ 
    public function getRecipe()
    {
        return $this->recipes;
    }

    /**
     * Get the value of dedication
     *
     * @return  string
     */ 
    public function getDedication()
    {
        return $this->dedication;
    }

    /**
     * Set the value of dedication
     *
     * @param  string  $dedication
     *
     * @return  self
     */ 
    public function setDedication(string $dedication)
    {
        $this->dedication = $dedication;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     *
     * @return  self
     */ 
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Adds an recipe to the cookbook
     * 
     * @param Recipe $recipe
     */
    public function addRecipe(Recipe $recipe)
    {
        $this->recipes.push($recipe);
    }

    /**
     * Remove Recipe from your cookbook
     * 
     * @param Recipe $recipe
     * 
     * @return self
     */

     public function removeRecipe(Recipe $recipe)
     {
        $key= array_search($recipe, $this->recipes);
        if ($key !== false) {
            unset($this->recipes[$key]);
        };

        return $this;
     }
}



?>