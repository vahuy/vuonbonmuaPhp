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
        require './objects/PageContainer.php';
        require './objects/Product.php';
        require './objects/DatabaseConnector.php';

        $footer = new PageContainer();
    ?>
</head>

<body class="index">
    <div class="header">
        <?php
            echo $footer->renderHeader();
            session_start();
            print_r($_SESSION);
        ?>
    </div>

    <div class="wrapper">
        <div class="hero">
            &nbsp;
        </div>
        <div class="container">
            <div class="row">
                <div class="large-12 columns">
                    <h2>Hoa hồng leo</h2>
                </div>
            </div>
            <div class="product-list">
                <div class="row">
                    <?php
                        $products = null;
                        $dbConnector = new DatabaseConnector();
                        $dbConnector->createConnection();
                        $result = $dbConnector->getClimbing();
                        $dbConnector->closeConnection();
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $image = $row['image'];
                            $price = $row['price'];
                            $shortDescription = $row['short_description'];

                            $item = new Product($id,$name,$image,$price,$shortDescription);
                            if ($products === null){
                                $products = array($item);
                            } else {
                                array_push($products, $item);
                            }
                            $item = null;
                        }
                        $arrlength = count($products);
                        for($x = 0; $x < $arrlength; $x++) {
                            echo $products[$x]->generateHtml();
                        }
                    ?>
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
