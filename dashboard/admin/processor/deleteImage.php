<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/23/2019
 * Time: 4:20 PM
 */

require_once ("../../objects/DatabaseConnector.php");
session_start();
$userType = $_SESSION['userType'];
$userName = $_SESSION['userName'];
if (empty($_SESSION) || empty($userName)) {
    header('Location: /dashboard/homepage.php');
}


$id = ($_GET['id']);
$productId = ($_GET['product']);

if (!empty($id)) {
    echo "product id $id";
    $url = 'Location:/dashboard/admin/manageProductImage.php?productId='.$productId;
    $dbConnector = new DatabaseConnector();
    $dbConnector->createConnection();
    $result = $dbConnector->deleteById(TABLE_IMAGE,$id);
    if($result === QUERY_SUCCESS) {
        header($url);
    } else {
        echo $result;
    }

    $dbConnector->closeConnection();
}
