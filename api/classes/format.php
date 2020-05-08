<?php

class Format{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $format;

    /**
     * @var int
     */
    private int $pageNumber;

    /**
     * @var string
     */
    private string $designTitle;

    


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
    public function setFormat(string $format)
    {
        $this->format = $format;

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
    public function setPageNumber(int $pageNumber)
    {
        $this->pageNumber = $pageNumber;

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
    public function setDesignTitle(string $designTitle)
    {
        $this->designTitle = $designTitle;

        return $this;
    }
}

?>