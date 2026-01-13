console.log('siswa.js loaded');

document.addEventListener('DOMContentLoaded', function() {
    initTabNavigation();
    initClassLogic();        
    initConditionalFields(); 
    initEkstrakurikuler();   
    initInputValidation();
    initPasswordFeatures();
    initBulkActions();
    initFormSubmitValidation();
});

// navigation tabs
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
                window.scrollTo({ top: 0, behavior: 'auto' });
            } 
        });
    });

    const firstError = document.querySelector('.is-invalid');
    if(firstError) {
        const tabPane = firstError.closest('.tab-pane');
        if(tabPane) {
            const tabId = '#' + tabPane.getAttribute('id');
            const tabBtn = document.querySelector(`button[data-bs-target="${tabId}"]`);
            if(tabBtn) tabBtn.click();
        }
        firstError.focus();
        showToast('Terdapat kesalahan pada input form. Silakan periksa kembali.', 'error');
    }
}

// logic kelas dan nomor urut
function initClassLogic() {
    const kelasSelect = document.getElementById('id-kelas');
    const noUrutInput = document.getElementById('nomor-urut');

    function toggleNoUrut() {
        if (!kelasSelect || !noUrutInput) return;

        const isKelasSelected = kelasSelect.value !== "";

        if (isKelasSelected) {
            noUrutInput.removeAttribute('disabled');
            noUrutInput.classList.remove('bg-light');
            noUrutInput.placeholder = "Masukkan nomor urut";
        } else {
            noUrutInput.classList.add('bg-light');
            noUrutInput.value = ''; 
            noUrutInput.placeholder = "Pilih kelas terlebih dahulu...";
        }
    }

    if (kelasSelect) {
        toggleNoUrut();

        kelasSelect.addEventListener('change', function() {
            toggleNoUrut();
            if (this.value !== "") {
                noUrutInput.value = ''; 
                noUrutInput.focus();
            }
        });
    }
}


// conditional fields (KIP & PIP & KPS)
function initConditionalFields() {
    const toggleDisplay = (triggerName, targetName, showValue) => {
        const trigger = document.querySelector(`[name="${triggerName}"]`);
        const target = document.querySelector(`[name="${targetName}"]`);
        
        if (!trigger || !target) return;
        const parentDiv = target.closest('.col-md-6') || target.closest('.col-md-4') || target.closest('.mb-3');

        const checkCondition = () => {
            if (trigger.value === showValue) {
                if(parentDiv) parentDiv.style.display = 'block';
                target.setAttribute('required', 'required');
            } else {
                if(parentDiv) parentDiv.style.display = 'none';
                target.removeAttribute('required');
                target.value = ''; 
            }
        };
        trigger.addEventListener('change', checkCondition);
        checkCondition();
    };

    toggleDisplay('disabilitas', 'keterangan_disabilitas', 'Lainnya');
    toggleDisplay('penerima_kps', 'no_kps', 'Ya');
    toggleDisplay('layak_pip', 'alasan_layak_pip', 'Ya');
    toggleDisplay('penerima_kip', 'no_kip', 'Ya');
    toggleDisplay('penerima_kip', 'nama_kip', 'Ya');
}

// ============================================================
// 4. EKSTRAKURIKULER DYNAMIC ROW (NEW FIX)
// ============================================================
function initEkstrakurikuler() {
    // A. Logic Dropdown Checkbox (Yang sudah ada sebelumnya)
    const ekstrakurikulerBtn = document.getElementById('id-ekstrakurikuler-dropdown-button');
    const ekstrakurikulerCheckboxes = document.querySelectorAll('.id-ekstrakurikuler-checkbox');

    if (ekstrakurikulerBtn && ekstrakurikulerCheckboxes.length > 0) {
        const updateButtonText = () => {
            const checkedCount = Array.from(ekstrakurikulerCheckboxes).filter(cb => cb.checked).length;
            ekstrakurikulerBtn.textContent = checkedCount > 0 ? `${checkedCount} Dipilih` : '-- Pilih Ekstrakurikuler --';
            if (checkedCount > 0) {
                ekstrakurikulerBtn.classList.add('text-primary', 'fw-bold');
                ekstrakurikulerBtn.classList.remove('is-invalid');
            } else {
                ekstrakurikulerBtn.classList.remove('text-primary', 'fw-bold');
            }
        };
        ekstrakurikulerCheckboxes.forEach(cb => cb.addEventListener('change', updateButtonText));
    }

    // B. Logic Tambah Row Manual (Jika menggunakan sistem add row)
    const addEkstraBtn = document.getElementById('add-ekstra');
    const ekstraContainer = document.getElementById('ekstra-container');

    if (addEkstraBtn && ekstraContainer) {
        let ekstraIndex = document.querySelectorAll('.ekstra-item').length;

        addEkstraBtn.addEventListener('click', function() {
            // Template Row
            // FIX: Tombol Hapus menggunakan w-100 dan icon+text agar tidak hilang
            const template = `
                <div class="row g-2 mb-2 ekstra-item align-items-end" id="ekstra-row-${ekstraIndex}">
                    <div class="col-md-5">
                        <label class="form-label small text-muted">Ekstrakurikuler</label>
                        <select class="form-select" name="ekstrakurikuler_dinamis[${ekstraIndex}][id]">
                            <option value="">Pilih...</option>
                            </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label small text-muted">Nilai</label>
                        <input type="text" class="form-control" name="ekstrakurikuler_dinamis[${ekstraIndex}][nilai]" placeholder="Nilai">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger w-100 remove-ekstra" data-id="${ekstraIndex}">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
            ekstraContainer.insertAdjacentHTML('beforeend', template);
            ekstraIndex++;
        });

        // Event Delegation Hapus Row
        ekstraContainer.addEventListener('click', function(e) {
            if (e.target.closest('.remove-ekstra')) {
                const btn = e.target.closest('.remove-ekstra');
                const id = btn.getAttribute('data-id');
                const row = document.getElementById(`ekstra-row-${id}`);
                if(row) row.remove();
            }
        });
    }
}

// password features
function initPasswordFeatures() {
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-toggle-password');
        if (!btn) return;

        e.preventDefault(); 
        
        const inputGroup = btn.closest('.input-group');
        const input = inputGroup.querySelector('input');
        const icon = btn.querySelector('i');

        if (input && icon) {
            if (input.type === "password") {
                input.type = "text"; 
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash'); 
            } else {
                input.type = "password"; 
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye'); 
            }
        }
    });
}

// logic input validation
function initInputValidation() {
    const rules = {
        'nik': { type: 'numeric', length: 16, label: 'NIK' },
        'no_kk': { type: 'numeric', length: 16, label: 'No. KK' },
        'nisn': { type: 'numeric', length: 10, label: 'NISN' },
        'kode_pos': { type: 'numeric', length: 5, label: 'Kode Pos' },
        'no_telepon_seluler': { type: 'numeric', min: 10, max: 13, label: 'No. HP' }, 
        'no_telepon_rumah': { type: 'numeric', min: 10, max: 15,     label: 'Telp Rumah' },
        'nik_ayah': { type: 'numeric', length: 16, label: 'NIK Ayah' },
        'nik_ibu': { type: 'numeric', length: 16, label: 'NIK Ibu' },
        'nik_wali': { type: 'numeric', length: 16, label: 'NIK Wali' },
        'nipd': { type: 'numeric', min:5, max:15, label: 'NIPD' },
        'berat_badan': { type: 'decimal' },
        'tinggi_badan': { type: 'numeric' },
        'lingkar_kepala': { type: 'numeric' },
        'jumlah_saudara_kandung': { type: 'numeric' },
        'anak_ke_berapa': { type: 'numeric' },
        'tahun_lahir_ayah': { type: 'numeric', length: 4 },
        'tahun_lahir_ibu': { type: 'numeric', length: 4 },
        'tahun_lahir_wali': { type: 'numeric', length: 4 },
        'nomor_urut': { type: 'numeric', maxValue: 45, label: 'Nomor Urut' }, 
    };

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

                if (rule.length && input.value.length !== rule.length) {
                    error = true;
                    msg = `${rule.label || 'Input'} harus ${rule.length} digit.`;
                }
                if (rule.min && input.value.length < rule.min) {
                    error = true;
                    msg = `${rule.label || 'Input'} minimal ${rule.min} digit.`;
                }

                input.setCustomValidity(error ? msg : '');
                if (updateUI) toggleError(input, error, msg);
            };

            input.addEventListener('input', function() {
                if (rule.type === 'numeric') this.value = this.value.replace(/[^0-9]/g, '');
                if (rule.type === 'decimal') this.value = this.value.replace(/[^0-9.]/g, '');
                if (rule.length && this.value.length > rule.length) {
                    this.value = this.value.substring(0, rule.length);
                }
                if (rule.maxValue && this.value !== "") {
                    if (parseInt(this.value) > rule.maxValue) {
                        this.value = rule.maxValue; 
                    }
                }
                validate(false); 
            });

            input.addEventListener('blur', function() {
                validate(true); 
            });
        }
    });
}

// copy data wali
function initBulkActions() {
    const tabWali = document.getElementById('form-wali'); 
    if(tabWali && !document.getElementById('btn-copy-ayah')) {
        const btnContainer = document.createElement('div');
        btnContainer.className = 'col-12 mt-3 text-end';
        btnContainer.innerHTML = `<button type="button" class="btn btn-sm btn-outline-info" id="btn-copy-ayah"><i class="bi bi-copy me-1"></i> Salin Data Ayah ke Wali</button>`;
        tabWali.insertBefore(btnContainer, tabWali.firstChild);

        document.getElementById('btn-copy-ayah').addEventListener('click', function() {
            const map = {
                'nama_ayah': 'nama_wali', 'nik_ayah': 'nik_wali', 'tahun_lahir_ayah': 'tahun_lahir_wali',
                'pekerjaan_ayah': 'pekerjaan_wali', 'jenjang_pendidikan_ayah': 'jenjang_pendidikan_wali', 'penghasilan_ayah': 'penghasilan_wali'
            };
            let count = 0;
            for (const [from, to] of Object.entries(map)) {
                const src = document.querySelector(`[name="${from}"]`);
                const dst = document.querySelector(`[name="${to}"]`);
                if(src && dst && src.value) { dst.value = src.value; count++; }
            }
            showToast(count > 0 ? 'Data Ayah berhasil disalin ke form Wali.' : 'Data Ayah masih kosong.', 'info');
        });
    }
}

// logic submit validation
function initFormSubmitValidation() {
    const form = document.getElementById('formSiswa');
    if (!form) return;

    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault(); 
            event.stopPropagation();
            
            const firstInvalid = form.querySelector(':invalid');
            if (firstInvalid) {
                const tabPane = firstInvalid.closest('.tab-pane');
                if (tabPane) {
                    const tabId = '#' + tabPane.getAttribute('id');
                    const tabBtn = document.querySelector(`button[data-bs-target="${tabId}"]`);
                    if(tabBtn) tabBtn.click();
                }
                setTimeout(() => {
                    firstInvalid.focus();
                    showToast('Data belum lengkap! Periksa kolom berwarna merah.', 'error');
                }, 200);
            }
            form.classList.add('was-validated'); 
        }
    });
}