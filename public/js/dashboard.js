document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard Loaded');

    // Fitur Klik Tanggal untuk History
    const datePicker = document.getElementById('dashboardDatePicker');
    if (datePicker) {
        datePicker.addEventListener('change', function() {
            const selectedDate = this.value; // Format: YYYY-MM-DD
            if (selectedDate) {
                // Redirect ke dashboard dengan parameter tanggal
                window.location.href = '/dashboard/' + selectedDate;
            }
        });
    }

    // Efek navigasi yang sudah ada
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            this.classList.add('opacity-50');
        });
    });
});