const kegiatan = document.getElementById('kegiatan') || document.getElementById('kegiatan-filter');
const mata_pelajaran = document.getElementById('mata-pelajaran');
const id_guru_mata_pelajaran = document.getElementById('id-guru-mata-pelajaran') || document.getElementById('guru-filter');

if (kegiatan && id_guru_mata_pelajaran && mata_pelajaran) {
    const id_guru_mata_pelajaran_raw_data = id_guru_mata_pelajaran.dataset.guruMataPelajaran;
    const id_guru_mata_pelajaran_data = JSON.parse(id_guru_mata_pelajaran_raw_data) || [];
    let id_guru_mata_pelajaran_value = id_guru_mata_pelajaran.value;
    let mata_pelajaran_value = mata_pelajaran.value;

    if (id_guru_mata_pelajaran.value) {
        id_guru_mata_pelajaran.disabled = false;
    } else {
        id_guru_mata_pelajaran.disabled = true;
    }

    kegiatan.addEventListener('change', () => {
        if (kegiatan.value === 'Belajar' && id_guru_mata_pelajaran_data.length > 0) {
            id_guru_mata_pelajaran.disabled = false;
            id_guru_mata_pelajaran.value = id_guru_mata_pelajaran_value;
            mata_pelajaran.value = mata_pelajaran_value;
        } else {
            id_guru_mata_pelajaran.disabled = true;
            // id_guru_mata_pelajaran_value = id_guru_mata_pelajaran.value;
            // mata_pelajaran_value = mata_pelajaran.value;
            id_guru_mata_pelajaran.value = '';
            mata_pelajaran.value = '';
        }
    });

    id_guru_mata_pelajaran.addEventListener('change', () => {
        const selected =
            id_guru_mata_pelajaran.options[
                id_guru_mata_pelajaran.selectedIndex
            ];
        if (selected && selected.dataset.mataPelajaran) {
            mata_pelajaran.value = selected.dataset.mataPelajaran;
        }
    });
}
