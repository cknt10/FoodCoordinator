<?php

class Period{
    /**
     * @var PDO
     */
    private $conn;
    /**
     * @var int
     */
    private $duration;
    /**
     * @var string
     */
    private $unit;


    public function __construct($duration = 0, $unit = ""){
        $this->duration = $duration;
        $this->unit = $unit;
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
     * Get the value of duration
     *
     * @return  int
     */ 
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @param  int  $duration
     *
     * @return  self
     */ 
    public function setDuration($duration)
    {
        $this->duration = $duration;

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
     * Get this Object as Array for JSON import
     *
     * @return array
     */
    public function getObjectAsArray()
    {
        return array(
            "duration" => $this->duration,
            "unit" => $this->unit,
          );
    }
}

?>