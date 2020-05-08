<?php

class Nutrients{

    /**
     * @var int
     */
    private int $id;
    /**
     * @var int
     */
    private int $kjoule;
    /**
     * @var float
     */
    private float $protein;
    /**
     * @var float
     */
    private float $dietaryFiber;
    /**
     * @var float
     */
    private float $sugar;
    /**
     * @var float
     */
    private float $fat;
    /**
     * @var float
     */
    private float $salt;
    /**
     * @var float
     */
    private float $vitaminA;
    /**
     * @var float
     */
    private float $vitaminB1;
    /**
     * @var float
     */
    private float $vitaminB2;
    /**
     * @var float
     */
    private float $vitaminB3;
    /**
     * @var float
     */
    private float $vitaminB5;
    /**
     * @var float
     */
    private float $vitaminB6;
    /**
     * @var float
     */
    private float $vitaminB8;
    /**
     * @var float
     */
    private float $vitaminB9;
    /**
     * @var float
     */
    private float $vitaminB12;
    /**
     * @var float
     */
    private float $vitaminC;
    /**
     * @var float
     */
    private float $vitaminD;
    /**
     * @var float
     */
    private float $vitaminE;
    /**
     * @var float
     */
    private float $vitaminH;
    /**
     * @var float
     */
    private float $vitaminK;
    /**
     * @var float
     */
    private float $satFats; 
    /**
     * @var float
     */
    private float $unsatFats;
    /**
     * @var float
     */
    private float $magnesium;
    /**
     * @var float
     */
    private float $sulfur;
    /**
     * @var float
     */
    private float $phospor;
    /**
     * @var float
     */
    private float $calcium;
    /**
     * @var float
     */
    private float $potassium;
    /**
     * @var float
     */
    private float $iodid;
    /**
     * @var float
     */
    private float $flourid;
    /**
     * @var float
     */
    private float $manganese;
    /**
     * @var float
     */
    private float $copper;
    /**
     * @var float
     */
    private float $zinc;
    /**
     * @var float
     */
    private float $iron;
    /**
     * @var float
     */
    private float $water;


    /**
     * Create Nutrients with needed Informations all Nullable except id
     * @param  int  $id
     * @param  int  $kjoule
     * @param  int $protein
     * @param  int $dietaryFiber
     * @param  int $sugar
     * @param  int $fat
     * @param  int $salt
     * @param  int $vitaminA
     * @param  int $vitaminB1
     * @param  int $vitaminB2
     * @param  int $vitaminB3
     * @param  int $vitaminB5
     * @param  int $vitaminB6
     * @param  int $vitaminB8
     * @param  int $vitaminB9 
     * @param  int $vitaminB12
     * @param  int $vitaminC
     * @param  int $vitaminD
     * @param  int $vitaminE
     * @param  int $vitaminH
     * @param  int $vitaminK
     * @param  int $satFats 
     * @param  int $unsatFats
     * @param  int $magnesium
     * @param  int $sulfur
     * @param  int $phospor
     * @param  int $calcium
     * @param  int $potassium
     * @param  int $iodid
     * @param  int $flourid
     * @param  int $manganese
     * @param  int $copper 
     * @param  int $zinc
     * @param  int $iron
     * @param  int $water
     * 
     */
    public function __construct($id, 
    $kjoule = null, 
    $protein = null, 
    $dietaryFiber = null, 
    $sugar = null, 
    $fat = null, 
    $salt = null, 
    $vitaminA = null, 
    $vitaminB1 = null, 
    $vitaminB2 = null, 
    $vitaminB3 = null, 
    $vitaminB5 = null, 
    $vitaminB6 = null, 
    $vitaminB8 = null, 
    $vitaminB9 = null, 
    $vitaminB12 = null, 
    $vitaminC = null, 
    $vitaminD = null,
    $vitaminE = null, 
    $vitaminH = null, 
    $vitaminK = null, 
    $satFats = null, 
    $unsatFats = null, 
    $magnesium = null, 
    $sulfur = null, 
    $phospor = null, 
    $calcium = null, 
    $potassium = null, 
    $iodid = null, 
    $flourid = null, 
    $manganese = null, 
    $copper = null, 
    $zinc = null, 
    $iron = null, 
    $water = null) {

        $this->id = $id;
        $this->kjoule = $kjoule;
        $this->protein = $protein;
        $this->dietaryFiber = $dietaryFiber;
        $this->sugar = $sugar;
        $this->fat = $fat;
        $this->salt = $salt;
        $this->vitaminA = $vitaminA;
        $this->vitaminB1 = $vitaminB1;
        $this->vitaminB2 = $vitaminB2;
        $this->vitaminB3 = $vitaminB3;
        $this->vitaminB5 = $vitaminB5;
        $this->vitaminB6 = $vitaminB6;
        $this->vitaminB8 = $vitaminB8;
        $this->vitaminB9 = $vitaminB9;
        $this->vitaminB12 = $vitaminB12;
        $this->vitaminC = $vitaminC;
        $this->vitaminD = $vitaminD;
        $this->vitaminE = $vitaminE;
        $this->vitaminH = $vitaminH;
        $this->vitaminK = $vitaminK;
        $this->satFats = $satFats;
        $this->unsatFats = $unsatFats;
        $this->magnesium = $magnesium;
        $this->sulfur = $sulfur;
        $this->phospor = $phospor;
        $this->calcium = $calcium;
        $this->potassium = $potassium;
        $this->iodid = $iodid;
        $this->flourid = $flourid;
        $this->manganese = $manganese;
        $this->copper = $copper;
        $this->zinc = $zinc;
        $this->iron = $iron;
        $this->water = $water;
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
     * Get the value of kjoule
     *
     * @return  int
     */ 
    public function getKjoule()
    {
        return $this->kjoule;
    }

    /**
     * Set the value of kjoule
     *
     * @param  int  $kjoule
     *
     * @return  self
     */ 
    public function setKjoule(int $kjoule)
    {
        $this->kjoule = $kjoule;

        return $this;
    }

    /**
     * Get the value of protein
     *
     * @return  float
     */ 
    public function getProtein()
    {
        return $this->protein;
    }

    /**
     * Set the value of protein
     *
     * @param  float  $protein
     *
     * @return  self
     */ 
    public function setProtein(float $protein)
    {
        $this->protein = $protein;

        return $this;
    }

    /**
     * Get the value of dietaryFiber
     *
     * @return  float
     */ 
    public function getDietaryFiber()
    {
        return $this->dietaryFiber;
    }

    /**
     * Set the value of dietaryFiber
     *
     * @param  float  $dietaryFiber
     *
     * @return  self
     */ 
    public function setDietaryFiber(float $dietaryFiber)
    {
        $this->dietaryFiber = $dietaryFiber;

        return $this;
    }

    /**
     * Get the value of sugar
     *
     * @return  float
     */ 
    public function getSugar()
    {
        return $this->sugar;
    }

    /**
     * Set the value of sugar
     *
     * @param  float  $sugar
     *
     * @return  self
     */ 
    public function setSugar(float $sugar)
    {
        $this->sugar = $sugar;

        return $this;
    }

    /**
     * Get the value of fat
     *
     * @return  float
     */ 
    public function getFat()
    {
        return $this->fat;
    }

    /**
     * Set the value of fat
     *
     * @param  float  $fat
     *
     * @return  self
     */ 
    public function setFat(float $fat)
    {
        $this->fat = $fat;

        return $this;
    }

    /**
     * Get the value of salt
     *
     * @return  float
     */ 
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set the value of salt
     *
     * @param  float  $salt
     *
     * @return  self
     */ 
    public function setSalt(float $salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get the value of vitaminA
     *
     * @return  float
     */ 
    public function getVitaminA()
    {
        return $this->vitaminA;
    }

    /**
     * Set the value of vitaminA
     *
     * @param  float  $vitaminA
     *
     * @return  self
     */ 
    public function setVitaminA(float $vitaminA)
    {
        $this->vitaminA = $vitaminA;

        return $this;
    }

    /**
     * Get the value of vitaminB1
     *
     * @return  float
     */ 
    public function getVitaminB1()
    {
        return $this->vitaminB1;
    }

    /**
     * Set the value of vitaminB1
     *
     * @param  float  $vitaminB1
     *
     * @return  self
     */ 
    public function setVitaminB1(float $vitaminB1)
    {
        $this->vitaminB1 = $vitaminB1;

        return $this;
    }

    /**
     * Get the value of vitaminB2
     *
     * @return  float
     */ 
    public function getVitaminB2()
    {
        return $this->vitaminB2;
    }

    /**
     * Set the value of vitaminB2
     *
     * @param  float  $vitaminB2
     *
     * @return  self
     */ 
    public function setVitaminB2(float $vitaminB2)
    {
        $this->vitaminB2 = $vitaminB2;

        return $this;
    }

    /**
     * Get the value of vitaminB3
     *
     * @return  float
     */ 
    public function getVitaminB3()
    {
        return $this->vitaminB3;
    }

    /**
     * Set the value of vitaminB3
     *
     * @param  float  $vitaminB3
     *
     * @return  self
     */ 
    public function setVitaminB3(float $vitaminB3)
    {
        $this->vitaminB3 = $vitaminB3;

        return $this;
    }

    /**
     * Get the value of vitaminB5
     *
     * @return  float
     */ 
    public function getVitaminB5()
    {
        return $this->vitaminB5;
    }

    /**
     * Set the value of vitaminB5
     *
     * @param  float  $vitaminB5
     *
     * @return  self
     */ 
    public function setVitaminB5(float $vitaminB5)
    {
        $this->vitaminB5 = $vitaminB5;

        return $this;
    }

    /**
     * Get the value of vitaminB6
     *
     * @return  float
     */ 
    public function getVitaminB6()
    {
        return $this->vitaminB6;
    }

    /**
     * Set the value of vitaminB6
     *
     * @param  float  $vitaminB6
     *
     * @return  self
     */ 
    public function setVitaminB6(float $vitaminB6)
    {
        $this->vitaminB6 = $vitaminB6;

        return $this;
    }

    /**
     * Get the value of vitaminB8
     *
     * @return  float
     */ 
    public function getVitaminB8()
    {
        return $this->vitaminB8;
    }

    /**
     * Set the value of vitaminB8
     *
     * @param  float  $vitaminB8
     *
     * @return  self
     */ 
    public function setVitaminB8(float $vitaminB8)
    {
        $this->vitaminB8 = $vitaminB8;

        return $this;
    }

    /**
     * Get the value of vitaminB9
     *
     * @return  float
     */ 
    public function getVitaminB9()
    {
        return $this->vitaminB9;
    }

    /**
     * Set the value of vitaminB9
     *
     * @param  float  $vitaminB9
     *
     * @return  self
     */ 
    public function setVitaminB9(float $vitaminB9)
    {
        $this->vitaminB9 = $vitaminB9;

        return $this;
    }

    /**
     * Get the value of vitaminB12
     *
     * @return  float
     */ 
    public function getVitaminB12()
    {
        return $this->vitaminB12;
    }

    /**
     * Set the value of vitaminB12
     *
     * @param  float  $vitaminB12
     *
     * @return  self
     */ 
    public function setVitaminB12(float $vitaminB12)
    {
        $this->vitaminB12 = $vitaminB12;

        return $this;
    }

    /**
     * Get the value of vitaminC
     *
     * @return  float
     */ 
    public function getVitaminC()
    {
        return $this->vitaminC;
    }

    /**
     * Set the value of vitaminC
     *
     * @param  float  $vitaminC
     *
     * @return  self
     */ 
    public function setVitaminC(float $vitaminC)
    {
        $this->vitaminC = $vitaminC;

        return $this;
    }

    /**
     * Get the value of vitaminD
     *
     * @return  float
     */ 
    public function getVitaminD()
    {
        return $this->vitaminD;
    }

    /**
     * Set the value of vitaminD
     *
     * @param  float  $vitaminD
     *
     * @return  self
     */ 
    public function setVitaminD(float $vitaminD)
    {
        $this->vitaminD = $vitaminD;

        return $this;
    }

    /**
     * Get the value of vitaminE
     *
     * @return  float
     */ 
    public function getVitaminE()
    {
        return $this->vitaminE;
    }

    /**
     * Set the value of vitaminE
     *
     * @param  float  $vitaminE
     *
     * @return  self
     */ 
    public function setVitaminE(float $vitaminE)
    {
        $this->vitaminE = $vitaminE;

        return $this;
    }

    /**
     * Get the value of vitaminH
     *
     * @return  float
     */ 
    public function getVitaminH()
    {
        return $this->vitaminH;
    }

    /**
     * Set the value of vitaminH
     *
     * @param  float  $vitaminH
     *
     * @return  self
     */ 
    public function setVitaminH(float $vitaminH)
    {
        $this->vitaminH = $vitaminH;

        return $this;
    }

    /**
     * Get the value of vitaminK
     *
     * @return  float
     */ 
    public function getVitaminK()
    {
        return $this->vitaminK;
    }

    /**
     * Set the value of vitaminK
     *
     * @param  float  $vitaminK
     *
     * @return  self
     */ 
    public function setVitaminK(float $vitaminK)
    {
        $this->vitaminK = $vitaminK;

        return $this;
    }

    /**
     * Get the value of satFats
     *
     * @return  float
     */ 
    public function getSatFats()
    {
        return $this->satFats;
    }

    /**
     * Set the value of satFats
     *
     * @param  float  $satFats
     *
     * @return  self
     */ 
    public function setSatFats(float $satFats)
    {
        $this->satFats = $satFats;

        return $this;
    }

    /**
     * Get the value of unsatFats
     *
     * @return  float
     */ 
    public function getUnsatFats()
    {
        return $this->unsatFats;
    }

    /**
     * Set the value of unsatFats
     *
     * @param  float  $unsatFats
     *
     * @return  self
     */ 
    public function setUnsatFats(float $unsatFats)
    {
        $this->unsatFats = $unsatFats;

        return $this;
    }

    /**
     * Get the value of magnesium
     *
     * @return  float
     */ 
    public function getMagnesium()
    {
        return $this->magnesium;
    }

    /**
     * Set the value of magnesium
     *
     * @param  float  $magnesium
     *
     * @return  self
     */ 
    public function setMagnesium(float $magnesium)
    {
        $this->magnesium = $magnesium;

        return $this;
    }

    /**
     * Get the value of sulfur
     *
     * @return  float
     */ 
    public function getSulfur()
    {
        return $this->sulfur;
    }

    /**
     * Set the value of sulfur
     *
     * @param  float  $sulfur
     *
     * @return  self
     */ 
    public function setSulfur(float $sulfur)
    {
        $this->sulfur = $sulfur;

        return $this;
    }

    /**
     * Get the value of phospor
     *
     * @return  float
     */ 
    public function getPhospor()
    {
        return $this->phospor;
    }

    /**
     * Set the value of phospor
     *
     * @param  float  $phospor
     *
     * @return  self
     */ 
    public function setPhospor(float $phospor)
    {
        $this->phospor = $phospor;

        return $this;
    }

    /**
     * Get the value of calcium
     *
     * @return  float
     */ 
    public function getCalcium()
    {
        return $this->calcium;
    }

    /**
     * Set the value of calcium
     *
     * @param  float  $calcium
     *
     * @return  self
     */ 
    public function setCalcium(float $calcium)
    {
        $this->calcium = $calcium;

        return $this;
    }

    /**
     * Get the value of potassium
     *
     * @return  float
     */ 
    public function getPotassium()
    {
        return $this->potassium;
    }

    /**
     * Set the value of potassium
     *
     * @param  float  $potassium
     *
     * @return  self
     */ 
    public function setPotassium(float $potassium)
    {
        $this->potassium = $potassium;

        return $this;
    }

    /**
     * Get the value of iodid
     *
     * @return  float
     */ 
    public function getIodid()
    {
        return $this->iodid;
    }

    /**
     * Set the value of iodid
     *
     * @param  float  $iodid
     *
     * @return  self
     */ 
    public function setIodid(float $iodid)
    {
        $this->iodid = $iodid;

        return $this;
    }

    /**
     * Get the value of flourid
     *
     * @return  float
     */ 
    public function getFlourid()
    {
        return $this->flourid;
    }

    /**
     * Set the value of flourid
     *
     * @param  float  $flourid
     *
     * @return  self
     */ 
    public function setFlourid(float $flourid)
    {
        $this->flourid = $flourid;

        return $this;
    }

    /**
     * Get the value of manganese
     *
     * @return  float
     */ 
    public function getManganese()
    {
        return $this->manganese;
    }

    /**
     * Set the value of manganese
     *
     * @param  float  $manganese
     *
     * @return  self
     */ 
    public function setManganese(float $manganese)
    {
        $this->manganese = $manganese;

        return $this;
    }

    /**
     * Get the value of copper
     *
     * @return  float
     */ 
    public function getCopper()
    {
        return $this->copper;
    }

    /**
     * Set the value of copper
     *
     * @param  float  $copper
     *
     * @return  self
     */ 
    public function setCopper(float $copper)
    {
        $this->copper = $copper;

        return $this;
    }

    /**
     * Get the value of zinc
     *
     * @return  float
     */ 
    public function getZinc()
    {
        return $this->zinc;
    }

    /**
     * Set the value of zinc
     *
     * @param  float  $zinc
     *
     * @return  self
     */ 
    public function setZinc(float $zinc)
    {
        $this->zinc = $zinc;

        return $this;
    }

    /**
     * Get the value of iron
     *
     * @return  float
     */ 
    public function getIron()
    {
        return $this->iron;
    }

    /**
     * Set the value of iron
     *
     * @param  float  $iron
     *
     * @return  self
     */ 
    public function setIron(float $iron)
    {
        $this->iron = $iron;

        return $this;
    }

    /**
     * Get the value of water
     *
     * @return  float
     */ 
    public function getWater()
    {
        return $this->water;
    }

    /**
     * Set the value of water
     *
     * @param  float  $water
     *
     * @return  self
     */ 
    public function setWater(float $water)
    {
        $this->water = $water;

        return $this;
    }
}


?>