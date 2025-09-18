const passwordInput = document.getElementById('password');
const toggleBtn = document.getElementById('togglePassBtn');
toggleBtn.addEventListener('click', () => {
    const icon = toggleBtn.querySelector('i');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.replace('fa-eye','fa-eye-slash');
        toggleBtn.classList.add('active');
    } else {
        passwordInput.type = 'password';
        icon.classList.replace('fa-eye-slash','fa-eye');
        toggleBtn.classList.remove('active');
    }
});

// Auto-hide alert
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});

// Validasi sederhana
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const u = document.getElementById('username').value.trim();
    const p = document.getElementById('password').value;
    if (!u || !p) {
        e.preventDefault();
        alert('Mohon lengkapi semua field!');
    }
});