<?php

class Gift{
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
    private $validity;

    /**
     * @var date
     */
    private $startDate;

    /**
     * @var bool
     */
    private $redeemed;



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
    public function setId(_$id)
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
     * Get the value of validity
     *
     * @return  int
     */ 
    public function getValidity()
    {
        return $this->validity;
    }

    /**
     * Set the value of validity
     *
     * @param  int  $validity
     *
     * @return  self
     */ 
    public function setValidity($_validity)
    {
        $this->validity = $_validity;

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
    public function setStartDate($_startDate)
    {
        $this->startDate = $_startDate;

        return $this;
    }

    /**
     * Get the value of redeemed
     *
     * @return  bool
     */ 
    public function getRedeemed()
    {
        return $this->redeemed;
    }

    /**
     * Set the value of redeemed
     *
     * @param  bool  $redeemed
     *
     * @return  self
     */ 
    public function setRedeemed($_redeemed)
    {
        $this->redeemed = $_redeemed;

        return $this;
    }

    /**
     * Get all gifts for an premium user
     * 
     * @param int $_premiumId
     * 
     * @return array 
     */
    public function fetchGifts($_premiumId)
    {
        $_result = array();
        $_sql = 'SELECT gift.G_ID AS G_ID, Gift_Descr, StartingDate, Validity, PU_ID, RedDate FROM gift INNER JOIN redeems ON gift.G_ID = redeems.G_ID WHERE PU_ID = :PU_ID';

        // prepare query statement
        $_stmt = $this->conn->prepare($_sql);

        //bind
        $_stmt->bindParam(":PU_ID", $_premiumId);

        // execute query
        $_stmt->execute();
        
        $num = $_stmt->rowCount();

        //If entry exists then Error
        if($num > 0) {
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($_row = $_stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($_row);

                //Split date from db
                $_dateStart = explode(' ', $StartingDate);
                $_dateEnd = explode(' ', $RedDate);

                //Check if he is still Premium
                $_date1 = $_dateStart[0];
                $_redeemed = 0;
                //$_redeemed = empty($_dateEnd) ? false : true;
 
                array_push($_result, array(
                    "id" => $G_ID,
                    "description" => $Gift_Descr,
                    "validity" => $Validity,
                    "startDate" => $_date1,
                    "redeemed" => $_redeemed,
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
            "validity" => $this->validity,
            "startDate" => $this->startDate,
            "redeemed" => $this->redeemed,
        );
    }
}

?>