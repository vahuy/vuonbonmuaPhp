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
    <link href="./stylesheets/modal.css" rel="stylesheet" type="text/css" />

    <?php
        require_once './objects/PageContainer.php';

        $pageContainer = new PageContainer();
        session_start();
    ?>
</head>

<body class="index">
    <div class="header">
        <?php
            $isLogged = false;
            if (!empty($_SESSION["isLogged"])) {
                $isLogged = $_SESSION["isLogged"];
            }
            echo $pageContainer->renderHeaderWithLogin($isLogged);
            echo $pageContainer->renderModalLogin();
        ?>
    </div>

    <div class="wrapper">
        <div class="hero-banner">
            <img src="../img/hero_banner.jpg" alt="home page">
        </div>
        <div class="container">
            <article>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Giới thiệu vườn bốn mùa</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <div class="search-container">
                            <input type="text" id="txtInput" onkeyup="verify(this.value)" placeholder="Search..">
                            <button type="button" id="btnSearch" onclick="search()"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div id="txtHint"></div>
            </article>
        </div>
        <div class="footer">
            <?php
                echo $pageContainer->renderFooter();
            ?>
            <script src="./js/loggin.js"></script>
            <script src="./js/product_search_handler.js"></script>
        </div>
    </div>
</body>
</html>
