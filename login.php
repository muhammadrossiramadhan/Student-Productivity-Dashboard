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
    <title>Login - SIMUT</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        
        <section class="auth-card">
            <h2><i class="fas fa-sign-in-alt"></i> Selamat Datang Kembali</h2>
            <p>Silakan masuk untuk melanjutkan tugas Anda.</p>
            
            <form action="login.php" method="POST">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Nama Pengguna" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Kata Sandi" required>
                </div>
                <button type="submit" name="login" class="btn-full btn-primary">Masuk</button>
            </form>
            
            <p class="auth-footer">Belum punya akun? <a href="register.php">Daftar</a></p>
        </section>
        </div>
</body>
</html>