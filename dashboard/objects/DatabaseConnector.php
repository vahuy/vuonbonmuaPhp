<?php
/**
 * Connect database
 * Created by PhpStorm.
 * User: Brian
 * Date: 1/8/2019
 * Time: 9:24 PM
 */
require_once "Product.php";
require_once "ProductMoreInfo.php";

class DatabaseConnector
{
    private $connector;
    private $PRODUCT_TYPE = array("shrub","climbing","otherPlants","treatment");

    function createConnection(){
            $servername = "localhost";
            $username = "huy";
            $password = "vuonbonmuatx22";
            $dbname = "laz87900_vuonbonmua";

//            $servername = "localhost";
//            $username = "laz87900_huy";
//            $password = "vuonbonmuatx22";
//            $dbname = "laz87900_vuonbonmua";


        // Create connection
        if ($this->connector === null) {
            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("utf8");
            $this->connector=$conn;
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
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

        $products = null;
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $image = $row['image'];
            $price = $row['price'];
            $shortDescription = $row['short_description'];
            $type = $row['type'];
            $description = $row['description'];
            $origin = $row['origin'];

            $item = new Product($id, $name, $image, $price, $shortDescription, $type, $description, $origin);
            if ($products === null){
                $products = array($item);
            } else {
                array_push($products, $item);
            }
            $item = null;
        }
        if (count($products)>0) {
            return $products;
        } else {
            return null;
        }
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

    function getProduct($productType){
        $types = $this->PRODUCT_TYPE;
        $result = null;
        if(in_array($productType, $types)) {
            $sql = "SELECT * FROM product WHERE type='$productType'";
            $result = $this->connector->query($sql);
        }
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
        $result = null;
        if (!empty($productId)) {
            $sql = "SELECT * FROM image WHERE product_id='$productId'";
            $result = $this->connector->query($sql);
        }
        return $result;
    }

    function  getProductChild($productId)
    {
        $sql = "SELECT * FROM product_child WHERE product_id='$productId'";
        $result = $this->connector->query($sql);
        return $result;
    }

    function getProductByKey($key) {
        $result = null;
        if (!empty($key)) {
            $keys = explode(" ", $key);

            $arrlength = count($keys);

            $condition = "";

            for ($x = 0; $x < $arrlength; $x++) {
                $condition = $condition." pm.specific_color LIKE '%$keys[$x]%' OR p.name LIKE '%$keys[$x]%' OR";
            }
            $condition = rtrim($condition, 'OR');

            $sql = "SELECT p.id, p.name, p.price, p.short_description, p.image
            FROM product p LEFT JOIN product_more_info pm
            ON p.id = pm.product_id
            WHERE".$condition;

            $result = $this->connector->query($sql);
        }
        return $result;
    }

    function getProductMoreInfo($productId) {
        $sql = "SELECT * FROM product_more_info WHERE product_id='$productId'";
        $result = $this->connector->query($sql);
        $row = $result->fetch_assoc();

        $id = $row['id'];
        $product_id = $row['product_id'];
        $best_seller = $row['best_seller'];
        $sku = $row['sku'];
        $alternate_name = $row['alternate_name'];
        $specific_ars_score=$row['specific_ars_score'];
        $bloom_type=$row['bloom_type'];
        $breeder_code=$row['breeder_code'];
        $characteristic=$row['characteristic'];
        $specific_color=$row['specific_color'];
        $fragrance=$row['fragrance'];
        $hardiness_zone=$row['hardiness_zone'];
        $height=$row['height'];
        $patent=$row['patent'];
        $rebloom=$row['rebloom'];
        $shade_tolerant=$row['shade_tolerant'];
        $width=$row['width'];
        $year=$row['year'];

        $productInfo = new ProductMoreInfo($id,$product_id,$best_seller,$sku,$alternate_name,$specific_ars_score,
            $bloom_type, $breeder_code, $characteristic,$specific_color,$fragrance,$hardiness_zone,$height,
            $patent,$rebloom,$shade_tolerant,$width,$year);

        return $productInfo;

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
        $isInStock = $product->getIsInStock();
        $sqlsearch = "SELECT * FROM product WHERE id='$id'";

        $result = $this->connector->query($sqlsearch);

        if ($result->num_rows > 0) {
            //update
            $sql = "UPDATE product
                SET 
                    name = '$name',
                    image = '$image',
                    price = '$price',
                    short_description = '$shortDescription',
                    type = '$type',
                    description = '$description',
                    origin = '$origin',
                    is_instock = '$isInStock'
                WHERE id='$id';
            ";
        } else {
//          insert
            $sql = "INSERT INTO product (id,name,description,short_description,image,price,type,origin,is_instock)
          VALUES ('$id','$name','$description','$shortDescription','$image','$price','$type','$origin','$isInStock')";
        }

        if (mysqli_query($this->connector, $sql)) {
            return QUERY_SUCCESS;
        } else {
            return "Error: " . $sql . "<br>" . mysqli_error($this->connector);
        }
    }

    function insertPhoto($arrayPhoto) {
        $sql = "INSERT INTO image (id, product_id, src) VALUE";
        if (!empty($arrayPhoto)) {
            foreach ($arrayPhoto as $value) {
                $id = $value->getId();
                $productId = $value->getProductId();
                $src = $value->getSrc();
                $photoInfo = "('$id','$productId','$src'),";
                $sql.=$photoInfo;
            }
            $sql=rtrim($sql,',');
        }
        if (mysqli_query($this->connector, $sql)) {
            echo "New record created successfully";
            return QUERY_SUCCESS;
        } else {
            return "Error: " . $sql . "<br>" . mysqli_error($this->connector);
        }
    }

    function insertProductMoreInfo(ProductMoreInfo $info) {
        $id = $info->getId();
        $product_id = $info->getProductId();
        $best_seller = $info->getBestSeller();
        $sku = $info->getSku();
        $alternate_name = $info->getAlternateName();
        $specific_ars_score=$info->getSpecificArsScore();
        $bloom_type=$info->getBloomType();
        $breeder_code=$info->getBreederCode();
        $characteristic=$info->getCharacteristic();
        $specific_color=$info->getSpecificColor();
        $fragrance=$info->getFragrance();
        $hardiness_zone=$info->getHardinessZone();
        $height=$info->getHeight();
        $patent=$info->getPatent();
        $rebloom=$info->getRebloom();
        $shade_tolerant=$info->getShadeTolerant();
        $width=$info->getWidth();
        $year=$info->getYear();

        $sqlsearch = "SELECT * FROM product_more_info WHERE product_id = '$product_id'";
        $result = $this->connector->query($sqlsearch);

        $bloom_type = $bloom_type === 'yes' ? true : false;
        $best_seller = $best_seller === 'yes' ? true : false;
        if ($result->num_rows > 0) {
            //update
            $sql = "UPDATE product_more_info
                SET 
                    best_seller = '$best_seller',
                    sku = '$sku',
                    alternate_name = '$alternate_name',
                    specific_ars_score= '$specific_ars_score',
                    bloom_type = '$bloom_type',
                    breeder_code = '$breeder_code',
                    characteristic = '$characteristic',
                    specific_color = '$specific_color',
                    fragrance = '$fragrance',
                    hardiness_zone = '$hardiness_zone',
                    height = '$height',
                    patent = '$patent',
                    rebloom = '$rebloom',
                    shade_tolerant = '$shade_tolerant',
                    width = '$width',
                    year = '$year'
                WHERE product_id = '$product_id';
            ";
        } else {
            //insert
            $sql = "INSERT INTO product_more_info (id, product_id, best_seller, sku, alternate_name, specific_ars_score, bloom_type, breeder_code, characteristic, specific_color, fragrance, hardiness_zone, height, patent, rebloom, shade_tolerant, width, year)
                    VALUE ('$id','$product_id','$best_seller','$sku','$alternate_name','$specific_ars_score','$bloom_type','$breeder_code','$characteristic','$specific_color','$fragrance','$hardiness_zone','$height','$patent','$rebloom','$shade_tolerant','$width','$year')
                ";
        }
        if (mysqli_query($this->connector, $sql)) {
            echo "New record created successfully";
            return QUERY_SUCCESS;
        } else {
            return "Error: " . $sql . "<br>" . mysqli_error($this->connector);
        }
    }

    function createXMPProductList($products, $location) {
        $numOfProduct = count($products);
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" '.' standalone="yes"?><feed/>');
        for ($i = 0; $i < $numOfProduct; ++$i) {
            $id = $products[$i]->getId();
            $name = $products[$i]->getName();
            $image = $products[$i]->getImage();
            $image = empty($image) ? "#" : $image;
            $track = $xml->addChild('product');
            $track->addChild('id', "$id");
            $track->addChild('name', "$name");
            $track->addChild('image', "$image");
        }
        $xml->asXML($location);
    }
    
    // SQL DELETE QUERY;
    function deleteById($tableName, $id) {
        $sql = "DELETE FROM $tableName WHERE id='$id'";
        if ($this->connector->query($sql) === TRUE) {
            return QUERY_SUCCESS;
        } else {
            return "Error deleting record: " . $this->connector->error;
        }
    }

    function deleteProduct($id) {
        $sql = "
        DELETE product, product_more_info, product_child, image 
        FROM product
        LEFT JOIN product_more_info ON product.id = product_more_info.product_id
        LEFT JOIN image ON product.id = image.product_id
        LEFT JOIN product_child ON product_child.product_id = product.id
        WHERE product.id = '$id'
        ";
        if ($this->connector->query($sql) === TRUE) {
            return QUERY_SUCCESS;
        } else {
            return "Error deleting record: " . $this->connector->error;
        }
    }
}
