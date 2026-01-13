console.log('pegawai.js loaded');

document.addEventListener("DOMContentLoaded", function () {

    // defintion
    const els = {
        form: document.getElementById('form-pegawai'),
        submitBtn: document.querySelector('button[type="submit"]'),
        posisi: document.getElementById('posisi'),

        // Scoped Data
        statusKepegawaian: document.getElementById('status-kepegawaian'),
        jabatan: document.getElementById('jabatan'),
        nip: document.getElementById('nip'),
        nipppk: document.getElementById('nipppk'),
        tglKerja: document.getElementById('permulaan-kerja'),
        tglKerjaRasda: document.getElementById('permulaan-kerja-sds2'),
        
        mapelBtn: document.getElementById('id-mata-pelajaran-dropdown-button'),
        mapelCheckboxes: document.querySelectorAll('.id-mata-pelajaran-checkbox'),
        
        ijazah: document.getElementById('ijazah-terakhir'),
        thnIjazah: document.getElementById('tahun-ijazah'),
        statusSertifikasi: document.getElementById('status-sertifikasi'),
        thnSertifikasi: document.getElementById('tahun-sertifikasi'),

        noSk: document.getElementById('no-sk'),
        tglSk: document.getElementById('tanggal-sk-terakhir'),

        username: document.getElementById('username'),
        password: document.getElementById('password'),
    };

    let lastPosisi = els.posisi ? els.posisi.value : '';
    const initialPosisi = els.posisi ? els.posisi.value : '';
    const isEditMode = window.location.pathname.endsWith('/edit');
    
    const rolesWithLogin = ['Staf Tata Usaha', 'Guru', 'Pegawai Perpustakaan', 'Satuan Pengamanan'];
    const rolesWithSertifikasi = ['Staf Tata Usaha', 'Guru', 'Pegawai Perpustakaan', 'Satuan Pengamanan', 'Pegawai Kebersihan'];

    // manage state
    const formDataCache = {}; 

    function saveScopedData(posisiName) {
        if (!posisiName) return;
        const selectedMapel = [];
        els.mapelCheckboxes.forEach(cb => { if (cb.checked) selectedMapel.push(cb.value); });

        formDataCache[posisiName] = {
            statusKepegawaian: els.statusKepegawaian ? els.statusKepegawaian.value : '',
            jabatan: els.jabatan ? els.jabatan.value : '',
            nip: els.nip ? els.nip.value : '',
            nipppk: els.nipppk ? els.nipppk.value : '',
            tglKerja: els.tglKerja ? els.tglKerja.value : '',
            tglKerjaRasda: els.tglKerjaRasda ? els.tglKerjaRasda.value : '',
            ijazah: els.ijazah ? els.ijazah.value : '',
            thnIjazah: els.thnIjazah ? els.thnIjazah.value : '',
            statusSertifikasi: els.statusSertifikasi ? els.statusSertifikasi.value : '',
            thnSertifikasi: els.thnSertifikasi ? els.thnSertifikasi.value : '',
            noSk: els.noSk ? els.noSk.value : '',
            tglSk: els.tglSk ? els.tglSk.value : '',
            username: els.username ? els.username.value : '',
            password: els.password ? els.password.value : '',
            mapel: selectedMapel
        };
    }

    function restoreScopedData(posisiName) {
        const data = formDataCache[posisiName];
        if (data) {
            if(els.statusKepegawaian) els.statusKepegawaian.value = data.statusKepegawaian;
            if(els.jabatan) els.jabatan.value = data.jabatan;
            if(els.nip) els.nip.value = data.nip;
            if(els.nipppk) els.nipppk.value = data.nipppk;
            if(els.tglKerja) els.tglKerja.value = data.tglKerja;
            if(els.tglKerjaRasda) els.tglKerjaRasda.value = data.tglKerjaRasda;
            if(els.ijazah) els.ijazah.value = data.ijazah;
            if(els.thnIjazah) els.thnIjazah.value = data.thnIjazah;
            if(els.statusSertifikasi) els.statusSertifikasi.value = data.statusSertifikasi;
            if(els.thnSertifikasi) els.thnSertifikasi.value = data.thnSertifikasi;
            if(els.noSk) els.noSk.value = data.noSk;
            if(els.tglSk) els.tglSk.value = data.tglSk;
            if(els.username) els.username.value = data.username;
            if(els.password) els.password.value = data.password;
            els.mapelCheckboxes.forEach(cb => { cb.checked = data.mapel.includes(cb.value); });
        }
    }

    function clearScopedData() {
        const fields = [
            els.statusKepegawaian, els.jabatan, els.nip, els.nipppk, els.tglKerja, els.tglKerjaRasda,
            els.ijazah, els.thnIjazah, els.statusSertifikasi, els.thnSertifikasi,
            els.noSk, els.tglSk, els.username, els.password
        ];
        fields.forEach(f => { if(f) f.value = ''; });
        els.mapelCheckboxes.forEach(cb => cb.checked = false);
    }

    // logic posisi
    function updateMapelLabel() {
        if (!els.mapelBtn) return;
        const checkedCount = Array.from(els.mapelCheckboxes).filter(i => i.checked).length;
        els.mapelBtn.textContent = checkedCount > 0 ? `${checkedCount} Dipilih` : '-- Pilih Mata Pelajaran --';
        
        if(checkedCount > 0) {
            els.mapelBtn.classList.add('text-primary', 'fw-bold');
            els.mapelBtn.classList.remove('is-invalid');
        } else {
            els.mapelBtn.classList.remove('text-primary', 'fw-bold');
        }
    }

    function updateFieldsState() {
        if (!els.posisi) return;
        const currentPosisi = els.posisi.value;
        const statusPegVal = els.statusKepegawaian ? els.statusKepegawaian.value : '';
        const statusSerVal = els.statusSertifikasi ? els.statusSertifikasi.value : '';

        // Reset
        const scopedFields = [
            els.nip, els.nipppk, els.statusKepegawaian, els.jabatan, 
            els.mapelBtn, els.username, els.password, 
            els.noSk, els.tglSk, els.thnSertifikasi
        ];
        scopedFields.forEach(el => { if(el) el.disabled = true; });

        toggleVisibility(els.nip, false); 
        toggleVisibility(els.nipppk, false);
        toggleVisibility(els.jabatan, false);

        if (rolesWithLogin.includes(currentPosisi)) {
            if(els.username) els.username.disabled = false;
            if(els.password) {
                els.password.disabled = false;
                if (isEditMode && rolesWithLogin.includes(initialPosisi) && currentPosisi === initialPosisi) {
                     els.password.removeAttribute('required');
                } else {
                     els.password.setAttribute('required', true);
                }
            }
            if(els.statusKepegawaian) els.statusKepegawaian.disabled = false;
        } else {
             if(els.password) els.password.removeAttribute('required');
        }

        // if (rolesWithSertifikasi.includes(currentPosisi)) {
        //     if(els.statusSertifikasi) els.statusSertifikasi.disabled = false;
        // }

        if (currentPosisi === 'Guru') {
            if(els.mapelBtn) els.mapelBtn.disabled = false;
        }

        if (statusPegVal === 'PNS') {
            if(els.nip) { els.nip.disabled = false; toggleVisibility(els.nip, true); }
            if(els.jabatan) { els.jabatan.disabled = false; toggleVisibility(els.jabatan, true); }
            enableSKFields(true);
        } else if (statusPegVal === 'PPPK') {
            if(els.nipppk) { els.nipppk.disabled = false; toggleVisibility(els.nipppk, true); }
            if(els.jabatan) { els.jabatan.disabled = false; toggleVisibility(els.jabatan, true); }
            enableSKFields(true);
        } else {
            toggleVisibility(els.nip, true);
            toggleVisibility(els.jabatan, true);
            enableSKFields(false);
        }

        if (!els.statusSertifikasi.disabled && statusSerVal === 'Sudah') {
            if(els.thnSertifikasi) els.thnSertifikasi.disabled = false;
        }
        
        updateMapelLabel();
    }

    function enableSKFields(enable) {
        if(els.noSk) els.noSk.disabled = !enable;
        if(els.tglSk) els.tglSk.disabled = !enable;
    }

    function toggleVisibility(element, show) {
        if (!element) return;
        const wrapper = element.closest('.col-md-6'); 
        if (wrapper) wrapper.style.display = show ? 'block' : 'none';
    }

    // event listener
    if (els.mapelCheckboxes.length > 0) {
        els.mapelCheckboxes.forEach(cb => cb.addEventListener('change', updateMapelLabel));
    }

    if (els.posisi) {
        saveScopedData(lastPosisi);
        updateFieldsState();

        els.posisi.addEventListener('change', function() {
            const newPosisi = this.value;
            saveScopedData(lastPosisi);
            if (formDataCache[newPosisi]) restoreScopedData(newPosisi);
            else clearScopedData();
            lastPosisi = newPosisi;
            updateFieldsState();
        });
    }

    if (els.statusKepegawaian) els.statusKepegawaian.addEventListener('change', updateFieldsState);
    if (els.statusSertifikasi) els.statusSertifikasi.addEventListener('change', updateFieldsState);
    
    setupGlobalHelpers();
    
    initTabNavigation();
    
    initFormSubmitValidation(els);
});

// helper functions
function initTabNavigation() {
    const navButtons = document.querySelectorAll('.btn-nav');
    navButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetContentId = this.getAttribute('data-next');
            if (!targetContentId) return;

            const tabTrigger = document.querySelector(`button[data-bs-target="${targetContentId}"]`);
            if (tabTrigger) {
                tabTrigger.click(); 
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } 
        });
    });
}

function initFormSubmitValidation(els) {
    const form = els.form;
    if (!form) return;

    form.addEventListener('submit', function(event) {
        
        let isCustomValid = true;
        if (els.posisi && els.posisi.value === 'Guru') {
            const checkedCount = Array.from(els.mapelCheckboxes).filter(i => i.checked).length;
            if (checkedCount === 0) {
                isCustomValid = false;
                if(els.mapelBtn) els.mapelBtn.classList.add('is-invalid');
                if (window.showToast) window.showToast('Guru wajib memilih minimal satu Mata Pelajaran!', 'error');
            } else {
                if(els.mapelBtn) els.mapelBtn.classList.remove('is-invalid');
            }
        }

        if (!form.checkValidity() || !isCustomValid) {
            event.preventDefault(); 
            event.stopPropagation();
            
            let firstInvalid = form.querySelector(':invalid');
            
            if (!firstInvalid && !isCustomValid) {
                firstInvalid = els.mapelBtn;
            }
            
            if (firstInvalid) {
                const tabPane = firstInvalid.closest('.tab-pane');
                
                if (tabPane) {
                    const tabId = '#' + tabPane.getAttribute('id');
                    const tabBtn = document.querySelector(`button[data-bs-target="${tabId}"]`);
                    
                    if(tabBtn) {
                        tabBtn.click(); 
                    }
                }
                
                setTimeout(() => {
                    firstInvalid.focus();
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    if(window.showToast) window.showToast('Data belum lengkap! Periksa kolom berwarna merah.', 'error');
                }, 200);
            }
            
            form.classList.add('was-validated'); 
        } else {
            if (els.submitBtn) {
                els.submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
                els.submitBtn.disabled = true;
            }
        }
    });
    
    const firstError = document.querySelector('.is-invalid');
    if(firstError) {
        const tabPane = firstError.closest('.tab-pane');
        if(tabPane) {
            const tabId = '#' + tabPane.getAttribute('id');
            const tabBtn = document.querySelector(`button[data-bs-target="${tabId}"]`);
            if(tabBtn) tabBtn.click();
        }
        setTimeout(() => firstError.focus(), 300);
        if(window.showToast) window.showToast('Terdapat kesalahan input. Silakan periksa kembali.', 'error');
    }
}

function setupGlobalHelpers() {
    const imgInp = document.getElementById('foto');
    const imgPrev = document.getElementById('image-preview');
    const imgDel = document.getElementById('image-delete-button');
    if(imgInp) {
        imgInp.addEventListener('change', function() {
            const [file] = this.files;
            if (file) {
                imgPrev.src = URL.createObjectURL(file);
                imgPrev.classList.remove('d-none');
                imgDel.classList.remove('d-none');
            }
        });
        if(imgDel) imgDel.onclick = () => {
            imgInp.value = ''; imgPrev.src = ''; 
            imgPrev.classList.add('d-none'); imgDel.classList.add('d-none');
        }
    }
    

}