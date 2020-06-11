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