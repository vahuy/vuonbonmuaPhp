
<?php

session_start();
$userType = $_SESSION['userType'];
$userName = $_SESSION['userName'];
if (empty($_SESSION) || empty($userName)) {
    header('Location: /dashboard/homepage.php');
}
    require_once ("../../objects/Product.php");
    require_once ("../../objects/DatabaseConnector.php");
    require_once ("../../objects/CONSTANT.php");
    $dbConnector = new DatabaseConnector();

    $name = $_POST["name"];
    $type = $_POST["productType"];
    $price = $_POST["price"];
    $short_description = $_POST["short_description"];
    $description = $_POST["description"];
    $main_photo = $_POST["main_photo"];
    $origin = $_POST["origin"];
    $is_instock = $_POST["instock"];

    if (isset($_POST["submit"])) {
        $product = new Product(null, $name, $main_photo, $price, $short_description, $type, $description, $origin);
        $product->setIsInStock($is_instock);
        $product->setId(spl_object_hash($product));
        $dbConnector->createConnection();
        $queryReqult = $dbConnector->insertProduct($product);
        $dbConnector->closeConnection();
        $product = null;

        if ($queryReqult === QUERY_SUCCESS) {
            header('Location: /dashboard/admin/addproduct.php');
        } else {
            echo $queryReqult;
        }
    }
    if (isset($_POST["update"])) {
        $id = $_POST["product_id"];
        $product = new Product($id, $name, $main_photo, $price, $short_description, $type, $description, $origin);
        $product->setIsInStock($is_instock);
        print_r($product);
        $dbConnector->createConnection();
        $queryReqult = $dbConnector->insertProduct($product);
        $dbConnector->closeConnection();
        $product = null;
        if ($queryReqult === QUERY_SUCCESS) {
            header('Location: /dashboard/admin/addproduct.php');
        } else {
            echo $queryReqult;
        }
    }
    if (isset($_POST["delete"])) {
        $id = $_POST["product_id"];
        echo "delete $id";
        $dbConnector->createConnection();
        $queryResult = $dbConnector->deleteProduct($id);
        $products = $dbConnector->getAllProduct();
        if ($queryResult === QUERY_SUCCESS) {
            header('Location: /dashboard/admin/addproduct.php');
            $dbConnector->createXMPProductList($products, XML_PRODUCT_LOCATION_LV1);
        } else {
            echo $queryResult;
        }
        $dbConnector->closeConnection();
    }

