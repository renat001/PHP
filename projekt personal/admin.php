<link rel="stylesheet" href="css/style.css">
<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    die("Access denied!");
}
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM jobs");
?>
<h2>Admin Dashboard</h2>
<a href="add_job.php">Add New Job</a>
  <tr><th>ID</th><th>Title</th><th>Description</th><th>Actions</th></tr>
  <?php while ($job = mysqli_fetch_assoc($result))  ?>
    <tr>
      <td><?php echo $job['id']; ?></td>
      <td><?php echo $job['title']; ?></td>
      <td><?php echo $job['description']; ?></td>
      <td>
        <a href="edit_job.php?id=<?php echo $job['id']; ?>">Edit</a> |
        <a href="delete_job.php?id=<?php echo $job['id']; ?>">Delete</a>
      </td>
    </tr>
</table>