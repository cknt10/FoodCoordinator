<?php

class Gift{
/**
 * @var int 
 */
private int $id;

/**
 * @var string
 */
private string $description;

/**
 * @var int
 */
private int $validity;

/**
 * @var date
 */
private date $startDate;

/**
 * @var bool
 */
private bool $redeemed;




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
 * Get the value of description
 *
 * @return  string
 */ 
public function getDescription()
{
return $this->description;
}

/**
 * Set the value of description
 *
 * @param  string  $description
 *
 * @return  self
 */ 
public function setDescription(string $description)
{
$this->description = $description;

return $this;
}

/**
 * Get the value of validity
 *
 * @return  int
 */ 
public function getValidity()
{
return $this->validity;
}

/**
 * Set the value of validity
 *
 * @param  int  $validity
 *
 * @return  self
 */ 
public function setValidity(int $validity)
{
$this->validity = $validity;

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
 * Get the value of redeemed
 *
 * @return  bool
 */ 
public function getRedeemed()
{
return $this->redeemed;
}

/**
 * Set the value of redeemed
 *
 * @param  bool  $redeemed
 *
 * @return  self
 */ 
public function setRedeemed(bool $redeemed)
{
$this->redeemed = $redeemed;

return $this;
}
}

?>