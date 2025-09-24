import '../css/app.css';

import './bootstrap';
// import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import * as bootstrap from 'bootstrap';

import './components/cancel_confirm.js';
import './components/delete_confirm.js';
import './partials/navbar.js';
import './partials/sidebar.js';
import './pages/master/ekstrakurikuler.js';
import './pages/master/pegawai.js';
import './pages/akademik/pengumuman.js';

const success_toast = document.getElementById('success-toast');

if (success_toast) {
    const toast = new bootstrap.Toast(success_toast);
    toast.show();
}

const image_input = document.querySelector('.image-input');
const image_preview = document.getElementById('image-preview');
const image_delete_button = document.getElementById('image-delete-button');
const image_delete = document.getElementById('image-delete');

if (image_input) {
    image_input.addEventListener('change', () => {
        if (image_input && image_input.files.length > 0) {
            const reader = new FileReader();
            reader.onload = (e) => {
                if (image_preview) {
                    image_preview.src = e.target.result;
                    image_preview.classList.remove('d-none');
                }
                if (image_delete_button) {
                    image_delete_button.classList.remove('d-none');
                }
                if (image_delete) {
                    image_delete.value = 0;
                }
            };
            reader.readAsDataURL(image_input.files[0]);
        }
    });
}

if (image_delete_button) {
    image_delete_button.addEventListener('click', () => {
        if (image_preview) {
            image_preview.src = '';
            image_preview.classList.add('d-none');
        }
        if (image_delete_button) {
            image_delete_button.classList.add('d-none');
        }
        if (image_input) {
            image_input.value = '';
        }
        if (image_delete) {
            image_delete.value = 1;
        }
    });
}
