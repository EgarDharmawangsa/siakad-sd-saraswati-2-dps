const delete_form = document.getElementById('delete-form');
const delete_confirm_button = document.getElementById('delete-confirm-button');

if (delete_confirm_button) {
    delete_confirm_button.addEventListener('click', () => {
        delete_form.submit();
    });
}