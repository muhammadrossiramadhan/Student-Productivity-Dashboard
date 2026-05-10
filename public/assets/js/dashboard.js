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

// logika navigasi tab & hamburger menu
const menuItems = document.querySelectorAll('.menu-item[data-tab]');
const sectionTugas = document.getElementById('section-tugas');
const sectionRiwayat = document.getElementById('section-riwayat');
const searchForm = document.getElementById('search-form');
const pageTitle = document.getElementById('page-title');
const hamburgerMenu = document.getElementById('hamburgerMenu');
const sidebar = document.getElementById('sidebar');

// tab switching
if (menuItems.length > 0) {
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // hapus active dari semua menu
            menuItems.forEach(m => m.classList.remove('active'));
            // set active ke menu yang diklik
            this.classList.add('active');
            
            const tab = this.getAttribute('data-tab');
            
            if (tab === 'beranda') {
                pageTitle.innerHTML = '<i class="fas fa-home"></i> BERANDA';
                if(sectionTugas) sectionTugas.style.display = 'block';
                if(sectionRiwayat) sectionRiwayat.style.display = 'flex';
                if(searchForm) searchForm.style.display = 'flex';
                if(btnAddModal) btnAddModal.style.display = 'flex';
            } 
            else if (tab === 'tugas') {
                pageTitle.innerHTML = '<i class="fas fa-tasks"></i> TUGAS';
                if(sectionTugas) sectionTugas.style.display = 'block';
                if(sectionRiwayat) sectionRiwayat.style.display = 'none';
                if(searchForm) searchForm.style.display = 'flex';
                if(btnAddModal) btnAddModal.style.display = 'flex';
            } 
            else if (tab === 'riwayat') {
                pageTitle.innerHTML = '<i class="fas fa-chart-line"></i> RIWAYAT';
                if(sectionTugas) sectionTugas.style.display = 'none';
                if(sectionRiwayat) sectionRiwayat.style.display = 'flex';
                if(searchForm) searchForm.style.display = 'none';
                if(btnAddModal) btnAddModal.style.display = 'none';
            }
            
            // tutup sidebar setelah klik menu di mobile
            if (window.innerWidth <= 1024 && sidebar) {
                sidebar.classList.remove('active');
            }
        });
    });
}

// hamburger menu toggle
if (hamburgerMenu && sidebar) {
    hamburgerMenu.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
}

// tutup modal jika klik di luar modal 
window.addEventListener('click', function(e) {
    if (e.target === addModal) {
        closeAddModal();
    }
    if (e.target === editModal) {
        closeEditModal();
    }
});

// mencegah double submit pada form modal
document.querySelectorAll('.modal form').forEach(form => {
    form.addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            submitBtn.style.opacity = '0.7';
            submitBtn.style.cursor = 'not-allowed';
        }
    });
});