<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("location: login.php");
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('location: index.php');
}
?>
<h3>Selamat Datang, <?= $_SESSION["username"] ?></h3>
<form action="dashboard.php" method="POST">
    <button type="submit" name="logout">Log Out</button>
</form>