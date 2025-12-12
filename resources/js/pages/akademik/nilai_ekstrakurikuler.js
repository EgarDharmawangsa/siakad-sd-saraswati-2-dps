const nilai_ekstrakurikuler_form = document.getElementById('nilai-ekstrakurikuler-form');
const nilai_inputs = document.querySelectorAll('.nilai-input');

if (nilai_ekstrakurikuler_form) {
    nilai_ekstrakurikuler_form.addEventListener('submit', () => {
        nilai_inputs.forEach((nilai_input) => {
            if (!nilai_input.dataset.change) {
                const hidden_input = nilai_input.previousElementSibling;
                hidden_input.remove();
                nilai_input.remove();
            }
        })
    });
}

if (nilai_inputs) {
    nilai_inputs.forEach((nilai_input) => {
        nilai_input.addEventListener('change', () => {
            this.DataTransferItem.change = 1;
        })
    });
}