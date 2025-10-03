const peringkat = document.getElementById('peringkat');
const peringkat_lainnya = document.getElementById('peringkat-lainnya');

if (peringkat) {
    let peringkat_lainnya_value = '';

    if (peringkat_lainnya.value) {
        peringkat_lainnya_value = peringkat_lainnya.value;
        peringkat_lainnya.removeAttribute('disabled');
        peringkat_lainnya.placeholder = 'Masukkan peringkat lainnya';
    }

    peringkat.addEventListener('change', () => {
        if (peringkat.value == 'Lainnya') {
            peringkat_lainnya.removeAttribute('disabled');
            peringkat_lainnya.placeholder = 'Masukkan peringkat lainnya';

            if (peringkat_lainnya_value) {
                peringkat_lainnya.value = peringkat_lainnya_value;
            }
        } else {
            peringkat_lainnya.setAttribute('disabled', true);
            peringkat_lainnya.placeholder = 'Untuk opsi Lainnya pada Peringkat.';
            peringkat_lainnya_value = peringkat_lainnya.value;
            peringkat_lainnya.value = '';
        }
    });
}
