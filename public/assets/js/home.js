function toggleMenu() {
    const navLinks = document.getElementById('navLinks');
    const icon = document.querySelector('.hamburger i');
    
    navLinks.classList.toggle('active');
    
    if (navLinks.classList.contains('active')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-times');
    } else {
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    }
}
