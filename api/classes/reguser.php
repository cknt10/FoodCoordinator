<?php
include_once 'recipe.php';


class RegUser{


    // database connection and table name
    /**
     * @var POD
     */
    private $conn;

    /**
     * @var int
     */
    private $cityId;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $gender;
    /**
     * @var string
     */
    private $street;
    /**
     * @var date
     */
    private $birthday;
    /**
     * @var int
     */
    private $postcode;
    /**
     * @var string Homelocation / ORT
     */
    private $location;
    /**
     * @var array Array of type Orders
     */
    private $orders;
    /**
     * @var array Array of type Recipe
     */
    private $recipes;
    /**
     * @var bool
     */
    private $loggedin;




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
        $this->conn = $_conn;
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
    public function setId($_id)
    {
        $this->id = $_id;

        return $this;
    }

    /**
     * Get the value of cityId
     *
     * @return  int
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set the value of cityId
     *
     * @param  int  $_cityId
     *
     * @return  self
     */
    public function setCityId($_cityId)
    {
        $this->cityId = $_cityId;

        return $this;
    }

    /**
     * @return string Username
     */

     public function getUsername()
     {
         return $this->username;
     }

    /**
     * @param string Username
     */
    public function setUsername($_name)
    {
       $this->username = $_name;
    }

    /**
    * @return string
    */
   public function getEmail()
   {
      return $this->email;
   }
   /**
    * @param string Username
    */
   public function setEmail($_name)
   {
      $this->email = $_name;
   }

       /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($_firstname)
    {
        $this->firstname = $_firstname;

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
     * @param  string  $_name
     *
     * @return  self
     */
    public function setName($_name)
    {
        $this->name = $_name;

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
     * @param  string  $_password
     *
     * @return  self
     */
    public function setPassword($_password)
    {
        $this->password = $_password;

        return $this;
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
     * @param  string  $_gender
     *
     * @return  self
     */
    public function setGender($_gender)
    {
        $this->gender = $_gender;

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
     * @param  string  $_street
     *
     * @return  self
     */
    public function setStreet($_street)
    {
        $this->street = $_street;

        return $this;
    }

    /**
     * Get the value of birthday
     *
     * @return  date
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the value of birthday
     *
     * @param  date  $_birthday
     *
     * @return  self
     */
    public function setBirthday($_birthday)
    {
        $this->birthday = $_birthday;

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
     * @param  int  $_postcode
     *
     * @return  self
     */
    public function setPostcode($_postcode)
    {
        $this->postcode = $_postcode;

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
     * @param  string  $_location  Homelocation / ORT
     *
     * @return  self
     */
    public function setLocation($_location)
    {
        $this->location = $_location;

        return $this;
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
     * Set array of type Recipe
     *
     * @param  array  $_recipes  Array of type Recipe
     *
     * @return  self
     */
    public function setRecipes($_recipes)
    {
        $this->recipes = $_recipes;

        return $this;
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

    /**
     * Set the value of loggedin
     *
     * @param  bool  $_loggedin
     *
     * @return  self
     */
    public function setLoggedin($_loggedin)
    {
        $this->loggedin = $_loggedin;

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
    public function checkUserExist($_name = "", $_username = "")
    {
        $_result = false;


        // select all query
        $_query = "SELECT * FROM user WHERE Mail = :Mail OR Username = :Username";

        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

        // sanitize
        $_name=htmlspecialchars(strip_tags($_name));
        $_username=htmlspecialchars(strip_tags($_username));

        // bind values
        $_stmt->bindParam(":Mail", $_name);
        $_stmt->bindParam(":Username", $_username);


        // execute query
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
                $this->email = $Mail;
                $this->username = $Username;
                //Set ID if not exist
                if($this->id == null){ $this->id = $U_ID;}
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
    public function checkLocation($_postcode, $_location, $_cityId = null)
    {
        $_result = false;
        $_query = "";

        // select all query
        if($_cityId != null){
            $_query = "SELECT * FROM cities WHERE C_ID = :C_ID";

            // prepare query statement
            $_stmt = $this->conn->prepare($_query);

            // sanitize
            //$postcode=htmlspecialchars(strip_tags($postcode));

            // bind values
            $_stmt->bindParam(":C_ID", $_cityId);

        }else{
            $_query = "SELECT * FROM cities WHERE PostalCode = :PostalCode";

            // prepare query statement
            $_stmt = $this->conn->prepare($_query);

            // sanitize
            //$postcode=htmlspecialchars(strip_tags($postcode));

            // bind values
            $_stmt->bindParam(":PostalCode", $_postcode);
        }



        // execute query
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

                //Check for the right location
                if(strcmp(strtolower($_location), strtolower($City)) == 0){
                    //Fill Objekt with City informations
                    $this->postcode = $PostalCode;
                    $this->location = $City;
                    $this->cityId = $C_ID;
                    $_result = true;
                }
                if($_cityId != null){
                    $this->postcode = $PostalCode;
                    $this->location = $City;
                    $this->cityId = $C_ID;
                    $_result = true;
                }
            }
        }

        return $_result;
    }

    /**
     * Insert a Location to Database
     * @param int $postcode
     * @param string $location
     */
    public function createLocation($_postcode, $_location)
    {
        // select all query
        $_query = "INSERT INTO cities (City, PostalCode) VALUES (:City, :PostalCode)";

        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

        // sanitize
        $_location=htmlspecialchars(strip_tags($_location));

        // bind values
        $_stmt->bindParam(":City", $_location);
        $_stmt->bindParam(":PostalCode", $_postcode);


        // execute query
        $_stmt->execute();

        $this->checkLocation($_postcode, $_location);
    }

    /**
     * Get all Locations to this Postalcode
     * 
     * @param int $_postcode 
     * 
     * @return array with alle Locations to this postalcode or null if empty
     */
    public function fetchLocations($_postcode){
        $_result = array();
        $_query = "SELECT * FROM cities WHERE PostalCode = :PostalCode";

        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

        // sanitize
        //$_postcode=htmlspecialchars(strip_tags($_postcode));

        // bind values
        $_stmt->bindParam(":PostalCode", $_postcode);

        // execute query
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
                array_push($_result, array(
                    "cityId" => $C_ID,
                    "city" => $City,
                    "postcode" => $PostalCode,
                ));
                
            }
        }
        return empty($_result) ? null : $_result;
    }


        /**
     * @param string $username
     * @param string $mail
     *
     * @return int cout of entries
     */

    public function login($_username = "", $_mail ="")
    {
        // select all query
        $_query = "SELECT * FROM user WHERE Username = :Username OR Mail = :Mail";

        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

        // sanitize
        $_username=htmlspecialchars(strip_tags($_username));
        $_mail=htmlspecialchars(strip_tags($_mail));

        // bind values
        $_stmt->bindParam(":Username", $_username);
        $_stmt->bindParam(":Mail", $_mail);

        // execute query
        $_stmt->execute();

        $_num = $_stmt->rowCount();

        if($_num>0){

            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($_row = $_stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($_row);

                $this->id = $U_ID;
                $this->username = $Username;
                $this->email = $Mail;
                $this->firstname = $FirstName;
                $this->name = $Name;
                $this->birthday = $Birthday;
                $this->gender = $Gender;
                $this->street = $Street;
                $this->password = $Password;
                $this->cityId = $C_ID;
            }

            $this->checkLocation("", "", $this->cityId);
        }

        return $_num;
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
        $_mail,
        $_username,
        $_password,
        $_firstname,
        $_name,
        $_gender,
        $_street,
        $_birthday,
        $_c_id
        )
    {
        $result = "";
        try{
            $_sql = "INSERT INTO user (Mail, Username, Password, FirstName, Name, Gender, Street, Birthday, C_ID) VALUES (:Mail, :Username, :Password, :FirstName, :Name, :Gender, :Street, :Birthday, :C_ID)";
            $_stmt= $this->conn->prepare($_sql);

            // sanitize
            $_mail=htmlspecialchars(strip_tags($_mail));
            $_username=htmlspecialchars(strip_tags($_username));
            $_password=htmlspecialchars(strip_tags($_password));
            $_firstname=htmlspecialchars(strip_tags($_firstname));
            $_name=htmlspecialchars(strip_tags($_name));
            $_gender=htmlspecialchars(strip_tags($_gender));
            $_street=htmlspecialchars(strip_tags($_street));

            //Hash Password
            $_passwort_hash = password_hash($_password, PASSWORD_DEFAULT);

            // bind values
            $_stmt->bindParam(":Mail", $_mail);
            $_stmt->bindParam(":Username", $_username);
            $_stmt->bindParam(":Password", $_passwort_hash);
            $_stmt->bindParam(":FirstName", $_firstname);
            $_stmt->bindParam(":Name", $_name);
            $_stmt->bindParam(":Gender", $_gender);
            $_stmt->bindParam(":Street", $_street);
            $_stmt->bindParam(":Birthday", $_birthday);
            $_stmt->bindParam(":C_ID", $_c_id);

            $_stmt->execute();
            $_result = "201";
        }catch(Eception $_e){
            $_result = $_e->getMessage();
        }

        $this->login($_username);
        return $_result;
    }

    /**
     * Update user data
     * 
     * @param int $_userId
     * @param string $_mail
     * @param string $_username
     * @param string $_firstname
     * @param string $_name
     * @param string $_gender
     * @param string $_street
     * @param date $_birthday
     * @param int $_cityId
     *
     * @return string
     */
    public function changeUser(
        $_userId,
        $_mail,
        $_username,
        $_firstname,
        $_name,
        $_gender,
        $_street,
        $_birthday,
        $_cityId,
        $_userImg
        )
    {
        $result = "";
        try{
            $_sql = "UPDATE user SET Mail = :Mail, Username = :Username, FirstName = :FirstName, Name = :Name, Gender = :Gender, Street = :Street, Birthday = :Birthday, C_ID = :C_ID, U_Img = :U_Img WHERE U_ID = :U_ID";
            $_stmt= $this->conn->prepare($_sql);

            // sanitize
            $_mail=htmlspecialchars(strip_tags($_mail));
            $_username=htmlspecialchars(strip_tags($_username));
            $_firstname=htmlspecialchars(strip_tags($_firstname));
            $_name=htmlspecialchars(strip_tags($_name));
            $_gender=htmlspecialchars(strip_tags($_gender));
            $_street=htmlspecialchars(strip_tags($_street));


            // bind values
            $_stmt->bindParam(":U_ID", $_userId);
            $_stmt->bindParam(":Mail", $_mail);
            $_stmt->bindParam(":Username", $_username);
            $_stmt->bindParam(":FirstName", $_firstname);
            $_stmt->bindParam(":Name", $_name);
            $_stmt->bindParam(":Gender", $_gender);
            $_stmt->bindParam(":Street", $_street);
            $_stmt->bindParam(":Birthday", $_birthday);
            $_stmt->bindParam(":C_ID", $_cityId);
            $_stmt->bindParam(":U_Img", $_userImg);

            $_stmt->execute();
            $_result = "200";
        }catch(Eception $_e){
            $_result = $_e->getMessage();
        }

        $this->login($_username);
        return $_result;
    }

    /**
     * Change password
     * 
     * @param int $_userId
     * @param string $_password
     *
     * @return string
     */
    public function changePassword($_userId, $_password)
    {
        $result = "";
        try{
            $_sql = "UPDATE user SET Password = :Password WHERE U_ID = :U_ID";
            $_stmt= $this->conn->prepare($_sql);

            //Hash Password
            $_passwort_hash = password_hash($_password, PASSWORD_DEFAULT);

            // bind values
            $_stmt->bindParam(":U_ID", $_userId);
            $_stmt->bindParam(":Password", $_passwort_hash);


            $_stmt->execute();
            $_result = "200";
        }catch(Eception $_e){
            $_result = $_e->getMessage();
        }

        $this->login($_username);
        return $_result;
    }

    /**
     *Clear the User
     */
    public function clearUser()
    {
      $this->conn = null;
      $this->cityId = null;
      $this->id = null;
      $this->username = null;
      $this->email = null;
      $this->firstname = null;
      $this->name = null;
      $this->password = null;
      $this->gender = null;
      $this->street = null;
      $this->birthday = null;
      $this->postcode = null;
      $this->location = null;
      $this->orders = null;
      $this->recipes = null;
      $this->loggedin = null;
    }

    /**
     * Get this Object as Array for JSON import
     *
     * @return array of this Class
     */
    public function getObjectAsArray()
    {
        //TODO Dustin: Alle Attribute aus diesem Objekt außer _conn und _loggedin als assoziatives Array zurückgeben
        // Beispiele kannst du unter der ingredient.php oder nutrient.php finden der Aufbau ist.

        return array(
          "cityId" => $this->cityId,
          "id" => $this->id,
          "username" => $this->username,
          "name" => $this->name,
          "password" => $this->password,
          "gender" => $this->gender,
          "street" => $this->street,
          "birthday" => $this->birthday,
          "postcode" => $this->postcode,
          "location" => $this->location,
          "orders" => empty($this->orders) ? null : $this->orders,
          "recipes" => empty($this->recipes) ? null : $this->recipes,
        );

    }
}

?>
