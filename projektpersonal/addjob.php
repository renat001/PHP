<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') die("Access denied!");
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    mysqli_query($conn, "INSERT INTO jobs (title, description) VALUES ('$title','$desc')");
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Job</title>
<style>
body { font-family: Arial; background:#f4f4f9; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
.container { background:white; padding:30px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); width:400px; }
input, textarea { width:100%; padding:8px; margin:5px 0; border:1px solid #ccc; border-radius:4px; }
button { padding:8px 16px; background:#27ae60; color:white; border:none; border-radius:4px; cursor:pointer; width:100%; }
button:hover { background:#219150; }
</style>
</head>
<body>
<div class="container">
<h2>Add Job</h2>
<form method="post">
Title:<br>
<input type="text" name="title" required><br>
Description:<br>
<textarea name="description" required></textarea><br><br>
<button type="submit">Add Job</button>
</form>
</div>
</body>
</html>