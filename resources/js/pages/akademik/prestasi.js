const peringkat = document.getElementById('peringkat') || document.getElementById('peringkat-filter');
const peringkat_lainnya = document.getElementById('peringkat-lainnya') || document.getElementById('peringkat-lainnya-filter');

if (peringkat) {
    let peringkat_lainnya_value = '';

    if (peringkat_lainnya.value) {
        peringkat_lainnya_value = peringkat_lainnya.value;
        peringkat_lainnya.removeAttribute('disabled');
    }

    peringkat.addEventListener('change', () => {
        if (peringkat.value === 'Lainnya') {
            peringkat_lainnya.removeAttribute('disabled');

            if (peringkat_lainnya_value) {
                peringkat_lainnya.value = peringkat_lainnya_value;
            }
        } else {
            peringkat_lainnya.setAttribute('disabled', true);
            peringkat_lainnya_value = peringkat_lainnya.value;
            peringkat_lainnya.value = '';
        }
    });
}
