<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') die("Access denied!");
include 'db.php';

$id = $_GET['id'];
$job = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jobs WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    mysqli_query($conn, "UPDATE jobs SET title='$title', description='$desc' WHERE id=$id");
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Job</title>
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
<h2>Edit Job</h2>
<form method="post">
Title:<br>
<input type="text" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" required><br>
Description:<br>
<textarea name="description" required><?php echo htmlspecialchars($job['description']); ?></textarea><br><br>
<button type="submit">Save Changes</button>
</form>
</div>
</body>
</html>