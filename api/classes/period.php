<?php

class Period{
    /**
     * @var int
     */
    private int $duration;
    /**
     * @var string
     */
    private string $unit;


    public function __construct($duration = 0, $unit = ""){
        $this->duration = $duration;
        $this->unit = $unit;
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
    public function setDuration(int $duration)
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
    public function setUnit(string $unit)
    {
        $this->unit = $unit;

        return $this;
    }
}

?>