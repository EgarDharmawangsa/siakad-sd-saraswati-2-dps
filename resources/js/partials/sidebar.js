const sidebar = document.getElementById('sidebar');
const toggle_sidebar = document.getElementById('toggleSidebar');
const close_sidebar = document.getElementById('closeSidebar');
const nilai_menu = document.getElementById("nilai-menu");
const nilai_icon = document.querySelector('.nilai-menu-icon');

if (sidebar) {
    toggle_sidebar.addEventListener('click', () => {
        sidebar.classList.add('show');
    });
}

if (close_sidebar) {
    close_sidebar.addEventListener('click', () => {
        sidebar.classList.remove('show');
    });
}

if (nilai_menu) {
    nilai_menu.addEventListener('show.bs.collapse', () => {
        nilai_icon.classList.add('nilai-icon-rotate');
    });
}

if (nilai_menu) {
    nilai_menu.addEventListener('hide.bs.collapse', () => {
        nilai_icon.classList.remove('nilai-icon-rotate');
    });
}




