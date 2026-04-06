<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">System Settings</h1>
    <p class="page-subtitle">Configure application branding, revenue rates, and integrations.</p>
</div>

<?php flash('settings_msg'); ?>

<div class="card" style="padding: 0; overflow: hidden;">
    <!-- Settings Tabs -->
    <div style="display: flex; border-bottom: 1px solid var(--glass-border); background: var(--bg-alt);">
        <button class="settings-tab active" onclick="switchTab('revenue')">💰 Revenue & Integration</button>
        <button class="settings-tab" onclick="switchTab('general')">🏢 General</button>
        <button class="settings-tab" onclick="switchTab('lga')">📍 LGAs & Units</button>
        <button class="settings-tab" onclick="switchTab('system')">⚙️ System</button>
    </div>

    <!-- Settings Content -->
    <div style="padding: 2.5rem;">
        <form action="<?php echo URLROOT; ?>/admin/settings" method="POST" id="settingsForm">
            <input type="hidden" name="action" value="update_settings">
            
            <!-- Revenue & Integrations Tab (Active by Default) -->
            <div id="revenue-tab" class="tab-content">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--primary);">Revenue & Tax Configuration</h3>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 3rem;">
                    <div class="stat-card" style="box-shadow: none; border: 1px solid var(--glass-border);">
                        <label class="form-label">Registration Fee (₦)</label>
                        <input type="number" name="registration_fee" value="<?php echo htmlspecialchars($data['settings']['registration_fee'] ?? '2000'); ?>" class="form-input" style="font-size: 1.2rem; font-weight: 700;">
                    </div>
                    <div class="stat-card" style="box-shadow: none; border: 1px solid var(--glass-border);">
                        <label class="form-label">Daily Tax Rate (₦)</label>
                        <input type="number" name="daily_rate" value="<?php echo htmlspecialchars($data['settings']['daily_rate'] ?? '200'); ?>" class="form-input" style="font-size: 1.2rem; font-weight: 700;">
                        <p style="font-size: 0.7rem; color: var(--text-muted); margin-top: 0.5rem;">Weekly = ×7, Monthly = ×30</p>
                    </div>
                </div>

                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: #f59e0b;">Paystack Gateway Integration</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2.5rem;">
                    <div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">Paystack Public Key</label>
                            <input type="text" name="paystack_public_key" value="<?php echo htmlspecialchars($data['settings']['paystack_public_key'] ?? ''); ?>" class="form-input" placeholder="pk_test_xxxxxxxx">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">Paystack Secret Key</label>
                            <input type="password" name="paystack_secret_key" value="<?php echo htmlspecialchars($data['settings']['paystack_secret_key'] ?? ''); ?>" class="form-input" placeholder="sk_test_xxxxxxxx">
                        </div>
                    </div>
                    <div>
                        <div style="padding: 1.5rem; background: #fffbeb; border-radius: 12px; border: 1px solid #fde68a;">
                            <p style="color: #92400e; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">💳 Split Payment Configuration</p>
                            <p style="color: #b45309; font-size: 0.8rem; margin-bottom: 1rem;">
                                The global State Revenue Account will default to receiving 75% of registration payments. Individual Units will automatically receive their 25% splits based on their saved Subaccount settings.
                            </p>
                        </div>
                    </div>
                </div>

                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: #10b981;">State Default Settlement Account</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">Bank Code (Paystack ID)</label>
                            <input type="text" name="main_bank_code" value="<?php echo htmlspecialchars($data['settings']['main_bank_code'] ?? ''); ?>" class="form-input" placeholder="e.g. 058 for GTB">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="main_account_number" value="<?php echo htmlspecialchars($data['settings']['main_account_number'] ?? ''); ?>" class="form-input">
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Settings -->
            <div id="general-tab" class="tab-content" style="display: none;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div>
                        <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;">Application Branding</h3>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">Association Name</label>
                            <input type="text" value="TOAN Kogi State" class="form-input">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">Contact Email</label>
                            <input type="email" value="info@toankogi.org" class="form-input">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">Contact Phone</label>
                            <input type="text" value="+234 801 234 5678" class="form-input">
                        </div>
                    </div>
                    <div style="text-align: center; padding: 2rem; background: var(--bg-alt); border-radius: 20px;">
                        <label class="form-label" style="text-align: left;">Association Logo</label>
                        <div style="width: 120px; height: 120px; background: white; border-radius: 15px; margin: 1rem auto; display: flex; align-items: center; justify-content: center; border: 2px dashed var(--glass-border);">
                            <img src="<?php echo URLROOT; ?>/images/logo.jpeg" style="max-width: 80%; border-radius: 5px;">
                        </div>
                        <button type="button" class="btn btn-outline" style="font-size: 0.8rem;">Change Logo</button>
                    </div>
                </div>
            </div>

            <!-- LGA Tab -->
            <div id="lga-tab" class="tab-content" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.1rem;">Managed LGAs</h3>
                    <a href="<?php echo URLROOT; ?>/admin/lgas" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem; text-decoration: none;">Manage LGAs</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>LGA Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-weight: 600;">Lokoja</td>
                                <td><span class="status-check paid">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- System Tab -->
            <div id="system-tab" class="tab-content" style="display: none;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;">System Configuration</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">System Language</label>
                            <select class="form-input">
                                <option>English (Nigeria)</option>
                                <option>Igala</option>
                                <option>Ebira</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 10px; padding: 1rem; background: var(--bg-alt); border-radius: 12px;">
                            <div style="flex: 1;">
                                <p style="font-weight: 600; font-size: 0.9rem;">Maintenance Mode</p>
                                <p style="font-size: 0.75rem; color: var(--text-muted);">Disable public access for updates</p>
                            </div>
                            <input type="checkbox" style="width: 20px; height: 20px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Bar -->
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--glass-border); display: flex; justify-content: flex-end; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2.5rem;">Save Settings</button>
            </div>
        </form>
    </div>
</div>

<style>
.settings-tab {
    padding: 1.2rem 2rem;
    background: none;
    border: none;
    font-family: inherit;
    font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
    transition: var(--transition);
    border-bottom: 3px solid transparent;
}

.settings-tab:hover {
    color: var(--primary);
    background: rgba(5, 150, 105, 0.05);
}

.settings-tab.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
    background: white;
}

.form-label {
    display: block;
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase;
    margin-bottom: 0.6rem;
    letter-spacing: 0.5px;
}

.form-input {
    width: 100%;
    padding: 0.8rem 1rem;
    border-radius: 12px;
    border: 1px solid var(--glass-border);
    font-family: inherit;
    font-weight: 500;
    outline: none;
    transition: var(--transition);
}

.form-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
}
</style>

<script>
function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(content => {
        content.style.display = 'none';
    });
    document.querySelectorAll('.settings-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    document.getElementById(tabId + '-tab').style.display = 'block';
    event.currentTarget.classList.add('active');
}
</script>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
