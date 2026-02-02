document.addEventListener('DOMContentLoaded', function () {
    // === Logic Modal Tambah Data ===
    const modal = document.getElementById('modalTambah');
    const btnBuka = document.getElementById('btnTambah');
    const btnTutup = document.querySelectorAll('.close-modal');

    if (btnBuka) {
        btnBuka.addEventListener('click', () => {
            modal.classList.remove('hidden');
            // Sedikit delay agar transisi CSS berjalan (jika menggunakan class active)
            setTimeout(() => modal.classList.add('active'), 10);
        });
    }

    btnTutup.forEach(btn => {
        btn.addEventListener('click', () => {
            modal.classList.remove('active');
            setTimeout(() => modal.classList.add('hidden'), 300);
        });
    });

    // === Logic Konfirmasi Hapus (SweetAlert2) ===
    const deleteForms = document.querySelectorAll('.form-delete');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            
            // Cek apakah SweetAlert tersedia
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    background: '#1f2937', // Dark bg
                    color: '#fff',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#4b5563',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            } else {
                // Fallback jika SweetAlert tidak di-load
                if (confirm('Yakin ingin menghapus data ini?')) {
                    form.submit();
                }
            }
        });
    });
});