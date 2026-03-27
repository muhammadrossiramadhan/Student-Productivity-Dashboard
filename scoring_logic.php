<?php
// Pastikan variabel global tersedia
global $db, $user_id;

// 1. Ambil data tenggat waktu (deadline & waktu) dari database
$sql_cek = "SELECT deadline, waktu FROM tasks WHERE id = '$id_tgs' AND user_id = '$user_id'";
$res_cek = $db->query($sql_cek);

if ($res_cek->num_rows > 0) {
    $data = $res_cek->fetch_assoc();
    
    // Gabungkan tanggal dan jam menjadi format timestamp
    $tenggat_timestamp = strtotime($data['deadline'] . ' ' . $data['waktu']);
    $waktu_sekarang = time(); // Timestamp saat ini
    
    // 2. Logika Penentuan Poin
    // Jika waktu sekarang masih kurang dari atau sama dengan tenggat = TEPAT WAKTU
    if ($waktu_sekarang <= $tenggat_timestamp) {
        $poin = 10;
    } else {
        // Jika melewati tenggat = TERLAMBAT
        $poin = 2;
    }
    
    // 3. Update database dengan status 'Selesai', waktu penyelesaian, dan poin yang didapat
    $waktu_selesai = date('Y-m-d H:i:s');
    $sql_update = "UPDATE tasks 
                   SET status = 'Selesai', 
                       selesai_at = '$waktu_selesai', 
                       poin_konsistensi = '$poin' 
                   WHERE id = '$id_tgs' AND user_id = '$user_id'";
                   
    $db->query($sql_update);
}
?>