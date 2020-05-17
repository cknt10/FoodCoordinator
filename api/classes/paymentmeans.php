<?php

interface PaymentMeans
{

    public function getName();
    public function setName(string $name);

}

class Paypal implements PaymentMeans{

    /**
     * @var string $name
     */
    private string $name;

    /**
     * @var string $email
     */
    private string $email;
    



    /**
     * Get $name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set $name
     *
     * @param  string  $name  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    

    /**
     * Get $email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set $email
     *
     * @param  string  $email  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

}



class Creditcard implements PaymentMeans{

    /**
     * @var string $name
     */
    private string $name;

    /**
     * @var int $knumber
     */
    private int $knumber;
    
    /**
     * @var date $validity
     */
    private date $validity;

    /**
     * @var int $cvc
     */
    private int $cvc;


    /**
     * Get $name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set $name
     *
     * @param  string  $name  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    

    /**
     * Get $knumber
     *
     * @return  int
     */ 
    public function getKnumber()
    {
            return $this->knumber;
    }

    /**
     * Set $knumber
     *
     * @param  int  $knumber  $knumber
     *
     * @return  self
     */ 
    public function setKnumber(int $knumber)
    {
            $this->knumber = $knumber;

            return $this;
    }

    /**
     * Get $validity
     *
     * @return  date
     */ 
    public function getValidity()
    {
            return $this->validity;
    }

    /**
     * Set $validity
     *
     * @param  date  $validity  $validity
     *
     * @return  self
     */ 
    public function setValidity(date $validity)
    {
            $this->validity = $validity;

            return $this;
    }

    /**
     * Get $cvc
     *
     * @return  int
     */ 
    public function getCvc()
    {
            return $this->cvc;
    }

    /**
     * Set $cvc
     *
     * @param  int  $cvc  $cvc
     *
     * @return  self
     */ 
    public function setCvc(int $cvc)
    {
            $this->cvc = $cvc;

            return $this;
    }
}



?>