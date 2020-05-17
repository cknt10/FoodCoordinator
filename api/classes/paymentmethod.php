<?php
require_once('paymentmeans.php');

class PaymentMethod{

    /**
     * @var int $id
     */
    private int $id;

    /**
     * @var string $description
     */
    private string $description;

    /**
     * @var PaymentMeans $paymentMeans
     */
    private PaymentMeans $paymentMeans;

    



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
    public function setId(int $id)
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
    public function setDescription(string $description)
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
    public function setPaymentMeans(PaymentMeans $paymentMeans)
    {
        $this->paymentMeans = $paymentMeans;

        return $this;
    }


    /**
     * Change youre Payment
     * 
     * 
     */
    public function changePayment(string $name)
    {
        # code...
    }
}


?>