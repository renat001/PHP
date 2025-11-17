<?php
session_start();
include 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $password === '') { $error = "Please enter username and password."; }
    else {
        $stmt = mysqli_prepare($conn, "SELECT id, username, password, role FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $dbUsername, $dbPassword, $role);
        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $dbPassword)) {
                $_SESSION['user_id']=$id; $_SESSION['username']=$dbUsername; $_SESSION['role']=$role;
                mysqli_stmt_close($stmt);
                header("Location: index.php"); exit;
            } else { $error = "Invalid username or password."; }
        } else { $error = "Invalid username or password."; }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<style>
    body{ font-family:Arial; background:#f4f4f9; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
    .login-container{ background:white; padding:30px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); width:300px; }
    h2{ margin-top:0; }
    input{ width:100%; padding:8px; margin:5px 0; border:1px solid #ccc; border-radius:4px; }
    button{ padding:8px 16px; background:#27ae60; color:white; border:none; border-radius:4px; cursor:pointer; width:100%; }
    button:hover{ background:#219150; }
    .error{ color:red; font-weight:bold; }
    a{ color:#3498db; text-decoration:none; }
</style>
</head>
<body>
<div class="login-container">
<h2>Login</h2>
<?php if ($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
<form method="post">
<label>Username:<br><input type="text" name="username" required></label><br>
<label>Password:<br><input type="password" name="password" required></label><br><br>
<button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="signup.php">Sign up</a></p>
</div>
</body>
</html>