<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') die("Access denied!");
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM jobs");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<style>
body { font-family: Arial; background: #f4f4f9; margin:0; padding:20px; }
.container { max-width: 900px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
h2 { text-align:center; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
th { background: #27ae60; color: #fff; }
a { color: #3498db; text-decoration: none; margin-right: 10px; }
a:hover { text-decoration: underline; }
.add-job { display:inline-block; margin-bottom:10px; padding: 8px 16px; background:#27ae60; color:white; border-radius:4px; text-decoration:none; }
.add-job:hover { background:#219150; }
.logout { float:right; padding:8px 16px; background:#e74c3c; color:white; border-radius:4px; text-decoration:none; }
.logout:hover { background:#c0392b; }
</style>
</head>
<body>
<div class="container">
<a class="logout" href="logout.php">Logout</a>
<h2>Admin Dashboard</h2>
<a class="add-job" href="addjob.php">Add New Job</a>
<table>
<tr><th>ID</th><th>Title</th><th>Description</th><th>Actions</th></tr>
<?php while ($job = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $job['id']; ?></td>
<td><?php echo htmlspecialchars($job['title']); ?></td>
<td><?php echo htmlspecialchars($job['description']); ?></td>
<td>
<a href="editjob.php?id=<?php echo $job['id']; ?>">Edit</a> |
<a href="deletejob.php?id=<?php echo $job['id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>