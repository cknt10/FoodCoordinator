<?php
require_once('ingredient.php');
require_once('period.php');
require_once('rating.php');

class Recipe{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $title;
    /**
     * @var string
     */
    private string $picture;
    /**
     * @var string
     */
    private string $description;
    /**
     * @var string
     */
    private string $instruction;
    /**
     * @var Period
     */
    private Period $duration;
    /**
     * @var date
     */
    private date $creationDate;
    /**
     * @var date
     */
    private date $lastChange;
    /**
     * @var string
     */
    private string $difficulty;
    /**
     * @var float
     */
    private float $rating;
    /**
     * @var bool
     */
    private bool $certified;
    /**
     * @var string[]
     */
    private array $keywords;
    /**
     * @var Ingredient[]
     */
    private array $ingredients;
    /**
     * @var float
     */
    private float $servings;
    /**
     * @var string
     */
    private string $type;
    /**
     * @var string
     */
    private string $createdUser;
    /**
     * @var Rating[]
     */
    private array $ratings;


    /**
     * Fills Recipe with needed Information
     */
    public function __construct($id,
    $creationDate,
    $ratings,
    $title = null,
    $picture = null,
    $description = null,
    $instruction = null,
    $duration = null,
    $lastChange = null,
    $difficulty = null,
    $rating = null,
    $certified = null,
    $keywords = null,
    $ingredients = null,
    $servings = null,
    $type = null,
    $createdUser = null
    
    ){

        $this->id = $id;
        $this->title = $title;
        $this->picture = $picture;
        $this->description = $description;
        $this->instruction = $instruction;
        $this->duration = $duration;
        $this->creationDate = $creationDate;
        $this->lastChange = $lastChange;
        $this->difficulty = $difficulty;
        $this->rating = $rating;
        $this->certified = $certified;
        $this->keywords = $keywords;
        $this->ingredients = $ingredients;
        $this->servings = $servings;
        $this->type = $type;
        $this->createdUser = $createdUser;
        $this->ratings = $ratings;
    }

    

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

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
     * Get the value of picture
     *
     * @return  string
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     *
     * @return  self
     */ 
    public function setPicture(string $picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of instruction
     *
     * @return  string
     */ 
    public function getInstruction()
    {
        return $this->instruction;
    }

    /**
     * Set the value of instruction
     *
     * @param  string  $instruction
     *
     * @return  self
     */ 
    public function setInstruction(string $instruction)
    {
        $this->instruction = $instruction;

        return $this;
    }

    /**
     * Get the value of duration
     *
     * @return  Period
     */ 
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @param  Period  $duration
     *
     * @return  self
     */ 
    public function setDuration(Period $duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of creationDate
     *
     * @return  date
     */ 
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @param  date  $creationDate
     *
     * @return  self
     */ 
    public function setCreationDate(date $creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of lastChange
     *
     * @return  date
     */ 
    public function getLastChange()
    {
        return $this->lastChange;
    }

    /**
     * Set the value of lastChange
     *
     * @param  date  $lastChange
     *
     * @return  self
     */ 
    public function setLastChange(date $lastChange)
    {
        $this->lastChange = $lastChange;

        return $this;
    }

    /**
     * Get the value of difficulty
     *
     * @return  string
     */ 
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set the value of difficulty
     *
     * @param  string  $difficulty
     *
     * @return  self
     */ 
    public function setDifficulty(string $difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get the value of rating
     *
     * @return  float
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @param  float  $rating
     *
     * @return  self
     */ 
    public function setRating(float $rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of certified
     *
     * @return  bool
     */ 
    public function getCertified()
    {
        return $this->certified;
    }

    /**
     * Set the value of certified
     *
     * @param  bool  $certified
     *
     * @return  self
     */ 
    public function setCertified(bool $certified)
    {
        $this->certified = $certified;

        return $this;
    }

    /**
     * Get the value of keywords
     *
     * @return  string[]
     */ 
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set the value of keywords
     *
     * @param  string[]  $keywords
     *
     * @return  self
     */ 
    public function setKeywords(array $keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    

    /**
     * Get the value of ingredients
     *
     * @return  Ingredient[]
     */ 
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Set the value of ingredients
     *
     * @param  Ingredient[]  $ingredients
     *
     * @return  self
     */ 
    public function setIngredients(array $ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    

    /**
     * Get the value of servings
     *
     * @return  float
     */ 
    public function getServings()
    {
        return $this->servings;
    }

    /**
     * Set the value of servings
     *
     * @param  float  $servings
     *
     * @return  self
     */ 
    public function setServings(float $servings)
    {
        $this->servings = $servings;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  string  $type
     *
     * @return  self
     */ 
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of createdUser
     *
     * @return  string
     */ 
    public function getCreatedUser()
    {
        return $this->createdUser;
    }

    /**
     * Set the value of createdUser
     *
     * @param  string  $createdUser
     *
     * @return  self
     */ 
    public function setCreatedUser(string $createdUser)
    {
        $this->createdUser = $createdUser;

        return $this;
    }

    /**
     * Get the value of ratings
     *
     * @return  Rating[]
     */ 
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * Change all Attributes in Recipe except id, created Date, certified, createdUser and ratings
     * 
     * @param Recipe $recipe
     * @param date $timestamp
     * 
     * @return self
     */
    public function changeRecipe(Recipe $recipe, date $timestamp){
        
        $this->title = $recipe->getTitle();
        $this->picture = $recipe->getPicture();
        $this->description = $recipe->getDescription();
        $this->instruction = $recipe->getInstruction();
        $this->duration = $recipe->getDuration();
        $this->lastChange = $timestamp;
        $this->difficulty = $recipe->getDifficulty();
        $this->rating = $recipe->getRating();
        $this->keywords = $recipe->getKeywords();
        $this->ingredients = $recipe->getIngredients();
        $this->servings = $recipe->getServings();
        $this->type = $recipe->getType();

        return $this;
    }

    /**
     * Add a new Keyword to the Array
     * 
     * @param string $name
     * 
     * @return array
     */
    public function addKeyword(string $name){
        $this->keywords.push($name);

        return $this->keywords;
    }

    /**
     * Remove Keyword from Keywords
     * 
     * @param string $name
     * 
     * @return string[]
     */
    public function removeKeyword(string $name){

        $key= array_search($name, $this->keywords);
        if ($key !== false) {
            unset($this->keywords[$key]);
        };

        return $this->keywords;
    }

    /**
     * Add an Ingredient to the Recipe
     * 
     * @param Ingredient $ingredient
     * 
     */
    public function addIngredient(Ingredient $ingredient){
        $this->ingredients.push($ingredient);
    }

    /**
     * Remove Ingredient from the Recipe
     * 
     * @param Ingredient $ingredient
     * 
     * @return Ingredient[]
     */
    public function removeIngredient(Ingredient $ingredient){
        $key= array_search($ingredient, $this->ingredients);
        if ($key !== false) {
            unset($this->ingredients[$key]);
        };

        return $this->ingredients;
    }

}
?>