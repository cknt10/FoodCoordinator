<?php

class Rating{
    /**
     * @var PDO
     */
    private $conn;

    /**
     * @var int
     */
    private $userId;
    
    /**
     * @var float
     */
    private $rating;

    /**
     * @var string
     */
    private $comment;
    
    /**
     * Standardconstrustor
     * 
     * @param $userId
     * @param $rating
     * @param $comment
     */
    public function __construct($_userId = 0, $_rating = 0, $_comment = ""){
        $this->userId = $_userId;
        $this->rating = $_rating;
        $this->comment = $_comment;
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
     * Get the value of comment
     *
     * @return  string
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @param  string  $comment
     *
     * @return  self
     */ 
    public function setComment($_comment)
    {
        $this->comment = $_comment;

        return $this;
    }

    /**
     * Get the value of userId
     *
     * @return  int
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @param  int  $userId
     *
     * @return  self
     */ 
    public function setUserId($_userId)
    {
        $this->userId = $_userId;

        return $this;
    }

    /**
     * Creates rating to an recipe
     * 
     * @param int $_recipeId
     * 
     * @return string
     */
    public function createRating($_recipeId)
    {
        $_sql = "";
        $_result = "";


        try{
            $_sql="INSERT INTO rating (R_ID, U_ID, Comment, BananaAmount) VALUES (:R_ID, :U_ID, :Comment, :BananaAmount)";
            $_stmt= $this->conn->prepare($_sql);


            // sanitize
            $this->comment=htmlspecialchars(strip_tags($this->comment));



            // bind values
            $_stmt->bindParam(":R_ID", $_recipeId);
            $_stmt->bindParam(":U_ID", $this->userId);
            $_stmt->bindParam(":Comment", $this->comment);
            $_stmt->bindParam(":BananaAmount", $this->rating);
       

            $_stmt->execute();
            $_result = "200";
        }catch(Exception $_e){
            $_result = $_e->getMessage();
        }

        return $_result;
    }

    /**
     * Creates rating to an recipe
     * 
     * @param float $_ratingId
     * @param int $_userId
     * 
     * @return string
     */
    public function fetchRatings($_ratingId, $_userId)
    {
        $_result = array();
        $_query = "SELECT * FROM rating WHERE R_ID = :R_ID AND U_ID = :U_ID";

        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

        // sanitize
        //$_postcode=htmlspecialchars(strip_tags($_postcode));

        // bind values
        $_stmt->bindParam(":R_ID", $_ratingId);
        $_stmt->bindParam(":U_ID", $_userId);

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
                    "recipeId" => $R_ID,
                    "userId" => $U_ID,
                    "comment" => $Comment,
                    "rating" => $BananaAmount,
                ));
                
            }
        }
        return empty($_result) ? null : $_result;
    }
    /**
     * Get this Object as Array for JSON import
     * 
     * @return array
     */
    public function getObjectAsArray()
    {
        return array(
            'userId' => $this->userId,
            'rating' => $this->rating,
            'comment' => $this->comment,
        );
    }
}
?>