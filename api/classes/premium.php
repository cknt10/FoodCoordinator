<?php

class Premium{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var int
     */
    private int $duration;

    /**
     * @var float
     */
    private float $netprice;
    /**
     * @var date
     */
    private date $startDate;

    

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
     * Get the value of netprice
     *
     * @return  float
     */ 
    public function getNetprice()
    {
        return $this->netprice;
    }

    /**
     * Set the value of netprice
     *
     * @param  float  $netprice
     *
     * @return  self
     */ 
    public function setNetprice(float $netprice)
    {
        $this->netprice = $netprice;

        return $this;
    }

    /**
     * Get the value of startDate
     *
     * @return  date
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @param  date  $startDate
     *
     * @return  self
     */ 
    public function setStartDate(date $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }
}

?>