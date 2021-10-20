<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/17/2019
 * Time: 3:52 PM
 */
session_start();
$userType = $_SESSION['userType'];
$userName = $_SESSION['userName'];
if (empty($_SESSION) || empty($userName)) {
    header('Location: /dashboard/homepage.php');
}

require_once ("../../objects/DatabaseConnector.php");
require_once ("../../objects/Image.php");
require_once ("../../objects/DatabaseConnector.php");

$dbConnector = new DatabaseConnector();
if (isset($_GET["submit"])) {
    $productId = $_GET["productId"];
    $inputPhoto = $_GET["photo"];
    $arrayPhotoObject = null;
    if (empty($inputPhoto)) {
        header('Location: /dashboard/admin/addphoto.php');
    } else {
        $arrayPhotoSrc = (explode("https://",$inputPhoto));
        if (!empty($arrayPhotoSrc)) {
            $numOfPhoto = count($arrayPhotoSrc);
            for($x = 1; $x < $numOfPhoto; $x++) {
                $src = 'https://'.trim($arrayPhotoSrc[$x],"\t\r\n");
                $photoInfo = new Image(null, $productId, $src);
                $photoInfo->setId(spl_object_hash($photoInfo));
                if (empty($arrayPhotoObject)){
                    $arrayPhotoObject = array($photoInfo);
                } else {
                    array_push($arrayPhotoObject, $photoInfo);
                }
                $photoInfo = null;
            }
        }
        $dbConnector->createConnection();
        $queryResult = $dbConnector->insertPhoto($arrayPhotoObject);
        $dbConnector->closeConnection();
        if ($queryResult === QUERY_SUCCESS) {
            header('Location: /dashboard/admin/addproduct.php');
        } else {
            echo $queryResult;
        }
    }
}