const log_out_form = document.getElementById('log-out-form');
const log_out_confirm_button = document.getElementById('log-out-confirm-button');

if (log_out_confirm_button) {
    log_out_confirm_button.addEventListener('click', () => {
        log_out_form.submit();
    });
}
