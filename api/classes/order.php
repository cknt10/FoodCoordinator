<?php

class Order{
    /**
     * @var POD
     */
    private $conn;
    /**
     * @var int
     */
    private $ordernumber;
    /**
     * @var int
     */
    private $amount;
    /**
     * @var bool
     */
    private $gift;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $recipient;
    /**
     * @var string
     */
    private $street;
    /**
     * @var int
     */
    private $postcode;
    /**
     * @var string
     */
    private $location;
    /**
     * @var array
     */
    private $cookbook;
    /**
     * @var PaymentMethod
     */
    private $payment;
    /**
     * @var float
     */
    private $unitPrice;
    /**
     * @var date
     */
    private $timestamp;
    




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

    /**
     * Insert an order into db
     * 
     * @param int $_userId
     * @param int $_cbId Cookbook Id
     * @param string $_cbTitle Cookbook Title
     * @param string $_dedication 
     * @param bool $_giftstatus is this a gift?
     * @param int $_amount amount of Cookbooks to deliver
     * @param string $_orderStatus
     * @param date $_timestamp order date
     * @param string $_recipient alternate person to deliver
     * @param string $_street deliver adress
     * @param int $_cityId id of the City in the database
     * @param int $_pmId id of the payment method 
     * 
     * @return string
     */
    public function createOrder($_userId, $_cbId, $_cbTitle, $_dedication, $_giftstatus, $_amount, $_orderStatus, $_timestamp, $_recipient, $_street, $_cityId, $_pmId)
    {
       $_result = "";
       if($_userId == null || $_cbId == null || $_cbTitle == null || $_dedication == null || 
       $_giftstatus == null || $_amount == null || $_orderStatus == null || $_timestamp == null || 
       $_recipient== null || $_street == null || $_cityId == null || $_pmId == null)
       { return "403";}

       try{
            $_query = "INSERT INTO cBorder (U_ID, CB_ID, BookTitle, Dedication, GiftStatus, Amount, OrderStatus, Timestamp, Recipient, Street, C_ID, PM_ID) VALUES (:U_ID, :CB_ID, :BookTitle, :Dedication, :GiftStatus, :Amount, :OrderStatus, :Timestamp, :Recipient, :Street, :C_ID, :PM_ID)";
            $_stmt= $this->conn->prepare($_query);

            // sanitize
            $_cbTitle=htmlspecialchars(strip_tags($_cbTitle));
            $_dedication=htmlspecialchars(strip_tags($_dedication));
            $_orderStatus=htmlspecialchars(strip_tags($_orderStatus));
            $_recipient=htmlspecialchars(strip_tags($_recipient));
            $_street=htmlspecialchars(strip_tags($_street));
            $_giftstatus = $_giftstatus == true ? 1 : 0;

            // bind values
            $_stmt->bindParam(":U_ID", $_userId);
            $_stmt->bindParam(":CB_ID", $_cbId);
            $_stmt->bindParam(":BookTitle", $_cbTitle);
            $_stmt->bindParam(":Dedication", $_dedication);
            $_stmt->bindParam(":GiftStatus", $_giftstatus);
            $_stmt->bindParam(":Amount", $_amount);
            $_stmt->bindParam(":OrderStatus", $_orderStatus);
            $_stmt->bindParam(":Timestamp", $_timestamp);
            $_stmt->bindParam(":Recipient", $_recipient);
            $_stmt->bindParam(":Street", $_street);
            $_stmt->bindParam(":C_ID", $_cityId);
            $_stmt->bindParam(":PM_ID", $_pmId);

            $_stmt->execute();
            $_result = "200";
       }catch(Eception $_e){
        $_result = $_e-getMessage();
       }
       
       return $_result;
    }

}


?>