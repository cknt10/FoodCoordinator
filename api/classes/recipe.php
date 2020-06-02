<?php
include_once 'ingredient.php';
include_once 'period.php';
include_once 'rating.php';

class Recipe{
    /**
     * @var PDO
     */
    private $_conn;
    /**
     * @var int
     */
    private $_id;
    /**
     * @var string
     */
    private $_title;
    /**
     * @var string
     */
    private $_picture;
    /**
     * @var string
     */
    private $_description;
    /**
     * @var string
     */
    private $_instruction;
    /**
     * @var Period
     */
    private $_duration;
    /**
     * @var date
     */
    private $_creationDate;
    /**
     * @var date
     */
    private $_lastChange;
    /**
     * @var string
     */
    private $_difficulty;
    /**
     * @var float
     */
    private $_rating;
    /**
     * @var bool
     */
    private $_certified;
    /**
     * @var string[]
     */
    private $_keywords  = array();
    /**
     * @var Ingredient[]
     */
    private $_ingredients = array();
    /**
     * @var float
     */
    private $_servings;
    /**
     * @var string
     */
    private $_createdUser;
    /**
     * @var Rating[]
     */
    private $_ratings = array();


    /**
     * Fills Recipe with needed Information
     */
    public function __construct(){

    }

    /**
     * creates connection in class to database
     * 
     * @param $conn PDO
     */
    public function connection($conn)
    {
        $this->_conn = $conn;
    }
    

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->_title = $title;

        return $this;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */ 
    public function getPicture()
    {
        return $this->_picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->_picture = $picture;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->_description = $description;

        return $this;
    }

    /**
     * Get the value of instruction
     *
     * @return  string
     */ 
    public function getInstruction()
    {
        return $this->_instruction;
    }

    /**
     * Set the value of instruction
     *
     * @param  string  $instruction
     *
     * @return  self
     */ 
    public function setInstruction($instruction)
    {
        $this->_instruction = $instruction;

        return $this;
    }

    /**
     * Get the value of duration
     *
     * @return  Period
     */ 
    public function getDuration()
    {
        return $this->_duration;
    }

    /**
     * Set the value of duration
     *
     * @param  Period  $duration
     *
     * @return  self
     */ 
    public function setDuration($duration)
    {
        $this->_duration = $duration;

        return $this;
    }

    /**
     * Get the value of creationDate
     *
     * @return  date
     */ 
    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @param  date  $creationDate
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of lastChange
     *
     * @return  date
     */ 
    public function getLastChange()
    {
        return $this->_lastChange;
    }

    /**
     * Set the value of lastChange
     *
     * @param  date  $lastChange
     *
     * @return  self
     */ 
    public function setLastChange($lastChange)
    {
        $this->_lastChange = $lastChange;

        return $this;
    }

    /**
     * Get the value of difficulty
     *
     * @return  string
     */ 
    public function getDifficulty()
    {
        return $this->_difficulty;
    }

    /**
     * Set the value of difficulty
     *
     * @param  string  $difficulty
     *
     * @return  self
     */ 
    public function setDifficulty($difficulty)
    {
        $this->_difficulty = $difficulty;

        return $this;
    }

    /**
     * Get the value of rating
     *
     * @return  float
     */ 
    public function getRating()
    {
        return $this->_rating;
    }

    /**
     * Set the value of rating
     *
     * @param  float  $rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->_rating = $rating;

        return $this;
    }

    /**
     * Get the value of certified
     *
     * @return  bool
     */ 
    public function getCertified()
    {
        return $this->_certified;
    }

    /**
     * Set the value of certified
     *
     * @param  bool  $certified
     *
     * @return  self
     */ 
    public function setCertified($certified)
    {
        $this->_certified = $certified;

        return $this;
    }

    /**
     * Get the value of keywords
     *
     * @return  string[]
     */ 
    public function getKeywords()
    {
        return $this->_keywords;
    }

    /**
     * Set the value of keywords
     *
     * @param  string[]  $keywords
     *
     * @return  self
     */ 
    public function setKeywords($keywords)
    {
        $this->_keywords = $keywords;

        return $this;
    }

    

    /**
     * Get the value of ingredients
     *
     * @return  Ingredient[]
     */ 
    public function getIngredients()
    {
        return $this->_ingredients;
    }

    /**
     * Set the value of ingredients
     *
     * @param  Ingredient[]  $ingredients
     *
     * @return  self
     */ 
    public function setIngredients($ingredients)
    {
        $this->_ingredients = $ingredients;

        return $this;
    }

    

    /**
     * Get the value of servings
     *
     * @return  float
     */ 
    public function getServings()
    {
        return $this->_servings;
    }

    /**
     * Set the value of servings
     *
     * @param  float  $servings
     *
     * @return  self
     */ 
    public function setServings($servings)
    {
        $this->_servings = $servings;

        return $this;
    }

    /**
     * Get the value of createdUser
     *
     * @return  string
     */ 
    public function getCreatedUser()
    {
        return $this->_createdUser;
    }

    /**
     * Set the value of createdUser
     *
     * @param  string  $createdUser
     *
     * @return  self
     */ 
    public function setCreatedUser($createdUser)
    {
        $this->_createdUser = $createdUser;

        return $this;
    }

    /**
     * Get the value of ratings
     *
     * @return  Rating[]
     */ 
    public function getRatings()
    {
        return $this->_ratings;
    }

    /**
     * Change all Attributes in Recipe except id, created Date, certified, createdUser and ratings
     * 
     * @param Recipe $recipe
     * @param date $timestamp
     * 
     * @return self
     */
    public function changeRecipe($recipe, $timestamp){
        
        $this->_title = $recipe->getTitle();
        $this->_picture = $recipe->getPicture();
        $this->_description = $recipe->getDescription();
        $this->_instruction = $recipe->getInstruction();
        $this->_duration = $recipe->getDuration();
        $this->_lastChange = $timestamp;
        $this->_difficulty = $recipe->getDifficulty();
        $this->_rating = $recipe->getRating();
        $this->_keywords = $recipe->getKeywords();
        $this->_ingredients = $recipe->getIngredients();
        $this->_servings = $recipe->getServings();
        $this->_type = $recipe->getType();

        return $this;
    }

    /**
     * Add a new keyword to the array distinct
     * 
     * @param string $name
     * 
     * @return array
     */
    public function addKeyword($name){
        if(count($this->_keywords) > 0){
            if(in_array($name, $this->_keywords)){
                return $this->_keywords;
            }
        }
        array_push($this->_keywords, $name);

        return $this->_keywords;
    }

    /**
     * Remove Keyword from Keywords
     * 
     * @param string $name
     * 
     * @return string[]
     */
    public function removeKeyword($name){

        $key= array_search($name, $this->_keywords);
        if ($key !== false) {
            unset($this->_keywords[$key]);
        };

        return $this->_keywords;
    }

    /**
     * Add an ingredient to the recipe distinct
     * 
     * @param Ingredient $ingredient
     * 
     */
    public function addIngredient($ingredient){
        if(count($this->_ingredients) > 0){
            if(in_array($ingredient, $this->_ingredients)){
                return $this->_ingredients;
            }
        }
        array_push($this->_ingredients, $ingredient);
    }

    /**
     * Remove Ingredient from the Recipe
     * 
     * @param Ingredient $ingredient
     * 
     * @return Ingredient[]
     */
    public function removeIngredient($ingredient){
        $key= array_search($ingredient, $this->_ingredients);
        if ($key !== false) {
            unset($this->_ingredients[$key]);
        };

        return $this->_ingredients;
    }

    /**
     * Add an rating to the recipe distinct
     * 
     * @param Ingredient $ingredient
     * 
     */
    public function addRating($rating){
        if(count($this->_ratings) > 0){
            if(in_array($rating, $this->_ratings)){
                return $this->_ratings;
            }
        }
        array_push($this->_ratings, $rating);
    }

    /**
     * Remove Ingredient from the Recipe
     * 
     * @param Ingredient $ingredient
     * 
     * @return Ingredient[]
     */
    public function removeRating($rating){
        //TODO 
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
            "id" => $this->_id,
            "title" => $this->_title,
            "picture" => $this->_picture,
            "servings" => $this->_servings,
            "description" => $this->_description,
            "instruction" => $this->_instruction,
            "createionDate" => $this->_creationDate,
            "duration" => $this->_duration,
            "difficulty" => $this->_difficulty,
            "certified" => $this->_certified,
            "lastChangeDate" => $this->_lastChange,
            "userId" => $this->_createdUser,
            "keywords" => $this->_keywords,
            "rating" => $this->_rating,
            "ratings" => $this->_ratings,
            "ingredients" => $this->_ingredients,
          );
    }

}
?>