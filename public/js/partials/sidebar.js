const sidebar = document.getElementById('sidebar');
const toggle_sidebar = document.getElementById('toggleSidebar');
const close_sidebar = document.getElementById('closeSidebar');

toggle_sidebar.addEventListener('click', () => {
    sidebar.classList.add('show');
});

close_sidebar.addEventListener('click', () => {
    sidebar.classList.remove('show');
});

document.addEventListener("DOMContentLoaded", function () {
    const nilaiMenu = document.getElementById("nilaiMenu");
    const nilaiIcon = document.querySelector('[href="#nilaiMenu"] i');

    nilaiMenu.addEventListener("show.bs.collapse", function () {
        nilaiIcon.classList.add("nilai-icon-rotate");
    });

    nilaiMenu.addEventListener("hide.bs.collapse", function () {
        nilaiIcon.classList.remove("nilai-icon-rotate");
    });
});




