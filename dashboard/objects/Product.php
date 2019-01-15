<?php
require_once('UTIL.php');
class Product {
    private $id;
    private $name;
    private $image;
    private $price;
    private $shortDescription;
    private $type;
    private $description;
    private $origin;
    private $color;

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
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
    public function __construct($id, $name, $image, $price, $shortDescription, $type, $description, $origin, $color)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
        $this->shortDescription = $shortDescription;
        $this->type = $type;
        $this->description = $description;
        $this->origin = $origin;
        $this->color = $color;
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
    public function setId($id): void
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
    public function setName($name): void
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
    public function setImage($image): void
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
    public function setPrice($price): void
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
    public function setShortDescription($shortDescription): void
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
    public function setType($type): void
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
    public function setDescription($description): void
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
    public function setOrigin($origin): void
    {
        $this->origin = $origin;
    }


    public function generateHtml() {
        $currency = UTIL::formatCurrency($this->price);
        return "
            <div class='col-sm-6 col-md-4 col-lg-3'>
                <a href='/dashboard/productdetail.php?id=$this->id'>
                    <img src=$this->image alt=$this->name>
                </a>
                <h1>$currency</h1>
                <a href='/dashboard/productdetail.php?id=$this->id'>$this->name</a>
                <p>$this->shortDescription</p>
            </div>";
    }
}
