<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<?php 
$current_lga_name = 'Kogi State';
foreach($data['lgas'] as $lga) {
    if($lga->id == $data['current_lga_id']) {
        $current_lga_name = $lga->name;
        break;
    }
}
?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 0.5rem;">
                <a href="<?php echo URLROOT; ?>/admin/lgas" style="text-decoration: none; color: var(--text-muted); font-size: 0.9rem;">📍 LGAs</a>
                <span style="color: var(--text-muted); font-size: 0.8rem;">/</span>
                <span style="font-weight: 700; color: var(--primary);"><?php echo htmlspecialchars($current_lga_name); ?> Units</span>
            </div>
            <h1 class="page-title">Management for <?php echo htmlspecialchars($current_lga_name); ?></h1>
            <p class="page-subtitle">Configure collection units and assign agents for this division.</p>
        </div>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <?php if($_SESSION['user_role'] === 'superadmin'): ?>
            <div style="background: white; padding: 0.5rem 1rem; border-radius: 12px; border: 1px solid var(--glass-border); display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 0.8rem; font-weight: 700; color: var(--text-muted);">SWITCH LGA:</span>
                <select onchange="window.location.href='<?php echo URLROOT; ?>/admin/units?lga_id='+this.value" style="border: none; font-family: inherit; font-weight: 700; outline: none; background: transparent; cursor: pointer;">
                    <?php foreach($data['lgas'] as $lga): ?>
                    <option value="<?php echo $lga->id; ?>" <?php echo ($lga->id == $data['current_lga_id']) ? 'selected' : ''; ?>><?php echo $lga->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>
            <button class="btn btn-primary" onclick="openModal('addUnitModal')">+ Add New Unit</button>
        </div>
    </div>
</div>

<?php flash('unit_msg'); ?>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Unit Name</th>
                    <th>Unit Code</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['units'] as $unit): ?>
                <tr>
                    <td style="font-weight: 600;"><?php echo $unit->name; ?></td>
                    <td style="font-family: monospace; font-weight: 600; color: var(--text-muted);"><?php echo $unit->code; ?></td>
                    <td><span class="status-check paid">Active</span></td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;" 
                                    onclick='editUnit(<?php echo json_encode($unit); ?>)'>✏️ Edit</button>
                            <form action="<?php echo URLROOT; ?>/admin/units" method="POST" 
                                  data-confirm="This will permanently remove this collection unit. Associated data may be affected." 
                                  data-confirm-title="Delete Unit?"
                                  style="display:inline;">
                                <input type="hidden" name="action" value="delete_unit">
                                <input type="hidden" name="id" value="<?php echo $unit->id; ?>">
                                <input type="hidden" name="lga_id" value="<?php echo $unit->lga_id; ?>">
                                <button type="submit" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem; color: var(--danger); border-color: var(--danger);">🗑️ Delete</button>
                            </form>

                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<!-- Add Unit Modal -->
<div id="addUnitModal" class="modal-overlay">
    <div class="card" style="width: 500px; padding: 2.5rem; position: relative; animation: slideUp 0.4s ease;">
        <button onclick="closeModal('addUnitModal')" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted);">×</button>
        <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Add New Collection Unit</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem; font-size: 0.9rem;">Register a new revenue collection point in **<?php echo htmlspecialchars($current_lga_name); ?>**.</p>
        
        <form action="<?php echo URLROOT; ?>/admin/units" method="POST">
            <input type="hidden" name="action" value="add_unit">
            <input type="hidden" name="lga_id" value="<?php echo $data['current_lga_id']; ?>">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Unit Name</label>
                <input type="text" name="name" placeholder="e.g. Market Square Unit" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Unit Short Code</label>
                <input type="text" name="code" placeholder="e.g. MKT" maxlength="3" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600; text-transform: uppercase;" required>
            </div>
            <div style="margin-bottom: 1.5rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid var(--glass-border);">
                <p style="font-size: 0.8rem; font-weight: 700; color: #0f172a; margin-bottom: 1rem;">🏦 Paystack Split Payment Setup</p>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-size: 0.7rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Bank</label>
                    <select name="bank_code" style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit;">
                        <option value="">Select Bank (Optional)</option>
                        <option value="044">Access Bank</option>
                        <option value="058">Guaranty Trust Bank</option>
                        <option value="033">United Bank for Africa</option>
                        <option value="057">Zenith Bank</option>
                        <option value="011">First Bank of Nigeria</option>
                        <option value="214">First City Monument Bank</option>
                        <option value="050">Ecobank Nigeria</option>
                        <option value="032">Union Bank of Nigeria</option>
                        <option value="215">Unity Bank</option>
                        <option value="035">Wema Bank</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.7rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Account Number</label>
                    <input type="text" name="account_number" placeholder="10 Digit Account Number" maxlength="10" style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 700; border-radius: 12px;">Complete Unit Setup</button>
        </form>
    </div>
</div>

<!-- Edit Unit Modal -->
<div id="editUnitModal" class="modal-overlay">
    <div class="card" style="width: 500px; padding: 2.5rem; position: relative; animation: slideUp 0.4s ease;">
        <button onclick="closeModal('editUnitModal')" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted);">×</button>
        <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Edit Collection Unit</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem; font-size: 0.9rem;">Update naming or code for this revenue collection point.</p>
        
        <form action="<?php echo URLROOT; ?>/admin/units" method="POST">
            <input type="hidden" name="action" value="edit_unit">
            <input type="hidden" id="edit_unit_id" name="id" value="">
            <input type="hidden" name="lga_id" value="<?php echo $data['current_lga_id']; ?>">
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Unit Name</label>
                <input type="text" id="edit_unit_name" name="name" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Unit Short Code</label>
                <input type="text" id="edit_unit_code" name="code" maxlength="10" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600; text-transform: uppercase;" required>
            </div>
            <div style="margin-bottom: 1.5rem; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px solid var(--glass-border);">
                <p style="font-size: 0.8rem; font-weight: 700; color: #0f172a; margin-bottom: 1rem;">🏦 Paystack Split Payment Setup</p>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-size: 0.7rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Bank</label>
                    <select name="bank_code" id="edit_bank_code" style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit;">
                        <option value="">Select Bank (Optional)</option>
                        <option value="044">Access Bank</option>
                        <option value="058">Guaranty Trust Bank</option>
                        <option value="033">United Bank for Africa</option>
                        <option value="057">Zenith Bank</option>
                        <option value="011">First Bank of Nigeria</option>
                        <option value="214">First City Monument Bank</option>
                        <option value="050">Ecobank Nigeria</option>
                        <option value="032">Union Bank of Nigeria</option>
                        <option value="215">Unity Bank</option>
                        <option value="035">Wema Bank</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.7rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Account Number</label>
                    <input type="text" name="account_number" id="edit_account_number" placeholder="10 Digit Account Number" maxlength="10" style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 700; border-radius: 12px;">Save Changes</button>
        </form>
    </div>
</div>


<script>
// Define modal functions globally so inline onclick handlers can access them
window.openModal = function(id) {
    const modal = document.getElementById(id);
    if (modal) modal.style.display = 'flex';
}

window.closeModal = function(id) {
    const modal = document.getElementById(id);
    if (modal) modal.style.display = 'none';
}

window.editUnit = function(unit) {
    document.getElementById('edit_unit_id').value = unit.id;
    document.getElementById('edit_unit_name').value = unit.name;
    document.getElementById('edit_unit_code').value = unit.code;
    if(document.getElementById('edit_bank_code')) document.getElementById('edit_bank_code').value = unit.bank_code || '';
    if(document.getElementById('edit_account_number')) document.getElementById('edit_account_number').value = unit.account_number || '';
    openModal('editUnitModal');
}

</script>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
