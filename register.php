<?php
include "service/database.php";
$register_message = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";
        if ($db->query($sql)) {
            $register_message = "Daftar akun berhasil, silakan login";
        } else {
            $register_message = "Daftar akun gagal";
        }
    } catch (mysqli_sql_exception) {
        $register_message = "Username sudah digunakan, silakan ganti";
    }
    $db->close();
}
?>