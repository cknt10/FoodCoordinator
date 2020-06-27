<?php
include_once 'recipe.php';


class Favourite{
    /**
     * @var PDO
     */
    private $conn;
    /**
     * @var string
     */
    private $name;
    /**
     * @var array 
     */
    private $recipes;

    /**
     * @var date
     */
    private $date;

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
    public function setName($_name)
    {
    $this->name = $_name;

    return $this;
    }

    /**
     * Get $recipes
     *
     * @return  array
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
    public function setRecipes($_recipes)
    {
    $this->recipes = $_recipes;

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
    public function setDate($_date)
    {
    $this->date = $_date;

    return $this;
    }

    /**
     * Add unique recipe
     * 
     * @param Recipe $_recipe
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
     * Remove recipe
     * 
     * @param Recipe $_recipe
     * 
     * @return array
     */
    public function removeRecipe($_recipe)
    {
        $_newRecipes = array();
        $_changes = false;

        if(count($this->recipes) > 0){
            for($_i = 0; $_i < count($this->recipes); $_i++){
                if($this->recipes[$_i]["id"] != $_recipe["id"] && $_recipe["id"] != null){
                    array_push($_newRecipes, $this->recipes[$_i]);
                    $_changes = true;
                }
            }
        }

        if($_changes){
            $this->recipes = $_newRecipes;
        }
        return $this->recipes;
    }


    /**
     * Returns all Favorites for an user 
     * 
     * @param int $_userId
     */
    public function fetchFavourites($_userId)
    {
        $_result = array();
        $_result["groups"] = array();

        $_query = "SELECT * FROM favourites WHERE PU_ID = :PU_ID";
        $_index = -1;
        $_group = "";

        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

        //bind
        $_stmt->bindParam(":PU_ID", $_userId);

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

                if($_group === $FavGroup){
                    //Same group

                    $_newRecipe = array(
                        "recipeId" => $R_ID,
                        "date" => $FavDate,
                    );

                    array_push($_result[$_index]["recipes"], $_newRecipe);
                }else{
                    //new group
                    $_group = $FavGroup;
                    $_index++;

                    $_groupArray = array(
                        "groupName" => $FavGroup,
                        "recipes" => array(
                            "recipeId" => $R_ID,
                            "date" => $FavDate,
                        )
                    );
                    array_push($_result, $_groupArray);
                }

                // array_push($_result, array(
                //     "recipeId" => $R_ID,
                //     "date" => $FavDate,
                //     "groupName" => $FavGroup
                // ));
                
            }
        }
        return empty($_result["groups"]) ? null : $_result;
    }

    /**
     * Returns this Objekt as Array
     * 
     * @return array
     */
    public function getObjectAsArray()
    {
        return array(
            "name" => $this->name,
            "recipes" => empty($this->recipes) ? null : $this->recipes,
            "date" => $this->pageNumber,
        );
    }

}



?>