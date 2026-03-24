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