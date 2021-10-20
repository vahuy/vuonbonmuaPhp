
<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 1/19/2019
 * Time: 4:42 PM
 */

class ProductMoreInfo {
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    private $productId;
    private $bestSeller;
    private $sku;
    private $alternateName;
    private $specificArsScore;
    private $bloomType;
    private $breederCode;
    private $characteristic;
    private $specificColor;
    private $fragrance ;
    private $hardinessZone;
    private $height;
    private $patent;
    private $rebloom;

    /**
     * ProductMoreInfo constructor.
     * @param $id
     * @param $productId
     * @param $bestSeller
     * @param $sku
     * @param $alternateName
     * @param $specificArsScore
     * @param $bloomType
     * @param $breederCode
     * @param $characteristic
     * @param $specificColor
     * @param $fragrance
     * @param $hardinessZone
     * @param $height
     * @param $patent
     * @param $rebloom
     * @param $shadeTolerant
     * @param $width
     * @param $year
     */
    public function __construct($id, $productId, $bestSeller, $sku, $alternateName, $specificArsScore, $bloomType, $breederCode, $characteristic, $specificColor, $fragrance, $hardinessZone, $height, $patent, $rebloom, $shadeTolerant, $width, $year)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->bestSeller = $bestSeller;
        $this->sku = $sku;
        $this->alternateName = $alternateName;
        $this->specificArsScore = $specificArsScore;
        $this->bloomType = $bloomType;
        $this->breederCode = $breederCode;
        $this->characteristic = $characteristic;
        $this->specificColor = $specificColor;
        $this->fragrance = $fragrance;
        $this->hardinessZone = $hardinessZone;
        $this->height = $height;
        $this->patent = $patent;
        $this->rebloom = $rebloom;
        $this->shadeTolerant = $shadeTolerant;
        $this->width = $width;
        $this->year = $year;
    }


    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getBestSeller()
    {
        return $this->bestSeller;
    }

    /**
     * @param mixed $bestSeller
     */
    public function setBestSeller($bestSeller)
    {
        $this->bestSeller = $bestSeller;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getAlternateName()
    {
        return $this->alternateName;
    }

    /**
     * @param mixed $alternateName
     */
    public function setAlternateName($alternateName)
    {
        $this->alternateName = $alternateName;
    }

    /**
     * @return mixed
     */
    public function getSpecificArsScore()
    {
        return $this->specificArsScore;
    }

    /**
     * @param mixed $specificArsScore
     */
    public function setSpecificArsScore($specificArsScore)
    {
        $this->specificArsScore = $specificArsScore;
    }

    /**
     * @return mixed
     */
    public function getBloomType()
    {
        return $this->bloomType;
    }

    /**
     * @param mixed $bloomType
     */
    public function setBloomType($bloomType)
    {
        $this->bloomType = $bloomType;
    }

    /**
     * @return mixed
     */
    public function getBreederCode()
    {
        return $this->breederCode;
    }

    /**
     * @param mixed $breederCode
     */
    public function setReederCode($breederCode)
    {
        $this->breederCode = $breederCode;
    }

    /**
     * @return mixed
     */
    public function getCharacteristic()
    {
        return $this->characteristic;
    }

    /**
     * @param mixed $characteristic
     */
    public function setCharacteristic($characteristic)
    {
        $this->characteristic = $characteristic;
    }

    /**
     * @return mixed
     */
    public function getSpecificColor()
    {
        return $this->specificColor;
    }

    /**
     * @param mixed $specificColor
     */
    public function setSpecificColor($specificColor)
    {
        $this->specificColor = $specificColor;
    }

    /**
     * @return mixed
     */
    public function getFragrance()
    {
        return $this->fragrance;
    }

    /**
     * @param mixed $fragrance
     */
    public function setFragrance($fragrance)
    {
        $this->fragrance = $fragrance;
    }

    /**
     * @return mixed
     */
    public function getHardinessZone()
    {
        return $this->hardinessZone;
    }

    /**
     * @param mixed $hardinessZone
     */
    public function setHardinessZone($hardinessZone)
    {
        $this->hardinessZone = $hardinessZone;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getPatent()
    {
        return $this->patent;
    }

    /**
     * @param mixed $patent
     */
    public function setPatent($patent)
    {
        $this->patent = $patent;
    }

    /**
     * @return mixed
     */
    public function getRebloom()
    {
        return $this->rebloom;
    }

    /**
     * @param mixed $rebloom
     */
    public function setRebloom($rebloom)
    {
        $this->rebloom = $rebloom;
    }

    /**
     * @return mixed
     */
    public function getShadeTolerant()
    {
        return $this->shadeTolerant;
    }

    /**
     * @param mixed $shadeTolerant
     */
    public function setShadeTolerant($shadeTolerant)
    {
        $this->shadeTolerant = $shadeTolerant;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }
    private $shadeTolerant;
    private $width;
    private $year ;

}