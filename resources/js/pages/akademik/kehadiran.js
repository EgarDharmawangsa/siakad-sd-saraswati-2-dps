const kehadiran_input = document.querySelectorAll('.kehadiran-input');
const kehadiran_status_filter = document.getElementById('kehadiran-status-filter');
const keterangan_filter = document.getElementById('keterangan-filter');

if (kehadiran_input.length) {
    kehadiran_input.forEach(_kehadiran_input => {
        _kehadiran_input.addEventListener('change', function () {

            const row_id = this.dataset.row;
            const tr = this.closest('tr');

            const hidden_status = tr.querySelector(
                `input[name="status[${row_id}]"]`
            );
            const keterangan = tr.querySelector('.keterangan-input');

            hidden_status.value = this.value;

            if (this.value === 'Izin') {
                if (keterangan.dataset.prev !== undefined) {
                    keterangan.value = keterangan.dataset.prev;
                }
                keterangan.disabled = false;
            } else {
                keterangan.dataset.prev = keterangan.value;
                keterangan.value = '';
                keterangan.disabled = true;
            }

            keterangan.dataset.change = 1;
            hidden_status.dataset.change = 1;
        });
    });
}

if (kehadiran_status_filter) {
    let keterangan_filter_value = keterangan_filter.value;
    kehadiran_status_filter.addEventListener('change', function () {
        if (status_filter.value === 'Izin') {
            keterangan_filter.disabled = false;
            keterangan_filter.value = keterangan_filter_value
        } else {
            keterangan_filter.disabled = true;
            keterangan_filter_value = keterangan_filter.value;
            keterangan_filter.value = '';
        }
    });
}
