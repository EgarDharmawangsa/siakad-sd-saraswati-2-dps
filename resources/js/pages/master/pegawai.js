document.addEventListener("DOMContentLoaded", function () {

    // defintion
    const els = {
        form: document.getElementById('form-pegawai'),
        submitBtn: document.querySelector('button[type="submit"]'),
        posisi: document.getElementById('posisi'),
        nama: document.getElementById('nama-pegawai'),
        nik: document.getElementById('nik'),

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
        const checkedBoxes = Array.from(els.mapelCheckboxes).filter(i => i.checked);
        const checkedCount = checkedBoxes.length;
        
        if (checkedCount > 0) {
            const names = checkedBoxes.map(cb => {
                return cb.dataset.nama || cb.parentElement.textContent.trim();
            });
            els.mapelBtn.textContent = names.join(', ');
            els.mapelBtn.classList.add('text-primary', 'fw-bold');
            els.mapelBtn.classList.remove('is-invalid');
        } else {
            els.mapelBtn.textContent = '-- Pilih Mata Pelajaran --';
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

        // --- Logic Readonly untuk Non-TU ---
        const isTu = els.form.dataset.isTu === undefined || els.form.dataset.isTu === 'true';
        if (!isTu) {
            if(els.nama) els.nama.readOnly = true;
            if(els.nik) els.nik.readOnly = true;
            if(els.nip) els.nip.readOnly = true;
            if(els.nipppk) els.nipppk.readOnly = true;
            if(els.statusKepegawaian) els.statusKepegawaian.readOnly = true;
            if(els.jabatan) els.jabatan.readOnly = true;
            if(els.mapelBtn) els.mapelBtn.readOnly = true;
            if(els.username) els.username.readOnly = true;
            if(els.password) els.password.readOnly = true;
            if(els.noSk) els.noSk.readOnly = true;
            if(els.tglSk) els.tglSk.readOnly = true;
            if(els.thnSertifikasi) els.thnSertifikasi.readOnly = true;
            if(els.mapelBtn) els.mapelBtn.readOnly = true;
            if(els.statusSertifikasi) els.statusSertifikasi.readOnly = true;
            if(els.statusKepegawaian) els.statusKepegawaian.readOnly = true;
            if(els.jabatan) els.jabatan.readOnly = true;
            if(els.nip) els.nip.readOnly = true;
            if(els.nipppk) els.nipppk.readOnly = true;
            if(els.posisi) els.posisi.readOnly = true;
            if(els.username) els.username.readOnly = true;
            if(els.password) els.password.readOnly = true;
            if(els.ijazah) els.ijazah.readOnly = true;
            if(els.thnIjazah) els.thnIjazah.readOnly = true;

            const lockSelect = (el) => {
                if(el) {
                    el.style.pointerEvents = 'none';
                    el.style.backgroundColor = '#e9ecef';
                    el.tabIndex = -1;
                    el.setAttribute('aria-readonly', 'true');
                    el.addEventListener('mousedown', e => e.preventDefault());
                }
            };

            lockSelect(els.nama);
            lockSelect(els.nik);
            lockSelect(els.nip);
            lockSelect(els.nipppk);
            lockSelect(els.posisi);
            lockSelect(els.statusKepegawaian);
            lockSelect(els.jabatan);
            lockSelect(els.mapelBtn);
            lockSelect(els.statusSertifikasi);
            lockSelect(els.username);
            lockSelect(els.password);
            lockSelect(els.noSk);
            lockSelect(els.tglSk);
            lockSelect(els.thnSertifikasi);
            lockSelect(els.ijazah);
            lockSelect(els.thnIjazah);
            lockSelect(els.tglKerja);
            lockSelect(els.tglKerjaRasda)
        }

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
    initInputValidation();
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
            const hiddenInputCount = form.querySelectorAll('input[type="hidden"][name="id_mata_pelajaran[]"]').length;
            const totalMapel = checkedCount + hiddenInputCount;
            
            if (totalMapel === 0) {
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

// logic input validation
function initInputValidation() {
    const rules = {
        'nik': { type: 'numeric', length: 16, label: 'NIK' },
        'nip': { type: 'numeric', length: 18 , label: 'NIP' }, 
        'nipppk': { type: 'numeric', length: 18, label: 'NIPPPK' },
        'no_telepon_seluler': { type: 'numeric', min: 10, max: 15, label: 'No. HP' },
        'no_telepon_rumah': { type: 'numeric', min: 10, max: 15, label: 'Telp Rumah' },
        'tahun_ijazah': { type: 'numeric', length: 4, label: 'Tahun Ijazah' },
        'tahun_sertifikasi': { type: 'numeric', length: 4, label: 'Tahun Sertifikasi' },
        'e_mail': { type: 'email', label: 'E-Mail' },
    };

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    const toggleError = (input, isError, msg = '') => {
        input.classList.remove('is-invalid', 'is-valid');
        let oldMsg = input.parentElement.querySelector('.invalid-feedback.custom-msg');
        if(oldMsg) oldMsg.remove();

        if (isError) {
            input.classList.add('is-invalid');
            input.setCustomValidity(msg); 
            if(msg) {
                let div = document.createElement('div');
                div.className = 'invalid-feedback custom-msg';
                div.style.display = 'block';
                div.innerText = msg;
                input.parentElement.appendChild(div);
            }
        } else {
            input.classList.add('is-valid');
            input.setCustomValidity(''); 
        }
    };

    Object.keys(rules).forEach(name => {
        const input = document.querySelector(`[name="${name}"]`);
        const rule = rules[name];

        if (input) {
            const validate = (updateUI = false) => {
                if(!input.value) { 
                    if(updateUI) input.classList.remove('is-invalid', 'is-valid');
                    input.setCustomValidity('');
                    return;
                }
                let error = false;
                let msg = '';

                if (rule.type === 'email' && !emailRegex.test(input.value)) {
                    error = true;
                    msg = `Format ${rule.label || 'Email'} tidak valid.`;
                }
                if (rule.length && input.value.length !== rule.length) {
                    error = true;
                    msg = `${rule.label || 'Input'} harus ${rule.length} digit.`;
                }
                if (rule.min && input.value.length < rule.min) {
                    error = true;
                    msg = `${rule.label || 'Input'} minimal ${rule.min} digit.`;
                }
                if (rule.max && input.value.length > rule.max) {
                    error = true;
                    msg = `${rule.label || 'Input'} maksimal ${rule.max} digit.`;
                }

                input.setCustomValidity(error ? msg : '');
                if (updateUI) toggleError(input, error, msg);
            };

            input.addEventListener('input', function() {
                if (rule.type === 'numeric') this.value = this.value.replace(/[^0-9]/g, '');
                
                if (rule.length && this.value.length > rule.length) {
                    this.value = this.value.substring(0, rule.length);
                }
                if (rule.max && this.value.length > rule.max) {
                    this.value = this.value.substring(0, rule.max);
                }
                validate(false); 
            });

            input.addEventListener('blur', function() {
                validate(true); 
            });
        }
    });
}