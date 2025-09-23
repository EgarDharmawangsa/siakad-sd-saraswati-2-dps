const sidebar = document.getElementById('sidebar');
const toggle_sidebar = document.getElementById('toggle-sidebar');

if (toggle_sidebar) {
    toggle_sidebar.addEventListener('click', () => {
        sidebar.classList.add('show');
    });
}