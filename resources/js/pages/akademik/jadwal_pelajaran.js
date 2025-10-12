const id_kelas = document.getElementById('id-kelas');
const mata_pelajaran = document.getElementById('mata-pelajaran');
const id_guru_mata_pelajaran = document.getElementById('id-guru-mata-pelajaran');
const kegiatan_belajar_radio = document.getElementById('kegiatan-belajar-radio');
const kegiatan_istirahat_radio = document.getElementById('kegiatan-istirahat-radio');

if (kegiatan_belajar_radio && kegiatan_istirahat_radio && id_guru_mata_pelajaran) {
    let guru_mata_pelajaran_value = id_guru_mata_pelajaran.value;
    let mata_pelajaran_value = mata_pelajaran.value;

    if (!kegiatan_belajar_radio.checked) {
        id_guru_mata_pelajaran.disabled = true;
    }

    kegiatan_belajar_radio.addEventListener('click', () => {
        id_guru_mata_pelajaran.value = guru_mata_pelajaran_value;
        mata_pelajaran.value = mata_pelajaran_value;

        kegiatan_belajar_radio.classList.add('active');
        kegiatan_istirahat_radio.classList.remove('active');

        id_guru_mata_pelajaran.disabled = false;
    });

    kegiatan_istirahat_radio.addEventListener('click', () => {
        guru_mata_pelajaran_value = id_guru_mata_pelajaran.value;
        mata_pelajaran_value = mata_pelajaran.value;
        id_guru_mata_pelajaran.value = 0;
        mata_pelajaran.value = '';

        kegiatan_istirahat_radio.classList.add('active');
        kegiatan_belajar_radio.classList.remove('active');

        id_guru_mata_pelajaran.disabled = true;
    });

    id_guru_mata_pelajaran.addEventListener('change', () => {
        const selected_id_guru_mata_pelajaran = id_guru_mata_pelajaran.options[id_guru_mata_pelajaran.selectedIndex];
        const selected_mata_pelajaran = selected_id_guru_mata_pelajaran.dataset.bsMataPelajaran;
        mata_pelajaran.value = selected_mata_pelajaran;
    });
}
