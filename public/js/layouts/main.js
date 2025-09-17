const image_input = document.querySelector('.image-input');
const image_preview = document.getElementById('image-preview');
const image_delete_button = document.getElementById('image-delete-button');
const image_delete = document.getElementById('image-delete');

function imagePreview() {
    if (image_input.files.length > 0) {
        const reader = new FileReader();
        reader.onload = e => {
            image_preview.src = e.target.result;
            image_preview.classList.remove('d-none');
            image_delete_button.classList.remove('d-none');
            if (image_delete) {
                image_delete.value = 0;
            }
        };
        reader.readAsDataURL(image_input.files[0]);
    }
}

function imageDelete() {
    image_preview.src = '';
    image_preview.classList.add('d-none');
    image_delete_button.classList.add('d-none');
    image_input.value = '';
    if (image_delete) {
        image_delete.value = 1;
    }
}
