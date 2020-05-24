<?php
include_once 'reguser.php';
include_once 'favourite.php';
include_once 'premium.php';

class PremiumUser extends RegUser{
    // database connection and table name
    /**
     * @var POD
     */
    private $_conn;

    /**
     * @var int $premiumId
     */
    private $_premiumId;

    /**
     * @var array $premium
     */
    private $_premium;

    /**
     * @var array $gifts
     */
    private $_gifts;

    /**
     * @var array $favourites
     */
    private $_favourites;

    /**
     * @var bool $payed Check if this User payed his Premium
     */
    private $_payed;

    /**
     * @var date 
     */
    private $_startDate;

    // constructor with $db as database connection
    public function __construct($db){
        parent::__construct($db);
        $this->_conn = $db;
    }

    /**
     * Get $premiumId
     *
     * @return  int
     */ 
    public function getPremiumId()
    {
        return $this->_premiumId;
    }

    /**
     * Set $premiumId
     *
     * @param  int  $premiumId  $premiumId
     *
     * @return  self
     */ 
    public function setPremiumId($premiumId)
    {
        $this->_premiumId = $premiumId;

        return $this;
    }

    /**
     * Get $premium
     *
     * @return  array
     */ 
    public function getPremium()
    {
        return $this->_premium;
    }

    /**
     * Set $premium
     *
     * @param  array  $premium  $premium
     *
     * @return  self
     */ 
    public function setPremium($premium)
    {
        $this->_premium = $premium;

        return $this;
    }

    /**
     * Get $gifts
     *
     * @return  array
     */ 
    public function getGifts()
    {
        return $this->_gifts;
    }

    /**
     * Set $gifts
     *
     * @param  array  $gifts  $gifts
     *
     * @return  self
     */ 
    public function setGifts($gifts)
    {
        $this->_gifts = $gifts;

        return $this;
    }

    /**
     * Get $favourites
     *
     * @return  array
     */ 
    public function getFavourites()
    {
        return $this->_favourites;
    }

    /**
     * Get $payed Check if this User payed his Premium
     *
     * @return  bool
     */ 
    public function getPayed()
    {
        return $this->_payed;
    }

    /**
     * Set $payed Check if this User payed his Premium
     *
     * @param  bool  $payed  $payed Check if this User payed his Premium
     *
     * @return  self
     */ 
    public function setPayed($payed)
    {
        $this->_payed = $payed;

        return $this;
    }

    /**
     * Get the value of startDate
     *
     * @return  date
     */ 
    public function getStartDate()
    {
        return $this->_startDate;
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
        $this->_startDate = $startDate;

        return $this;
    }

    /**
     * @param int $id
     * @param date $timestamp
     * 
     * @return Gift
     */
    public function getGift($id, $timestamp)
    {
        $gift = $this->_gifts[$id];
        //TODO:......

        return $gift;
    }

    /**
     * Add Favourite to Array
     * 
     * @param Favourite $favourite
     */
    public function addFavourite(Favourite $favourite)
    {
        $this->_favourites.push($favourite);
    }

    /**
     * Remove Favourite from Array
     * 
     * @param Favourite $favourite
     * 
     * @return array of Favourites
     */
    public function removeFavourite($favourite)
    {
        $key= array_search($favourite, $this->_favourites);
        if ($key !== false) {
            unset($this->_favourites[$key]);
        };
        return $this->_favourites;
    }

    /**
     * Return if an user is still Premium
     * 
     * @param date $timestamp
     * 
     * @return bool 
     */
    public function isPremium($userid, $timestamp)
    {
        $result = false;
        $_date = "";

        // select all query
        $query = "SELECT pu.PU_ID, pu.Premium_ID, pu.U_ID, pu.PM_ID, pu.StartingDate as UserStaringDate, p.StartingDate as PremiumStartingDate, p.Premium_Descr, p.Price, p.Duration
        from premiumUser as pu
        Inner Join premium as p
        ON pu.Premium_ID = p.Premium_ID
        Where pu.U_ID = :U_ID";



        // prepare query statement
        $stmt = $this->_conn->prepare($query);

        // bind values
        $stmt->bindParam(":U_ID", $userid);


        // execute query
        $stmt->execute();


        $_num = $stmt->rowCount();

        //If entry exists then Error
        if($_num !== 0) {
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);

                

                //Split date from db
                $_date = explode(' ', $UserStaringDate);

                //Check if he is still Premium
                $date1 = new DateTime($_date[0]);
                $date1->add(new DateInterval('P'. strval($Duration) .'D'));
                $date2 = new DateTime($timestamp);

                if($date1 > $date2){
                    $result = true;
                    $this->_premiumId = $PU_ID;
                    $this->_startDate = $_date[0];
                }                
            }
        }
    
        return $result;
    }


}
?>