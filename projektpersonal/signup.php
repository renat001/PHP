<?php
include 'db.php';
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST'){
    $username=trim($_POST['username']??'');
    $password=$_POST['password']??'';
    if($username===''||$password==='') $error="Fill both fields.";
    else{
        $stmt=mysqli_prepare($conn,"SELECT id FROM users WHERE username=?");
        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt)>0) $error="Username already taken.";
        else{
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $role='user';
            $stmt2=mysqli_prepare($conn,"INSERT INTO users (username,password,role) VALUES (?,?,?)");
            mysqli_stmt_bind_param($stmt2,"sss",$username,$hash,$role);
            if(mysqli_stmt_execute($stmt2)){
                mysqli_stmt_close($stmt2);
                header("Location: login.php");
                exit;
            }else $error="Database error: ".mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<style>
body{ font-family:Arial; background:#f4f4f9; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
.signup-container{ background:white; padding:30px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); width:300px; }
h2{ margin-top:0; }
input{ width:100%; padding:8px; margin:5px 0; border:1px solid #ccc; border-radius:4px; }
button{ padding:8px 16px; background:#27ae60; color:white; border:none; border-radius:4px; cursor:pointer; width:100%; }
button:hover{ background:#219150; }
.error{ color:red; font-weight:bold; }
a{ color:#3498db; text-decoration:none; }
</style>
</head>
<body>
<div class="signup-container">
<h2>Sign Up</h2>
<?php if($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
<form method="post">
<label>Username:<br><input type="text" name="username" required></label><br>
<label>Password:<br><input type="password" name="password" required></label><br><br>
<button type="submit">Sign Up</button>
</form>
<p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
