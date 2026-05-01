// Membuka modal tambah tugas
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

// Menutup modal tambah tugas
function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

// Membuka modal edit tugas dan mengisi datanya
function openEditModal(task) {
    document.getElementById('edit_task_id').value = task.id;
    document.getElementById('edit_judul').value = task.judul;
    document.getElementById('edit_deadline').value = task.deadline;
    document.getElementById('edit_prioritas').value = task.prioritas;
    document.getElementById('edit_deskripsi').value = task.deskripsi;
    
    // Set link hapus dengan ID yang sesuai
    document.getElementById('delete_link').href = 'index.php?action=delete_task&id=' + task.id;
    
    document.getElementById('editModal').style.display = 'flex';
}

// Menutup modal edit tugas
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}