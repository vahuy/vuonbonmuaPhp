<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

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

    <script src='https://cdn.jsdelivr.net/g/lodash@4(lodash.min.js+lodash.fp.min.js)'></script>
    <?php
        require './objects/Product.php';
        require './objects/PageContainer.php';
        require_once './objects/DatabaseConnector.php';
//      Init global variable
        $pageContainer = new PageContainer();
        $dbConnector = new DatabaseConnector();
        session_start();
    ?>


</head>
    <body class="index">
    <div class="header">
        <?php
            echo $pageContainer->renderHeader();
            session_unset();
            // destroy the session
            session_destroy();
        ?>
    </div>

    <div class="wrapper">
        <div class="hero-banner">
            <img src="../img/hero_banner.jpg" alt="home page">
        </div>
        <div class="container">
            <div class="row">
                <div class="large-12 columns">
                    <h2>Thuốc hữu cơ</h2>
                </div>
            </div>
            <div class="product-list">
                <div class="row">
                    <?php
                    $products = null;
                    $dbConnector = new DatabaseConnector();
                    $dbConnector->createConnection();
                    $result = $dbConnector->getProduct("treatment");
                    $dbConnector->closeConnection();
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $image = $row['image'];
                        $price = $row['price'];
                        $shortDescription = $row['short_description'];
                        $type = $row['type'];
                        $description = $row['description'];
                        $origin = $row['origin'];

                        $item = new Product($id, $name, $image, $price, $shortDescription, $type, $description, $origin);
                        if ($products === null){
                            $products = array($item);
                        } else {
                            array_push($products, $item);
                        }
                        $item = null;
                    }
                    if (!empty($products)) {
                        $arrlength = count($products);
                        for ($x = 0; $x < $arrlength; $x++) {
                            echo $products[$x]->generateHtml();
                        }
                    } else {
                        echo "Hiện chưa có sản phẩm nào";
                    }
                    ?>
                </div>
<!--                <div class="row">-->
                    <?php
//                        $product1 = new Product('1','Neem Oil',',,'');
//                        $product2 = new Product('2','Bounce Back','https://i.ibb.co/BVJhkjb/bounce-Back.jpg',22000,'Phân hữu cơ tương đối tốt cho người bận rộn, thành phần dinh dưỡng cân đối.');
//                        $product3 = new Product('3','Keo Bẫy Trĩ','https://i.ibb.co/ydkFLMZ/meomo-7973.jpg',339000,'Diệt côn trùng gây hại mà không độc. Dùng bẫy các thể loại trĩ, ruồi nhặng, bướm nhỏ, ong xén lá, bọ cánh cứng, kiến....');
//                        $product4 = new Product('4','Super Thrive','https://i.ibb.co/6ZC4r51/super-Thrive.jpg',324000,'Chuyên cho rễ trần, cây yếu SuperThrive');
//                        $product5 = new Product('5','Vi lượng sắt 50Gr','https://i.ibb.co/DQc4h28/sat-Vi-Luong.jpg',50000,'Bổ sung sắt dạng chelate, giúp cây hấp thụ tốt.
//                            Lượng dùng: 1/2 muỗng cà phê rải đều trên mặt chậu rồi tưới. Hoặc 15gr cho 4l nước phun lá.');
//                        $product6 = new Product('6','Insect Killing Soap 32-Ounce','https://i.ibb.co/crspdMY/soap32.jpg',1378000,'Dung tích 946. Hàng Mỹ
//                            Cách pha: 77ml cho 4l nước, phun trực tiếp. Phun đẫm khi trời mát, không có nắng, nhiệt độ không quá cao. Phun cả mặt trên, dưới lá, dọc thân và mặt chậu.');
//                        $product7 = new Product('7','Insect Killing Soap 16-Ounce','https://i.ibb.co/X2vmW39/soap16.jpg',515000,'Diệt côn trùng gây hại mà không độc. Có thể dùng cho rau đến ngày thu hoạch.
//                            Giết được trĩ, nhện, sâu, ruồi trắng đục thân, rầy xanh...tất tần tật các con thân mềm.
//                            Dung tích 473ml. Hàng Mỹ
//                            Cách pha: 77ml cho 4l nước, phun trực tiếp.
//                            Link hãng: http://www.saferbrand.com/safer-brand-insect-killing-soap-concentrate-16-oz-5118');
//                        $product8 = new Product('8','Kéo cắt cành Fiskar','https://i.ibb.co/k9FtzGH/keocatcanh.jpg',480000,'Cắt gọn gàng, êm tay, lưỡi thep bền lâu. Toàn bộ thân làm bằng thép luôn.');
//                        $product9 = new Product('9','Take Root','https://i.ibb.co/D5vzWj6/takeRoot.jpg',245000,'Sản phẩm hỗ trợ nhân giống các loại cây trồng, có cả lan, hoa hồng, cây gia vị như mint, rosemary đều dùng được tất.
//                            Chứa hóc môn kích thích sinh trưởng, đây mới là sp thật sự sinh ra rễ từ 1 khúc cây. Không phải như N3M là cây đã có rễ sẵn, nó chỉ kích thích phân chia rễ đã có sẵn, tăng kích thước bộ rễ.');
//                        $product10 = new Product('10','Super Hume','https://i.ibb.co/xDFV0GF/supper-Hume.jpg',130000,'Super HUME là phân hữu cơ sinh học bón lá có tác dụng cải tạo, giải độc, hạ phèn, xốp đất, giúp bộ rể phát triển mạnh, giảm phân bón hóa học, giúp cây đâm chồi nhanh, đẻ nhánh khỏe.');
//                        $products = array($product1, $product2, $product3, $product4, $product5, $product6, $product7, $product8, $product9);
//
//                        $arrlength = count($products);
//                        for($x = 0; $x < $arrlength; $x++) {
//                            echo $products[$x]->generateHtml();
//                        }
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
