<?php
require_once('reguser.php');
require_once('favourite.php');

class PremiumUser extends RegUser{

    /**
     * @var array $premium
     */
    private array $premium;

    /**
     * @var array $gifts
     */
    private array $gifts;

    /**
     * @var array $favourites
     */
    private array $favourites;

    /**
     * @var bool $payed Check if this User payed his Premium
     */
    private bool $payed;

    /**
     * @var date 
     */
    private date $startDate;

    



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
    public function setPremium(array $premium)
    {
        $this->premium = $premium;

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
     * @param  array  $gifts  $gifts
     *
     * @return  self
     */ 
    public function setGifts(array $gifts)
    {
        $this->gifts = $gifts;

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
    public function setPayed(bool $payed)
    {
        $this->payed = $payed;

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
    public function setStartDate(date $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @param int $id
     * @param date $timestamp
     * 
     * @return Gift
     */
    public function getGift(int $id, date $timestamp)
    {
        $gift = $this->gifts[$id];
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
        $this->favourites.push($favourite);
    }

    /**
     * Remove Favourite from Array
     * 
     * @param Favourite $favourite
     * 
     * @return array of Favourites
     */
    public function removeFavourite(Favourite $favourite)
    {
        $key= array_search($favourite, $this->favourites);
        if ($key !== false) {
            unset($this->favourites[$key]);
        };
        return $this->favourites;
    }

    /**
     * Return if an user is still Premium
     * 
     * @param date $timestamp
     * 
     * @return bool 
     */
    public function isPremium(date $timestamp)
    {
        //TODO test needed
       if($premium[0]->startDate + $premium[0]->duration <= $timestamp){
        return true;
       }
       return false;
    }
}

?>