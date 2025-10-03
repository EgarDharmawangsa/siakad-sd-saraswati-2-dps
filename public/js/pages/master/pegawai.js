document.addEventListener('DOMContentLoaded', function() {
    const posisi = document.getElementById('posisi');
    const status_kepegawaian = document.getElementById('status-kepegawaian');
    const status_sertifikasi = document.getElementById('status-sertifikasi');
    const nip = document.getElementById('nip');
    const jabatan = document.getElementById('jabatan');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const guru_mapel_btn = document.getElementById('guru-mata-pelajaran-dropdown-button');
    const no_sk = document.getElementById('no-sk');
    const tanggal_sk = document.getElementById('tanggal-sk-terakhir');
    const tahun_sertifikasi = document.getElementById('tahun-sertifikasi');

    if (!posisi || !status_kepegawaian || !status_sertifikasi) {
        console.warn('Elemen tidak ditemukan.');
        return;
    }

    function update_fields() {
        const posisi_val = posisi.value;
        const status_val = status_kepegawaian.value;
        const sertifikasi_val = status_sertifikasi.value;

        // Reset semua ke disabled
        if (nip) nip.disabled = true;
        if (jabatan) jabatan.disabled = true;
        if (username) username.disabled = true;
        if (password) password.disabled = true;
        if (guru_mapel_btn) guru_mapel_btn.disabled = true;
        if (no_sk) no_sk.disabled = true;
        if (tanggal_sk) tanggal_sk.disabled = true;
        if (tahun_sertifikasi) tahun_sertifikasi.disabled = true;

        if (posisi_val === '2') { // Guru
            if (guru_mapel_btn) guru_mapel_btn.disabled = false;
            if (status_val === 'PNS' || status_val === 'PPPK') {
                if (nip) nip.disabled = false;
                if (jabatan) jabatan.disabled = false;
            }
            if (username) username.disabled = false;
            if (password) password.disabled = false;
            if (tahun_sertifikasi) tahun_sertifikasi.disabled = false;
        } else if (posisi_val === '1' || posisi_val === '3') { // TU / Perpus
            if (status_val === 'PNS' || status_val === 'PPPK') {
                if (nip) nip.disabled = false;
                if (jabatan) jabatan.disabled = false;
            }
            if (username) username.disabled = false;
            if (password) password.disabled = false;
            if (tahun_sertifikasi) tahun_sertifikasi.disabled = false;
        }

        if (sertifikasi_val === '1') {
            if (no_sk) no_sk.disabled = false;
            if (tanggal_sk) tanggal_sk.disabled = false;
        }
    }

    function handle_posisi_change() {
        status_kepegawaian.value = '';
        update_fields();
    }

    update_fields();
    posisi.addEventListener('change', handle_posisi_change);
    status_kepegawaian.addEventListener('change', update_fields);
    status_sertifikasi.addEventListener('change', update_fields);

    // Cek awal sertifikasi
    if (status_sertifikasi.value === '1') {
        if (tahun_sertifikasi) tahun_sertifikasi.disabled = false;
    }
});
