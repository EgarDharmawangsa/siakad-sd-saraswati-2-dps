const kehadiran_form = document.getElementById('kehadiran-form');
const kehadiran_inputs = document.querySelectorAll('.kehadiran-input');
const keterangan_inputs = document.querySelectorAll('.keterangan-input');
const kehadiran_status_filter = document.getElementById('kehadiran-status-filter');
const keterangan_filter = document.getElementById('keterangan-filter');

// Event listener untuk input kehadiran
if (kehadiran_inputs.length) {
    kehadiran_inputs.forEach((input) => {
        input.addEventListener('change', function () {
            const rowId = this.dataset.row;
            const tr = this.closest('tr');

            const hiddenStatus = tr.querySelector(`input[name="status[${rowId}]"]`);
            const keterangan = tr.querySelector('.keterangan-input');

            hiddenStatus.value = this.value;

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

            keterangan.dataset.change = '1';
            hiddenStatus.dataset.change = '1';
        });
    });
}

// Event listener untuk input keterangan
if (keterangan_inputs.length) {
    keterangan_inputs.forEach((input) => {
        input.addEventListener('input', function () {
            this.dataset.change = '1';
        });
    });
}

// Saat submit form kehadiran
if (kehadiran_form) {
    kehadiran_form.addEventListener('submit', () => {
        const processedRows = new Set();

        kehadiran_inputs.forEach((input) => {
            const rowKey = input.dataset.row;
            if (!rowKey || processedRows.has(rowKey)) return;

            const rowInputs = document.querySelectorAll(
                `.kehadiran-input[data-row="${rowKey}"], 
                 .keterangan-input[data-row="${rowKey}"],
                 input[type="hidden"][data-row="${rowKey}"]`
            );

            const hasChange = Array.from(rowInputs).some(
                (el) => el.dataset.change === '1'
            );

            if (!hasChange) {
                rowInputs.forEach((el) => (el.disabled = true));
            }

            processedRows.add(rowKey);
        });
    });
}

if (kehadiran_status_filter) {
    let keterangan_filter_value = keterangan_filter.value;

    if (kehadiran_status_filter.value === 'Izin') {
        keterangan_filter.disabled = false;
    }

    kehadiran_status_filter.addEventListener('change', function () {
        if (kehadiran_status_filter.value === 'Izin') {
            keterangan_filter.disabled = false;
            keterangan_filter.value = keterangan_filter_value;
        } else {
            keterangan_filter.disabled = true;
            keterangan_filter_value = keterangan_filter.value;
            keterangan_filter.value = '';
        }
    });
}
