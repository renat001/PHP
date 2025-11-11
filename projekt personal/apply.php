<link rel="stylesheet" href="css/style.css">
<?php
session_start();
if (!isset($_SESSION['username'])) die("Login required!");
echo "Thank you for applying, " . $_SESSION['username'] . "!<br><a href='index.php'>Back</a>";
?>