<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 1/19/2019
 * Time: 4:11 PM
 */

session_start();
$userType = $_SESSION['userType'];
$userName = $_SESSION['userName'];
if (empty($_SESSION) || empty($userName)) {
    header('Location: /dashboard/homepage.php');
}

require_once ("../../objects/DatabaseConnector.php");
require_once ("../../objects/ProductMoreInfo.php");

$dbConnector = new DatabaseConnector();

if (isset($_GET["submit"])) {
    $productId = $_GET["productId"];
    $bestSeller = $_GET["bestSeller"];
    $sku = $_GET["sku"];
    $alternateName = $_GET["alternateName"];
    $specificArsScore = $_GET["specificArsScore"];
    $bloomType = $_GET["bloomType"];
    $breederCode = $_GET["breederCode"];
    $characteristic = $_GET["characteristic"];
    $specificColor = $_GET["specificColor"];
    $fragrance = $_GET["fragrance"];
    $hardinessZone = $_GET["hardinessZone"];
    $height = $_GET["height"];
    $patent = $_GET["patent"];
    $rebloom = $_GET["rebloom"];
    $shadeTolerant = $_GET["shadeTolerant"];
    $width = $_GET["width"];
    $year = $_GET["year"];

    $productInfo = new ProductMoreInfo(null,$productId,$bestSeller,$sku,$alternateName,$specificArsScore,
        $bloomType,$breederCode,$characteristic,$specificColor,$fragrance,$hardinessZone,
        $height,$patent,$rebloom,$shadeTolerant,$width,$year);

    $productInfo->setId(spl_object_hash($productInfo));

    $dbConnector->createConnection();
    $result = $dbConnector->insertProductMoreInfo($productInfo);
    $dbConnector->closeConnection();

    $url = "Location: /dashboard/productdetail.php?id=".$productId;

    if ($result===QUERY_SUCCESS) {
        header($url);
    } else {
        echo $result;
    }
}