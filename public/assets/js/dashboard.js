// elemen html (selectors)
const addModal = document.getElementById('addModal');
const editModal = document.getElementById('editModal');
const btnAddModal = document.getElementById('btnAddModal');
const btnCloseAddModal = document.getElementById('btnCloseAddModal');
const btnCloseEditModal = document.getElementById('btnCloseEditModal');
const taskCards = document.querySelectorAll('.task-card');

const editTaskId = document.getElementById('edit_task_id');
const editJudul = document.getElementById('edit_judul');
const editDeadline = document.getElementById('edit_deadline');
const editWaktu = document.getElementById('edit_waktu');
const editPrioritas = document.getElementById('edit_prioritas');
const editDeskripsi = document.getElementById('edit_deskripsi');
const editTaskForm = document.getElementById('editTaskForm');

// fungsi & logika
// buka modal tambah tugas
function openAddModal() {
    if (addModal) addModal.style.display = 'flex';
}

// tutup modal tambah tugas
function closeAddModal() {
    if (addModal) addModal.style.display = 'none';
}

// buka modal edit dan isi field-nya sesuai data tugas
function openEditModal(task, basePath) {
    if (editTaskId) editTaskId.value = task.id;
    if (editJudul) editJudul.value = task.nama_tugas;
    if (editDeadline) editDeadline.value = task.deadline;
    if (editWaktu) editWaktu.value = task.waktu;
    if (editPrioritas) editPrioritas.value = task.prioritas;
    if (editDeskripsi) editDeskripsi.value = task.deskripsi || '';

    // set action form ke route update
    if (editTaskForm) editTaskForm.action = basePath + '/' + task.id;

    if (editModal) editModal.style.display = 'flex';
}

// tutup modal edit
function closeEditModal() {
    if (editModal) editModal.style.display = 'none';
}

// tombol & kejadian (event listeners)
// buka modal tambah
if (btnAddModal) {
    btnAddModal.addEventListener('click', openAddModal);
}

// tutup modal tambah
if (btnCloseAddModal) {
    btnCloseAddModal.addEventListener('click', closeAddModal);
}

// tutup modal edit
if (btnCloseEditModal) {
    btnCloseEditModal.addEventListener('click', closeEditModal);
}

// buka modal edit saat card tugas diklik
taskCards.forEach(card => {
    card.addEventListener('click', function() {
        const taskData = JSON.parse(this.getAttribute('data-task'));
        const basePath = this.getAttribute('data-url');
        openEditModal(taskData, basePath);
    });
});