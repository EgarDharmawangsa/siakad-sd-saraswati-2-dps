console.log('siswa.js loaded');

document.addEventListener('DOMContentLoaded', function() {
    initTabNavigation();        
    initConditionalFields();    
    initInputValidation();      
    initPasswordFeatures();     
    initBulkActions();          
    initFormSubmitValidation(); 
});

// navigation
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

// input conditional
function initConditionalFields() {
    const toggleField = (triggerName, targetName, showValue) => {
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

    toggleField('disabilitas', 'keterangan_disabilitas', 'Lainnya');
    toggleField('penerima_kps', 'no_kps', 'Ya');
    toggleField('layak_pip', 'alasan_layak_pip', 'Ya');

    const kipTrigger = document.querySelector('[name="penerima_kip"]');
    if (kipTrigger) {
        const checkKip = () => {
            const display = kipTrigger.value === 'Ya' ? 'block' : 'none';
            const noKip = document.querySelector('[name="no_kip"]');
            const namaKip = document.querySelector('[name="nama_kip"]');
            
            if(noKip) noKip.closest('.col-md-4, .col-md-6').style.display = display;
            if(namaKip) namaKip.closest('.col-md-4, .col-md-6').style.display = display;
        };
        kipTrigger.addEventListener('change', checkKip);
        checkKip();
    }
}

// password feutures
function initPasswordFeatures() {
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.input-group button');

        if (btn && (btn.querySelector('.bi-eye') || btn.querySelector('.bi-eye-slash'))) {
            e.preventDefault(); 
            
            const inputGroup = btn.closest('.input-group');
            const input = inputGroup.querySelector('input');
            const icon = btn.querySelector('i');

            if (input) {
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
        }
    });

    const passInput = document.getElementById('password');
    const confirmInput = document.getElementById('konfirmasi_password');

    if (passInput && confirmInput) {
        const checkMatch = () => {
            const val1 = passInput.value;
            const val2 = confirmInput.value;

            confirmInput.classList.remove('is-invalid', 'is-valid');
            
            if (val2.length > 0) {
                if (val1 === val2) {
                    confirmInput.classList.add('is-valid'); 
                } else {
                    confirmInput.classList.add('is-invalid'); 
                }
            }
        };

        passInput.addEventListener('input', checkMatch); 
        confirmInput.addEventListener('input', checkMatch);
    }
}

// validation type of input and length
function initInputValidation() {
    const rules = {
        'nik': { type: 'numeric', length: 16, label: 'NIK' },
        'no_kk': { type: 'numeric', length: 16, label: 'No. KK' },
        'nisn': { type: 'numeric', length: 10, label: 'NISN' },
        'kode_pos': { type: 'numeric', length: 5, label: 'Kode Pos' },
        'no_telepon_seluler': { type: 'numeric', min: 10, max: 13, label: 'No. HP' },
        'no_telepon_rumah': { type: 'numeric', min: 5, max: 15, label: 'Telp Rumah' },
        'nik_ayah': { type: 'numeric', length: 16, label: 'NIK Ayah' },
        'nik_ibu': { type: 'numeric', length: 16, label: 'NIK Ibu' },
        'nik_wali': { type: 'numeric', length: 16, label: 'NIK Wali' },
        'nipd': { type: 'numeric', length: 20, label: 'NIPD' },
        'berat_badan': { type: 'decimal' },
        'tinggi_badan': { type: 'numeric' },
        'lingkar_kepala': { type: 'numeric' },
        'jumlah_saudara_kandung': { type: 'numeric' },
        'anak_ke_berapa': { type: 'numeric' },
        'tahun_lahir_ayah': { type: 'numeric', length: 4 },
        'tahun_lahir_ibu': { type: 'numeric', length: 4 },
        'tahun_lahir_wali': { type: 'numeric', length: 4 },
    };

    const toggleError = (input, isError, msg = '') => {
        input.classList.remove('is-invalid', 'is-valid');
        let oldMsg = input.parentElement.querySelector('.invalid-feedback.custom-msg');
        if(oldMsg) oldMsg.remove();

        if (isError) {
            input.classList.add('is-invalid');
            if(msg) {
                let div = document.createElement('div');
                div.className = 'invalid-feedback custom-msg';
                div.style.display = 'block';
                div.innerText = msg;
                input.parentElement.appendChild(div);
            }
        } else {
            input.classList.add('is-valid');
        }
    };

    Object.keys(rules).forEach(name => {
        const input = document.querySelector(`[name="${name}"]`);
        const rule = rules[name];

        if (input) {
            input.addEventListener('input', function() {
                if (rule.type === 'numeric') this.value = this.value.replace(/[^0-9]/g, '');
                if (rule.type === 'decimal') this.value = this.value.replace(/[^0-9.]/g, '');
                if (rule.length && this.value.length > rule.length) {
                    this.value = this.value.substring(0, rule.length);
                }
            });

            input.addEventListener('blur', function() {
                if(!this.value) { 
                    this.classList.remove('is-invalid', 'is-valid');
                    return;
                }
                let error = false;
                let msg = '';
                if (rule.length && this.value.length !== rule.length) {
                    error = true;
                    msg = `${rule.label || 'Input'} harus ${rule.length} digit.`;
                }
                if (rule.min && this.value.length < rule.min) {
                    error = true;
                    msg = `${rule.label || 'Input'} minimal ${rule.min} digit.`;
                }
                toggleError(this, error, msg);
            });
        }
    });
}

// copy data from ayah
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
            showToast(count > 0 ? 'Data Ayah berhasil disalin ke form Wali.' : 'Data Ayah masih kosong, tidak ada yang disalin.', 'info');
        });
    }
}

// submit validation
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
                    
                    if(tabBtn) {
                        tabBtn.click();
                    }
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

// toast
window.showToast = function(message, type = 'success') {
    let container = document.getElementById('toast-container-js');
    // if (!container) {
    //     container = document.createElement('div');
    //     container.id = 'toast-container-js';
    //     container.className = 'toast-container position-fixed start-50 translate-middle-x p-3'; 
    //     container.style.top = '30px';
    //     container.style.zIndex = '99999';
    //     document.body.appendChild(container);
    // }

    let bgClass = 'text-bg-success'; 
    let icon = '<i class="bi bi-check-circle-fill me-2"></i>';

    if (type === 'error') {
        bgClass = 'text-bg-danger';
        icon = '<i class="bi bi-exclamation-triangle-fill me-2"></i>';
    }

    const toastEl = document.createElement('div');
    
    toastEl.className = `toast align-items-center w-auto ${bgClass} border-0 show mb-2 shadow-lg`;
    toastEl.style.maxWidth = 'none'; 
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');

    toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body text-white text-nowrap"> 
                ${icon} ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

    container.appendChild(toastEl);

    setTimeout(() => {
        toastEl.classList.remove('show');
        setTimeout(() => {
            if (toastEl.parentNode) toastEl.parentNode.removeChild(toastEl);
        }, 500); 
    }, 4000);
};

const ekstrakurikulerBtn = document.getElementById('id-ekstrakurikuler-dropdown-button');
const ekstrakurikulerCheckboxes = document.querySelectorAll('.id-ekstrakurikuler-checkbox');

if (ekstrakurikulerBtn && ekstrakurikulerCheckboxes.length > 0) {

    const updateButtonText = () => {
        const checkedCount = Array.from(ekstrakurikulerCheckboxes)
            .filter(cb => cb.checked).length;

        ekstrakurikulerBtn.textContent =
            checkedCount > 0 ? `${checkedCount} Dipilih` : '-- Pilih Ekstrakurikuler --';

        if (checkedCount > 0) {
            ekstrakurikulerBtn.classList.add('text-primary', 'fw-bold');
            ekstrakurikulerBtn.classList.remove('is-invalid');
        } else {
            ekstrakurikulerBtn.classList.remove('text-primary', 'fw-bold');
        }
    };

    ekstrakurikulerCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateButtonText);
    });
}
