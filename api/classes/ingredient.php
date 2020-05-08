<?php
require_once('nutrients.php');


class Ingredient{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var int
     */
    private int $amount;
    /**
     * @var string
     */
    private string $unit;
    /**
     * @var string
     */
    private string $description;
    /**
     * @var Nutrients
     */
    private Nutrients $nutrients;
    /**
     * @var float
     */
    private float $alc;
    /**
     * @var string
     */
    private string $type;

    

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
    public function setId(int $id)
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
    public function setAmount(int $amount)
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
    public function setUnit(string $unit)
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
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of nutrients
     *
     * @return  Nutrients
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
    public function setAlc(float $alc)
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
    public function setType(string $type)
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
    public function createNutrients(Nutrients $nutrients){
        if($this->nutrients){ return $this;}
        $this->nutrients = $nutrients;
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
    public function changeNutrients(string $name, float $value){
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
    public function removeNutrion(string $name){
        $this->nutrients[$name] = null;
        return $this;
    }

}


?>