<?php
session_start();
if (!isset($_SESSION['username'])) die("Login required!");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Thank You</title>
<style>
body { font-family: Arial; background:#f4f4f9; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
.container { background:white; padding:30px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); text-align:center; }
a.button { display:inline-block; margin-top:15px; padding:8px 16px; background:#3498db; color:white; text-decoration:none; border-radius:4px; }
a.button:hover { background:#2980b9; }
</style>
</head>
<body>
<div class="container">
    <h2>Thank you for applying, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a class="button" href="index.php">Back to Jobs</a>
</div>
</body>
</html>