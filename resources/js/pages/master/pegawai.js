const guru_mata_pelajaran_items = document.querySelectorAll('.guru-mata-pelajaran-item');
const guru_mata_pelajaran_dropdown_button = document.getElementById('guru-mata-pelajaran-dropdown-button');


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

