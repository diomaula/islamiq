// script.js

document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi dropdown jika diperlukan
    var dropdowns = document.querySelectorAll('.dropdown-toggle');
    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(event) {
            event.stopPropagation();
            var dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        });
    });
});
