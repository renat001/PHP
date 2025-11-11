<link rel="stylesheet" href="css/style.css">
<?php
session_start();
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM jobs");
?>
<h2>Available Jobs</h2>
<?php while ($job = mysqli_fetch_assoc($result)) { ?>
  <div>
    <h3><?php echo $job['title']; ?></h3>
    <p><?php echo $job['description']; ?></p>
    <a href="apply.php?id=<?php echo $job['id']; ?>">Apply</a>
  </div>
<?php } ?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
  <a href="admin.php">Dashboard</a>
<?php } ?>