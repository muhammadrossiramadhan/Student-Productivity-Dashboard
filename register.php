<?php
include "services/database.php";

$register_message = "";

if (isset($_POST["register"])) {
    $panggilan = $_POST["panggilan"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Amankan password dengan hashing (jangan simpan teks mentah)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (panggilan, username, password) VALUES ('$panggilan', '$username', '$hashed_password')";

        if ($db->query($sql)) {
            // Berhasil, arahkan kembali ke index dengan status sukses
            header("location: index.php?status=sukses_daftar");
        } else {
            header("location: index.php?status=gagal_daftar");
        }
    } catch (mysqli_sql_exception $e) {
        // Gagal, biasanya karena username ganda
        header("location: index.php?status=gagal_daftar");
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up | Student.io</title>
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="register-body"> 
    <div class="register-box"> 

        <div class="register-header"> 
            <h2><i class="fas fa-user-plus"></i> Create Account</h2>
            <p>QWERT</p>
        </div>
            
        <form action="actions/register_action.php" method="POST">
            <div class="register-input-field"> 
                <i class="fas fa-id-card"></i>
                <input type="text" name="panggilan" placeholder="Nama Panggilan" required>
            </div>

            <div class="register-input-field"> 
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            
            <div class="register-input-field"> 
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <button type="submit" name="register" class="register-btn-primary">Register</button> 
        </form>

        <div class="register-footer"> 
            <p>Already have an account? <a href="login.php">Sign in</a></p>
            <p><a href="index.php">Back to Home</a></p>
        </div>
        
    </div>
    </body>
</html>