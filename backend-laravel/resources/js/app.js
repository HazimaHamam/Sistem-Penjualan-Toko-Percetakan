/*
|--------------------------------------------------------------------------
| Laravel Bootstrap
|--------------------------------------------------------------------------
*/

import './bootstrap';

/*
|--------------------------------------------------------------------------
| AlpineJS
| Menggantikan CDN unpkg di app.blade.php
|--------------------------------------------------------------------------
*/

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

/*
|--------------------------------------------------------------------------
| Frontend Dashboard Modules
|--------------------------------------------------------------------------
*/

import './frontend/dashboard/sidebar';

/*
|--------------------------------------------------------------------------
| Global UI Helpers — Dropdown
|--------------------------------------------------------------------------
| Kedua listener dropdown digabung menjadi satu untuk efisiensi.
| - Klik [data-toggle="dropdown"] → toggle menu berikutnya
| - Klik di luar [data-dropdown-menu] → tutup semua menu terbuka
|--------------------------------------------------------------------------
*/

document.addEventListener('click', function (e) {

    // 1. Toggle dropdown yang diklik
    const toggle = e.target.closest('[data-toggle="dropdown"]');
    if (toggle) {
        const menu = toggle.nextElementSibling;
        if (menu) {
            menu.classList.toggle('hidden');
        }
    }

    // 2. Tutup semua dropdown yang terbuka jika klik di luar
    document.querySelectorAll('[data-dropdown-menu]').forEach(menu => {
        const isOutsideMenu   = !menu.contains(e.target);
        const isOutsideToggle = !menu.previousElementSibling?.contains(e.target);

        if (isOutsideMenu && isOutsideToggle) {
            menu.classList.add('hidden');
        }
    });

});