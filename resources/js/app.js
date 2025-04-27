import TomSelect from "tom-select";

import './bootstrap';

import Alpine from 'alpinejs';


document.addEventListener('DOMContentLoaded', () => {
    new TomSelect('select[name="domisili_penempatan"]');
    new TomSelect('select[name="domisili_perusahaan"]');
});

window.Alpine = Alpine;

Alpine.start();
