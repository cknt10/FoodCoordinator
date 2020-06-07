<?php
include_once 'nutrient.php';


class Ingredient{
    /**
     * @var PDO
     */
    private $_conn;
    /**
     * @var int
     */
    private $_id;
    /**
     * @var int
     */
    private $_amount;
    /**
     * @var string
     */
    private $_unit;
    /**
     * @var string
     */
    private $_description;
    /**
     * @var array
     */
    private $_nutrients = array();
    

    /**
     * standard constructor
     */
    public function __construct()
    {

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
     * Get the value of amount
     *
     * @return  int
     */ 
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * Set the value of amount
     *
     * @param  int  $amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->_amount = $amount;

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
     * Get the value of nutrients
     *
     * @return  array
     */ 
    public function getNutrients()
    {
        return $this->_nutrients;
    }

    /**
     * Get the value of alc
     *
     * @return  float
     */ 
    public function getAlc()
    {
        return $this->_alc;
    }

    /**
     * Set the value of alc
     *
     * @param  float  $alc
     *
     * @return  self
     */ 
    public function setAlc($alc)
    {
        $this->_alc = $alc;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Set the value of type
     *
     * @param  string  $type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->_type = $type;

        return $this;
    }

    /**
     * Set all Nutrients if not exists else it returns self
     * 
     * @param Nutrients $nutrients
     * 
     * @return self
     */
    public function addNutrient($nutrient){
        $unique = true;
        if(count($this->_nutrients) > 0){
            for($i = 0; $i < count($this->_nutrients); $i++){
                if($this->_nutrients[$i]["id"] == $nutrient["id"] && $nutrient["id"] != null){
                    $unique = false;
                }
            }
        }
        
        if($unique){
            array_push($this->_nutrients, $nutrient);
        }

        return $this;
    }

    /**
     * Sets a value to an specific Nutrion
     * 
     * @param string $name
     * @param float $value
     * 
     * @return self
     */
    public function changeNutrients($name, $value){
        $this->_nutrients[$name] = $value;
        return $this;
    }

    /**
     * Reset an Nutrion
     * 
     * @param string $name
     * 
     * @return self
     */
    public function removeNutrion($name){
        $_nutrient = $this->_nutrients[$name];

        $key= array_search($_nutrient, $this->_nutrients);
        if ($key !== false) {
            unset($this->_nutrients[$key]);
        };

        return $this->nutrients;
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
            "amount" => $this->_amount,
            "unit" => $this->_unit,
            "description" => $this->_description,
            "nutrients" => empty($this->_nutrients) ? null : $this->_nutrients, 
          );
    }

}


?>