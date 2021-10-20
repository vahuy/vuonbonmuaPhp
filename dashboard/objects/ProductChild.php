<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/15/2019
 * Time: 2:15 PM
 */
require_once('Util.php');

class ProductChild {
    private $id;
    private $product_id;
    private $entry_date;
    private $price;
    private $import_from;
    private $info;
    private $status;
    /**
     * ProductChild constructor.
     * @param $id
     * @param $product_id
     * @param $entry_date
     * @param $price
     * @param $import_from
     * @param $info
     * @param $status
     */
    public function __construct($id, $product_id, $entry_date, $price, $import_from, $info, $status)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->entry_date = $entry_date;
        $this->price = $price;
        $this->import_from = $import_from;
        $this->info = $info;
        $this->status = $status;
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
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getEntryDate()
    {
        return $this->entry_date;
    }

    /**
     * @param mixed $entry_date
     */
    public function setEntryDate($entry_date)
    {
        $this->entry_date = $entry_date;
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
    public function getImportFrom()
    {
        return $this->import_from;
    }

    /**
     * @param mixed $import_from
     */
    public function setImportFrom($import_from)
    {
        $this->import_from = $import_from;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param mixed $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function generateHtml() {
        $price = UTIL::formatCurrency($this->price);
        return "
        <div class='row'>
            <div class='col-md-3'>
                <p>$this->entry_date</p>
            </div>
            <div class='col-md-3'>
                <p>$this->info</p>
            </div>
            <div class='col-md-3'>
                <p>$this->import_from</p>
            </div>
            <div class='col-md-3'>
                <p>$price</p>
            </div>
        </div>
        ";
    }
}