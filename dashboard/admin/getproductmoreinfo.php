<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/24/2019
 * Time: 10:36 AM
 */
session_start();
$userType = $_SESSION['userType'];
$userName = $_SESSION['userName'];
if (empty($_SESSION) || empty($userName)) {
    header('Location: /dashboard/homepage.php');
}

require_once("../objects/DatabaseConnector.php");
require_once("../objects/Component.php");
$id = ($_GET['id']);
$dbConnector = new DatabaseConnector();
$component = new Component();
$dbConnector->createConnection();
$moreInfo = $dbConnector->getProductMoreInfo($id);
$dbConnector->closeConnection();

$best_seller = $moreInfo->getBestSeller();
$sku = $moreInfo->getSku();
$alternate_name = $moreInfo->getAlternateName();
$specific_ars_score = $moreInfo->getSpecificArsScore();
$bloom_type = $moreInfo->getBloomType();
$breeder_code = $moreInfo->getBreederCode();
$characteristic = $moreInfo->getCharacteristic();
$specific_color = $moreInfo->getSpecificColor();
$fragrance = $moreInfo->getFragrance();
$hardiness_zone = $moreInfo->getHardinessZone();
$height = $moreInfo->getHeight();
$patent = $moreInfo->getPatent();
$rebloom = $moreInfo->getRebloom();
$shade_tolerant = $moreInfo->getShadeTolerant();
$width = $moreInfo->getWidth();
$year = $moreInfo->getYear();

?>
<div class="row">
    <div class="col-md-6 col-lg-6"><label>Best Seller<?php $component->renderOptionWithSelected('bestSeller',false, $OPTION_YES_NO, $OPTION_YES_NO_NAME, $best_seller) ?></label></div>
    <div class="col-md-6"><label>SKU<input type="text" id="sku" name="sku" value="<?php echo $sku ?>"></label></div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6"><label>Alternate Name<input type="text" id="alternateName" name="alternateName" value="<?php echo $alternate_name ?>"></label></div>
    <div class="col-md-6"><label>Specifc ARS Score<input type="text" id="specificArsScore" name="specificArsScore" value="<?php echo $specific_ars_score ?>"></label></div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6"><label>Bloom Type<input type="text" id="bloomType" name="bloomType" value="<?php echo $bloom_type ?>"></label></div>
    <div class="col-md-6"><label>Breed Code<input type="text" id="breederCode" name="breederCode" value="<?php echo $breeder_code ?>"></label></div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6"><label>Characteristics<input type="text" id="characteristic" name="characteristic" value="<?php echo $characteristic ?>"></label></div>
    <div class="col-md-6"><label>Specific Color<input type="text" name="specificColor" id="specificColor" value="<?php echo $specific_ars_score ?>"></label></div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6"><label>Fragrance<input type="text" id="fragrance" name="fragrance" value="<?php echo $alternate_name ?>"></label></div>
    <div class="col-md-6"><label>Height<input type="text" id="height" name="height" value="<?php echo $height ?>"></label></div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6"><label>Patent #<input type="text" id="patent" name="patent" value="<?php echo $patent ?>"></label></div>
    <div class="col-md-6"><label>Rebloom<input type="text" id="rebloom" name="rebloom" value="<?php echo $rebloom ?>" ></label></div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6"><label>Shade Tolerant<?php $component->renderOptionWithSelected('shadeTolerant',false, $OPTION_YES_NO, $OPTION_YES_NO_NAME, $shade_tolerant) ?></label></div>
    <div class="col-md-6"><label>Width<input type="text" id="width" name="width" value="<?php echo $width ?>" ></label></div>
</div>
<div class="row">
    <div class="col-md-6"><label>Hardiness Zone<input type="text" id="hardinessZone" name="hardinessZone" value="<?php echo $hardiness_zone ?>" ></label></div>
    <div class="col-md-6 col-lg-6"><label>Year<input type="text" id="year" name="year" value="<?php echo $year ?>" ></label></div>
</div>
<div class="row">
    <div class="col-md-6"><?php echo $component->renderButton('Reset','reset', 'reset',false) ?></div>
    <div class="col-md-6"><?php echo $component->renderButton('Submit','submit', 'submit', false) ?></div>
</div>
