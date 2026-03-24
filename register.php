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