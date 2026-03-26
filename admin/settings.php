<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">System Settings</h1>
    <p class="page-subtitle">Configure application branding, revenue rates, and system parameters.</p>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <!-- Settings Tabs -->
    <div style="display: flex; border-bottom: 1px solid var(--glass-border); background: var(--bg-alt);">
        <button class="settings-tab active" onclick="switchTab('general')">🏢 General</button>
        <button class="settings-tab" onclick="switchTab('revenue')">💰 Revenue Rates</button>
        <button class="settings-tab" onclick="switchTab('lga')">📍 LGAs & Units</button>
        <button class="settings-tab" onclick="switchTab('system')">⚙️ System</button>
    </div>

    <!-- Settings Content -->
    <div style="padding: 2.5rem;">
        <form id="settingsForm" onsubmit="saveSettings(event)">
            
            <!-- General Settings -->
            <div id="general-tab" class="tab-content">
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
                            <img src="../images/logo.jpeg" style="max-width: 80%; border-radius: 5px;">
                        </div>
                        <button type="button" class="btn btn-outline" style="font-size: 0.8rem;">Change Logo</button>
                    </div>
                </div>
            </div>

            <!-- Revenue Settings -->
            <div id="revenue-tab" class="tab-content" style="display: none;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem;">Revenue & Tax Configuration</h3>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                    <div class="stat-card" style="box-shadow: none; border: 1px solid var(--glass-border);">
                        <label class="form-label">Daily Tax Rate (₦)</label>
                        <input type="number" value="200" class="form-input" style="font-size: 1.2rem; font-weight: 700;">
                    </div>
                    <div class="stat-card" style="box-shadow: none; border: 1px solid var(--glass-border);">
                        <label class="form-label">Weekly Tax Rate (₦)</label>
                        <input type="number" value="1200" class="form-input" style="font-size: 1.2rem; font-weight: 700;">
                    </div>
                    <div class="stat-card" style="box-shadow: none; border: 1px solid var(--glass-border);">
                        <label class="form-label">Registration Fee (₦)</label>
                        <input type="number" value="5000" class="form-input" style="font-size: 1.2rem; font-weight: 700;">
                    </div>
                </div>
                <div style="margin-top: 2rem; padding: 1.5rem; background: #fffbeb; border-radius: 15px; border: 1px solid #fde68a;">
                    <p style="color: #92400e; font-size: 0.85rem; font-weight: 600;">⚠️ Changing these rates will affect all future transactions and calculated outstanding balances.</p>
                </div>
            </div>

            <!-- LGA Tab -->
            <div id="lga-tab" class="tab-content" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.1rem;">Managed LGAs</h3>
                    <button type="button" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;">+ Add LGA</button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>LGA Name</th>
                                <th>Total Units</th>
                                <th>Total Members</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-weight: 600;">Lokoja</td>
                                <td>12 Units</td>
                                <td>4,250</td>
                                <td><span class="status-check paid">Active</span></td>
                                <td><button type="button" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.7rem;">Manage</button></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600;">Okene</td>
                                <td>8 Units</td>
                                <td>3,120</td>
                                <td><span class="status-check paid">Active</span></td>
                                <td><button type="button" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.7rem;">Manage</button></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600;">Dekina</td>
                                <td>15 Units</td>
                                <td>2,840</td>
                                <td><span class="status-check paid">Active</span></td>
                                <td><button type="button" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.7rem;">Manage</button></td>
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
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">Timezone</label>
                            <select class="form-input">
                                <option>(GMT+01:00) Lagos</option>
                                <option>(GMT+00:00) UTC</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="form-label">Backup Frequency</label>
                            <select class="form-input">
                                <option>Daily at Midnight</option>
                                <option>Weekly</option>
                                <option>Manual Only</option>
                            </select>
                        </div>
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
                <button type="button" class="btn btn-outline">Discard Changes</button>
                <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2.5rem;">Save All Settings</button>
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
    // Hide all tab content
    document.querySelectorAll('.tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Deactivate all tabs
    document.querySelectorAll('.settings-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById(tabId + '-tab').style.display = 'block';
    
    // Activate clicked tab
    event.currentTarget.classList.add('active');
}

function saveSettings(e) {
    e.preventDefault();
    alert('Settings saved successfully!');
}
</script>

<?php include 'layouts/footer.php'; ?>
