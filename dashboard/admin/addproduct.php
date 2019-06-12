<!doctype html>
<html lang="en">
<head>
    <?php
    require_once ("../objects/CONSTANT.php");
    require_once ("../objects/DatabaseConnector.php");
    session_start();
    $userType = $_SESSION['userType'];
    $userName = $_SESSION['userName'];
    if (empty($_SESSION) || empty($userName) || $userType !== ADMIN) {
        header('Location: /dashboard/homepage.php');
    }

    $dbConnector = new DatabaseConnector();
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
    $PRODUCT_TYPE = json_decode(PRODUCT_TYPE);
    $PRODUCT_TYPE_NAME = json_decode(PRODUCT_TYPE_NAME);
    ?>
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
            xmlhttp.open("GET","./processor/livesearch.php?q="+str,true);
            xmlhttp.send();
        }

        function setProduct(object) {
            const id = object.getAttribute("href");
            const name = object.getAttribute("target");
            document.getElementById("livesearch").style.display="none";
            document.getElementById('productName').value = name.toString();
            document.getElementById('productId').value = id.toString();
        }

        function clearSearch() {
            document.getElementById('searchField').value = null;
        }

    </script>
</div>

<div class="wrapper">
    <div class="hero-banner">
        <img src="../../img/hero_banner.jpg" alt="home page">
    </div>
    <div class="container admin">
        <div class="row">
            <div class="col-md-12">
                <h2>Tìm sản phẩm</h2>
            </div>
            <form action="updateProduct.php" method="get">
                <div class="row">
                    <div class="col-md-6">
                            <label>Nhập tên<input id="searchField" type="text" size="30" onblur="clearSearch()" onkeyup="showResult(this.value)"></label>
                            <div id="livesearch"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label>Tên sản phẩm<input id="productName" type="text" name="productName" required disabled></label></div>
                    <div class="col-md-6"><label>Mã sản phẩm<input id="productId" type="text" name="productId" required></label></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" name="gotoUpdate">Load product</button>
                    </div>
                </div>
            </form>
            <div class="col-md-12">
                <h2>Tạo sản phẩm mới</h2>
            </div>
            <form action="./processor/doaddproduct.php" method="post">
                <div class="row">
                    <div class="col-md-6"><label>Tên <input type="text" name="name" required></label></div>
                    <div class="col-md-6"><label>Loại <?php echo $component->renderOption('productType', false, $PRODUCT_TYPE, $PRODUCT_TYPE_NAME) ?></label></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label>Giá từ <input type="number" id="price" min="10000" step="10000" value="300000" name="price"></label></div>
                    <div class="col-md-6"><label>Xuất xứ <input type="text" id="origin" name="origin"></label></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label>Mô tả ngắn <textarea id="shortDescription" name="short_description" required rows="4" cols="50" >&nbsp;</textarea></label></div>
                    <div class="col-md-6"><label>Mô tả <textarea id="description" name="description" rows="10" cols="50" >&nbsp;</textarea></label></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label>Hình chính <input type="text" id="mainphoto" name="main_photo"></label></div>
                    <div class="col-md-6"><label>Instock <?php echo $component->renderOption('instock', false, $OPTION_YES_NO, $OPTION_YES_NO_NAME) ?></label></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><?php echo $component->renderButton('Reset','reset', 'reset',false) ?></div>
                    <div class="col-md-6"><?php echo $component->renderButton('Submit','submit', 'submit', false) ?></div>
                </div>
            </form>
            <div class="col-md-12">
                <h2>Danh sách sản phẩm</h2>
            </div>
            <div class="row">
                <div class="col-md-6"><label>Số lượng</label></div>
                <div class="col-md-6"><label><?php echo $numOfProduct?></label></div>
            </div>
            <div class="table-all-product">
                <table>
                    <tr>
                        <td>ID</td>
                        <td>NAME</td>
                    </tr>
                    <?php
                        for ($i = 0; $i < $numOfProduct; $i++) {
                            $id = $products[$i]->getId();
                            $name = $products[$i]->getName();

                            echo "<tr>
                                    <td>$id</td>
                                    <td>$name</td>
                                  </tr>";
                        }
                    ?>
                </table>
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
