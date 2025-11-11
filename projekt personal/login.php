<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php';   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = "Please enter username and password.";
    } else {
        // Prepared statement to avoid SQL injection
        $stmt = mysqli_prepare($conn, "SELECT id, username, password, role FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $dbUsername, $dbPassword, $role);
        if (mysqli_stmt_fetch($stmt)) {
            // $dbPassword is the hashed password in DB (password_hash)
            if (password_verify($password, $dbPassword)) {
                // login success
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $dbUsername;
                $_SESSION['role'] = $role;
                mysqli_stmt_close($stmt);
                header("Location: index.php");
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
  <h2>Login</h2>
  <?php if (!empty($error)): ?>
    <div style="color:red;"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>
  <form method="post" action="">
    Username:<br>
    <input type="text" name="username" required><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
  </form>
  <p><a href="signup.php">Sign up</a></p>
</body>
</html>