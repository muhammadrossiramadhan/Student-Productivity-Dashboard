<?php
require_once __DIR__ . '/../core/Model.php';

class TaskModel extends Model {

    // 1. Ambil data tugas aktif (Belum Selesai) beserta logika pencarian
    public function getActiveTasks($user_id, $search = "") {
        $sql = "SELECT *, 
                (CASE WHEN CONCAT(deadline, ' ', waktu) < NOW() THEN 'Terlambat' ELSE 'Mendatang' END) as status_waktu 
                FROM tasks 
                WHERE user_id = :uid AND status = 'Belum Selesai'";
        
        if (!empty($search)) {
            $sql .= " AND (nama_tugas LIKE :search OR deskripsi LIKE :search)";
        }
        
        $sql .= " ORDER BY deadline ASC, waktu ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':uid', $user_id);
        if (!empty($search)) {
            $stmt->bindValue(':search', "%$search%");
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 2. Ambil 5 riwayat terakhir
    public function getHistoryTasks($user_id, $limit = 5) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = :uid AND status = 'Selesai' ORDER BY selesai_at DESC LIMIT :limit");
        $stmt->bindValue(':uid', $user_id);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 3. Ambil data grafik performa (7 hari terakhir)
    public function getChartData($user_id) {
        $labels = []; 
        $data_poin = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $tgl = date('Y-m-d', strtotime("-$i days"));
            $labels[] = date('d M', strtotime($tgl));
            
            $stmt = $this->db->prepare("SELECT SUM(poin_konsistensi) as total FROM tasks WHERE user_id = ? AND DATE(selesai_at) = ?");
            $stmt->execute([$user_id, $tgl]);
            $row = $stmt->fetch();
            $data_poin[] = $row['total'] ?? 0;
        }
        return ['labels' => $labels, 'data' => $data_poin];
    }

    // 4. Tambah Tugas Baru (Create)
    public function addTask($user_id, $nama, $desk, $dead, $waktu, $prio) {
        $stmt = $this->db->prepare("INSERT INTO tasks (user_id, nama_tugas, deskripsi, deadline, waktu, prioritas, status) VALUES (?, ?, ?, ?, ?, ?, 'Belum Selesai')");
        return $stmt->execute([$user_id, $nama, $desk, $dead, $waktu, $prio]);
    }

    // 4b. Update Tugas (Edit)
    public function updateTask($id, $user_id, $nama, $desk, $dead, $waktu, $prio) {
        $stmt = $this->db->prepare("UPDATE tasks SET nama_tugas = ?, deskripsi = ?, deadline = ?, waktu = ?, prioritas = ? WHERE id = ? AND user_id = ?");
        return $stmt->execute([$nama, $desk, $dead, $waktu, $prio, $id, $user_id]);
    }

    // 5. Tandai Selesai dan Hitung Poin (Update)
    public function markAsDone($id, $user_id) {
        $stmt = $this->db->prepare("SELECT deadline, waktu, prioritas FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        $cek = $stmt->fetch();
        if(!$cek) return false;

        $tenggat = $cek['deadline'] . ' ' . $cek['waktu'];
        $skrg = date('Y-m-d H:i:s');
        
        // Logika Poin Baru: Mempertimbangkan Prioritas
        $is_ontime = (strtotime($skrg) <= strtotime($tenggat));
        if ($is_ontime) {
            $poin = ($cek['prioritas'] === 'Tinggi') ? 15 : (($cek['prioritas'] === 'Sedang') ? 10 : 5);
        } else {
            $poin = ($cek['prioritas'] === 'Tinggi') ? 5 : (($cek['prioritas'] === 'Sedang') ? 3 : 1);
        }

        $stmtU = $this->db->prepare("UPDATE tasks SET status='Selesai', selesai_at=?, poin_konsistensi=? WHERE id=? AND user_id=?");
        return $stmtU->execute([$skrg, $poin, $id, $user_id]);
    }

    // 6. Hapus Tugas (Delete)
    public function deleteTask($id, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $user_id]);
    }
}