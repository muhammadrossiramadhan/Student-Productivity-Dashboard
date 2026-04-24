<?php
include "services/database.php";
session_start();

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        
        // Verifikasi password yang dihash
        if (password_verify($password, $data["password"])) {
            // Set session login
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['panggilan'] = $data['panggilan'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['is_login'] = true;

            header("location: dashboard.php");
            exit;
        } else {
            header("location: index.php?status=gagal_login");
        }
    } else {
        header("location: index.php?status=gagal_login");
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="login-body"> 
    <div class="login-box"> 

        <div class="login-header"> 
            <h2><i class="fas fa-sign-in-alt"></i> Welcome Back!</h2>
            <p>Sign in to continue to your account.</p>
        </div>
            
        <form action="" method="POST">
            <div class="login-input-field"> 
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            
            <div class="login-input-field"> 
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <button type="submit" name="login" class="login-btn-primary">Sign In</button> 
        </form>

        <div class="login-footer"> 
            <p>Don't have an account? <a href="register.php">Sign up</a></p>
        </div>
        
    </div>
</body>
</html>