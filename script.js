// Variabel untuk menyimpan data akun sementara (simulasi database)
let registeredUser = null;

function nextPage(id) {
    const pages = document.querySelectorAll('.page');
    pages.forEach(p => p.classList.remove('active'));
    
    const target = document.getElementById(id);
    if (target) {
        target.classList.add('active');
    }
}

// LOGIKA REGISTER
function prosesDaftar(event) {
    event.preventDefault();
    
    const nama = document.getElementById('namaInput').value;
    const email = document.getElementById('regEmail').value;
    const pass = document.getElementById('regPass').value;
    const passConfirm = document.getElementById('regPassConfirm').value;

    // 1. Cek Konfirmasi Password
    if (pass !== passConfirm) {
        alert("Konfirmasi password tidak cocok! Silakan ulangi.");
        return;
    }

    // 2. Simpan data ke database sementara
    registeredUser = { email: email, pass: pass, nama: nama };
    startLoading(nama);
}

// LOGIKA LOGIN
function cekLogin(event) {
    event.preventDefault();
    const email = document.getElementById('loginEmail').value;
    const pass = document.getElementById('loginPass').value;

    // Cek apakah user sudah terdaftar atau belum
    if (registeredUser && email === registeredUser.email && pass === registeredUser.pass) {
        startLoading(registeredUser.nama);
    } else {
        // Jika tidak terdaftar atau salah, larikan ke halaman sebelumnya (page2)
        alert("Akun tidak ditemukan atau password salah! Silakan daftar terlebih dahulu.");
        nextPage('page2');
    }
}

// FUNGSI LOADING
function startLoading(nama) {
    nextPage('pageLoading');
    setTimeout(() => {
        const welcomeText = document.getElementById('welcomeText');
        if(welcomeText) welcomeText.innerText = `Halo ${nama}!`;        nextPage('pageGreeting');
    }, 3000);
}

// NAVIGASI FITUR
function goToFeature(pilihan) {
    if (pilihan === 'Tambah Tugas') nextPage ('pageTambahKegiatan');
    else if (pilihan === 'Tambah Kegiatan') nextPage('pageTambahKegiatan');
    else if (pilihan === 'Atur Jadwal') nextPage('pageAturJadwal');
}

// LOGIKA MENYIMPAN DATA
function saveItem(tipe) {
    let input, listId;
    
    if (tipe === 'Tugas') {
        input = document.getElementById('tugasInput');
        listId = 'listTugas';
    } else if (tipe === 'Kegiatan') {
        input = document.getElementById('kegiatanInput');
        listId = 'listKegiatan';
    } else if (tipe === 'Jadwal') {
        const jam = document.getElementById('jamBelajar').value;
        const mapel = document.getElementById('mapelInput').value;
        if(!jam || !mapel) return alert("Isi jam dan mapel!");
        displayItem('listJadwal', `${jam} - ${mapel}`);
        return;
    }

    if (!input || input.value === "") return alert("Isi dulu ya!");
    displayItem(listId, input.value);
    input.value = ""; 
}

function displayItem(listId, text) {
    const list = document.getElementById(listId);
    const div = document.createElement('div');
    div.className = 'item-list';
    div.innerHTML = `<span>${text}</span> <button onclick="this.parentElement.remove()" style="width:auto; padding:2px 8px; background:red;">X</button>`;
    list.appendChild(div);
}

// SIMULASI LOGIN GOOGLE
function loginGoogle() {
    alert("Fitur ini akan mengarahkanmu ke sistem login Google API di masa depan.");
    // Simulasi langsung masuk
    startLoading("User Google");
}

let userStatus = ""; // Global variable untuk simpan Pelajar/Mahasiswa

// Tambahkan logika ini di fungsi setRole (yang kamu buat di awal)
function setStatus(status) {
    userStatus = status;
    const inputMapel = document.getElementById('mapelKuliah');
    if (inputMapel) {
        inputMapel.placeholder = (status === 'Pelajar') ? "Mata Pelajaran" : "Mata Kuliah";
    }
    nextPage('pageRegister');
}

function simpanTugasLengkap() {
    const nama = document.getElementById('namaTugas').value;
    const mapel = document.getElementById('mapelKuliah').value;
    const deadline = document.getElementById('deadlineTugas').value;
    const prioritas = document.getElementById('prioritasTugas').value;
    const pengingat = document.getElementById('pengingatTugas').value;

    if (!nama || !deadline) return alert("Nama tugas dan Deadline wajib diisi!");

    const list = document.getElementById('listTugasLengkap');
    const card = document.createElement('div');
    card.className = `task-card priority-${prioritas}`;
    
    card.innerHTML = `
        <div style="font-weight:bold; font-size:1.1rem;">${nama}</div>
        <div style="font-size:0.85rem; color:#666;">${mapel}</div>
        <hr>
        <div style="font-size:0.8rem;">
            📅 Deadline: ${deadline} <br>
            🔔 Pengingat: ${pengingat ? pengingat.replace('T', ' ') : '-'} <br>
            🔥 Prioritas: <strong>${prioritas}</strong>
        </div>
        <button onclick="this.parentElement.remove()" style="margin-top:10px; background:red; padding:5px;">Hapus</button>
    `;

    list.appendChild(card);
    
    // Reset form setelah simpan
    document.getElementById('namaTugas').value = "";
    document.getElementById('mapelKuliah').value = "";
}

function simpanKegiatanLengkap() {
    const nama = document.getElementById('namaKegiatan').value;
    const jenis = document.getElementById('jenisKegiatan').value;
    const durasi = document.getElementById('durasiKegiatan').value;
    const lokasi = document.getElementById('lokasiKegiatan').value;
    const notes = document.getElementById('notesKegiatan').value;

    if (!nama) return alert("Nama kegiatan wajib diisi!");

    const list = document.getElementById('listKegiatanLengkap');
    const card = document.createElement('div');
    card.className = "activity-card";
    
    card.innerHTML = `
        <div style="font-weight:bold; font-size:1.1rem; color:#8e44ad;">${nama}</div>
        <div style="font-size:0.85rem; font-style:italic;">${jenis}</div>
        <hr style="border:0.5px solid #eee;">
        <div style="font-size:0.8rem;">
            ⏱️ <strong>Durasi:</strong> ${durasi || '-'} <br>
            📍 <strong>Lokasi:</strong> ${lokasi || '-'} <br>
            📝 <strong>Notes:</strong> ${notes || '-'}
        </div>
        <button onclick="this.parentElement.remove()" style="margin-top:10px; background:#e74c3c; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">Hapus</button>
    `;

    list.appendChild(card);
    
    // Reset form
    document.getElementById('namaKegiatan').value = "";
    document.getElementById('durasiKegiatan').value = "";
    document.getElementById('lokasiKegiatan').value = "";
    document.getElementById('notesKegiatan').value = "";
}

// Pastikan fungsi goToFeature kamu diupdate untuk menghapus pilihan Jadwal Belajar
function goToFeature(pilihan) {
    if (pilihan === 'Tambah Tugas') nextPage('pageTambahTugas');
    else if (pilihan === 'Tambah Kegiatan') nextPage('pageTambahKegiatan');
}

// Toggle Menu Titik Tiga
function toggleMenu() {
    document.getElementById("dropdownMenu").classList.toggle("show");
}

// Tutup menu jika klik di luar
window.onclick = function(event) {
    if (!event.target.matches('.menu-dots') && !event.target.matches('.menu-dots span')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// Fungsi Simpan yang dimodifikasi agar masuk ke Dashboard
function simpanTugasLengkap() {
    const nama = document.getElementById('namaTugas').value;
    const deadline = document.getElementById('deadlineTugas').value;
    if (!nama || !deadline) return alert("Isi data tugas!");

    const taskObj = {
        id: Date.now(),
        nama: nama,
        detail: document.getElementById('mapelKuliah').value,
        type: 'Tugas'
    };

    addToDashboard(taskObj);
    nextPage('pageDashboard');
    // Reset form
    document.getElementById('namaTugas').value = "";
}

function addToDashboard(obj) {
    const list = document.getElementById('activeTasksList');
    // Hapus teks "belum ada tugas" jika ada
    if(list.querySelector('p')) list.innerHTML = '';

    const div = document.createElement('div');
    div.className = 'todo-item';
    div.id = `item-${obj.id}`;
    div.innerHTML = `
        <input type="checkbox" onclick="selesaikanTugas(${obj.id}, '${obj.nama}', '${obj.type}')">
        <div>
            <strong>[${obj.type}] ${obj.nama}</strong><br>
            <small style="color: #666;">${obj.detail || ''}</small>
        </div>
    `;
    list.appendChild(div);
}

function selesaikanTugas(id, nama, type) {
    // 1. Hapus dari dashboard
    const element = document.getElementById(`item-${id}`);
    element.style.opacity = '0.5';
    
    setTimeout(() => {
        element.remove();
        // 2. Tambah ke Riwayat
        const historyList = document.getElementById('historyList');
        const histDiv = document.createElement('div');
        histDiv.className = 'todo-item';
        histDiv.style.background = '#e8f5e9';
        histDiv.innerHTML = `<span>✅</span> <div><strong>${nama}</strong><br><small>Selesai pada: ${new Date().toLocaleDateString()}</small></div>`;
        historyList.appendChild(histDiv);
    }, 500);
}

// Fitur Lupa Password Sederhana
function lupaPassword() {
    const email = prompt("Masukkan email Anda untuk pemulihan:");
    if (email) {
        alert("Instruksi pemulihan telah dikirim ke " + email);
    }
}