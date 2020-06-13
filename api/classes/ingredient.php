<?php
include_once 'nutrient.php';


class Ingredient{
    /**
     * @var PDO
     */
    private $conn;
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $amount;
    /**
     * @var string
     */
    private $unit;
    /**
     * @var string
     */
    private $description;
    /**
     * @var array
     */
    private $nutrients = array();
    

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
     * Get the value of amount
     *
     * @return  int
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @param  int  $amount
     *
     * @return  self
     */ 
    public function setAmount($_amount)
    {
        $this->amount = $_amount;

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
     * Get the value of nutrients
     *
     * @return  array
     */ 
    public function getNutrients()
    {
        return $this->nutrients;
    }

    /**
     * Get the value of alc
     *
     * @return  float
     */ 
    public function getAlc()
    {
        return $this->alc;
    }

    /**
     * Set the value of alc
     *
     * @param  float  $alc
     *
     * @return  self
     */ 
    public function setAlc($_alc)
    {
        $this->alc = $_alc;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  string  $type
     *
     * @return  self
     */ 
    public function setType($_type)
    {
        $this->type = $_type;

        return $this;
    }

    /**
     * Set all Nutrients if not exists else it returns self
     * 
     * @param Nutrients $nutrients
     * 
     * @return self
     */
    public function addNutrient($_nutrient){
        $_unique = true;
        if(count($this->nutrients) > 0){
            for($_i = 0; $_i < count($this->nutrients); $_i++){
                if($this->nutrients[$_i]["id"] == $_nutrient["id"] && $_nutrient["id"] != null){
                    $_unique = false;
                }
            }
        }
        
        if($_unique){
            array_push($this->nutrients, $_nutrient);
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
    public function changeNutrients($_name, $_value){
        $this->nutrients[$_name] = $_value;
        return $this;
    }

    /**
     * Reset an Nutrion
     * 
     * @param string $name
     * 
     * @return self
     */
    public function removeNutrion($_name){
        $_nutrient = $this->nutrients[$_name];

        $_key= array_search($_nutrient, $this->nutrients);
        if ($_key !== false) {
            unset($this->nutrients[$_key]);
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
            "id" => $this->id,
            "amount" => $this->amount,
            "unit" => $this->unit,
            "description" => $this->description,
            "nutrients" => empty($this->nutrients) ? null : $this->nutrients, 
          );
    }

}


?>