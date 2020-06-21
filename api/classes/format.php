<?php

class Format{
    /**
     * @var PDO
     */
    private $conn;
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $format;

    /**
     * @var int
     */
    private $pageNumber;

    /**
     * @var string
     */
    private $designTitle;


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
     * Get the value of format
     *
     * @return  string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the value of format
     *
     * @param  string  $format
     *
     * @return  self
     */
    public function setFormat($_format)
    {
        $this->format = $_format;

        return $this;
    }

    /**
     * Get the value of pageNumber
     *
     * @return  int
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * Set the value of pageNumber
     *
     * @param  int  $pageNumber
     *
     * @return  self
     */
    public function setPageNumber($_pageNumber)
    {
        $this->pageNumber = $_pageNumber;

        return $this;
    }

    /**
     * Get the value of designTitle
     *
     * @return  string
     */
    public function getDesignTitle()
    {
        return $this->designTitle;
    }

    /**
     * Set the value of designTitle
     *
     * @param  string  $designTitle
     *
     * @return  self
     */
    public function setDesignTitle($_designTitle)
    {
        $this->designTitle = $_designTitle;

        return $this;
    }

    /**
     * Get load all formats
     *
     * @return array
     */
    public function fetchFormats()
    {
        $_result = array();

        //TODO Dustin: Hole alle Formate aus der Datenbank und gebe diese als assoziatives array zurück. Ein beispielt wie dies gemacht wird findest du in
        //classes/recipe.php in der Funktion fetchKeywords
        $_query = "SELECT Format FROM cookBook";

        // prepare query statement
        $_stmt = $this->conn->prepare($_query);

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
                    "format" => $CB_FORMAT,
                ));

            }
        }
        return empty($_result) ? null : $_result;
    }
}

?>
