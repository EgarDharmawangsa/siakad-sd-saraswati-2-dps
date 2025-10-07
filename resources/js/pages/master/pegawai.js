document.addEventListener("DOMContentLoaded", function () {
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const posisi = document.getElementById("posisi");
    const jabatan = document.getElementById("jabatan");
    const statusKepegawaian = document.getElementById("status_kepegawaian");
    const statusSertifikasi = document.getElementById("status_sertifikasi");
    const nip = document.getElementById("nip");
    const nipppk = document.getElementById('nipppk');
    const guruMapelBtn = document.getElementById("guru-mata-pelajaran-dropdown-button");
    const noSk = document.getElementById("no_sk");
    const tanggalSk = document.getElementById("tanggal_sk_terakhir");
    const tahunSertifikasi = document.getElementById("tahun_sertifikasi");

    // Validasi elemen
    if (!posisi || !statusKepegawaian) {
        console.warn("Elemen posisi atau status_kepegawaian tidak ditemukan.");
        return;
    }

    // Fungsi update field
    function updateFields() {
    const posisiVal = posisi.value;
    const statusVal = statusKepegawaian.value;
    const sertifikasiVal = statusSertifikasi ? statusSertifikasi.value : "";

    // Reset semua ke disabled
    if (nip) nip.disabled = true;
    if (nipppk) nipppk.disabled = true;
    if (statusKepegawaian) statusKepegawaian.disabled = true;
    if (jabatan) jabatan.disabled = true;
    if (guruMapelBtn) guruMapelBtn.disabled = true;
    if (username) username.disabled = true;
    if (password) password.disabled = true;
    if (noSk) noSk.disabled = true;
    if (tanggalSk) tanggalSk.disabled = true;
    if (statusSertifikasi) statusSertifikasi.disabled = true;
    if (tahunSertifikasi) tahunSertifikasi.disabled = true;

    if (nip) nip.closest('.col-md-6').style.display = 'block';

    if (nipppk) nipppk.closest('.col-md-6').style.display = 'none';

    if (jabatan) jabatan.closest('.col-md-6').style.display = 'block';

    if (statusVal === '2') { // PPPK
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
        if (noSk) noSk.disabled = false;
        if (tanggalSk) tanggalSk.disabled = false;
        
    } 
    else if (statusVal === '1') { // PNS
        // Aktifkan NIP (tetap muncul)
        if (nip) nip.disabled = false;
        // Tampilkan jabatan untuk PNS
        if (jabatan) {
            jabatan.closest('.col-md-6').style.display = 'block';
            jabatan.disabled = false;
        }
        if (noSk) noSk.disabled = false;
        if (tanggalSk) tanggalSk.disabled = false;
    }

    if (posisiVal === "1" || posisiVal === "2" || posisiVal === "3") {
        // Staf TU (1), Guru (2), Perpus (3)
        if (username) username.disabled = false;
        if (password) password.disabled = false;
        if (statusKepegawaian) statusKepegawaian.disabled = false;
    }

    if (posisiVal === "1" || posisiVal === "2" || posisiVal === "3" || posisiVal === "5") { // Staf TU
        if (statusSertifikasi) statusSertifikasi.disabled = false;
    }
    else if (posisi === "4") { // Kebersihan
        if (statusSertifikasi) statusSertifikasi.disabled = false;
    }

    if (posisiVal === "2") { // Guru
        if (guruMapelBtn) guruMapelBtn.disabled = false;
    }

    if (sertifikasiVal === "1") {
        if (tahunSertifikasi) tahunSertifikasi.disabled = false;
    }

}

    // Reset status kepegawaian saat posisi berubah
    function handlePosisiChange() {
        statusKepegawaian.value = "0"; // Reset ke opsi default
        updateFields();
    }

    // Preview gambar
    const imageInput = document.getElementById("foto");
    const imagePreview = document.getElementById("image-preview");
    const imageDeleteButton = document.getElementById("image-delete-button");

    if (imageInput && imagePreview && imageDeleteButton) {
        imageInput.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove("d-none");
                    imageDeleteButton.classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        imageDeleteButton.addEventListener("click", function () {
            imageInput.value = "";
            imagePreview.src = "";
            imagePreview.classList.add("d-none");
            imageDeleteButton.classList.add("d-none");
        });
    }

    // Inisialisasi
    updateFields();
    posisi.addEventListener("change", handlePosisiChange);
    if (statusKepegawaian)
        statusKepegawaian.addEventListener("change", updateFields);
    if (statusSertifikasi)
        statusSertifikasi.addEventListener("change", updateFields);
});