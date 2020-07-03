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
    public function addRecipe($_recipe)
    {
        $_unique = true;
        if(count($this->recipes) > 0){
            for($_i = 0; $_i < count($this->recipes); $_i++){
                if($this->recipes[$_i]["id"] == $_recipe["id"] && $_recipe["id"] != null){
                    $_unique = false;
                }
            }
        }

        if($_unique){
            array_push($this->recipes, $_recipe);
        }
    }

    /**
     * Remove Recipe from your cookbook
     * 
     * @param Recipe $recipe
     * 
     * @return self
     */

     public function removeRecipe($_recipe)
     {
        $_recipies = array();
        $_changes = false;

        if(count($this->recipes) > 0){
            for($_i = 0; $_i < count($this->recipes); $_i++){
                if($this->recipes[$_i]["id"] != $_recipe["id"] && $_recipe["id"] != null){
                    array_push($_recipies, $this->recipes[$_i]);
                    $_changes = true;
                }
            }
        }

        if($_changes){
            $this->ingredients = $_recipies;
        }

        return $this;
     }
}



?>