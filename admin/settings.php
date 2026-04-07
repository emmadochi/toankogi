<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">System Settings</h1>
    <p class="page-subtitle">Configure application branding, revenue rates, and system parameters.</p>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <!-- Settings Tabs -->
    <div style="display: flex; border-bottom: 1px solid var(--glass-border); background: var(--bg-alt); overflow-x: auto; -webkit-overflow-scrolling: touch; scrollbar-width: none;">
        <button class="settings-tab active" onclick="switchTab('general')">🏢 General</button>
        <button class="settings-tab" onclick="switchTab('revenue')">💰 Revenue</button>
        <button class="settings-tab" onclick="switchTab('lga')">📍 LGAs</button>
        <button class="settings-tab" onclick="switchTab('system')">⚙️ System</button>
    </div>

    <!-- Settings Content -->
    <div style="padding: 2rem 1.5rem;">
        <form id="settingsForm" onsubmit="saveSettings(event)">
            
            <!-- General Settings -->
            <div id="general-tab" class="tab-content">
                <div class="admin-grid">
                    <div>
                        <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; font-weight: 700;">Identity & Branding</h3>
                        <div class="form-group">
                            <label class="form-label">Association Name</label>
                            <input type="text" value="TOAN Kogi State" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Contact Email</label>
                            <input type="email" value="info@toankogi.org" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Contact Phone</label>
                            <input type="text" value="+234 801 234 5678" class="form-input">
                        </div>
                    </div>
                    <div style="text-align: center; padding: 2rem; background: var(--bg-alt); border-radius: 20px; border: 1px solid var(--glass-border);">
                        <label class="form-label" style="text-align: left;">System Logo</label>
                        <div style="width: 100px; height: 100px; background: white; border-radius: 15px; margin: 1rem auto; display: flex; align-items: center; justify-content: center; border: 1px solid var(--glass-border); box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                            <img src="../images/logo.jpeg" style="max-width: 70%; border-radius: 4px;">
                        </div>
                        <button type="button" class="btn btn-outline" style="font-size: 0.75rem; width: 100%;">Upload New Logo</button>
                    </div>
                </div>
            </div>

            <!-- Revenue Settings -->
            <div id="revenue-tab" class="tab-content" style="display: none;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; font-weight: 700;">Revenue Configuration</h3>
                <div class="admin-grid">
                    <div class="card" style="box-shadow: none; border: 1px solid var(--glass-border); padding: 1.25rem;">
                        <label class="form-label">Daily Tax (₦)</label>
                        <input type="number" value="200" class="form-input" style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">
                    </div>
                    <div class="card" style="box-shadow: none; border: 1px solid var(--glass-border); padding: 1.25rem;">
                        <label class="form-label">Weekly Tax (₦)</label>
                        <input type="number" value="1200" class="form-input" style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">
                    </div>
                    <div class="card" style="box-shadow: none; border: 1px solid var(--glass-border); padding: 1.25rem;">
                        <label class="form-label">Registration (₦)</label>
                        <input type="number" value="5000" class="form-input" style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">
                    </div>
                </div>
                <div style="margin-top: 2rem; padding: 1.25rem; background: #fffbeb; border-radius: 12px; border: 1px solid #fde68a; display: flex; gap: 10px;">
                    <span>⚠️</span>
                    <p style="color: #92400e; font-size: 0.8rem; font-weight: 600; line-height: 1.5;">Rate changes are immediate and will reflect on all new field collections.</p>
                </div>
            </div>

            <!-- LGA Tab -->
            <div id="lga-tab" class="tab-content" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                    <h3 style="font-size: 1.1rem; font-weight: 700;">Governance Areas</h3>
                    <button type="button" class="btn btn-primary" style="padding: 0.6rem 1.25rem; font-size: 0.8rem;">+ Add LGA</button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>LGA</th>
                                <th>Units</th>
                                <th class="hide-mobile">Capacity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-weight: 700;">Lokoja</td>
                                <td>12</td>
                                <td class="hide-mobile">4,250</td>
                                <td><span class="status-check paid" style="font-size: 0.6rem;">Active</span></td>
                                <td><button type="button" class="btn btn-outline" style="padding: 0.4rem; font-size: 0.75rem;">⚙️</button></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700;">Okene</td>
                                <td>8</td>
                                <td class="hide-mobile">3,120</td>
                                <td><span class="status-check paid" style="font-size: 0.6rem;">Active</span></td>
                                <td><button type="button" class="btn btn-outline" style="padding: 0.4rem; font-size: 0.75rem;">⚙️</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- System Tab -->
            <div id="system-tab" class="tab-content" style="display: none;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; font-weight: 700;">System Controls</h3>
                <div class="admin-grid">
                    <div>
                        <div class="form-group">
                            <label class="form-label">System Language</label>
                            <select class="form-input">
                                <option>English (Nigeria)</option>
                                <option>Igala</option>
                                <option>Ebira</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Timezone</label>
                            <select class="form-input">
                                <option>(GMT+01:00) Lagos</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="form-label">Backup Schedule</label>
                            <select class="form-input">
                                <option>Daily at Midnight</option>
                                <option>Weekly</option>
                            </select>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; padding: 1.25rem; background: var(--bg-alt); border-radius: 12px; border: 1px solid var(--glass-border);">
                            <div style="flex: 1;">
                                <p style="font-weight: 700; font-size: 0.9rem;">Maintenance</p>
                                <p style="font-size: 0.7rem; color: var(--text-muted);">Lock site access</p>
                            </div>
                            <input type="checkbox" style="width: 22px; height: 22px; accent-color: var(--primary);">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Bar -->
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--glass-border); display: flex; flex-direction: column; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="padding: 1rem; width: 100%; font-weight: 700;">Save All Configuration</button>
                <button type="button" class="btn btn-outline" style="padding: 1rem; width: 100%; font-size: 0.9rem;">Discard Changes</button>
            </div>
        </form>
    </div>
</div>

<style>
.settings-tab {
    padding: 1.2rem 1.75rem;
    background: none;
    border: none;
    font-family: inherit;
    font-weight: 700;
    color: var(--text-muted);
    cursor: pointer;
    transition: var(--transition);
    border-bottom: 3px solid transparent;
    white-space: nowrap;
    font-size: 0.85rem;
}

.settings-tab:hover {
    color: var(--primary);
}

.settings-tab.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
    background: white;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-size: 0.7rem;
    font-weight: 800;
    color: var(--text-muted);
    text-transform: uppercase;
    margin-bottom: 0.6rem;
    letter-spacing: 0.5px;
}

.form-input {
    width: 100%;
    padding: 0.85rem 1rem;
    border-radius: 12px;
    border: 1px solid var(--glass-border);
    font-family: inherit;
    font-weight: 600;
    outline: none;
    transition: var(--transition);
    background: white;
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
