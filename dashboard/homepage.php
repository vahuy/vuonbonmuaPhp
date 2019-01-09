
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

    <script src='https://cdn.jsdelivr.net/g/lodash@4(lodash.min.js+lodash.fp.min.js)'></script>
    <?php
    require './objects/Product.php';
    require './objects/DatabaseConnector.php';
    require './objects/PageContainer.php';

    $footer = new PageContainer();
    ?>

</head>

<body class="index">
    <div class="header">
        <?php
        echo $footer->renderHeader();
        ?>
    </div>

    <div class="wrapper">
        <div class="hero">
            &nbsp;
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Giới thiệu vườn bốn mùa</h2>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <p>Không tiếp khách tham quan hay không hẹn trước. Có rất nhiều
                        ảnh hoa thật, trồng và nở tại HCM, các bạn có thể xem để hình dung
                        hoa sẽ ra sao. Chúng tôi trồng hoa thân thiện với môi trường, cây
                        phát triển tự nhiên với phân bón hữu cơ là chính. Không kích thích
                        để nhìn cây xum xuê bán giá cao.</p>
                </div>
            </div>
        </div>
        <div class="footer">
            <?php
            echo $footer->renderFooter();
            ?>
        </div>
    </div>
</body>
</html>
