<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/25/2019
 * Time: 10:17 AM
 */
require_once "./objects/DatabaseConnector.php";
$key = $_GET['q'];
$dbConnector = new DatabaseConnector();
$dbConnector->createConnection();
$result = $dbConnector->getProductByKey($key);
$dbConnector->closeConnection();
?>

<div class="product-list">
    <div class="row">
        <?php
        $products = null;
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $image = $row['image'];
            $price = $row['price'];
            $shortDescription = $row['short_description'];

            $item = new Product($id, $name, $image, $price, $shortDescription, null, null, null);
            if ($products === null){
                $products = array($item);
            } else {
                array_push($products, $item);
            }
            $item = null;
        }
        $arrlength = count($products);
        for($x = 0; $x < $arrlength; $x++) {
            echo $products[$x]->generateHtml();
        }
        ?>
    </div>
</div>