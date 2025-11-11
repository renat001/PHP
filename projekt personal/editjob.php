<link rel="stylesheet" href="css/style.css">
<?php
session_start();
if ($_SESSION['role'] != 'admin') die("Access denied!");
include 'db.php';
$id = $_GET['id'];
$job = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jobs WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    mysqli_query($conn, "UPDATE jobs SET title='$title', description='$desc' WHERE id=$id");
    header("Location: admin.php");
}
?>
<form method="post">
  <h2>Edit Job</h2>
  Title: <input type="text" name="title" value="<?php echo $job['title']; ?>"><br>
  Description: <textarea name="description"><?php echo $job['description']; ?></textarea><br>
  <button type="submit">Save Changes</button>
</form>