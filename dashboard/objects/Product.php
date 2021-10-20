<?php
require_once('Util.php');
class Product {
    private $id;
    private $name;
    private $price;
    private $type;
    private $image;
    private $shortDescription;
    private $description;
    private $origin;
    private $isInStock;

    /**
     * @return mixed
     */
    public function getIsInStock()
    {
        return $this->isInStock;
    }

    /**
     * @param mixed $isInStock
     */
    public function setIsInStock($isInStock)
    {
        $this->isInStock = $isInStock;
    }

    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $image
     * @param $price
     * @param $shortDescription
     * @param $type
     * @param $description
     * @param $origin
     */
    public function __construct($id, $name, $image, $price, $shortDescription, $type, $description, $origin)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
        $this->shortDescription = $shortDescription;
        $this->type = $type;
        $this->description = $description;
        $this->origin = $origin;
    }

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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param mixed $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param mixed $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }


    public function generateHtml() {
        $currency = UTIL::formatCurrency($this->price);
        return "
            <div class='col-sm-6 col-md-4 col-lg-3'>
                <div class='product-image'>
                    <a href='/dashboard/productdetail.php?id=$this->id'>
                        <img src=$this->image alt=$this->name>
                    </a>
                </div>
                <div class='product-price color-red'><h1>$currency</h1></div>
                <div class='product-name'><a href='/dashboard/productdetail.php?id=$this->id'><h5>$this->name</h5></a></div>
                <p>$this->shortDescription</p>
            </div>";
    }
}
