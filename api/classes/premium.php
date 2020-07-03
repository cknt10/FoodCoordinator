<?php

class Premium{
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
     * @var int
     */
    private $duration;

    /**
     * @var float
     */
    private $netprice;
    /**
     * @var date
     */
    private $startDate;

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
    public function setId($id)
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
    public function setDescription($description)
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
    public function setDuration($duration)
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
    public function setNetprice($netprice)
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
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

        /**
     * Get load all formats
     *
     * @return array
     */
    public function fetchPremium()
    {
        $_result = array();

        $_query = "SELECT * FROM premium";

        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

        // execute query
        $_stmt->execute();

        $_num = $_stmt->rowCount();

        //If entry exists then Error
        if($_num > 0) {
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($_row = $_stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($_row);
                array_push($_result, array(
                    "id" => $Premium_ID,
                    "description" => $Premium_Descr,
                    "duration" => $Duration,
                    "netprice" => $Price,
                    "startDate" => $StartingDate
                ));

            }
        }
        return empty($_result) ? null : $_result;
    }

    /**
     * Returns this Objekt as Array
     * 
     * @return array
     */
    public function getObjectAsArray()
    {
        return array(
            "id" => $this->id,
            "description" => $this->description,
            "duration" => $this->duration,
            "netprice" => $this->netprice,
            "startDate" => $this->startDate,
        );
    }
}

?>