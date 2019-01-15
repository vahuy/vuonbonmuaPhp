<?php
/**
 * Connect database
 * Created by PhpStorm.
 * User: Brian
 * Date: 1/8/2019
 * Time: 9:24 PM
 */
require_once 'Product.php';

class DatabaseConnector
{
    private $connector;

    function createConnection(){
//            $servername = "localhost";
//            $username = "huy";
//            $password = "vuonbonmuatx22";
//            $dbname = "vuonbonmua";

//            $servername = "localhost";dd
//            $username = "laz87900_huy";
//            $password = "vuonbonmuatx22";
//            $dbname = "laz87900_vuonbonmua";
//
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "laz87900_vuonbonmua";

        // Create connection
        if ($this->connector === null) {
            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("utf8");
            $this->connector=$conn;
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        } else {
            return $this->connector;
        }

    }
// SQL Get query
    function getConnector() {
        return $this->connector;
    }

    function getAllProduct(){
        $sql = "SELECT * FROM product";
        $result = $this->connector->query($sql);

//            if ($result->num_rows > 0) {
//                echo "data found";
//            } else {
//                echo "0 results";
//            }
        return $result;
    }

    function getProductDetail($id){
        $sql = "SELECT * FROM product WHERE id='$id'";
        $result = $this->connector->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function getClimbing(){
        $sql = "SELECT * FROM product WHERE type='climbing'";
        $result = $this->connector->query($sql);
        return $result;
    }

    function getShrub(){
        $sql = "SELECT * FROM product WHERE type='shrub'";
        $result = $this->connector->query($sql);
        return $result;
    }

    function getTreatment(){
        $sql = "SELECT * FROM product WHERE type='treatment'";
        $result = $this->connector->query($sql);
        return $result;
    }
    /**
     * Close Database connection
     * @param $conn
     */
    function closeConnection(){
        $this->connector->close();
//            mysqli::mysqli_get_server_info("localhost");
//            echo "close connection successfully";
    }

    function getNote($noteName){
        $sql = "SELECT * FROM note WHERE name='$noteName'";
        $result = $this->connector->query($sql);
        return $result;
    }

    function  validateUserAccount($name, $password){
        $sql = "SELECT * FROM user_account WHERE name='$name' AND password='$password'";
        $result = $this->connector->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function  getProductImages($productId){
        $sql = "SELECT * FROM image WHERE product_id='$productId'";
        $result = $this->connector->query($sql);
        return $result;
    }

    function  getProductChild($productId)
    {
        $sql = "SELECT * FROM product_child WHERE product_id='$productId'";
        $result = $this->connector->query($sql);
        return $result;
    }
//        SQL INSERT QUERY
    function insertProduct(Product $product) {
        $id = $product->getId();
        $name = $product->getName();
        $image = $product->getImage();
        $price = $product->getPrice();
        $shortDescription = $product->getShortDescription();
        $type = $product->getType();
        $description = $product->getDescription();
        $origin = $product->getOrigin();
        $color = $product->getColor();

        $sql = "INSERT INTO product (id,name,color,description,short_description,image,price,type,origin)
          VALUES ('$id','$name', '$color','$description','$shortDescription','$image','$price','$type','$origin')";
        if (mysqli_query($this->connector, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->connector);
        }
    }
}
