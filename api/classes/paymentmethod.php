<?php
include_once 'paymentmeans.php';


class PaymentMethod{
    /**
     * @var PDO
     */
    private $_conn;
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
    public function connection($conn)
    {
        $this->_conn = $conn;
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
    public function setId($id)
    {
        $this->id = $id;

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
    public function setDescription($description)
    {
        $this->description = $description;

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
    public function setPaymentMeans($paymentMeans)
    {
        $this->paymentMeans = $paymentMeans;

        return $this;
    }


    /**
     * Change youre Payment
     * 
     * 
     */
    public function changePayment($name)
    {
        if($name == "Paypal"){
            $this->paymentMeans = new Paypal();
        }else{
            $this->paymentMeans = new Creditcard();
        }
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