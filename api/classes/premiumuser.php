<?php
include_once 'reguser.php';
include_once 'favourite.php';
include_once 'premium.php';

class PremiumUser extends RegUser{
    // database connection and table name
    /**
     * @var POD
     */
    private $conn;

    /**
     * @var int $premiumId
     */
    private $premiumId;

    /**
     * @var array $premium
     */
    private $premium;

    /**
     * @var array $gifts
     */
    private $gifts;

    /**
     * @var array $favourites
     */
    private $favourites;

    /**
     * @var bool $payed Check if this User payed his Premium
     */
    private $payed;

    /**
     * @var date
     */
    private $startDate;

    // constructor with $db as database connection
    public function __construct(){

    }

    /**
     * creates connection in class to database
     * 
     * @param $conn PDO
     */
    public function connection($_conn)
    {
        parent::connection($_conn);
        $this->conn = $_conn;
    }

    /**
     * Get $premiumId
     *
     * @return  int
     */
    public function getPremiumId()
    {
        return $this->premiumId;
    }

    /**
     * Set $premiumId
     *
     * @param  int  $premiumId  $premiumId
     *
     * @return  self
     */
    public function setPremiumId($_premiumId)
    {
        $this->premiumId = $_premiumId;

        return $this;
    }

    /**
     * Get $premium
     *
     * @return  array
     */
    public function getPremium()
    {
        return $this->premium;
    }

    /**
     * Set $premium
     *
     * @param  array  $premium  $premium
     *
     * @return  self
     */
    public function setPremium($_premium)
    {
        $this->premium = $_premium;

        return $this;
    }

    /**
     * Get $gifts
     *
     * @return  array
     */
    public function getGifts()
    {
        return $this->gifts;
    }

    /**
     * Set $gifts
     *
     * @param  array  $_gifts 
     *
     * @return  self
     */
    public function setGifts($_gifts)
    {
        $this->gifts = $_gifts;

        return $this;
    }

    /**
     * Get $favourites
     *
     * @return  array
     */
    public function getFavourites()
    {
        return $this->favourites;
    }

    /**
     * Set $favourites
     *
     * @return  array
     */
    public function setFavourites($_favourites)
    {
        return $this->favourites = $_favourites;
    }


    /**
     * Get $payed Check if this User payed his Premium
     *
     * @return  bool
     */
    public function getPayed()
    {
        return $this->payed;
    }

    /**
     * Set $payed Check if this User payed his Premium
     *
     * @param  bool  $payed  $payed Check if this User payed his Premium
     *
     * @return  self
     */
    public function setPayed($_payed)
    {
        $this->payed = $_payed;

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
     * @param int $id
     * @param date $timestamp
     *
     * @return Gift
     */
    public function getGift($_id, $_timestamp)
    {
        $_gift = $this->gifts[$_id];
        //TODO:......

        return $_gift;
    }

    /**
     * Add Favourite to Array
     *
     * @param Favourite $favourite
     */
    public function addFavourite($_favourite)
    {

        //TODO: Overthink it again
        $_unique = true;
        if(count($this->ingrfavouritesedients) > 0){
            for($_i = 0; $_i < count($this->favourites); $_i++){
                if($this->favourites[$_i]["name"] == $_favourite["name"] && $_favourite["name"] != null){
                    $_unique = false;
                }
            }
        }
        
        if($_unique){
            $this->favourites.push($_favourite);
        }
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
        //TODO:
    }

    /**
     * Return if an user is still Premium
     *
     * @param date $timestamp
     *
     * @return bool
     */
    public function isPremium($_userid, $_timestamp)
    {
        $_result = false;
        $_date = "";

        // select all query
        $_query = "SELECT pu.PU_ID, pu.Premium_ID, pu.U_ID, pu.PM_ID, pu.StartingDate as UserStartingDate, p.StartingDate as PremiumStartingDate, p.Premium_Descr, p.Price, p.Duration
        from premiumUser as pu
        Inner Join premium as p
        ON pu.Premium_ID = p.Premium_ID
        Where pu.U_ID = :U_ID";



        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

        // bind values
        $_stmt->bindParam(":U_ID", $_userid);


        // execute query
        $_stmt->execute();


        $_num = $_stmt->rowCount();

        //If entry exists then Error
        if($_num !== 0) {
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($_row = $_stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($_row);



                //Split date from db
                $_date = explode(' ', $UserStartingDate);

                //Check if he is still Premium
                $_date1 = new DateTime($_date[0]);
                $_date1->add(new DateInterval('P'. strval($Duration) .'D'));
                $_date2 = new DateTime($_timestamp);

                if($_date1 > $_date2){
                    $_result = true;
                    $this->premiumId = $PU_ID;
                    $_premium = new Premium();
                    $_premium->setId($PM_ID);
                    $_premium->setDescription($Premium_Descr);
                    $_premium->setNetprice($Price);
                    $_premium->setDuration($Duration);
                    $_premium->setStartDate($PremiumStartingDate);
                    $this->premium = $_premium->getObjectAsArray();
                    $this->startDate = $_date[0];
                    $this->payed = true;
                }
            }
        }

        return $_result;
    }

    /**
     *Clear the User
     */
    public function clearUser()
    {
      parent::clearUser();

      $this->conn = null;
      $this->premiumId = null;
      $this->premium = null;
      $this->gifts = null;
      $this->favourites = null;
      $this->payed = null;
      $this->startDate = null;

    }


    /**
     * Get this Object as Array for JSON import
     *
     * @return array of this Class
     */
    public function getObjectAsArray()
    {
        return array(
            "premiumId" => $this->premiumId,
            "premium" => empty ($this->premium) ? null : $this->premium,
            "gifts" => empty ($this->gifts) ? null : $this->gifts,
            "favourites" => empty ($this->favourites) ? null : $this->favourites,
            "payed" => $this->payed,
            "startDate" => $this->startDate,
            );
    }

}
?>
