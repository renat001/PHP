<?php
session_start();
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM jobs");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Job Portal</title>
<style>
body { font-family: Arial; background:#f4f4f9; margin:0; padding:0; }
header { background:#2c3e50; color:white; padding:15px 20px; display:flex; justify-content:space-between; align-items:center; }
header a { color:white; text-decoration:none; margin-left:10px; padding:6px 12px; background:#e67e22; border-radius:4px; }
header a:hover { background:#d35400; }
.container { max-width:900px; margin:40px auto; padding:20px; }
.job-card { background:white; padding:20px; margin-bottom:15px; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
.job-card h3 { margin-top:0; }
.job-card a.button { display:inline-block; padding:6px 12px; background:#27ae60; color:white; text-decoration:none; border-radius:4px; margin-top:10px; }
.job-card a.button:hover { background:#219150; }
</style>
</head>
<body>
<header>
    <h1>Job Portal</h1>
    <div>
        <?php if (isset($_SESSION['username'])): ?>
            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="admin.php">Admin Dashboard</a>
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
        <?php endif; ?>
    </div>
</header>

<div class="container">
<h2>Available Jobs</h2>
<?php while ($job = mysqli_fetch_assoc($result)) { ?>
  <div class="job-card">
    <h3><?php echo htmlspecialchars($job['title']); ?></h3>
    <p><?php echo htmlspecialchars($job['description']); ?></p>
    <?php if (isset($_SESSION['username'])): ?>
        <a class="button" href="apply.php?id=<?php echo $job['id']; ?>">Apply</a>
    <?php else: ?>
        <a class="button" href="login.php">Login to Apply</a>
    <?php endif; ?>
  </div>
<?php } ?>
</div>
</body>
</html>