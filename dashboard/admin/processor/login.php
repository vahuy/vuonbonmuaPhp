<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 1/20/2019
 * Time: 4:57 PM
 */

session_start();
$userType = $_SESSION['userType'];
$userName = $_SESSION['userName'];
if (empty($_SESSION) || empty($userName)) {
    header('Location: /dashboard/homepage.php');
}

require_once ("../../objects/DatabaseConnector.php");
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $dbConnector = new DatabaseConnector();
    $dbConnector->createConnection();

    $password = base64_encode($password);
    $result = $dbConnector->validateUserAccount($name,$password);

    if ($result!==null) {

        $_SESSION["userType"] = $result['type'];
        $_SESSION["userName"] = $result['name'];
        $_SESSION["isLogged"] = true;
        header('Location: /dashboard/admin/addproduct.php');

        return;
    }
    $dbConnector->closeConnection();
}
if (isset($_POST["logout"])) {
    session_unset();
    // destroy the session
    session_destroy();
}
header('Location: /dashboard/homepage.php');
