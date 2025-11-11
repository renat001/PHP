<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style.css">
<?php
session_start();
if ($_SESSION['role'] != 'admin') die("Access denied!");
include 'db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM jobs WHERE id=$id");
header("Location: admin.php");
?>