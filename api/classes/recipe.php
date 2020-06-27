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
     * @param  string  $_createdUser
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
     * Set the value of ratings
     *
     * @param  string  $_retings
     *
     * @return  self
     */ 
    public function setRatings($_ratings)
    {
        $this->ratings = $_ratings;

        return $this;
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
        $_unique = true;
        if(count($this->keywords) > 0){
            for($_i = 0; $_i < count($this->keywords); $_i++){
                if($this->keywords[$_i] == $_name && $_name != null){
                    $_unique = false;
                }
            }
        }

        if($_unique){
            array_push($this->keywords, $_name);
        }

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
     * Saves keywords to this recipe
     *
     * @param int $_id recipe id
     * @param array $_keywords
     *
     * @return string
     */
    public function createKeywords($_id, $_keywords)
    {
        //first entry
        $_result = "";

        try{
            $_sql='INSERT INTO recipeHasKeywords (R_ID, KW_ID) VALUES (:R_ID0, :KW_ID0)';

            for($_i = 1; $_i < count($_keywords); $_i++){
                $_sql = $_sql . ', (:R_ID' .strval($_i). ', :KW_ID'.strval($_i).')';
            }

            $_stmt= $this->conn->prepare($_sql);

            //bind params
            for($_i=0; $_i<count($_keywords); $_i++){
                $_stmt->bindParam(":R_ID".strval($_i), $_id);
                $_stmt->bindParam(":KW_ID".strval($_i), $_keywords[$_i]);
            }

            $_stmt->execute();
            $_result = "200";
        }catch(Eception $_e){
            $_result = $_e->getMessage();
        }


        return $_result;
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
        $_newIngredients = array();
        $_changes = false;

        if(count($this->ingredients) > 0){
            for($_i = 0; $_i < count($this->ingredients); $_i++){
                if($this->ingredients[$_i]["id"] != $_ingredient["id"] && $_ingredient["id"] != null){
                    array_push($_newIngredients, $this->ingredients[$_i]);
                    $_changes = true;
                }
            }
        }

        if($_changes){
            $this->ingredients = $_newIngredients;
        }
        return $this->ingredients;
    }

    /**
     * Add an rating to the recipe distinct
     *
     * @param Rating $ingredient
     *
     */
    public function addRating($_rating){
        $_unique = true;
        if(count($this->ratings) > 0){
            for($_i = 0; $_i < count($this->ratings); $_i++){
                if($this->ratings[$_i]["userId"] == $_rating["userId"] &&
                $this->ratings[$_i]["rating"] == $_rating["rating"] &&
                $this->ratings[$_i]["comment"] == $_rating["comment"] &&
                $_rating["userId"] != null &&
                $_rating["rating"] != null){
                    $_unique = false;
                }
            }
        }

        if($_unique){
            array_push($this->ratings, $_rating);
        }
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
     * Calculate and set rating from all ratings
     */
    public function calculateRating()
    {
        //TODO Dustin: Berechne anhand ratings in diesem Objekt das rating und setze es.
      $avg = 0;

      for ($_i = 0; $_i < count($this->ratings); $_i++){
        $avg = $avg + $this->ratings[$_i]["rating"];
      }
      $this->rating = $avg / count($this->ratings);
    }


    /**
     * Get load all keywords
     *
     * @return array
     */
    public function fetchKeywords()
    {
        $_result = array();
        $_query = "SELECT * FROM keywords";

        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

        // execute query
        $_stmt->execute();


        $_num = $_stmt->rowCount();

        //If entry exists then Error
        if($_num > 0) {
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($_row = $_stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($_row);
                array_push($_result, array(
                    "id" => $KW_ID,
                    "name" => $KW_NAME,
                ));

            }
        }
        return empty($_result) ? null : $_result;
    }

    /**
     * Create an recipe in the database
     *
     * @param $_title
     * @param $_picture
     * @param $_servings
     * @param $_description
     * @param $_instruction
     * @param $_creationDate
     * @param $_duration
     * @param $_difficulty
     * @param $_certified
     * @param $_lastChange
     * @param $_userId
     *
     * @return self
     */
    public function createRecipe($_title, $_picture, $_servings, $_description, $_instruction, $_creationDate, $_duration, $_difficulty, $_certified, $_lastChange, $_userId)
    {
        $_result = "";

        if($_title == null || $_creationDate == null || $_userId == null){
            return "403";
        }

        try{
            $_sql="INSERT INTO recipe (Title, Picture, Servings, R_Descr, Instruction, CreationDate, Duration, Difficulty, Certified, LastChange, U_ID) VALUES (:Title, :Picture, :Servings, :R_Descr, :Instruction, :CreationDate, :Duration, :Difficulty, :Certified, :LastChange, :U_ID)";
            $_stmt= $this->conn->prepare($_sql);


            // sanitize
            $_title=htmlspecialchars(strip_tags($_title));
            $_picture=htmlspecialchars(strip_tags($_picture));
            $_description=htmlspecialchars(strip_tags($_description));
            $_instruction=htmlspecialchars(strip_tags($_instruction));


            // bind values
            $_stmt->bindParam(":Title", $_title);
            $_stmt->bindParam(":Picture", $_picture);
            $_stmt->bindParam(":Servings", $_servings);
            $_stmt->bindParam(":R_Descr", $_description);
            $_stmt->bindParam(":Instruction", $_instruction);
            $_stmt->bindParam(":CreationDate", $_creationDate);
            $_stmt->bindParam(":Duration", $_duration);
            $_stmt->bindParam(":Difficulty", $_difficulty);
            $_stmt->bindParam(":Certified", $_certified);
            $_stmt->bindParam(":LastChange", $_lastChange);
            $_stmt->bindParam(":U_ID", $_userId);

            $_stmt->execute();
            $_result = "200";
        }catch(Eception $_e){
            $_result = $_e->getMessage();
        }


    }

    /**
     * Gets an recipe and sets the data to this object
     *
     * @param $_date creation date of this recipe
     * @param $_userId id from creation user
     * @param $_lastChange an optinal parameter
     * 
     * @return int the id of this recipe
     */
    public function fetchRecipe($_date, $_userId, $_lastChange = "")
    {
        $_result = -1;
        if($_lastChange === ""){
            $_sql = "SELECT * FROM recipe WHERE CreationDate = :CreationDate AND U_ID = :U_ID";
        }else{
            $_sql = "SELECT * FROM recipe WHERE CreationDate = :CreationDate AND U_ID = :U_ID AND LastChange = :LastChange";
        }
        

        $_stmt= $this->conn->prepare($_sql);

        // sanitize
        //$_date=htmlspecialchars(strip_tags($_date));

        // bind values
        $_stmt->bindParam(":CreationDate", $_date);
        $_stmt->bindParam(":U_ID", $_userId);
        if($_lastChange != ""){ $_stmt->bindParam(":LastChange", $_lastChange); }

        $_stmt->execute();

        $_num = $_stmt->rowCount();

        //If entry exists then Error
        if($_num > 0) {
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($_row = $_stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($_row);

                $this->id = $R_ID;
                $this->title = $Title;
                $this->picture = $Picture;
                $this->servings = $Servings;
                $this->description = $R_Descr;
                $this->instruction = $Instruction;
                $this->creationDate = $CreationDate;
                $this->duration = $Duration;
                $this->difficulty = $Difficulty;
                $this->certified = $Certified;
                $this->lastChange = $LastChange;
                $this->createdUser = $U_ID;
                $_result = $R_ID;

            }
        }

        return $_result;
    }

        /**
     * Gets an recipe and sets the data to this object
     * 
     * @param $_userId id from creation user
     * 
     * @return array
     */
    public function fetchAllRecipe($_userId)
    {
        $_sql = "SELECT * FROM recipe WHERE U_ID = :U_ID"; 

        $_stmt= $this->conn->prepare($_sql);

        $_stmt->bindParam(":U_ID", $_userId);

        $_stmt->execute();

        return $_stmt;
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
