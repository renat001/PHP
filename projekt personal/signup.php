<link rel="stylesheet" href="css/style.css">
<?php
// signup.php
include 'db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = "Fill both fields.";
    } else {
        // check if username taken
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "Username already taken.";
            mysqli_stmt_close($stmt);
        } else {
            mysqli_stmt_close($stmt);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user'; // default role
            $stmt2 = mysqli_prepare($conn, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt2, "sss", $username, $hash, $role);
            if (mysqli_stmt_execute($stmt2)) {
                echo "Signup successful! <a href='login.php'>Login</a>";
                mysqli_stmt_close($stmt2);
                exit;
            } else {
                $error = "Database error during signup.";
                mysqli_stmt_close($stmt2);
            }
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Sign Up</title></head>
<body>
  <h2>Sign Up</h2>
  <?php if (!empty($error)): ?>
    <div style="color:red;"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>
  <form method="post" action="">
    Username:<br>
    <input type="text" name="username" required><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Sign Up</button>
  </form>
</body>
</html>
