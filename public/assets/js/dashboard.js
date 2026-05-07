// buka modal tambah tugas
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

// tutup modal tambah tugas
function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

// buka modal edit dan isi field-nya sesuai data tugas yang diklik
function openEditModal(task, basePath) {
    document.getElementById('edit_task_id').value = task.id;
    document.getElementById('edit_judul').value = task.nama_tugas;
    document.getElementById('edit_deadline').value = task.deadline;
    document.getElementById('edit_waktu').value = task.waktu;
    document.getElementById('edit_prioritas').value = task.prioritas;
    document.getElementById('edit_deskripsi').value = task.deskripsi;

    // set action form ke route update yang bener
    document.getElementById('editTaskForm').action = basePath + '/' + task.id;

    document.getElementById('editModal').style.display = 'flex';
}

// tutup modal edit
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}