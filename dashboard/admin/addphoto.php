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

            document.getElementById('productName').value = name.toString();
            document.getElementById('productId').value = id.toString();
            document.getElementById("livesearch").style.display="none";
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
    <div class="container admin">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm hình sản phẩm</h2>
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
                <form method="get" enctype="multipart/form-data" action="processor/doaddphoto.php">
                    <div class="row">
                        <div class="col-md-6"><label>Tên sản phẩm<input id="productName" type="text" name="productName" required></label></div>
                        <div class="col-md-6"><label>Mã sản phẩm<input id="productId" type="text" name="productId" required></label></div>
                    </div><div class="row">
                        <div class="col-md-6 col-lg-6"><label>Link ảnh <textarea name="photo" rows="4" cols="70" placeholder="Describe yourself here...">&nbsp;</textarea></label></div>
                        <div class="col-md-6">&nbsp;</label></div>
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
