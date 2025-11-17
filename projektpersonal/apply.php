<?php
session_start();
if (!isset($_SESSION['username'])) die("Please login to apply.");
include 'db.php';
$job_id = $_GET['id'] ?? 0;

// Optionally, you could store applications in a separate table
// mysqli_query($conn, "INSERT INTO applications (user_id, job_id) VALUES ({$_SESSION['user_id']}, $job_id)");

header("Location: thankyou.php");
exit;
?>