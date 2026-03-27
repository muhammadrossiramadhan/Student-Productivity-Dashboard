<?php
// Gunakan global agar variabel dari dashboard.php terbaca
global $db, $user_id, $id_tgs;

if (!isset($db) || !isset($id_tgs)) {
    return; 
}

// 1. Ambil data tugas
$sql_cek = "SELECT deadline, waktu FROM tasks WHERE id = '$id_tgs'";
$res_cek = $db->query($sql_cek);

if ($res_cek && $res_cek->num_rows > 0) {
    $data = $res_cek->fetch_assoc();
    
    // Hitung Deadline vs Waktu Sekarang
    $deadline_time = strtotime($data['deadline'] . ' ' . $data['waktu']);
    $current_time = time(); 

    // 2. Kalkulasi Poin: Tepat waktu (10), Terlambat (2)
    $poin = ($current_time <= $deadline_time) ? 10 : 2;
    $now = date('Y-m-d H:i:s');

    // 3. Update Database (Status, Waktu Selesai, dan Poin)
    $sql_update = "UPDATE tasks 
                   SET status = 'Selesai', 
                       selesai_at = '$now', 
                       poin_konsistensi = '$poin' 
                   WHERE id = '$id_tgs'";
                   
    $db->query($sql_update);
}