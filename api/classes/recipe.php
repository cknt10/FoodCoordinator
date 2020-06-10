<?php
include_once 'ingredient.php';
include_once 'period.php';
include_once 'rating.php';

class Recipe{
    /**
     * @var PDO
     */
    private $conn;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $instruction;
    /**
     * @var Period
     */
    private $duration;
    /**
     * @var date
     */
    private $creationDate;
    /**
     * @var date
     */
    private $lastChange;
    /**
     * @var string
     */
    private $difficulty;
    /**
     * @var float
     */
    private $rating;
    /**
     * @var bool
     */
    private $certified;
    /**
     * @var string[]
     */
    private $keywords  = array();
    /**
     * @var Ingredient[]
     */
    private $ingredients = array();
    /**
     * @var float
     */
    private $servings;
    /**
     * @var string
     */
    private $createdUser;
    /**
     * @var Rating[]
     */
    private $ratings = array();


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
    public function connection($_conn)
    {
        $this->conn = $_conn;
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
    public function setId($_id)
    {
        $this->id = $_id;

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
    public function setTitle($_title)
    {
        $this->title = $_title;

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
    public function setPicture($_picture)
    {
        $this->picture = $_picture;

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
    public function setDescription($_description)
    {
        $this->description = $_description;

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
    public function setInstruction($_instruction)
    {
        $this->instruction = $_instruction;

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
    public function setDuration($_duration)
    {
        $this->duration = $_duration;

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
    public function setCreationDate($_creationDate)
    {
        $this->creationDate = $_creationDate;

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
    public function setLastChange($_lastChange)
    {
        $this->lastChange = $_lastChange;

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
    public function setDifficulty($_difficulty)
    {
        $this->difficulty = $_difficulty;

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
    public function setRating($_rating)
    {
        $this->rating = $_rating;

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
    public function setCertified($_certified)
    {
        $this->certified = $_certified;

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
    public function setKeywords($_keywords)
    {
        $this->keywords = $_keywords;

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
    public function setIngredients($_ingredients)
    {
        $this->ingredients = $_ingredients;

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
    public function setServings($_servings)
    {
        $this->servings = $_servings;

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
    public function setCreatedUser($_createdUser)
    {
        $this->createdUser = $_createdUser;

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
    public function changeRecipe($_recipe, $_timestamp){
        
        $this->title = $_recipe->getTitle();
        $this->picture = $_recipe->getPicture();
        $this->description = $_recipe->getDescription();
        $this->instruction = $_recipe->getInstruction();
        $this->duration = $_recipe->getDuration();
        $this->lastChange = $_timestamp;
        $this->difficulty = $_recipe->getDifficulty();
        $this->rating = $_recipe->getRating();
        $this->keywords = $_recipe->getKeywords();
        $this->ingredients = $_recipe->getIngredients();
        $this->servings = $_recipe->getServings();
        $this->type = $_recipe->getType();

        return $this;
    }

    /**
     * Add a new keyword to the array distinct
     * 
     * @param string $name
     * 
     * @return array
     */
    public function addKeyword($_name){
        if(count($this->keywords) > 0){
            if(inarray($_name, $this->keywords)){
                return $this->keywords;
            }
        }
        array_push($this->keywords, $_name);

        return $this->keywords;
    }

    /**
     * Remove Keyword from Keywords
     * 
     * @param string $name
     * 
     * @return string[]
     */
    public function removeKeyword($_name){

        $_key= array_search($_name, $this->keywords);
        if ($_key !== false) {
            unset($this->keywords[$_key]);
        };

        return $this->keywords;
    }

    /**
     * Add an ingredient to the recipe distinct
     * 
     * @param Ingredient $ingredient
     * 
     */
    public function addIngredient($_ingredient){
        $_unique = true;
        if(count($this->ingredients) > 0){
            for($_i = 0; $_i < count($this->ingredients); $_i++){
                if($this->ingredients[$_i]["id"] == $_ingredient["id"] && $_ingredient["id"] != null){
                    $_unique = false;
                }
            }
        }
        
        if($_unique){
            array_push($this->ingredients, $_ingredient);
        }
    }

    /**
     * Remove Ingredient from the Recipe
     * 
     * @param Ingredient $ingredient
     * 
     * @return Ingredient[]
     */
    public function removeIngredient($_ingredient){
        $this->ingredients = array_diff($this->ingredients, $_ingredient);

        return $this->ingredients;
    }

    /**
     * Add an rating to the recipe distinct
     * 
     * @param Rating $ingredient
     * 
     */
    public function addRating($_rating){
        if(count($this->ratings) > 0){
            if(in_array($_rating, $this->ratings)){
                return $this->ratings;
            }
        }
        array_push($this->ratings, $_rating);
    }

    /**
     * Remove Ingredient from the Recipe
     * 
     * @param Rating $ingredient
     * 
     * @return Rating[]
     */
    public function removeRating($_rating){
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
            "id" => $this->id,
            "title" => $this->title,
            "picture" => $this->picture,
            "servings" => $this->servings,
            "description" => $this->description,
            "instruction" => $this->instruction,
            "createionDate" => $this->creationDate,
            "duration" => $this->duration,
            "difficulty" => $this->difficulty,
            "certified" => $this->certified,
            "lastChangeDate" => $this->lastChange,
            "userId" => $this->createdUser,
            "keywords" => empty($this->keywords) ? null : $this->keywords,
            "rating" => $this->rating,
            "ratings" => empty($this->ratings) ? null : $this->ratings,
            "ingredients" =>  empty($this->ingredients) ? null : $this->ingredients,
          );
    }

}
?>