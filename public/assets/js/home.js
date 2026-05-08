// elemen html (selectors)
const hamburger = document.getElementById('hamburgerMenu');
const navLinks = document.getElementById('navLinks');
const navItems = document.querySelectorAll('.nav-links a');
const hamburgerIcon = document.querySelector('.hamburger i');


// fungsi & logika
// toggle menu navigasi mobile
function toggleMenu() {
    navLinks.classList.toggle('active');
    
    if (navLinks.classList.contains('active')) {
        hamburgerIcon.classList.remove('fa-bars');
        hamburgerIcon.classList.add('fa-times');
    } else {
        hamburgerIcon.classList.remove('fa-times');
        hamburgerIcon.classList.add('fa-bars');
    }
}


// tombol & kejadian (event listeners)
// buka tutup menu hamburger
if (hamburger) {
    hamburger.addEventListener('click', toggleMenu);
}

// tutup menu saat link diklik (untuk mobile)
navItems.forEach(item => {
    item.addEventListener('click', () => {
        if (navLinks.classList.contains('active')) {
            toggleMenu();
        }
    });
});
