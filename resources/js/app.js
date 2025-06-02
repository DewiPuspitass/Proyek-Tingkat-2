import TomSelect from "tom-select";
import './bootstrap';
import Alpine from 'alpinejs';

document.addEventListener('DOMContentLoaded', () => {

    const domisiliPenempatan = document.querySelector('select[name="domisili_penempatan"]');
    if (domisiliPenempatan) {
        new TomSelect(domisiliPenempatan);
    }

    const domisiliPerusahaan = document.querySelector('select[name="domisili_perusahaan"]');
    if (domisiliPerusahaan) {
        new TomSelect(domisiliPerusahaan);
    }
});

window.Alpine = Alpine;
Alpine.start();
