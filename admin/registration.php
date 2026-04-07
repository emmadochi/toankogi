<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Tricycle Registration</h1>
    <p class="page-subtitle">Register a new member and generate a unique digital ID.</p>
</div>

<div class="content-grid">
    <!-- Registration Form -->
    <div class="card">
        <form style="display: flex; flex-direction: column; gap: 2.5rem;">
            <!-- Section: Passport Photo -->
            <div class="form-section">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--primary); display: flex; align-items: center; gap: 10px;">
                    <span style="background: var(--primary); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">1</span>
                    Passport Photograph
                </h3>
                <div style="border: 2px dashed var(--glass-border); border-radius: 15px; padding: 2.5rem; text-align: center; background: var(--bg-alt); cursor: pointer; transition: 0.3s;" onclick="alert('Digital Camera System: Please connect an external camera or browse files.')">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.3;">📷</div>
                    <p style="font-size: 0.9rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--dark);">Click to upload or take a snapshot</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Recommended: 500x500px (Max 2MB)</p>
                </div>
            </div>

            <!-- Section 2: Owner Details -->
            <div class="form-section">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--primary); display: flex; align-items: center; gap: 10px;">
                    <span style="background: var(--primary); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">2</span>
                    Owner Information
                </h3>
                <div class="admin-grid">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" id="reg-name" placeholder="Ameh Sunday" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" placeholder="08012345678" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gender</label>
                        <select class="form-input">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Blood Group</label>
                        <select class="form-input">
                            <option>O+</option>
                            <option>A+</option>
                            <option>B+</option>
                            <option>AB+</option>
                            <option>O-</option>
                        </select>
                    </div>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label">Next of Kin (Name & Phone)</label>
                        <input type="text" placeholder="Mary Sunday - 09088776655" class="form-input">
                    </div>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label">Residential Address</label>
                        <textarea rows="2" placeholder="Enter full address" class="form-input" style="height: auto;"></textarea>
                    </div>
                </div>
            </div>

            <!-- Section 3: Vehicle & Location -->
            <div class="form-section">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--primary); display: flex; align-items: center; gap: 10px;">
                    <span style="background: var(--primary); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">3</span>
                    Vehicle & Location
                </h3>
                <div class="admin-grid">
                    <div class="form-group">
                        <label class="form-label">Plate Number</label>
                        <input type="text" id="reg-plate" placeholder="LKJ-123-ABC" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Engine Number</label>
                        <input type="text" placeholder="ENG-456789" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">LGA</label>
                        <select class="form-input">
                            <option>Lokoja</option>
                            <option>Okene</option>
                            <option>Dekina</option>
                            <option>Idah</option>
                            <option>Kabba/Bunu</option>
                            <option>Adavi</option>
                            <option>Ajaokuta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Unit</label>
                        <select class="form-input">
                            <option>Central Park 01</option>
                            <option>Market Gate</option>
                            <option>University Road</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 1rem; padding-top: 1.5rem; border-top: 1px solid var(--glass-border); flex-wrap: wrap;">
                <button type="button" id="complete-reg-btn" class="btn btn-primary" style="flex: 2; padding: 1rem; min-width: 200px;">Complete Registration</button>
                <button type="reset" class="btn btn-outline" style="flex: 1; padding: 1rem; min-width: 150px;">Clear Form</button>
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
                <p style="font-size: 0.75rem; color: var(--accent); font-weight: 700; margin-bottom: 1.5rem;">KOG-LOK-01-<?php echo rand(10000, 99999); ?></p>
                <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 1rem; border-radius: 12px; text-align: left;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.7rem; margin-bottom: 0.4rem;">
                        <span style="opacity: 0.6;">Plate No:</span>
                        <span style="font-weight: 600;" id="preview-plate">PENDING</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.7rem; margin-bottom: 0.4rem;">
                        <span style="opacity: 0.6;">Unit:</span>
                        <span style="font-weight: 600;">- Unassigned -</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.7rem;">
                        <span style="opacity: 0.6;">Blood GP:</span>
                        <span style="font-weight: 600;">O+</span>
                    </div>
                </div>
            </div>
            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding: 1rem; margin-top: 1rem; font-size: 0.7rem; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <span style="opacity: 0.6; display: block; font-size: 0.6rem;">EXPIRES</span>
                    <span style="color: var(--accent);">25/03/2027</span>
                </div>
                <div style="width: 40px; height: 40px; background: white; padding: 4px; border-radius: 4px;">
                    <!-- Dummy QR Code -->
                    <div style="width: 100%; height: 100%; background: linear-gradient(45deg, #000 25%, transparent 25%, transparent 50%, #000 50%, #000 75%, transparent 75%, transparent); background-size: 10px 10px; opacity: 0.8;"></div>
                </div>
            </div>
        </div>

        <!-- Documentation Note -->
        <div class="card" style="background: var(--primary-light); border-color: rgba(5, 150, 105, 0.2);">
            <h4 style="color: var(--primary); margin-bottom: 0.5rem; font-size: 0.9rem;">Information</h4>
            <p style="font-size: 0.85rem; color: var(--primary-dark); line-height: 1.5;">
                Upon completion, an SMS will reach the owner and the Unique ID will be immediately valid for verification by field agents.
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('reg-name');
    const plateInput = document.getElementById('reg-plate');
    const previewName = document.getElementById('preview-name');
    const previewPlate = document.getElementById('preview-plate');
    const completeBtn = document.getElementById('complete-reg-btn');

    // Live Preview Logic
    nameInput.addEventListener('input', (e) => {
        previewName.textContent = e.target.value || 'New Member';
    });

    plateInput.addEventListener('input', (e) => {
        if (previewPlate) previewPlate.textContent = e.target.value.toUpperCase() || 'PENDING';
    });

    // Handle Completion
    completeBtn.addEventListener('click', function() {
        const name = nameInput.value || 'New Member';
        const plate = plateInput.value || 'PENDING';
        
        if (!nameInput.value || !plateInput.value) {
            alert('Please fill in the Member Name and Plate Number.');
            return;
        }

        // Show a brief loading state
        this.innerHTML = 'Processing...';
        this.disabled = true;

        setTimeout(() => {
            // Redirect to success page with data
            window.location.href = `registration_success.php?name=${encodeURIComponent(name)}&plate=${encodeURIComponent(plate)}`;
        }, 1500);
    });
});
</script>

<?php include 'layouts/footer.php'; ?>
