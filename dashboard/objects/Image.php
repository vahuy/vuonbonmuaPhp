<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/15/2019
 * Time: 10:43 AM
 */

class Image {
    private $id;
    private $product_id;
    private $src;

    /**
     * image constructor.
     * @param $id
     * @param $product_id
     * @param $src
     */
    public function __construct($id, $product_id, $src)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->src = $src;
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
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param mixed $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    public function generateHtml() {
        return "
            <div class='col-md-2'>
                <a onclick=changeMainPhoto('$this->src')>
                    <img src='$this->src'>
                </a>
            </div>
        ";
    }

    public function generateHtmlWithTag($image, $name) {
        return "
            <div class='col-md-2 col-xs-2 col-sm-12'>
                <a onclick=changeMainPhoto('$image')>
                    <img src='$image' alt='$name'>
                </a>
            </div>
        ";
    }
}