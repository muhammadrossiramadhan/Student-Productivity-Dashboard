<?php
global $db, $user_id;

if (!isset($db) || !isset($user_id)) { return; }

$labels = []; 
$data_poin = [];

for ($i = 6; $i >= 0; $i--) {
    $tgl = date('Y-m-d', strtotime("-$i days"));
    $labels[] = date('d M', strtotime($tgl));
    
    // Ambil SUM poin_konsistensi per tanggal
    $sql = "SELECT SUM(poin_konsistensi) as total FROM tasks 
            WHERE user_id = '$user_id' AND DATE(selesai_at) = '$tgl' AND status = 'Selesai'";
    
    $res = $db->query($sql);
    $row = $res->fetch_assoc();
    $data_poin[] = $row['total'] ?? 0;
}
?>

<div class="auth-card" style="margin-top: 30px; background: #ffffff; border: 1px solid #eee; padding: 15px; border-radius: 12px;">
    <h3 style="font-size: 15px; margin-bottom: 15px;">
        <i class="fas fa-chart-line" style="color: #4facfe text-align: left;"></i> Statistik Performa (7 Hari)
    </h3>
    <div style="width: 100%; height: 200px;">
        <canvas id="performaChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('performaChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Skor',
                data: <?= json_encode($data_poin) ?>,
                borderColor: '#4facfe',
                backgroundColor: 'rgba(79, 172, 254, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#00f2fe'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' }, ticks: { stepSize: 5 } },
                x: { grid: { display: false } }
            }
        }
    });
</script>