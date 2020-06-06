<?php

class Nutrient{
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
    private $_description;
    /**
     * @var string
     */
    private $_unit;
    /**
     * @var float
     */
    private $_amount;
   
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
     * Get the value of unit
     *
     * @return  string
     */ 
    public function getUnit()
    {
        return $this->_unit;
    }

    /**
     * Set the value of unit
     *
     * @param  string  $unit
     *
     * @return  self
     */ 
    public function setUnit($unit)
    {
        $this->_unit = $unit;

        return $this;
    }

    /**
     * Get the value of amount
     *
     * @return  float
     */ 
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * Set the value of amount
     *
     * @param  float  $amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->_amount = $amount;

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
            "id" => $this->_id,
            "description" => $this->_description,
            "amount" => $this->_amount,
            "unit" => $this->_unit,
        );

    }
}


?>