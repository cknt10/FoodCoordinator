<?php
include_once 'nutrient.php';


class Ingredient{
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
    private $nutrients;
    /**
     * @var float
     */
    private $alc;
    /**
     * @var string
     */
    private $type;

    

    /**
     * Standard Constructor only ID needed to create this class
     */
    public function __construct(int $id, int $amount = null, string $unit = "", string $description = "", Nutrients $nutrients = null, float $alc = null, string $type ="")
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->unit = $unit;
        $this->description = $description;
        $this->nutrients = $nutrients;
        $this->alc = $alc;
        $this->type = $type;
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
    public function setId($id)
    {
        $this->id = $id;

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
    public function setAmount($amount)
    {
        $this->amount = $amount;

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
    public function setUnit($unit)
    {
        $this->unit = $unit;

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
    public function setDescription($description)
    {
        $this->description = $description;

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
    public function setAlc($alc)
    {
        $this->alc = $alc;

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
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set all Nutrients if not exists else it returns self
     * 
     * @param Nutrients $nutrients
     * 
     * @return self
     */
    public function createNutrients($nutrient){
        if($this->nutrients){ return $this;}
        $this->nutrients.push($nutrient);
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
        $this->nutrients[$name] = $value;
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
        $_nutrient = $this->nutrients[$name];

        $key= array_search($_nutrient, $this->nutrients);
        if ($key !== false) {
            unset($this->nutrients[$key]);
        };

        return $this->nutrients;
    }

}


?>