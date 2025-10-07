// const guru_mata_pelajaran_items = document.querySelectorAll('.guru-mata-pelajaran-item');
// const guru_mata_pelajaran_dropdown_button = document.getElementById('guru-mata-pelajaran-dropdown-button');


if (guru_mata_pelajaran_items) {
    guru_mata_pelajaran_items.forEach((guru_mata_pelajaran_item) => {
        guru_mata_pelajaran_item.addEventListener('change', () => {
            const checked = Array.from(guru_mata_pelajaran_items)
                .filter((i) => i.checked)
                .map((i) => i.value);
            guru_mata_pelajaran_dropdown_button.textContent =
                checked.length > 0
                    ? `${checked.length} Dipilih`
                    : '-- Pilih Mata Pelajaran --';
        });
    });
}


// if (guru_mata_pelajaran_items) {
//     guru_mata_pelajaran_items.forEach((guru_mata_pelajaran_item) => {
//         guru_mata_pelajaran_item.addEventListener('change', () => {
//             const checked = Array.from(guru_mata_pelajaran_items)
//                 .filter((i) => i.checked)
//                 .map((i) => i.value);
//             guru_mata_pelajaran_dropdown_button.textContent =
//                 checked.length > 0
//                     ? `${checked.length} Dipilih`
//                     : '-- Pilih Mata Pelajaran --';
//         });
//     });
// }

document.addEventListener('DOMContentLoaded', function () {
    // Elemen
    const posisi = document.getElementById('posisi');
    const statusKepegawaian = document.getElementById('status-kepegawaian');
    const statusSertifikasi = document.getElementById('status-sertifikasi');
    const nip = document.getElementById('nip');
    const nipppk = document.getElementById('nipppk');
    const jabatan = document.getElementById('jabatan');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const guruMapelBtn = document.getElementById('guru-mata-pelajaran-dropdown-button');
    const noSk = document.getElementById('no-sk');
    const tanggalSk = document.getElementById('tanggal-sk-terakhir');
    const tahunSertifikasi = document.getElementById('tahun-sertifikasi');

    // Validasi elemen
    if (!posisi || !statusKepegawaian) {
        console.warn('Elemen posisi atau status_kepegawaian tidak ditemukan.');
        return;
    }

    // Fungsi update field
    function updateFields() {
        const posisiVal = posisi.value;
        const statusVal = statusKepegawaian.value;
        const sertifikasiVal = statusSertifikasi ? statusSertifikasi.value : '';

        // Reset semua ke disabled
        if (nip) nip.disabled = true;
        if (nipppk) nipppk.disabled = true;
        if (jabatan) jabatan.disabled = true;
        if (username) username.disabled = true;
        if (password) password.disabled = true;
        if (guruMapelBtn) guruMapelBtn.disabled = true;
        if (noSk) noSk.disabled = true;
        if (tanggalSk) tanggalSk.disabled = true;
        if (tahunSertifikasi) tahunSertifikasi.disabled = true;

        // Sembunyikan/tampilkan NIP & NIPPPK
        if (nip) nip.closest('.col-md-6').style.display = 'none';
        if (nipppk) nipppk.closest('.col-md-6').style.display = 'none';

        // Logika berdasarkan status kepegawaian
        if (statusVal === 'PPPK') {
            if (nipppk) {
                nipppk.closest('.col-md-6').style.display = 'block';
                nipppk.disabled = false;
            }
        } else if (statusVal === 'PNS') {
            if (nip) {
                nip.closest('.col-md-6').style.display = 'block';
                nip.disabled = false;
            }
        }

        // Logika berdasarkan posisi
        if (posisiVal === 'Guru') {
            if (guruMapelBtn) guruMapelBtn.disabled = false;
            if (statusVal === 'PNS' || statusVal === 'PPPK') {
                if (jabatan) jabatan.disabled = false;
            }
            if (username) username.disabled = false;
            if (password) password.disabled = false;
            if (tahunSertifikasi) tahunSertifikasi.disabled = false;
        } 
        else if (posisiVal === 'Staf Tata Usaha' || posisiVal === 'Pegawai Perpustakaan') {
            if (statusVal === 'PNS' || statusVal === 'PPPK') {
                if (jabatan) jabatan.disabled = false;
            }
            if (username) username.disabled = false;
            if (password) password.disabled = false;
            if (tahunSertifikasi) tahunSertifikasi.disabled = false;
        }
        // Kebersihan/Satpam: semua tetap disabled

        // Aktifkan SK jika sertifikasi = "Sudah"
        if (sertifikasiVal === 'Sudah') {
            if (noSk) noSk.disabled = false;
            if (tanggalSk) tanggalSk.disabled = false;
        }
    }

    // Reset status kepegawaian saat posisi berubah
    function handlePosisiChange() {
        statusKepegawaian.value = 'default';
        updateFields();
    }

    // Preview gambar
    const imageInput = document.getElementById('foto');
    const imagePreview = document.getElementById('image-preview');
    const imageDeleteButton = document.getElementById('image-delete-button');

    if (imageInput && imagePreview && imageDeleteButton) {
        imageInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                    imageDeleteButton.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });

        imageDeleteButton.addEventListener('click', function () {
            imageInput.value = '';
            imagePreview.src = '';
            imagePreview.classList.add('d-none');
            imageDeleteButton.classList.add('d-none');
        });
    }

    // Inisialisasi
    updateFields();
    posisi.addEventListener('change', handlePosisiChange);
    if (statusKepegawaian) statusKepegawaian.addEventListener('change', updateFields);
    if (statusSertifikasi) statusSertifikasi.addEventListener('change', updateFields);
});

