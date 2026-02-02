document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard Loaded');

    // Contoh: Menambahkan efek aktif secara dinamis jika diperlukan
    const navLinks = document.querySelectorAll('nav a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Efek loading sederhana saat berpindah menu
            this.classList.add('opacity-50');
        });
    });
});