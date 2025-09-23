const sidebar = document.getElementById('sidebar');
const close_sidebar = document.getElementById('close-sidebar');
const nilai_menu = document.getElementById('nilai-menu');
const nilai_icon = document.querySelector('.nilai-menu-icon');

if (close_sidebar) {
    close_sidebar.addEventListener('click', () => {
        sidebar.classList.remove('show');
    });
}

if (nilai_menu) {
    nilai_menu.addEventListener('show.bs.collapse', () => {
        nilai_icon.classList.add('nilai-icon-rotate');
    });

    nilai_menu.addEventListener('hide.bs.collapse', () => {
        nilai_icon.classList.remove('nilai-icon-rotate');
    });
}
