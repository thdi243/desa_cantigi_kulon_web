import './bootstrap';

import Alpine from 'alpinejs';

import Swal from 'sweetalert2';

import.meta.glob([
    '../fonts/**',
]);

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();
