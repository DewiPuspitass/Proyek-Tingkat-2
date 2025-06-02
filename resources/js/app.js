// Import TomSelect dan Alpine
import TomSelect from "tom-select";
import './bootstrap';
import Alpine from 'alpinejs';

// Jalankan setelah DOM siap
document.addEventListener('DOMContentLoaded', () => {
    // Inisialisasi TomSelect hanya jika elemennya ada

    const domisiliPenempatan = document.querySelector('select[name="domisili_penempatan"]');
    if (domisiliPenempatan) {
        new TomSelect(domisiliPenempatan);
    }

    const domisiliPerusahaan = document.querySelector('select[name="domisili_perusahaan"]');
    if (domisiliPerusahaan) {
        new TomSelect(domisiliPerusahaan);
    }

    // Atau bisa juga general, inisialisasi semua dengan class tertentu
    // document.querySelectorAll('.tomselect').forEach(el => {
    //     new TomSelect(el);
    // });
});

// Start Alpine.js
window.Alpine = Alpine;
Alpine.start();
