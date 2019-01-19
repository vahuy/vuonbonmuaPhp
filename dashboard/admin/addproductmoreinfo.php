<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Use title if it's in the page YAML frontmatter -->
    <title>VuonBonMua</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="lodash" href="https://raw.githubusercontent.com/lodash/lodash/4.17.11-npm/lodash.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="../stylesheets/reset.css" rel="stylesheet" type="text/css" />
    <link href="../stylesheets/vbm.css" rel="stylesheet" type="text/css" />
    <link href="../stylesheets/admin.css" rel="stylesheet" type="text/css" />

    <script src='https://cdn.jsdelivr.net/g/lodash@4(lodash.min.js+lodash.fp.min.js)'></script>

    <?php
    require '../objects/PageContainer.php';
    require_once '../objects/Component.php';
    require_once '../objects/DatabaseConnector.php';
    require_once '../objects/CONSTANT.php';

    $dbConnector = new DatabaseConnector();
    $pageContainer = new PageContainer();
    $component = new Component();
    session_start();
    ?>
    <?php
        $dbConnector->createConnection();
        $products = $dbConnector->getAllProduct();
        $dbConnector->closeConnection();
        $numOfProduct =  count($products);
        echo "numofproduct $numOfProduct";

        $xmlDoc=new DOMDocument();
        $xmlDoc->load(".\xml\productname.xml");
        $x=$xmlDoc->getElementsByTagName('product');

        if($numOfProduct !== $x->length) {
            //create xml file
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" '.' standalone="yes"?><feed/>');
            for ($i = 0; $i < $numOfProduct; ++$i) {
                $id = $products[$i]->getId();
                $name = $products[$i]->getName();
                $track = $xml->addChild('product');
                $track->addChild('id', "$id");
                $track->addChild('name', "$name");
            }
            $xml->asXML(XML_PRODUCT_LOCATION);
        }
    ?>
<!--Handle input-->
    <script>
        function showResult(str) {
            if (str.length===0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState===4 && this.status===200) {
                    document.getElementById("livesearch").innerHTML=this.responseText;
                    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                    document.getElementById("livesearch").style.display="block";
                }
            };
            console.log(str);
            xmlhttp.open("GET","./processor/livesearch.php?q="+str,true);
            xmlhttp.send();
        }

        function setProduct(object) {
            const id = object.getAttribute("href");
            const name = object.getAttribute("target");
            const mainPhoto = object.getAttribute("image");

            document.getElementById('productName').value = name.toString();
            document.getElementById('productId').value = id.toString();
            document.getElementById("livesearch").style.display="none";
            document.getElementById('mainphoto').src = mainPhoto;
        }

        function clearSearch() {
            document.getElementById('searchField').value = null;
        }

    </script>
</head>

<body class="index">
<div class="header">
    <?php
        $isLogged = false;
        echo $pageContainer->renderAdminHeaderWithLogin($isLogged);
    ?>
</div>

<div class="wrapper">
    <div class="hero">
        &nbsp;
    </div>
    <div class="container admin add-photo">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm chi tiết sản phẩm</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-photo">
                    <img id="mainphoto" src="" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="live-search">
                <div class="col-md-8">
                    <form>
                        <label>Nhập tên<input id="searchField" type="text" size="30" onblur="clearSearch()" onkeyup="showResult(this.value)"></label>
                        <div id="livesearch"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="get" enctype="multipart/form-data" action="processor/doaddproductmoreinfo.php">
                    <div class="row">
                        <div class="col-md-6"><label>Tên sản phẩm<input id="productName" type="text" name="productName" required></label></div>
                        <div class="col-md-6"><label>Mã sản phẩm<input id="productId" type="text" name="productId" required></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6"><label>Best Seller<?php $component->renderOption('bestSeller',false, $OPTION_YES_NO, $OPTION_YES_NO_NAME) ?></label></div>
                        <div class="col-md-6"><label>SKU<input type="text" id="sku" name="sku"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6"><label>Alternate Name<input type="text" id="alternateName" name="alternateName"></label></div>
                        <div class="col-md-6"><label>Specifc ARS Score<input type="text" id="specificArsScore" name="specificArsScore"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6"><label>Bloom Type<input type="text" id="bloomType" name="bloomType"></label></div>
                        <div class="col-md-6"><label>Breed Code<input type="text" id="breederCode" name="breederCode"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6"><label>Characteristics<input type="text" id="characteristic" name="characteristic" ></label></div>
                        <div class="col-md-6"><label>Specific Color<input type="text" name="specificColor" id="specificColor"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6"><label>Fragrance<input type="text" id="fragrance" name="fragrance" ></></label></div>
                        <div class="col-md-6"><label>Height<input type="text" id="height" name="height" </label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6"><label>Patent #<input type="text" id="patent" name="patent" ></label></div>
                        <div class="col-md-6"><label>Rebloom<input type="text" id="rebloom" name="rebloom"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6"><label>Shade Tolerant<?php $component->renderOption('shadeTolerant',false, $OPTION_YES_NO, $OPTION_YES_NO_NAME) ?></label></div>
                        <div class="col-md-6"><label>Width<input type="text" id="width" name="width"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><label>Hardiness Zone<input type="text" id="hardinessZone" name="hardinessZone"></label></div>
                        <div class="col-md-6 col-lg-6"><label>Year<input type="text" id="year" name="year" ></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><?php echo $component->renderButton('Reset','reset', 'reset',false) ?></div>
                        <div class="col-md-6"><?php echo $component->renderButton('Submit','submit', 'submit', false) ?></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php
            echo $pageContainer->renderFooter();
        ?>
    </div>
</div>
</body>
</html>
