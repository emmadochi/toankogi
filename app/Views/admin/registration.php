<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Tricycle Registration</h1>
    <p class="page-subtitle">Register a new member and generate a unique digital ID.</p>
</div>

<?php flash('reg_msg'); ?>

<div class="content-grid" style="grid-template-columns: 1fr 350px; gap: 2rem;">
    <!-- Registration Form -->
    <div class="card">
        <form action="<?php echo URLROOT; ?>/admin/registration" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 2rem;">
            <!-- Section: Passport Photo -->
            <div class="form-section">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--primary); display: flex; align-items: center; gap: 10px;">
                    <span style="background: var(--primary); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">1</span>
                    Passport Photograph
                </h3>
                <input type="file" name="passport_image" id="passport-input" accept="image/*" style="display: none;">
                <div id="passport-dropzone" style="border: 2px dashed var(--glass-border); border-radius: 15px; padding: 2rem; text-align: center; background: var(--bg-alt); cursor: pointer; transition: 0.3s; position: relative; overflow: hidden;">
                    <div id="passport-preview-container" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;">
                        <img id="passport-preview-img" src="" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(0,0,0,0.5); color: white; font-size: 0.7rem; padding: 5px;">Click to change</div>
                    </div>
                    <div id="passport-placeholder">
                        <div style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.2;">📷</div>
                        <p style="font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Click to upload or take a snapshot</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">Format: JPEG, PNG (Max 2MB)</p>
                    </div>
                </div>
            </div>


            <!-- Section 2: Owner Details -->
            <div class="form-section">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--primary); display: flex; align-items: center; gap: 10px;">
                    <span style="background: var(--primary); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">2</span>
                    Owner Information
                </h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Full Name</label>
                        <input type="text" name="fullname" id="reg-name" placeholder="e.g. Ameh Sunday" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt);" required>
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Phone Number</label>
                        <input type="tel" name="phone" placeholder="e.g. 08012345678" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt);" required>
                    </div>
                </div>
            </div>

            <!-- Section 3: Vehicle & Location -->
            <div class="form-section">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--primary); display: flex; align-items: center; gap: 10px;">
                    <span style="background: var(--primary); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">3</span>
                    Vehicle & Location
                </h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Plate Number</label>
                        <input type="text" name="plate_number" id="reg-plate" placeholder="e.g. LKJ-123-ABC" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt);" required>
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">LGA</label>
                        <select name="lga_id" id="lga-select" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt); font-family: inherit;">
                            <option value="">Select LGA</option>
                            <?php foreach($data['lgas'] as $lga): ?>
                            <option value="<?php echo $lga->id; ?>"><?php echo $lga->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Unit</label>
                        <select name="unit_id" id="unit-select" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt); font-family: inherit;" required>
                            <option value="">Select Unit</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 1rem; padding-top: 1rem; border-top: 1px solid var(--glass-border);">
                <button type="submit" class="btn btn-primary" style="flex: 1; padding: 1rem;">Complete Registration</button>
                <button type="reset" class="btn btn-outline" style="padding: 1rem;">Clear Form</button>
            </div>
        </form>
    </div>

    <!-- Live Preview Card -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card" style="background: var(--dark); color: white; border: none; overflow: hidden; position: relative;">
            <div style="position: absolute; top: 0; right: 0; padding: 1.5rem; opacity: 0.1; font-size: 5rem;">KOGI</div>
            <div class="card-title" style="color: white; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 1rem;">ID Card Preview</div>
            <div style="text-align: center; padding: 1.5rem 0;">
                <div style="width: 100px; height: 100px; background: rgba(255,255,255,0.05); border: 2px solid var(--primary); border-radius: 12px; margin: 0 auto 1.5rem; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 3rem; color: rgba(255,255,255,0.1);">👤</span>
                </div>
                <h3 style="font-size: 1.1rem; margin-bottom: 0.3rem;" id="preview-name">New Member</h3>
                <p style="font-size: 0.75rem; color: var(--accent); font-weight: 700; margin-bottom: 1.5rem;">KOG-LOK-01-XXXXX</p>
                <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 1rem; border-radius: 12px; text-align: left;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.7rem; margin-bottom: 0.4rem;">
                        <span style="opacity: 0.6;">Plate No:</span>
                        <span style="font-weight: 600;" id="preview-plate">PENDING</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const unitsByLga = <?php echo json_encode($data['unitsByLga']); ?>;
    const lgaSelect = document.getElementById('lga-select');
    const unitSelect = document.getElementById('unit-select');

    lgaSelect.addEventListener('change', function() {
        const lgaId = this.value;
        unitSelect.innerHTML = '<option value="">Select Unit</option>';
        
        if (lgaId && unitsByLga[lgaId]) {
            unitsByLga[lgaId].forEach(unit => {
                const option = document.createElement('option');
                option.value = unit.id;
                option.textContent = unit.name;
                unitSelect.appendChild(option);
            });
        }
    });

    // Passport Upload Preview
    const passportInput = document.getElementById('passport-input');
    const passportDropzone = document.getElementById('passport-dropzone');
    const previewContainer = document.getElementById('passport-preview-container');
    const previewImg = document.getElementById('passport-preview-img');
    const cardPreviewImg = document.querySelector('.card .user-avatar img') || document.querySelector('.card span[style*="font-size: 3rem"]');

    passportDropzone.addEventListener('click', () => passportInput.click());

    passportInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewContainer.style.display = 'block';
                previewImg.src = e.target.result;
                
                // Update ID card preview
                const idCardAvatar = document.querySelector('.card[style*="background: var(--dark)"] div[style*="width: 100px"]');
                if (idCardAvatar) {
                    idCardAvatar.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">`;
                    idCardAvatar.style.border = '2px solid var(--accent-primary)';
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Live Preview Logic
    const nameInput = document.getElementById('reg-name');
    const plateInput = document.getElementById('reg-plate');
    const previewName = document.getElementById('preview-name');
    const previewPlate = document.getElementById('preview-plate');

    nameInput.addEventListener('input', (e) => {
        previewName.textContent = e.target.value.toUpperCase() || 'NEW MEMBER';
    });

    plateInput.addEventListener('input', (e) => {
        previewPlate.textContent = e.target.value.toUpperCase() || 'PENDING';
    });

    // Paystack Form Submission interception
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // If we already have the reference, let it submit to the backend
        if (document.querySelector('input[name="paystack_reference"]')) {
            return;
        }

        e.preventDefault();

        // Basic validation
        if(!nameInput.value || !plateInput.value || !unitSelect.value) {
            alert('Please fill out all required fields.');
            return;
        }

        const selectedUnitId = unitSelect.value;
        const lgaId = lgaSelect.value;
        let subaccountCode = '';

        if (lgaId && unitsByLga[lgaId]) {
            const unit = unitsByLga[lgaId].find(u => u.id == selectedUnitId);
            if (unit && unit.subaccount_code) {
                subaccountCode = unit.subaccount_code;
            }
        }

        const email = 'agent@toankogi.org'; 
        const amount = <?php echo $data['registration_fee'] ?? 2000; ?> * 100;

        let handler = PaystackPop.setup({
            key: paystackKey,
            email: email,
            amount: amount,
            currency: 'NGN',
            subaccount: subaccountCode ? subaccountCode : undefined,
            ref: 'REG_' + Math.floor((Math.random() * 1000000000) + 1),
            callback: function(response) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'paystack_reference';
                hiddenInput.value = response.reference;
                form.appendChild(hiddenInput);
                form.submit();
            },
            onClose: function() {
                alert('Payment window closed. Registration not completed.');
            }
        });
        handler.openIframe();
    });
});

</script>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
