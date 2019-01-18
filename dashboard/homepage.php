
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

    <script src='https://cdn.jsdelivr.net/g/lodash@4(lodash.min.js+lodash.fp.min.js)'></script>

    <?php
        require_once './objects/DatabaseConnector.php';
        require_once './objects/PageContainer.php';
        require_once './objects/UserAccount.php';
        require_once './objects/CONSTANT.php';

        $pageContainer = new PageContainer();
        $dbConnector = new DatabaseConnector();
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
        <script>
            // Get the modal
            const modal = document.getElementById('myModal');

            // Get the button that opens the modal
            const btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            const span = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            };

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            };

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>

    <div class="wrapper">
        <div class="hero">
            &nbsp;
        </div>
        <?php
            if (!empty($_POST["name"]) && !empty($_POST["password"])) {
                $dbConnector->createConnection();
                $user = $dbConnector->validateUserAccount($_POST["name"], $_POST["password"]);
                $dbConnector->closeConnection();
                $type = $user['type'];
                $name = $user['name'];
                if (!empty($user)) {
                    $_SESSION["userType"] = $type;
                    $_SESSION["userName"] = $name;
                    $_SESSION["isLogged"] = true;
                } else {
                    echo "0 results";
                }
            }
        ?>
        <div class="container">
            <article>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Giới thiệu vườn bốn mùa</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <p><?php echo GIOI_THIEU_VBM ?></p>
                    </div>
                </div>
            </article>
        </div>
        <div class="footer">
            <?php
                echo $pageContainer->renderFooter();
            ?>
        </div>
    </div>
</body>
</html>
