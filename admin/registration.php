<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Tricycle Registration</h1>
    <p class="page-subtitle">Register a new member and generate a unique digital ID.</p>
</div>

<div class="content-grid" style="grid-template-columns: 1fr 350px; gap: 2rem;">
    <!-- Registration Form -->
    <div class="card">
        <form style="display: flex; flex-direction: column; gap: 2rem;">
            <!-- Section: Passport Photo -->
            <div class="form-section">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--primary); display: flex; align-items: center; gap: 10px;">
                    <span style="background: var(--primary); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">1</span>
                    Passport Photograph
                </h3>
                <div style="border: 2px dashed var(--glass-border); border-radius: 15px; padding: 2rem; text-align: center; background: var(--bg-alt); cursor: pointer; transition: 0.3s;" onmouseover="this.style.borderColor='var(--primary)';" onmouseout="this.style.borderColor='var(--glass-border)';" onclick="alert('Digital Camera System: Please connect an external camera or browse files.')">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.2;">📷</div>
                    <p style="font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Click to upload or take a snapshot</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Format: JPEG, PNG (Max 2MB)</p>
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
                        <input type="text" placeholder="e.g. Ameh Sunday" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt); transition: var(--transition);">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Phone Number</label>
                        <input type="tel" placeholder="e.g. 08012345678" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt);">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Gender</label>
                        <select style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt); font-family: inherit;">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Blood Group</label>
                        <select style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt); font-family: inherit;">
                            <option>O+</option>
                            <option>A+</option>
                            <option>B+</option>
                            <option>AB+</option>
                            <option>O-</option>
                        </select>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Next of Kin (Name & Phone)</label>
                        <input type="text" placeholder="e.g. Mary Sunday - 09088776655" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt);">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Residential Address</label>
                        <textarea rows="2" placeholder="Enter full address" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt); font-family: inherit;"></textarea>
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
                        <input type="text" placeholder="e.g. LKJ-123-ABC" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt);">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Engine Number</label>
                        <input type="text" placeholder="e.g. ENG-456789" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt);">
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">LGA</label>
                        <select style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt); font-family: inherit;">
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
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Unit</label>
                        <select style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); outline: none; background: var(--bg-alt); font-family: inherit;">
                            <option>Central Park 01</option>
                            <option>Market Gate</option>
                            <option>University Road</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 1rem; padding-top: 1rem; border-top: 1px solid var(--glass-border);">
                <button type="button" class="btn btn-primary" style="flex: 1; padding: 1rem;">Complete Registration</button>
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
                <p style="font-size: 0.75rem; color: var(--accent); font-weight: 700; margin-bottom: 1.5rem;">KOG-LOK-01-<?php echo rand(10000, 99999); ?></p>
                <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 1rem; border-radius: 12px; text-align: left;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.7rem; margin-bottom: 0.4rem;">
                        <span style="opacity: 0.6;">Plate No:</span>
                        <span style="font-weight: 600;">PENDING</span>
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

<?php include 'layouts/footer.php'; ?>
