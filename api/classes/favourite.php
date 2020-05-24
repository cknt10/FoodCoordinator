<?php
include_once 'recipe.php';


class Favourite{
/**
 * @var string $name
 */
private $name;
/**
 * @var Recipe[] $recipes
 */
private $recipes;

/**
 * @var date $date
 */
private $date;



/**
 * Get $name
 *
 * @return  string
 */ 
public function getName()
{
return $this->name;
}

/**
 * Set $name
 *
 * @param  string  $name  $name
 *
 * @return  self
 */ 
public function setName($name)
{
$this->name = $name;

return $this;
}

/**
 * Get $recipes
 *
 * @return  Recipe[]
 */ 
public function getRecipes()
{
return $this->recipes;
}

/**
 * Set $recipes
 *
 * @param  Recipe[]  $recipes  $recipes
 *
 * @return  self
 */ 
public function setRecipes($recipes)
{
$this->recipes = $recipes;

return $this;
}

/**
 * Get $date
 *
 * @return  date
 */ 
public function getDate()
{
return $this->date;
}

/**
 * Set $date
 *
 * @param  date  $date  $date
 *
 * @return  self
 */ 
public function setDate($date)
{
$this->date = $date;

return $this;
}

/**
 * 
 * @param Recipe $recipe
 */
public function addRecipe($recipe)
{
    $this->recipes.push($recipe);
}

/**
 * @param Recipe $recipe
 */
public function removeRecipe($recipe)
{
    $key= array_search($recipe, $this->recipes);
    if ($key !== false) {
        unset($this->recipes[$key]);
    };
}

}



?>