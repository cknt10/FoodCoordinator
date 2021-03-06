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
    public function setOrdernumber($ordernumber)
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
    public function setAmount($amount)
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
    public function setGift($gift)
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
    public function setStatus($status)
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
    public function setRecipient($recipient)
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
    public function setStreet($street)
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
    public function setPostcode($postcode)
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
    public function setLocation($location)
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
    public function setPayment($payment)
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
    public function setUnitPrice($unitPrice)
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
    public function setTimestamp($timestamp)
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
    public function addCookbook($cookbook)
    {
        $this->cookbook.push($cookbook);
    }

    /**
     * Remove youre Cookbook from Order
     * 
     * @param Cookbook $cookbook
     */
    public function removeCookbook($cookbook)
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
    public function updateStatus($name)
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
     * Gets an recipe and sets the data to this object
     *
     * @param $_date creation date of this recipe
     * @param $_userId id from creation user
     * @param $_lastChange an optinal parameter
     * 
     * @return int the id of this recipe
     */
    public function fetchOrder($_date, $_userId)
    {
        $_result = -1;

        $_sql = "SELECT OrderNo FROM cBorder WHERE Timestamp = :Timestamp AND U_ID = :U_ID";

        $_stmt= $this->conn->prepare($_sql);

        // sanitize
        //$_date=htmlspecialchars(strip_tags($_date));

        // bind values
        $_stmt->bindParam(":Timestamp", $_date);
        $_stmt->bindParam(":U_ID", $_userId);

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

                $_result = $OrderNo;

            }
        }

        return $_result;
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
        $_result = $_e->getMessage();
       }
       
       return $_result;
    }


    /**
     * Create an connection from recipe to ingredients
     * 
     * @param int $_orderNumber
     * @param array $_multiarray input for ingredients
     * 
     * 
     */
    public function createOrderRecipe($_orderNumber, $_multiarray)
    {
        $_result = "";
        $_sql = null;
        $_stmt = null;
        try{
            //first entry
            $_sql='INSERT INTO orderRecipeList (OrderNo, R_ID) VALUES (:OrderNo0, :R_ID0)';

            //Add new values
            if(count($_multiarray)>1){
                for($_i = 1; $_i < count($_multiarray); $_i++){
                    $_sql = $_sql . ', (:OrderNo' .strval($_i). ', :R_ID'.strval($_i).')';
                }    
            }

            $_stmt= $this->conn->prepare($_sql);

            //bind params
            for($_i=0; $_i<count($_multiarray); $_i++){
                $_stmt->bindParam(":OrderNo".strval($_i), $_orderNumber);
                $_stmt->bindParam(":R_ID".strval($_i), $_multiarray[$_i]);
            }     
            
            $_stmt->execute();
            $_result = "200";
        }catch(Eception $_e){
            $_result = $_e->getMessage();
        }

        return $_result;
    }

        /**
     * Get this Object as Array for JSON import
     *
     * @return array
     */
    public function getObjectAsArray()
    {
        //TODOs
        //order ratings by Creation Date
        //order keywords
        //calculate ratins for this recipe
        return array(
            "ordernumber" => $this->ordernumber,
            "amount" => $this->amount,
            "gift" => $this->gift,
            "status" => $this->status,
            "recipient" => $this->recipient,
            "street" => $this->street,
            "postcode" => $this->postcode,
            "location" => $this->location,
            "cookbook" => $empty($this->cookbook) ? null : $this->cookbook,
            "payment" => $this->payment,
            "unitPrice" => $this->unitPrice,
            "timestamp" => $this->timestamp
          );
    }
}


?>