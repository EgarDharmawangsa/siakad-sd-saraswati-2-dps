import '../css/app.css';

import './bootstrap';
// import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import * as bootstrap from 'bootstrap';
import flatpickr from 'flatpickr';

import './components/cancel_modal.js';
import './components/delete_modal.js';
import './partials/navbar.js';
import './partials/sidebar.js';
import './pages/beranda.js';
import './pages/master/pegawai.js';
import './pages/akademik/jadwal_pelajaran.js';
import './pages/akademik/prestasi.js';
import './pages/akademik/pengumuman.js';

const page_body = document.getElementById('page-body');
const success_toast = document.getElementById('success-toast');
const error_toast = document.getElementById('error-toast');
const filter_modal_close_button = document.getElementById('filter-modal-close-button');
const filter_modal_form = document.getElementById('filter-modal-form');
const filter_modal_clear_button = document.getElementById('filter-modal-clear-button');
const image_input = document.querySelector('.image-input');
const image_preview = document.getElementById('image-preview');
const image_delete_button = document.getElementById('image-delete-button');
const image_delete = document.getElementById('image-delete');
const jam_array = [];
jam_array[0] =
    document.getElementById('jam-mulai') ||
    document.getElementById('jam-mulai-filter');
jam_array[1] =
    document.getElementById('jam-selesai') ||
    document.getElementById('jam-selesai-filter');

const route_name_value = page_body.dataset.routeName;

if (success_toast || error_toast) {
    const toast = new bootstrap.Toast(success_toast || error_toast);
    toast.show();
}

if (filter_modal_close_button) {
    filter_modal_close_button.addEventListener('click', () => {
        filter_modal_close_button.blur();
    });
}

if (filter_modal_clear_button) {
    filter_modal_clear_button.addEventListener('click', () => {
        filter_modal_form.querySelectorAll('input, select').forEach((input) => {
            input.value = '';
        });
    });
}

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

if (!route_name_value.includes('.show') && jam_array) {
    const flatpickr_option = {
        allowInput: true,
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
    };

    jam_array.forEach((_jam_array) => {
        if (_jam_array) flatpickr(_jam_array, flatpickr_option);
    });
}
