{{-- resources/views/frontend/partials/script.blade.php --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | MOBILE MENU TOGGLE
    |--------------------------------------------------------------------------
    */
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });
    }


    /*
    |--------------------------------------------------------------------------
    | USER DROPDOWN TOGGLE
    |--------------------------------------------------------------------------
    */
    const dropdownBtn = document.getElementById('userDropdownBtn');
    const dropdownMenu = document.getElementById('userDropdownMenu');
    const dropdownWrapper = document.getElementById('userDropdownWrapper');

    if (dropdownBtn && dropdownMenu && dropdownWrapper) {

        dropdownBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
            if (!dropdownWrapper.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }


    /*
    |--------------------------------------------------------------------------
    | AUTO CLOSE ALERT
    |--------------------------------------------------------------------------
    */
    const alertBox = document.getElementById('alert');

    if (alertBox) {
        setTimeout(() => {
            alertBox.classList.add('opacity-0', 'transition-opacity', 'duration-500');

            setTimeout(() => {
                alertBox.remove();
            }, 500);

        }, 3000);
    }


    /*
    |--------------------------------------------------------------------------
    | NAVBAR SHADOW ON SCROLL
    |--------------------------------------------------------------------------
    */
    const navbar = document.getElementById('navbar');

    if (navbar) {
        window.addEventListener('scroll', function () {

            if (window.scrollY > 10) {
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.remove('shadow-md');
            }

        });
    }

});


/*
|--------------------------------------------------------------------------
| CONFIRM DELETE (Global Function)
|--------------------------------------------------------------------------
*/
function confirmDelete(event) {
    if (!confirm('Yakin ingin menghapus data ini?')) {
        event.preventDefault();
    }
}
</script>


{{-- VITE JS --}}
@vite('resources/js/app.js')