const kehadiran_input = document.querySelectorAll('.kehadiran-input');

if (kehadiran_input.length) {
    kehadiran_input.forEach(_kehadiran_input => {
        _kehadiran_input.addEventListener('change', function () {

            const row_id = this.dataset.row;
            const tr = this.closest('tr');

            const hidden_status = tr.querySelector(
                `input[name="status[${row_id}]"]`
            );
            const keterangan = tr.querySelector('.keterangan-input');

            // update hidden status
            hidden_status.value = this.value;

            if (this.value === 'Izin') {
                // restore nilai lama
                if (keterangan.dataset.prev !== undefined) {
                    keterangan.value = keterangan.dataset.prev;
                }
                keterangan.disabled = false;
            } else {
                // simpan nilai lama
                keterangan.dataset.prev = keterangan.value;

                // kosongkan & disable
                keterangan.value = '';
                keterangan.disabled = true;
            }

            // tandai perubahan
            keterangan.dataset.change = 1;
            hidden_status.dataset.change = 1;
        });
    });
}
