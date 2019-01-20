<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 1/20/2019
 * Time: 4:57 PM
 */
require_once ("../../objects/DatabaseConnector.php");
$name = $_POST["name"];
$password = $_POST["password"];
if (isset($_POST["submit"])) {
    $dbConnector = new DatabaseConnector();
    $dbConnector->createConnection();
    $password = base64_encode($password);
    $result = $dbConnector->validateUserAccount($name,$password);
    $dbConnector->closeConnection();
    if ($result===null) {
        header('Location: /dashboard/homepage.php');
    } else {
        session_start();
        $_SESSION["userType"] = $result['type'];
        $_SESSION["userName"] = $result['name'];
        $_SESSION["isLogged"] = true;
        header('Location: /dashboard/admin/addproduct.php');
    }
} else {
    header('Location: /dashboard/homepage.php');
}
