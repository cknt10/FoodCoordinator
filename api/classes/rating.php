<?php

class Rating{
    /**
     * @var float
     */
    private float $rating;

    /**
     * @var string
     */
    private string $comment;
    
    public function __construct($rating = 0, $comment = ""){
        $this->rating = $rating;
        $this->comment = $comment;
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
    public function setComment(string $comment)
    {
        $this->comment = $comment;

        return $this;
    }
}
?>