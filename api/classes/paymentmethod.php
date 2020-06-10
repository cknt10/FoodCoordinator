<?php
include_once 'paymentmeans.php';


class PaymentMethod{
    /**
     * @var PDO
     */
    private $conn;
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var PaymentMeans $paymentMeans
     */
    private $paymentMeans;

    

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
     * Get $id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set $id
     *
     * @param  int  $id  $id
     *
     * @return  self
     */ 
    public function setId($_id)
    {
        $this->id = $_id;

        return $this;
    }

    /**
     * Get $description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set $description
     *
     * @param  string  $description  $description
     *
     * @return  self
     */ 
    public function setDescription($_description)
    {
        $this->description = $_description;

        return $this;
    }

    /**
     * Get $paymentMeans
     *
     * @return  PaymentMeans
     */ 
    public function getPaymentMeans()
    {
        return $this->paymentMeans;
    }

    /**
     * Set $paymentMeans
     *
     * @param  PaymentMeans  $paymentMeans  $paymentMeans
     *
     * @return  self
     */ 
    public function setPaymentMeans($_paymentMeans)
    {
        $this->paymentMeans = $_paymentMeans;

        return $this;
    }

    /**
     * Get Paments from Database
     * 
     * 
     */
    public function fetchPayment()
    {
        $_query = "SELECT * FROM paymentMethod";
        $_paymentMeans = new PaymentMeans();
        $_result = array();

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
            while ($_row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($_row);

                $_paymentMeans->setId($PM_ID);
                $_paymentMeans->setDescription($PM_Descr);
                array_push($_result, $_paymentMeans->getObjectAsArray());
            }
        }

        return empty($_result) ? null : $_result;
    }


    /**
     * Change youre Payment
     * 
     * @param int $_id
     * @param string $_description
     */
    public function changePayment($_id, $_description)
    {
        $this->paymentMeans->setId($_id);
        $this->paymentMeans->setDescription($_description);

        return $this->paymentMeans;
    }

    /**
     * Get this Object as Array for JSON import
     * 
     * @return array of this Class
     */
    public function getObjectAsArray()
    {
        return array(
            // "id" => $this->_id,
            // "amount" => $this->_amount,
            // "unit" => $this->_unit,
            // "description" => $this->_description,
            // "nutrients" => empty($this->_nutrients) ? null : $this->_nutrients, 
          );
    }
}


?>