<!doctype html>
<html lang="en">
<head>
    <?php
    session_start();
    $userType = $_SESSION['userType'];
    $userName = $_SESSION['userName'];
    if (empty($_SESSION) || empty($userName) || $userType !== ADMIN) {
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
    <link href="../stylesheets/modal.css" rel="stylesheet" type="text/css" />
    <link href="../stylesheets/admin.css" rel="stylesheet" type="text/css" />

    <script src='https://cdn.jsdelivr.net/g/lodash@4(lodash.min.js+lodash.fp.min.js)'></script>

    <?php
    require '../objects/PageContainer.php';
    require_once '../objects/Component.php';
    require_once "../objects/CONSTANT.php";
    $pageContainer = new PageContainer();
    $component = new Component();
    ?>

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
    <?php
    /**
     * Created by PhpStorm.
     * User: vahuy
     * Date: 1/22/2019
     * Time: 4:18 PM
     */
    require_once("../objects/DatabaseConnector.php");
    if (isset($_GET["gotoUpdate"])) {
        $productId = $_GET["productId"];
        $dbConnector = new DatabaseConnector();
        $dbConnector->createConnection();
        $product = $dbConnector->getProductDetail($productId);
        $dbConnector->closeConnection();
        if ($product === null) {
            header('Location: /dashboard/admin/addproduct.php');
        } else {
            $id = $product['id'];
            $name = $product['name'];
            $price = $product['price'];
            $type = $product['type'];
            $image = $product['image'];
            $shortDescription = $product['short_description'];
            $description = $product['short_description'];
            $origin = $product['origin'];
            $instock = $product['is_instock'];
        }
    }
    $PRODUCT_TYPE = json_decode(PRODUCT_TYPE);
    $PRODUCT_TYPE_NAME = json_decode(PRODUCT_TYPE_NAME);
    ?>
</div>

<div class="wrapper">
    <div class="hero-banner">
        <img src="../../img/hero_banner.jpg" alt="home page">
    </div>
    <div class="container admin">
        <div class="row">
            <div class="col-md-12">
                <h2>Thông tin sản phẩm</h2>
            </div>
            <form action="./processor/doaddproduct.php" method="post">
                <div class="row">
                    <div class="col-md-6"><label>Mã sản phẩm <input type="text" name="product_id" required value="<?php echo $id?$id:'' ?>"></label></div>
                    <div class="col-md-6"><label>Tên <input type="text" name="name" required value="<?php echo $name?$name:'' ?>"></label></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label>Loại <?php echo $component->renderOptionWithSelected('productType', false, $PRODUCT_TYPE, $PRODUCT_TYPE_NAME, $instock) ?></label></div>
                    <div class="col-md-6"><label>Instock <?php echo $component->renderOption('instock', false, $OPTION_YES_NO, $OPTION_YES_NO_NAME) ?></label></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label>Giá từ <input type="number" id="price" min="1000" step="1000" name="price" value="<?php echo $price?$price:'' ?>"></label></div>
                    <div class="col-md-6"><label>Xuất xứ <input type="text" id="origin" name="origin" value="<?php echo $origin?$origin:'' ?>"></label></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label>Mô tả ngắn <textarea id="shortDescription" name="short_description" required rows="4" cols="50"><?php echo $shortDescription?$shortDescription:'' ?></textarea></label></div>
                    <div class="col-md-6"><label>Mô tả <textarea id="description" name="description" rows="10" cols="50" ><?php echo $description?$description:'' ?></textarea></label></div>
                </div>
                <div class="row">
                    <div class="col-md-12"><label>Hình chính <input type="text" id="mainphoto" name="main_photo" value="<?php echo $image?$image:'' ?>"></label></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><?php echo $component->renderButton('Reset','reset', 'reset',false) ?></div>
                    <div class="col-md-4"><?php echo $component->renderButton('Update','update', 'submit', false) ?></div>
                    <div class="col-md-4"><?php echo $component->renderButton('Delete','delete', 'submit', false) ?></div>
                </div>
            </form>
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

