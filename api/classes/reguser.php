<?php
include_once 'recipe.php';


class RegUser{


    // database connection and table name
    /**
     * @var POD
     */
    private $_conn;

    /**
     * @var int
     */
    private $_cityId;
    
    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    private $_username;
    /**
     * @var string
     */
    private $_email;
    /**
     * @var string
     */
    private $_firstname;
    /**
     * @var string
     */
    private $_name;
    /**
     * @var string
     */
    private $_password;
    /**
     * @var string
     */
    private $_gender;
    /**
     * @var string
     */
    private $_street;
    /**
     * @var date
     */
    private $_birthday;
    /**
     * @var int
     */
    private $_postcode;    
    /**
     * @var string Homelocation / ORT
     */
    private $_location;
    /**
     * @var array Array of type Orders
     */
    private $_orders;
    /**
     * @var array Array of type Recipe
     */
    private $_recipes;
    /**
     * @var bool
     */
    private $_loggedin;




    // constructor with $db as database connection
    public function __construct($db){
        $this->_conn = $db;
    }

    /**
     * Get the value of _id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set the value of _id
     *
     * @param  int  $_id
     *
     * @return  self
     */ 
    public function setId($_id)
    {
        $this->_id = $_id;

        return $this;
    }

    /**
     * Get the value of _cityId
     *
     * @return  int
     */ 
    public function getCityId()
    {
        return $this->_cityId;
    }

    /**
     * Set the value of _cityId
     *
     * @param  int  $_cityId
     *
     * @return  self
     */ 
    public function setCityId($_cityId)
    {
        $this->_cityId = $_cityId;

        return $this;
    }

    /**
     * @return string Username
     */

     public function getUsername()
     {
         return $this->_username;
     }

    /**
     * @param string Username
     */
    public function setUsername($name)
    {
       $this->_username = $name;
    }

    /**
    * @return string
    */
   public function getEmail()
   {
      return $this->_email;
   }
   /**
    * @param string Username
    */
   public function setEmail($name)
   {
      $this->_email = $name;
   }

       /**
     * Get the value of _firstname
     */ 
    public function getFirstname()
    {
        return $this->_firstname;
    }

    /**
     * Set the value of _firstname
     *
     * @return  self
     */ 
    public function setFirstname($_firstname)
    {
        $this->_firstname = $_firstname;

        return $this;
    }

    

    /**
     * Get the value of _name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Set the value of _name
     *
     * @param  string  $_name
     *
     * @return  self
     */ 
    public function setName($_name)
    {
        $this->_name = $_name;

        return $this;
    }

    /**
     * Get the value of _password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Set the value of _password
     *
     * @param  string  $_password
     *
     * @return  self
     */ 
    public function setPassword($_password)
    {
        $this->_password = $_password;

        return $this;
    }

    /**
     * Get the value of _gender
     *
     * @return  string
     */ 
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Set the value of _gender
     *
     * @param  string  $_gender
     *
     * @return  self
     */ 
    public function setGender($_gender)
    {
        $this->_gender = $_gender;

        return $this;
    }

    /**
     * Get the value of _street
     *
     * @return  string
     */ 
    public function getStreet()
    {
        return $this->_street;
    }

    /**
     * Set the value of _street
     *
     * @param  string  $_street
     *
     * @return  self
     */ 
    public function setStreet($_street)
    {
        $this->_street = $_street;

        return $this;
    }

    /**
     * Get the value of _birthday
     *
     * @return  date
     */ 
    public function getBirthday()
    {
        return $this->_birthday;
    }

    /**
     * Set the value of _birthday
     *
     * @param  date  $_birthday
     *
     * @return  self
     */ 
    public function setBirthday($_birthday)
    {
        $this->_birthday = $_birthday;

        return $this;
    }

    /**
     * Get the value of _postcode
     *
     * @return  int
     */ 
    public function getPostcode()
    {
        return $this->_postcode;
    }

    /**
     * Set the value of _postcode
     *
     * @param  int  $_postcode
     *
     * @return  self
     */ 
    public function setPostcode($_postcode)
    {
        $this->_postcode = $_postcode;

        return $this;
    }

    /**
     * Get homelocation / ORT
     *
     * @return  string
     */ 
    public function getLocation()
    {
        return $this->_location;
    }

    /**
     * Set homelocation / ORT
     *
     * @param  string  $_location  Homelocation / ORT
     *
     * @return  self
     */ 
    public function setLocation($_location)
    {
        $this->_location = $_location;

        return $this;
    }

    /**
     * Get array of type Recipe
     *
     * @return  array
     */ 
    public function getRecipes()
    {
        return $this->_recipes;
    }

    /**
     * Set array of type Recipe
     *
     * @param  array  $_recipes  Array of type Recipe
     *
     * @return  self
     */ 
    public function setRecipes($_recipes)
    {
        $this->_recipes = $_recipes;

        return $this;
    }

    /**
     * Get the value of _loggedin
     *
     * @return  bool
     */ 
    public function getLoggedin()
    {
        return $this->_loggedin;
    }

    /**
     * Set the value of _loggedin
     *
     * @param  bool  $_loggedin
     *
     * @return  self
     */ 
    public function setLoggedin($_loggedin)
    {
        $this->_loggedin = $_loggedin;

        return $this;
    }

   


    /**
     *  
     * @param string $name Mail from Frontend
     * @param string $username Username from Frontend
     * 
     * Return true if mail exists in DB
     * @return bool
     */
    public function checkUserExist($name = "", $username = "")
    {
        $_result = false;
        
            
        // select all query
        $query = "SELECT * FROM user WHERE Mail = :Mail OR Username = :Username";

        // prepare query statement
        $stmt = $this->_conn->prepare($query);
    
        // sanitize
        $name=htmlspecialchars(strip_tags($name));
        $username=htmlspecialchars(strip_tags($username));

        // bind values
        $stmt->bindParam(":Mail", $name);
        $stmt->bindParam(":Username", $username);


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
                $this->_email = $Mail;
                $this->_username = $Username;
                //Set ID if not exist
                if($this->_id == null){ $this->_id = $U_ID;}
                $_result = true;
            }
        }
        return $_result;
    }


    /**
     *  
     * @param string $postcode Postcode from Frontend
     * 
     * Return true if postcode exists in DB
     * @return bool
     */
    public function checkLocation($postcode)
    {
        $_result = false;
        // select all query
        $query = "SELECT * FROM cities WHERE PostalCode = :PostalCode";

        // prepare query statement
        $stmt = $this->_conn->prepare($query);
    
        // sanitize
        //$postcode=htmlspecialchars(strip_tags($postcode));

        // bind values
        $stmt->bindParam(":PostalCode", $postcode);


        // execute query
        $stmt->execute();

        $_num = $stmt->rowCount();
        

        //If entry exists then Error
        if($_num == 0) {
            $this->_postcode = null;  
        }else{
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
                $this->_postcode = $PostalCode;

                //Fill Objekt with City informations
                if($this->_location == null){ $this->_location = $City; }
                if($this->_cityId == null){ $this->_cityId = $C_ID; }
            }
        }


        if($this->_postcode == $postcode) { $_result = true;}

        return $_result;
    }

    /**
     * Insert a Location to Database
     * @param int $postcode
     * @param string $location
     */
    public function createLocation($postcode, $location)
    {
        // select all query
        $query = "INSERT INTO cities (City, PostalCode) VALUES (:City, :PostalCode)";

        // prepare query statement
        $stmt = $this->_conn->prepare($query);
    
        // sanitize
        $location=htmlspecialchars(strip_tags($location));

        // bind values
        $stmt->bindParam(":PostalCode", $postcode);
        $stmt->bindParam(":City", $location);


        // execute query
        $stmt->execute();

        $this->checkLocation($postcode);
    }

    /**
     * Insert a Location to Database
     * @param string $mail
     * @param string $username
     * @param string $password
     * @param string $firstname
     * @param string $name
     * @param string $gender
     * @param string $street
     * @param date $birthday
     * @param int $c_id
     * 
     * @return string
     */
    public function createUser(
        $mail, 
        $username, 
        $password, 
        $firstname,
        $name, 
        $gender, 
        $street,
        $birthday,
        $c_id
        )
    {
        $result = "";
        try{
            $sql = "INSERT INTO user (Mail, Username, Password, FirstName, Name, Gender, Street, Birthday, C_ID) VALUES (:Mail, :Username, :Password, :FirstName, :Name, :Gender, :Street, :Birthday, :C_ID)";
            $stmt= $this->_conn->prepare($sql);
    
            // sanitize
            $mail=htmlspecialchars(strip_tags($mail));
            $username=htmlspecialchars(strip_tags($username));
            $password=htmlspecialchars(strip_tags($password));
            $firstname=htmlspecialchars(strip_tags($firstname));
            $name=htmlspecialchars(strip_tags($name));
            $gender=htmlspecialchars(strip_tags($gender));
            $street=htmlspecialchars(strip_tags($street));
    
            //Hash Password
            $passwort_hash = password_hash($password, PASSWORD_DEFAULT);
    
            // bind values
            $stmt->bindParam(":Mail", $mail);
            $stmt->bindParam(":Username", $username);
            $stmt->bindParam(":Password", $passwort_hash);
            $stmt->bindParam(":FirstName", $firstname);
            $stmt->bindParam(":Name", $name);
            $stmt->bindParam(":Gender", $gender);
            $stmt->bindParam(":Street", $street);
            $stmt->bindParam(":Birthday", $birthday);
            $stmt->bindParam(":C_ID", $c_id);
    
            $stmt->execute();
            $result = "201";
        }catch(Eception $e){
            $result = $e-getMessage();
        }
       

        return $result;
    }

    public function login()
    {
        // select all query
        $query = "SELECT * FROM user WHERE Username = :Username";

        // prepare query statement
        $stmt = $this->_conn->prepare($query);
    
        // sanitize
        $this->_username=htmlspecialchars(strip_tags($this->_username));

        // bind values
        $stmt->bindParam(":Username", $this->_username);


        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    /**
     * 
     */
    public function clearUser()
    {
        # TODO Dustin: alle Attribute aus diesem Objekt auf null setzen
    }



}

?>