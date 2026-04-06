<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">User Roles & Management</h1>
            <p class="page-subtitle">Manage administrative access across State, LGA, and Unit levels.</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('addUserModal')">+ Add New Administrator</button>
    </div>
</div>

<?php flash('user_msg'); ?>

<div class="card">
    <!-- Role Overview Stats -->
    <div style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px solid var(--glass-border); padding-bottom: 1.5rem;">
        <div>
            <span style="display: block; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">LGA Admins</span>
            <p style="font-size: 1.5rem; font-weight: 700;"><?php echo number_format($data['userStats']->lga_admins); ?></p>
        </div>
        <div style="width: 1px; height: 35px; background: var(--glass-border);"></div>
        <div>
            <span style="display: block; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Unit Admins</span>
            <p style="font-size: 1.5rem; font-weight: 700;"><?php echo number_format($data['userStats']->unit_admins); ?></p>
        </div>
        <div style="width: 1px; height: 35px; background: var(--glass-border);"></div>
        <div>
            <span style="display: block; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Field Agents</span>
            <p style="font-size: 1.5rem; font-weight: 700;"><?php echo number_format($data['userStats']->agents); ?></p>
        </div>
    </div>

    <!-- Users Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Administrator</th>
                    <th>Role</th>
                    <th>Scope (LGA / Unit)</th>
                    <th>Contact</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['admins'] as $row): ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; background: var(--bg-alt); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700;">
                                <?php echo substr($row->fullname, 0, 1); ?>
                            </div>
                            <div>
                                <span style="font-weight: 600; display: block;"><?php echo $row->fullname; ?></span>
                                <span style="font-size: 0.7rem; color: var(--text-muted);">@<?php echo $row->username; ?></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="role-badge" style="font-size: 0.65rem;"><?php echo str_replace('_', ' ', strtoupper($row->role)); ?></span>
                    </td>
                    <td style="font-size: 0.85rem;">
                        <?php 
                            if($row->role == 'superadmin') echo 'Global';
                            elseif($row->role == 'lga_admin') echo ($row->lga_name ?? 'N/A') . ' / FULL';
                            else echo ($row->lga_name ?? 'N/A') . ' / ' . ($row->unit_name ?? 'N/A');
                        ?>
                    </td>
                    <td style="font-size: 0.85rem;"><?php echo $row->email; ?></td>
                    <td>
                        <span class="status-check <?php echo $row->status === 'active' ? 'paid' : 'pending'; ?>">
                            <?php echo ucfirst($row->status ?? 'Active'); ?>
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;" 
                                    onclick='editUser(<?php echo json_encode($row); ?>)'>✏️ Edit</button>
                            <?php if($row->id != $_SESSION['user_id'] && $row->role != 'superadmin'): ?>
                                <form action="<?php echo URLROOT; ?>/admin/users" method="POST" 
                                      data-confirm="This administrator will no longer be able to log in. Their historical data will be preserved."
                                      data-confirm-title="Deactivate User?"
                                      style="display:inline;">
                                    <input type="hidden" name="action" value="delete_user">
                                    <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                                    <button type="submit" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem; color: var(--danger); border-color: var(--danger);">🚫 Deactivate</button>
                                </form>

                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="modal-overlay">
    <div class="card" style="width: 550px; padding: 2.5rem; position: relative; animation: slideUp 0.4s ease;">
        <button onclick="closeModal('addUserModal')" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted);">×</button>
        <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Create Administrator</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem; font-size: 0.9rem;">Assign new administrative credentials within your jurisdiction.</p>
        
        <form action="<?php echo URLROOT; ?>/admin/users" method="POST">
            <input type="hidden" name="action" value="add_user">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Full Name</label>
                    <input type="text" name="fullname" placeholder="e.g. John Doe" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Email Address</label>
                    <input type="email" name="email" placeholder="john@kogi.gov.ng" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Username</label>
                    <input type="text" name="username" placeholder="jdoe_admin" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Initial Password</label>
                    <input type="password" name="password" placeholder="••••••••" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Assignment Role</label>
                <select id="roleSelect" name="role" onchange="toggleScopeFields()" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                    <?php if($_SESSION['user_role'] === 'superadmin'): ?>
                    <option value="lga_admin">LGA Administrator</option>
                    <option value="unit_admin">Unit Administrator</option>
                    <?php endif; ?>
                    <?php if($_SESSION['user_role'] === 'lga_admin'): ?>
                    <option value="unit_admin">Unit Administrator</option>
                    <?php endif; ?>
                    <option value="agent">Field Collection Agent</option>
                </select>
            </div>

            <div id="lgaField" style="margin-bottom: 1.5rem; <?php echo ($_SESSION['user_role'] !== 'superadmin') ? 'display:none;' : ''; ?>">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Assigned LGA</label>
                <select id="lgaSelectField" name="lga_id" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;">
                    <option value="">Select LGA...</option>
                    <?php if($_SESSION['user_role'] === 'superadmin'): ?>
                        <?php foreach($data['lgas'] as $lga): ?>
                        <option value="<?php echo $lga->id; ?>"><?php echo $lga->name; ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="<?php echo $_SESSION['user_lga_id']; ?>" selected><?php echo $_SESSION['user_lga_id']; ?></option>
                    <?php endif; ?>
                </select>
            </div>

            <div id="unitField" style="margin-bottom: 2rem; display: none;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Assigned Collection Unit</label>
                <select id="unitSelectField" name="unit_id" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;">
                    <option value="">Select Unit...</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 700; border-radius: 12px;">Create Credentials</button>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal-overlay">
    <div class="card" style="width: 600px; padding: 2.5rem; position: relative; animation: slideUp 0.4s ease;">
        <button onclick="closeModal('editUserModal')" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted);">×</button>
        <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Edit Administrator</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem; font-size: 0.9rem;">Modify administrative credentials and jurisdictional assignments.</p>
        
        <form action="<?php echo URLROOT; ?>/admin/users" method="POST">
            <input type="hidden" name="action" value="edit_user">
            <input type="hidden" id="edit_user_id" name="id" value="">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Full Name</label>
                    <input type="text" id="edit_fullname" name="fullname" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Email Address</label>
                    <input type="email" id="edit_email" name="email" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Username</label>
                    <input type="text" id="edit_username" name="username" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Change Password (optional)</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Assignment Role</label>
                    <select id="edit_role" name="role" onchange="toggleScopeFields('edit')" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                        <?php if($_SESSION['user_role'] === 'superadmin'): ?>
                        <option value="superadmin">Super Administrator</option>
                        <option value="lga_admin">LGA Administrator</option>
                        <option value="unit_admin">Unit Administrator</option>
                        <?php endif; ?>
                        <?php if($_SESSION['user_role'] === 'lga_admin'): ?>
                        <option value="unit_admin">Unit Administrator</option>
                        <?php endif; ?>
                        <option value="agent">Field Collection Agent</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Account Status</label>
                    <select id="edit_status" name="status" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div id="edit_lgaField" style="margin-bottom: 1.5rem; display: none;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Assigned LGA</label>
                <select id="edit_lgaSelectField" name="lga_id" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;">
                    <option value="">Select LGA...</option>
                    <?php if($_SESSION['user_role'] === 'superadmin'): ?>
                        <?php foreach($data['lgas'] as $lga): ?>
                        <option value="<?php echo $lga->id; ?>"><?php echo $lga->name; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div id="edit_unitField" style="margin-bottom: 2rem; display: none;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Assigned Collection Unit</label>
                <select id="edit_unitSelectField" name="unit_id" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;">
                    <option value="">Select Unit...</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 700; border-radius: 12px;">Update Credentials</button>
        </form>
    </div>
</div>

<script>
const unitsByLga = <?php echo json_encode($data['unitsByLga']); ?>;

function toggleScopeFields(mode = 'add') {
    const prefix = mode === 'edit' ? 'edit_' : '';
    const roleSelect = document.getElementById(prefix + 'roleSelect') || document.getElementById(prefix + 'role');
    const lgaField = document.getElementById(prefix + 'lgaField');
    const unitField = document.getElementById(prefix + 'unitField');
    
    if (!roleSelect || !lgaField || !unitField) return;

    const role = roleSelect.value;
    const userRole = '<?php echo $_SESSION['user_role']; ?>';

    // Role-based visibility
    if (userRole === 'superadmin') {
        lgaField.style.display = (role === 'superadmin') ? 'none' : 'block';
    } else {
        lgaField.style.display = 'none';
    }
    
    if (role === 'unit_admin' || role === 'agent') {
        unitField.style.display = 'block';
    } else {
        unitField.style.display = 'none';
    }
}

window.editUser = function(user) {
    document.getElementById('edit_user_id').value = user.id;
    document.getElementById('edit_fullname').value = user.fullname;
    document.getElementById('edit_email').value = user.email;
    document.getElementById('edit_username').value = user.username;
    document.getElementById('edit_role').value = user.role;
    document.getElementById('edit_status').value = user.status || 'active';
    
    if(user.lga_id) {
        document.getElementById('edit_lgaSelectField').value = user.lga_id;
        // Trigger LGA change to load units
        const event = new Event('change');
        document.getElementById('edit_lgaSelectField').dispatchEvent(event);
        
        // Wait a bit for units to load then set unit_id
        setTimeout(() => {
            if(user.unit_id) document.getElementById('edit_unitSelectField').value = user.unit_id;
        }, 100);
    }
    
    toggleScopeFields('edit');
    openModal('editUserModal');
}


document.addEventListener('DOMContentLoaded', function() {
    // Initial toggle check
    toggleScopeFields();

    // Logic to filter units based on selected LGA
    const setupLgaFilter = (lgaId, unitSelectId) => {
        const unitSelect = document.getElementById(unitSelectId);
        if (!unitSelect) return;
        
        unitSelect.innerHTML = '<option value="">Select Unit...</option>';
        if (lgaId && unitsByLga[lgaId]) {
            unitsByLga[lgaId].forEach(unit => {
                const option = document.createElement('option');
                option.value = unit.id;
                option.textContent = unit.name;
                unitSelect.appendChild(option);
            });
        }
    };

    const lgaSelect = document.getElementById('lgaSelectField');
    if (lgaSelect) {
        lgaSelect.addEventListener('change', function() {
            setupLgaFilter(this.value, 'unitSelectField');
        });
    }

    const editLgaSelect = document.getElementById('edit_lgaSelectField');
    if (editLgaSelect) {
        editLgaSelect.addEventListener('change', function() {
            setupLgaFilter(this.value, 'edit_unitSelectField');
        });
    }


    // Assign toggle function to role selector change
    const roleSelect = document.getElementById('roleSelect');
    if (roleSelect) {
        roleSelect.addEventListener('change', toggleScopeFields);
    }
});
</script>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
