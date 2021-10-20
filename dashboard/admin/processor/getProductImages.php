<?php
session_start();
$userType = $_SESSION['userType'];
$userName = $_SESSION['userName'];
if (empty($_SESSION) || empty($userName)) {
    header('Location: /dashboard/homepage.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
            padding: 5px;
        }

        th {text-align: left;}
    </style>
</head>
<body>

<?php
require_once ("../../objects/DatabaseConnector.php");
$id = ($_GET['id']);
$dbConnector = new DatabaseConnector();
$dbConnector->createConnection();
$images = $dbConnector->getProductImages($id);
$dbConnector->closeConnection();
echo "<table>
<tr>
<th>Lastname</th>
<th>Age</th>
<th>&nbsp;</th>
</tr>";
while ($row = $images->fetch_assoc()) {
    $id = $row['id'];
    $src = $row['src'];
    $productId = $row['product_id'];
    echo "<tr>";
    echo "<td><img src="."'$src'" ."alt='Smiley face' height='42' width='42'></td>";
    echo "<td>$id</td>";
    echo "<td><a href='./processor/deleteImage.php?id=$id&product=$productId'>X</a></td>";
    echo "</tr>";
}
echo "</table>";
?>
</body>
</html>