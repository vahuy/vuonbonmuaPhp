<!DOCTYPE html>
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
    <meta charset="UTF-8">
    <title>VuonBonMua-Note</title>
    <?php
        require '../objects/UTIL.php';
        require '../objects/DatabaseConnector.php';
        require '../objects/PageContainer.php';

        $page = new PageContainer();
        $dbConnector = new DatabaseConnector();
    ?>
</head>
<body class="index">
    <div class="header">
        <?php
            echo $page->renderHeader();
        ?>
    </div>

    <div class="wrapper">
        <div class="hero-banner">
            <img src="../../img/hero_banner.jpg" alt="home page">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Hướng dẫn trồng hồng</h2>
                </div>
            </div>
            <div class="page-note">
                <div class="row">
                    <div class="large-12 columns">
                        <?php
                            $url = UTIL::getUrl();
                            $array = (explode("?",$url));
                            $noteKey = ($array[1]);

                            $dbConnector->createConnection();
                            $result = $dbConnector->getNote($noteKey);
                            $dbConnector->closeConnection();

                            $row = $result->fetch_assoc();
                            $title = $row['title'];
                            $content = $row['content'];

                        echo "<h4>$title<h4>";
                        echo "<p>$content<p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <?php
                echo $page->renderFooter();
            ?>
        </div>
    </div>
</body>
</html>