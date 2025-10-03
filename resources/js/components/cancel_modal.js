const cancel_button = document.getElementById('cancel-button');
const cancel_confirm_button = document.getElementById('cancel-confirm-button');

if (cancel_confirm_button) {
    cancel_confirm_button.addEventListener('click', () => {
        const route = cancel_button.dataset.route;
        window.location.href = route;
    });
}