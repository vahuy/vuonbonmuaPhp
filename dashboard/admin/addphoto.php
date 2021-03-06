<!doctype html>
<html lang="en">
<head>
    <?php
    require_once '../objects/CONSTANT.php';
    session_start();
    $userType = $_SESSION['userType'];
    $userName = $_SESSION['userName'];
    if (empty($_SESSION) || empty($userName)) {
        header('Location: /dashboard/homepage.php');
    }
    ?>
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

    <?php
    require '../objects/PageContainer.php';
    require_once '../objects/Component.php';
    require_once '../objects/DatabaseConnector.php';

    $dbConnector = new DatabaseConnector();
    $pageContainer = new PageContainer();
    $component = new Component();

    libxml_disable_entity_loader(false);
    $dbConnector->createConnection();
    $products = $dbConnector->getAllProduct();
    $dbConnector->closeConnection();
    $numOfProduct =  count($products);

    $xmlDoc=new DOMDocument();
    $xmlDoc->load(XML_PRODUCT_LOCATION);
    $x=$xmlDoc->getElementsByTagName('product');

    if($numOfProduct !== $x->length) {
        //create xml file
        $dbConnector->createXMPProductList($products, XML_PRODUCT_LOCATION);
    }
    ?>
<!--Handle input-->
    <script src="../js/live_search.js"></script>
    <script>
        function setProduct(object) {
            const id = object.getAttribute("href");
            const name = object.getAttribute("target");
            const mainPhoto = object.getAttribute("image");

            document.getElementById('productName').value = name.toString();
            document.getElementById('productId').value = id.toString();
            document.getElementById("livesearch").style.display="none";
            document.getElementById('mainphoto').src = mainPhoto;
            getImageList(id);
        }
    </script>
</head>

<body class="index">
<div class="header">
    <?php
    $isLogged = false;
    if (!empty($_SESSION["isLogged"])) {
        $isLogged = $_SESSION["isLogged"];
    }
    echo $pageContainer->renderAdminHeaderWithLogin($isLogged);
    ?>
</div>
<div class="wrapper">
    <div class="hero-banner">
        <img src="../../img/hero_banner.jpg" alt="home page">
    </div>
    <div class="container admin add-photo">
        <div class="row">
            <div class="col-md-12">
                <h2>Th??m h??nh s???n ph???m</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-photo">
                    <img id="mainphoto" src="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="live-search">
                <div class="col-md-8">
                    <form>
                        <label>Nh???p t??n<input id="searchField" type="text" size="30" onblur="clearSearch()" onkeyup="showResult(this.value)"></label>
                        <div id="livesearch"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="get" enctype="multipart/form-data" action="processor/doaddphoto.php">
                    <div class="row">
                        <div class="col-md-6"><label>T??n s???n ph???m<input id="productName" type="text" name="productName" required></label></div>
                        <div class="col-md-6"><label>M?? s???n ph???m<input id="productId" type="text" name="productId" required></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6"><label>Link ???nh <textarea name="photo" rows="4" cols="70" >&nbsp;</textarea></label></div>
                        <div class="col-md-6">&nbsp;</label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><?php echo $component->renderButton('Reset','reset', 'reset',false) ?></div>
                        <div class="col-md-6"><?php echo $component->renderButton('Submit','submit', 'submit', false) ?></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Qu???n l?? h??nh</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="txtHint"><b>Images info will be listed here...</b></div>
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
