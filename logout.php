<?php
// Mulai session
session_start();

// Hapus semua data session
session_unset();
session_destroy();

// Redirect kembali ke halaman utama
header("location: index.php");
exit;
?>