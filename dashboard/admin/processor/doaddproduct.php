<?php
    require_once ("../../objects/Product.php");
    require_once ("../../objects/DatabaseConnector.php");
    require_once ("../../objects/CONSTANT.php");
    $dbConnector = new DatabaseConnector();

    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $type = $_POST["productType"];
        $price = $_POST["price"];
        $color = $_POST["color"];
        $short_description = $_POST["short_description"];
        $description = $_POST["description"];
        $main_photo = $_POST["main_photo"];
        $origin = $_POST["origin"];
        $product = new Product(null, $name, $main_photo, $price, $short_description, $type, $description, $origin, $color);
        $product->setId(spl_object_hash($product));
        $dbConnector->createConnection();
        $queryReqult = $dbConnector->insertProduct($product);
        $product = null;
        $dbConnector->closeConnection();
        if ($queryReqult === QUERY_SUCCESS) {
            header('Location: /dashboard/admin/addproduct.php');
        } else {
            echo $queryReqult;
        }

    }
