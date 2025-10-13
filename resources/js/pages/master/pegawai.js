// document.addEventListener('DOMContentLoaded', function () {
const username = document.getElementById('username');
const password = document.getElementById('password');
const posisi = document.getElementById('posisi');
const jabatan = document.getElementById('jabatan');
const status_kepegawaian = document.getElementById('status-kepegawaian');
const status_sertifikasi = document.getElementById('status-sertifikasi');
const nip = document.getElementById('nip');
const nipppk = document.getElementById('nipppk');
const id_mata_pelajaran_hidden = document.querySelectorAll('.id-mata-pelajaran-hidden');
const id_mata_pelajaran_dropdown_button = document.getElementById('id-mata-pelajaran-dropdown-button');
const id_mata_pelajaran_checkboxes = document.querySelectorAll('.id-mata-pelajaran-checkbox');
const no_sk = document.getElementById('no-sk');
const tanggal_sk_terakhir = document.getElementById('tanggal-sk-terakhir');
const tahun_sertifikasi = document.getElementById('tahun-sertifikasi');

if (id_mata_pelajaran_checkboxes) {
    function checkedMataPelajaran() {
        const checked = Array.from(id_mata_pelajaran_checkboxes)
            .filter((i) => i.checked)
            .map((i) => i.value);
        id_mata_pelajaran_dropdown_button.textContent =
            checked.length > 0
                ? `${checked.length} Dipilih`
                : '-- Pilih Mata Pelajaran --';
    }

    id_mata_pelajaran_checkboxes.forEach(
        (guru_mata_pelajaran_checkbox) => {
            checkedMataPelajaran();
            guru_mata_pelajaran_checkbox.addEventListener('change', () => {
                checkedMataPelajaran();
            });
        }
    );
}

if (posisi) {
    // Fungsi update field
    function updateFields() {
        const posisi_value = posisi.value;
        const status_kepegawaian_value = status_kepegawaian.value;
        const status_sertifikasi_value = status_sertifikasi
            ? status_sertifikasi.value
            : '';

        // Reset semua ke disabled
        if (nip) nip.disabled = true;
        if (nipppk) nipppk.disabled = true;
        if (status_kepegawaian) status_kepegawaian.disabled = true;
        if (jabatan) jabatan.disabled = true;
        if (id_mata_pelajaran_dropdown_button)
            id_mata_pelajaran_dropdown_button.disabled = true;
        if (username) username.disabled = true;
        if (password) password.disabled = true;
        if (no_sk) no_sk.disabled = true;
        if (tanggal_sk_terakhir) tanggal_sk_terakhir.disabled = true;
        if (status_sertifikasi) status_sertifikasi.disabled = true;
        if (tahun_sertifikasi) tahun_sertifikasi.disabled = true;

        if (nip) nip.closest('.col-md-6').style.display = 'block';

        if (nipppk) nipppk.closest('.col-md-6').style.display = 'none';

        if (jabatan) jabatan.closest('.col-md-6').style.display = 'block';

        if (status_kepegawaian_value === 'PPPK') {
            // PPPK
            // Sembunyikan NIP, tampilkan NIPPPK
            if (nip) nip.closest('.col-md-6').style.display = 'none';
            if (nipppk) {
                nipppk.closest('.col-md-6').style.display = 'block';
                nipppk.disabled = false;
            }
            // Tampilkan jabatan untuk PPPK
            if (jabatan) {
                jabatan.closest('.col-md-6').style.display = 'block';
                jabatan.disabled = false;
            }
            if (no_sk) no_sk.disabled = false;
            if (tanggal_sk_terakhir) tanggal_sk_terakhir.disabled = false;
        } else if (status_kepegawaian_value === 'PNS') {
            // PNS
            // Aktifkan NIP (tetap muncul)
            if (nip) nip.disabled = false;
            // Tampilkan jabatan untuk PNS
            if (jabatan) {
                jabatan.closest('.col-md-6').style.display = 'block';
                jabatan.disabled = false;
            }
            if (no_sk) no_sk.disabled = false;
            if (tanggal_sk_terakhir) tanggal_sk_terakhir.disabled = false;
        }

        if (
            posisi_value === 'Staf Tata Usaha' ||
            posisi_value === 'Guru' ||
            posisi_value === 'Pegawai Perpustakaan'
        ) {
            // Staf TU (1), Guru (2), Perpus (3)
            if (username) username.disabled = false;
            if (password) password.disabled = false;
            if (status_kepegawaian) status_kepegawaian.disabled = false;
        }

        if (
            posisi_value === 'Staf Tata Usaha' ||
            posisi_value === 'Guru' ||
            posisi_value === 'Pegawai Perpustakaan' ||
            posisi_value === 'Satuan Pengamanan'
        ) {
            // Staf TU
            if (status_sertifikasi) status_sertifikasi.disabled = false;
        } else if (posisi === 'Pegawai Kebersihan') {
            // Kebersihan
            if (status_sertifikasi) status_sertifikasi.disabled = false;
        }

        if (posisi_value === 'Guru') {
            // Guru
            if (id_mata_pelajaran_dropdown_button)
                id_mata_pelajaran_dropdown_button.disabled = false;
        }

        if (status_sertifikasi_value === 'Sudah') {
            if (tahun_sertifikasi) tahun_sertifikasi.disabled = false;
        }
    }

    // Reset status kepegawaian saat posisi berubah
    function handlePosisiChange() {
        status_kepegawaian.value = 'default'; // Reset ke opsi default
        updateFields();
    }

    // Inisialisasi
    updateFields();
    posisi.addEventListener('change', handlePosisiChange);
    if (status_kepegawaian)
        status_kepegawaian.addEventListener('change', updateFields);
    if (status_sertifikasi)
        status_sertifikasi.addEventListener('change', updateFields);
}
// });
