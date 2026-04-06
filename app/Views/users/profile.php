<?php require APPROOT . '/Views/inc/users/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">My Profile</h1>
    <p class="page-subtitle">Manage your personal and vehicle details registered with TOAN Kogi.</p>
</div>

<div class="content-grid">
    <!-- Personal Details -->
    <div class="card">
        <div class="card-title">
            <span>Identification Details</span>
            <button class="btn btn-outline" style="font-size: 0.75rem; padding: 0.4rem 0.8rem;" onclick="openModal('editProfileModal')">Edit Profile</button>
        </div>
        <div class="grid-stack" style="gap: 2rem; margin-bottom: 2rem;">
            <?php if(!empty($data['member']->passport_image)): ?>
                <div style="width: 120px; height: 120px; border-radius: 20px; overflow: hidden; margin: 0 auto; border: 3px solid var(--glass-border);">
                    <img src="<?php echo URLROOT . '/' . $data['member']->passport_image; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            <?php else: ?>
                <div style="width: 120px; height: 120px; background: #f1f5f9; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin: 0 auto;">👤</div>
            <?php endif; ?>
            
            <div style="flex: 1; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <label style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Full Name</label>
                    <p style="font-weight: 600;" id="display-name"><?php echo $data['member']->fullname; ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">TOAN ID</label>
                    <p style="font-weight: 600;"><?php echo $data['member']->unique_id; ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Phone Number</label>
                    <p style="font-weight: 600;" id="display-phone"><?php echo $data['member']->phone; ?></p>
                </div>
                <div>
                    <label style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">LGA</label>
                    <p style="font-weight: 600;"><?php echo $data['member']->lga_name; ?></p>
                </div>
            </div>
        </div>
        
        <div style="padding: 1.5rem; background: var(--bg-alt); border-radius: 12px; border-left: 4px solid var(--primary);">
            <h5 style="margin-bottom: 0.5rem;">Member Since</h5>
            <p style="font-size: 0.9rem; color: var(--text-muted);">Registered on <?php echo date('F j, Y', strtotime($data['member']->created_at)); ?> at <?php echo $data['member']->unit_name; ?>.</p>
        </div>
    </div>

    <!-- Security Settings -->
    <div class="card">
        <div class="card-title">Security Settings</div>
        
        <?php flash('member_error'); ?>
        <?php flash('member_success'); ?>

        <form action="<?php echo URLROOT; ?>/users/update_password" method="POST">
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="Minimum 6 characters" required minlength="6">
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Repeat new password" required minlength="6">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Update Password</button>
        </form>
    </div>

    <!-- Vehicle Details -->
    <div class="card">
        <div class="card-title">Registered Vehicle</div>
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div style="display: flex; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                <span style="color: var(--text-muted);">Brand/Model</span>
                <span style="font-weight: 600;">Bajaj RE 4S</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                <span style="color: var(--text-muted);">Plate Number</span>
                <span style="font-weight: 600;">LKD-452-QA</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                <span style="color: var(--text-muted);">Chassis Number</span>
                <span style="font-weight: 600;">BJ4S2024X9876</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                <span style="color: var(--text-muted);">Color</span>
                <span style="font-weight: 600;">Yellow/Green</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="color: var(--text-muted);">Engine Number</span>
                <span style="font-weight: 600;">ENG98765432</span>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Profile</h3>
            <span class="close-modal" onclick="closeModal('editProfileModal')">&times;</span>
        </div>
        <form onsubmit="handleProfileUpdate(event)">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="input-name" class="form-control" value="John Doe" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" id="input-phone" class="form-control" value="0803 456 7890" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="input-email" class="form-control" value="john.doe@example.com" required>
            </div>
            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="button" class="btn btn-outline" style="flex: 1;" onclick="closeModal('editProfileModal')">Cancel</button>
                <button type="submit" class="btn btn-primary" style="flex: 1;">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).style.display = 'flex';
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

function handleProfileUpdate(e) {
    e.preventDefault();
    const saveBtn = e.target.querySelector('button[type="submit"]');
    const originalText = saveBtn.innerText;
    
    saveBtn.innerText = 'Saving...';
    saveBtn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        document.getElementById('display-name').innerText = document.getElementById('input-name').value;
        document.getElementById('display-phone').innerText = document.getElementById('input-phone').value;
        document.getElementById('display-email').innerText = document.getElementById('input-email').value;
        
        saveBtn.innerText = 'Saved!';
        setTimeout(() => {
            closeModal('editProfileModal');
            saveBtn.innerText = originalText;
            saveBtn.disabled = false;
        }, 800);
    }, 1500);
}

function handleSecurityUpdate(e) {
    e.preventDefault();
    const updateBtn = e.target.querySelector('button[type="submit"]');
    const originalText = updateBtn.innerText;
    
    updateBtn.innerText = 'Updating...';
    updateBtn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        updateBtn.innerText = 'Password Updated!';
        updateBtn.style.background = '#059669';
        
        setTimeout(() => {
            updateBtn.innerText = originalText;
            updateBtn.disabled = false;
            updateBtn.style.background = '';
            e.target.reset();
        }, 2000);
    }, 1500);
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.className === 'modal-overlay') {
        event.target.style.display = 'none';
    }
}
</script>

<?php require APPROOT . '/Views/inc/users/footer.php'; ?>
