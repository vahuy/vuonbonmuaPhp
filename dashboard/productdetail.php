
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
    <link href="./stylesheets/reset.css" rel="stylesheet" type="text/css" />
    <link href="./stylesheets/vbm.css" rel="stylesheet" type="text/css" />
    <link href="./stylesheets/productdetail.css" rel="stylesheet" type="text/css" />

    <?php
        require './objects/DatabaseConnector.php';
        require './objects/PageContainer.php';
        require './objects/Image.php';
        require './objects/ProductChild.php';
        require './objects/Component.php';

        $pageContainer = new PageContainer();
        $dbConnector = new DatabaseConnector();
        $component = new Component();
        $UTIL = new UTIL();
    ?>
    <script>
        // Create changing photo function
        function changeMainPhoto(photo) {
            mainphoto.src=photo;
        }
    </script>
</head>

<body class="index">
    <div class="header">
        <?php
            $isLogged = true;
            echo $pageContainer->renderHeader($isLogged);
            //Get PARAM from URL
            $url = $UTIL->getUrl();
            $array = (explode("=",$url));
            $id = ($array[1]);

            $dbConnector->createConnection();
            $result = $dbConnector->getProductDetail($id);
            $images = $dbConnector->getProductImages($id);
            $productChild = $dbConnector->getProductChild($id);
            $productMoreInfo = $dbConnector->getProductMoreInfo($id);
            $dbConnector->closeConnection();
            $productType = null;
        ?>
    </div>

    <div class="wrapper">
        <div class="hero-banner">
            <img src="../img/hero_banner.jpg" alt="home page">
        </div>
        <div class="container product-detail">
            <div class="row">
                <div class="col-md-12">
                    <h2>Product details</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="main-photo">
                            <div class="col-md-12">
                                <?php
                                    $name = $result['name'];
                                    $image = $result['image'];
                                    $productType = $result['type'];
                                    echo "<img id='mainPhoto' src=$image alt=$name>";
                                ?>
                                <script>
                                    //Get id of mainPhoto for changing photo
                                    const mainphoto = document.getElementById('mainPhoto');
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="sub-photo">
                            <div class="col-md-2">
                                <!-- print out main image of product-->
                                <?php
                                    $name = $result['name'];
                                    $image = $result['image'];
                                    echo "
                                        <a onclick=changeMainPhoto('$image')>
                                            <img src='$image' alt='$name'>
                                        </a>
                                    ";
                                ?>
                            </div>
                            <!-- print out all image of product-->
                            <?php
                                $imageList = null;
                                while ($row = $images->fetch_assoc()) {
                                    $id = $row['id'];
                                    $productId = $row['product_id'];
                                    $src= $row['src'];

                                    $item = new Image($id, $productId, $src);
                                    if ($imageList === null){
                                        $imageList = array($item);
                                    } else {
                                        array_push($imageList, $item);
                                    }
                                    $item = null;
                                }
                                if (!empty($imageList)) {
                                    $arrLength = count($imageList);
                                    for($x = 0; $x < $arrLength; $x++) {
                                        echo $imageList[$x]->generateHtml();
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="rose-info">
                        <div><h1><?php echo $result['name'] ?></h1></div>
                        <div><h5>Giống: <?php echo $result['origin'] ?></h5></div>
                        <p>
                            <?php echo $result['description'] ?>
                        </p>
                        <p>IN STOCK: <?php echo $component->getValueFromBoolean($result['is_instock']) ?></p>
                    </div>
                </div>
            </div>
            <?php echo (!empty($productMoreInfo) ?
             "<div class='row rose-more-info'>
                <div class='col-md-12'>
                    <div class='tab-title'>Thông tin thêm</div>
<!--                    BEST SELLER-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Best Seller
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $component->getValueFromBoolean($productMoreInfo->getBestSeller())
                        ."</div>
                    </div>
<!--                    SKU-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            SKU
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getSku()
                        ."</div>
                    </div>
<!--                    Alternate Name(s)-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Alternate Name(s)
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getAlternateName()
                        ."</div>
                    </div>
                    <!-- Specifc ARS Score-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Specifc ARS Score
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getSpecificArsScore()
                        ."</div>
                    </div>
<!--                    Bloom Type-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Kiểu cánh
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getBloomType()
                        ."</div>
                    </div>
<!--                    Breeder Code-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Breeder Code
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getBreederCode()
                        ."</div>
                    </div>
<!--                    Characteristics-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Characteristics
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getCharacteristic()
                        ."</div>
                    </div>
<!--                    Specific Color-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Specific Color
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getSpecificColor()
                        ."</div>
                    </div>
<!--                    Fragrance-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Fragrance
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getFragrance()
                        ."</div>
                    </div>
<!--                    Hardiness Zone(s)-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Hardiness Zone(s)
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getHardinessZone()
                        ."</div>
                    </div>
<!--                    Height-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Height
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getHeight()
                        ."</div>
                    </div>
<!--                    Rebloom-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Rebloom
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getRebloom()
                        ."</div>
                    </div>
<!--                    Shade Tolerant-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Shade Tolerant
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $component->getValueFromBoolean($productMoreInfo->getShadeTolerant())
                        ."</div>
                    </div>
<!--                    Width-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Width
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getWidth()
                        ."</div>
                    </div>
<!--                    Year-->
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'>
                            Year
                        </div>
                        <div class='col-md-9 col-sm-9'>".
                            $productMoreInfo->getYear()
                        ."</div>
                    </div>
                </div>
            </div>":"")
            ?>
            <?php
                if ($productType !== 'treatment') {
                    echo "
                    <div class='row'>
                        <div class='col-md-12'>
                            <p>Danh sách cây đang bán</p>
                        </div>
                    </div>
                    ";
                }
            ?>
            <?php
                if ($productType !== 'treatment') {
                    echo "
                        <div class='child-table'>
                            <div class='row'>
                                <div class='col-md-3'>
                                    <p>Ngày nhập</p>
                                </div>
                                <div class='col-md-3'>
                                    <p>Mô tả</p>
                                </div>
                                <div class='col-md-3'>
                                    <p>Nguồn nhập</p>
                                </div>
                                <div class='col-md-3'>
                                    <p>Giá bán</p>
                                </div>
                            </div>
                    ";
                }
            ?>
                <!--Get all product child-->
                <?php
                    $productChildList = null;
                    while ($row = $productChild->fetch_assoc()) {
                        $id = $row['id'];
                        $productId = $row['product_id'];
                        $entry_date = $row['entry_date'];
                        $price = $row['price'];
                        $importFrom = $row['import_from'];
                        $info = $row['info'];
                        $status = $row['status'];

                        $item = new ProductChild($id, $productId, $entry_date,$price, $importFrom, $info, $status);
                        if ($productChildList === null){
                            $productChildList = array($item);
                        } else {
                            array_push($productChildList, $item);
                        }
                        $item = null;
                    }
                    if (empty($productChildList) && $productType!== 'treatment') {
                        echo "Giống này hiện không có sẵn, xin hệ facebook vườn bốn mùa để order.";
                    } else {
                        if (!empty($productChildList)) {
                            $arrLength = count($productChildList);
                            for ($x = 0; $x < $arrLength; $x++) {
                                echo $productChildList[$x]->generateHtml();
                            }
                        }
                    }
                ?>
            <?php
            if ($productType !== 'treatment') {
                echo "
                        </div>
                    </div>
                    ";
            }
            ?>

        <div class="footer">
            <?php
                echo $pageContainer->renderFooter();
            ?>
        </div>
    </div>
</body>
</html>
