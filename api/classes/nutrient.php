<?php

class Nutrient{
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
    private $description;
    /**
     * @var string
     */
    private $unit;
    /**
     * @var float
     */
    private $amount;
   
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
     * Get the value of unit
     *
     * @return  string
     */ 
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set the value of unit
     *
     * @param  string  $unit
     *
     * @return  self
     */ 
    public function setUnit($_unit)
    {
        $this->unit = $_unit;

        return $this;
    }

    /**
     * Get the value of amount
     *
     * @return  float
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @param  float  $amount
     *
     * @return  self
     */ 
    public function setAmount($_amount)
    {
        $this->amount = $_amount;

        return $this;
    }

    /**
     * Get this Object as Array for JSON import
     * 
     * @return array of this Class
     */
    public function getObjectAsArray()
    {
        return array(
            "id" => $this->id,
            "description" => $this->description,
            "amount" => $this->amount,
            "unit" => $this->unit,
        );

    }
}


?>