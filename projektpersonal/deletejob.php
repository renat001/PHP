<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') die("Access denied!");
include 'db.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM jobs WHERE id=$id");
header("Location: admin.php");
exit;
?>