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

    <script src='https://cdn.jsdelivr.net/g/lodash@4(lodash.min.js+lodash.fp.min.js)'></script>

    <?php
    require '../objects/PageContainer.php';
    require_once '../objects/Component.php';
    $pageContainer = new PageContainer();
    $component = new Component();
    session_start();
    ?>
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Tạo sản phẩm mới</h2>
            </div>
            <form method="get" enctype="multipart/form-data" action="processor/doaddphoto.php">
                <div class="row">
                    <div class="col-md-6"><label>Mã sản phẩm<input type="text" name="productId" required></label></div>
                    <div class="col-md-6"><label>Mô tả <textarea name="photo" rows="4" cols="70" placeholder="Describe yourself here...">&nbsp;</textarea></label></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><?php echo $component->renderButton('Reset','reset', 'reset',false) ?></div>
                    <div class="col-md-6"><?php echo $component->renderButton('Submit','submit', 'submit', false) ?></div>
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
