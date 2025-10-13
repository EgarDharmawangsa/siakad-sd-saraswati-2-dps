let data_to_delete = null;
const delete_forms = document.querySelectorAll('.delete-form');
const delete_confirm_button = document.getElementById('delete-confirm-button');

if (delete_forms) {
    delete_forms.forEach((form) => {
        const delete_button = form.querySelector('.delete-button');

        delete_button.addEventListener('click', () => {
            data_to_delete = form;
        });
    });
}

if (delete_confirm_button) {
    delete_confirm_button.addEventListener('click', () => {
        if (data_to_delete) {
            data_to_delete.submit();
            data_to_delete = null;
        }
    });
}
