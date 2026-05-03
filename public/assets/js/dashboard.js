// Membuka modal tambah tugas
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

// Menutup modal tambah tugas
function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

// Membuka modal edit tugas dan mengisi datanya (Terintegrasi MVC)
function openEditModal(task, basePath) {
    document.getElementById('edit_task_id').value = task.id;
    document.getElementById('edit_judul').value = task.nama_tugas;
    document.getElementById('edit_deadline').value = task.deadline;
    document.getElementById('edit_waktu').value = task.waktu;
    document.getElementById('edit_prioritas').value = task.prioritas;
    document.getElementById('edit_deskripsi').value = task.deskripsi;
    
    // Mengubah Action form update sesuai dengan Base Path + ID Tugas
    document.getElementById('editTaskForm').action = basePath + '/index.php?url=task/update/' + task.id;
    
    document.getElementById('editModal').style.display = 'flex';
}