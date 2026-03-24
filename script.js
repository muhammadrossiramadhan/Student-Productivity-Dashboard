// Navigasi Halaman
function showPage(pageId) {
    const pages = document.querySelectorAll('.page-content');
    pages.forEach(page => page.classList.remove('active-page'));
    
    const activePage = document.getElementById(pageId);
    if (activePage) {
        activePage.classList.add('active-page');
    }
}

// Toggle Menu
function toggleMenu() {
    const navMenu = document.getElementById('navMenu');
    navMenu.classList.toggle('show');
}