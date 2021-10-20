<!doctype html>
<html lang="en">
<head>
    <?php
    /**
     * Created by PhpStorm.
     * User: Brian
     * Date: 1/23/2019
     * Time: 11:02 PM
     */
    require_once '../objects/CONSTANT.php';
    require_once ("../objects/Util.php");
    $UTIL = new UTIL();
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

    <script src='https://cdn.jsdelivr.net/g/lodash@4(lodash.min.js+lodash.fp.min.js)'></script>

    <?php
    require '../objects/PageContainer.php';
    require_once '../objects/DatabaseConnector.php';

    $dbConnector = new DatabaseConnector();
    $pageContainer = new PageContainer();
    ?>
    <?php
    $url = $UTIL->getUrl();
    $array = (explode("=",$url));
    $id = ($array[1]);
    $dbConnector->createConnection();
    $product = $dbConnector->getProductDetail($id);
    $result = $dbConnector->getProductImages($id);
    $dbConnector->closeConnection();
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
</div>
<div class="wrapper">
    <div class="hero-banner">
        <img src="../../img/hero_banner.jpg" alt="home page">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-photo">
                    <img id="mainphoto" src="<?php echo $product['image'] ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý hình</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="txtHint"><b>Images info will be listed here...</b></div>
                <?php
                echo "<table>
                <tr>
                <th>Lastname</th>
                <th>Age</th>
                <th>&nbsp;</th>
                </tr>";
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $src = $row['src'];
                    $productId = $row['product_id'];
                    echo "<tr>";
                    echo "<td><img src="."'$src'" ."alt='Smiley face' height='42' width='42'></td>";
                    echo "<td>$id</td>";
                    echo "<td><a href='./processor/deleteImage.php?id=$id&product=$productId'>X</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
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
