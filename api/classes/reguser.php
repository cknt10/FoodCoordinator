<?php
require_once('recipe.php');


class RegUser{

    /**
     * @var int 
     */
    private int $id;

    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $firstname;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var string
     */
    private string $gender;
    /**
     * @var string
     */
    private string $street;
    /**
     * @var int
     */
    private int $postcode;
    /**
     * @var string Homelocation / ORT
     */
    private string $location;
    /**
     * @var array Array of type Orders
     */
    private array $orders;
    /**
     * @var array Array of type Recipe
     */
    private array $recipes;
    /**
     * @var bool
     */
    private bool $loggedin;


    public function __construct()
    {
        # code...
    }

    

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     *
     * @return  string
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */ 
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of firstname
     *
     * @return  string
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param  string  $firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

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
     * Get homelocation / ORT
     *
     * @return  string
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set homelocation / ORT
     *
     * @param  string  $location  Homelocation / ORT
     *
     * @return  self
     */ 
    public function setLocation(string $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get array of type Orders
     *
     * @return  array
     */ 
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Get array of type Recipe
     *
     * @return  array
     */ 
    public function getRecipes()
    {
        return $this->recipes;
    }


    /**
     * Get the value of loggedin
     *
     * @return  bool
     */ 
    public function getLoggedin()
    {
        return $this->loggedin;
    }



    public function login()
    {
        $this->loggedin = true;
    }

    public function logout()
    {
        $this->loggedin = false;
    }


    /**
     * Resets all Attributes of RegUser
     * 
     * @return self
     */
    public function clearUser()
    {
        $this->id = null;
        $this->username = "";
        $this->firstname = "";
        $this->name = "";
        $this->email = "";
        $this->street = "";
        $this->postcode = null;
        $this->location = "";
        $this->orders = null;
        $this->recipes = null;
        $this->loggedin = false;


        return $this;
    }



    /**
     * Extends Order Array
     * 
     * @param Order $order
     */
    public function extendOrder(Order $order)
    {
        $this->orders.push($order);
    }

    /**
     * @param Order $order
     * 
     * @return array of orders
     */
    public function removeOrder(Order $order)
    {
        $key= array_search($order, $this->orders);
        if ($key !== false) {
            unset($this->orders[$key]);
        };

        return $this->orders;
    }


    /**
     * TODO: Check if needed
     */

     public function upgradePremium(Type $var = null)
     {
         # code...
     }

     /**
      * @param Recipe $recipe
      */
     public function createRecipe(Recipe $recipe)
     {
        $this->recipes.push($recipe);
     }

     /**
      * @param Recipe $recipe
      * 
      * @return array of Recipes
      */
     public function removeRecipe(Recipe $recipe)
     {
        //TODO: 
     }


    /**
     * Get the value of gender
     *
     * @return  string
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @param  string  $gender
     *
     * @return  self
     */ 
    public function setGender(string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }
}

?>