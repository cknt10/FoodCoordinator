<?php

class Rating{
    /**
     * @var PDO
     */
    private $_conn;

    /**
     * @var int
     */
    private $_userId;
    
    /**
     * @var float
     */
    private $_rating;

    /**
     * @var string
     */
    private $_comment;
    
    /**
     * Standardconstrustor
     * 
     * @param $userId
     * @param $rating
     * @param $comment
     */
    public function __construct($userId = 0, $rating = 0, $comment = ""){
        $this->_userId = $userId;
        $this->_rating = $rating;
        $this->_comment = $comment;
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
     * Get the value of comment
     *
     * @return  string
     */ 
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * Set the value of comment
     *
     * @param  string  $comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->_comment = $comment;

        return $this;
    }

    /**
     * Get the value of userId
     *
     * @return  int
     */ 
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * Set the value of userId
     *
     * @param  int  $userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->_userId = $userId;

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
            'userId' => $this->_userId,
            'rating' => $this->_rating,
            'comment' => $this->_comment,
        );
    }
}
?>