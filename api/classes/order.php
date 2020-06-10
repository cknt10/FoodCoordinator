<?php

class Order{

    /**
     * @var int
     */
    private int $ordernumber;
    /**
     * @var int
     */
    private int $amount;
    /**
     * @var bool
     */
    private bool $gift;
    /**
     * @var string
     */
    private string $status;
    /**
     * @var string
     */
    private string $recipient;
    /**
     * @var string
     */
    private string $street;
    /**
     * @var int
     */
    private int $postcode;
    /**
     * @var string
     */
    private string $location;
    /**
     * @var array
     */
    private array $cookbook;
    /**
     * @var PaymentMethod
     */
    private PaymentMethod $payment;
    /**
     * @var float
     */
    private float $unitPrice;
    /**
     * @var date
     */
    private date $timestamp;
    







    /**
     * Get the value of ordernumber
     *
     * @return  int
     */ 
    public function getOrdernumber()
    {
        return $this->ordernumber;
    }

    /**
     * Set the value of ordernumber
     *
     * @param  int  $ordernumber
     *
     * @return  self
     */ 
    public function setOrdernumber(int $ordernumber)
    {
        $this->ordernumber = $ordernumber;

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
     * Get the value of gift
     *
     * @return  bool
     */ 
    public function getGift()
    {
        return $this->gift;
    }

    /**
     * Set the value of gift
     *
     * @param  bool  $gift
     *
     * @return  self
     */ 
    public function setGift(bool $gift)
    {
        $this->gift = $gift;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  string
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  string  $status
     *
     * @return  self
     */ 
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of recipient
     *
     * @return  string
     */ 
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set the value of recipient
     *
     * @param  string  $recipient
     *
     * @return  self
     */ 
    public function setRecipient(string $recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get the value of street
     *
     * @return  string
     */ 
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @param  string  $street
     *
     * @return  self
     */ 
    public function setStreet(string $street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get the value of postcode
     *
     * @return  int
     */ 
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set the value of postcode
     *
     * @param  int  $postcode
     *
     * @return  self
     */ 
    public function setPostcode(int $postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get the value of location
     *
     * @return  string
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @param  string  $location
     *
     * @return  self
     */ 
    public function setLocation(string $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of cookbook
     *
     * @return  array
     */ 
    public function getCookbook()
    {
        return $this->cookbook;
    }

    /**
     * Get the value of payment
     *
     * @return  PaymentMethod
     */ 
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set the value of payment
     *
     * @param  PaymentMethod  $payment
     *
     * @return  self
     */ 
    public function setPayment(PaymentMethod $payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get the value of unitPrice
     *
     * @return  float
     */ 
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Set the value of unitPrice
     *
     * @param  float  $unitPrice
     *
     * @return  self
     */ 
    public function setUnitPrice(float $unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get the value of timestamp
     *
     * @return  date
     */ 
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     *
     * @param  date  $timestamp
     *
     * @return  self
     */ 
    public function setTimestamp(date $timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Add an Cookbook to the Order
     * 
     * @param Cookbook $cookbook
     * 
     */
    public function addCookbook(Cookbook $cookbook)
    {
        $this->cookbook.push($cookbook);
    }

    /**
     * Remove youre Cookbook from Order
     * 
     * @param Cookbook $cookbook
     */
    public function removeCookbook(Cookbook $cookbook)
    {
        $key= array_search($cookbook, $this->cookbook);
        if ($key !== false) {
            unset($this->cookbook[$key]);
        };

        return $this->cookbook;
    }

    /**
     * Update youre order status
     * 
     * @param string $name
     * 
     * @return string
     */
    public function updateStatus(string $name)
    {
        
        //TODO

        return "";

    }

    /**
     * TODO: Needed?
     */
    public function print()
    {
        # code...
    }

    public function createOrder()
    {
       
    }

}


?>