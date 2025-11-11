<link rel="stylesheet" href="css/style.css">
<?php
session_start();
if ($_SESSION['role'] != 'admin') die("Access denied!");
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    mysqli_query($conn, "INSERT INTO jobs (title, description) VALUES ('$title','$desc')");
    header("Location: admin.php");
}
?>
<form method="post">
  <h2>Add Job</h2>
  Title: <input type="text" name="title" required><br>
  Description: <textarea name="description" required></textarea><br>
  <button type="submit">Add Job</button>
</form>