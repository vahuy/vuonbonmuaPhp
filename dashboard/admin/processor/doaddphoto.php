<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/17/2019
 * Time: 3:52 PM
 */
    require_once ("../../objects/DatabaseConnector.php");
    require_once ("../../objects/Image.php");
    require_once ("../../objects/DatabaseConnector.php");

    $dbConnector = new DatabaseConnector();
    if (isset($_GET["submit"])) {
        $productId = $_GET["productId"];
        $inputPhoto = $_GET["photo"];
        $arrayPhotoObject = null;
        $arrayPhotoSrc = (explode("https://",$inputPhoto));

        if (!empty($arrayPhotoSrc)) {
            $numOfPhoto = count($arrayPhotoSrc);
            for($x = 1; $x < $numOfPhoto; $x++) {
                $photoInfo = new Image(null, $productId, $arrayPhotoSrc[$x]);
                $photoInfo->setId(spl_object_hash($photoInfo));
                if (empty($arrayPhotoObject)){
                    $arrayPhotoObject = array($photoInfo);
                } else {
                    array_push($arrayPhotoObject, $photoInfo);
                }
                echo "<br><br>";
                $photoInfo = null;
            }
        }
        $dbConnector->createConnection();
        $dbConnector->insertPhoto($arrayPhotoObject);
        $queryResult = $dbConnector->closeConnection();
        if ($queryResult === QUERY_SUCCESS) {
            header('Location: /dashboard/admin/addproduct.php');
        } else {
            echo $queryResult;
        }
    }