import '../css/app.css';

import Swal from 'sweetalert2';
import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import './partials/sidebar.js';
import './pages/master/ekstrakurikuler.js';
import './pages/akademik/pengumuman.js';

// const delete_form = document.getElementById('delete-form');

// function deletePopUp() {
//     Swal.fire({
//         title: "Apakah Anda yakin?",
//         text: "Data yang dihapus tidak dapat dikembalikan.",
//         icon: "warning",
//         showCancelButton: true,
//         reverseButtons: true,
//         confirmButtonColor: "#0d6efd",
//         cancelButtonColor: "#dc3545",
//         confirmButtonText: "Ya",
//         cancelButtonText: "Batal"
//     }).then((result) => {
//         if (result.isConfirmed && delete_form) {
//             delete_form.submit();
//         }
//     });
// }

// function cancelPopUp(route) {
//     Swal.fire({
//         title: "Apakah Anda yakin?",
//         text: "Proses yang dibatalkan tidak dapat dikembalikan.",
//         icon: "warning",
//         showCancelButton: true,
//         reverseButtons: true,
//         confirmButtonColor: "#0d6efd",
//         cancelButtonColor: "#dc3545",
//         confirmButtonText: "Ya",
//         cancelButtonText: "Batal"
//     }).then((result) => {
//         if (result.isConfirmed && route) {
//             window.location.href = route;
//         }
//     });
// }

const image_input = document.querySelector('.image-input');
const image_preview = document.getElementById('image-preview');
const image_delete_button = document.getElementById('image-delete-button');
const image_delete = document.getElementById('image-delete');

if (image_input) {
    image_input.addEventListener('change', () => {
        if (image_input && image_input.files.length > 0) {
            const reader = new FileReader();
            reader.onload = e => {
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
