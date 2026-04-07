<?php include 'layouts/header.php'; ?>

<?php
$lga_name = isset($_GET['lga']) ? $_GET['lga'] : 'Lokoja';
?>

<div class="page-header" style="flex-wrap: wrap; gap: 1rem;">
    <div style="flex: 1; min-width: 250px;">
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 0.5rem;">
            <a href="lgas.php" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 1.1rem;">←</a>
            <span style="font-weight: 800; color: var(--primary); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;"><?php echo htmlspecialchars($lga_name); ?></span>
        </div>
        <h1 class="page-title">Collection Units</h1>
        <p class="page-subtitle">Configure regional collection points and agents.</p>
    </div>
    <button class="btn btn-primary" style="width: 100%; sm-width: auto; padding: 0.8rem 1.5rem; font-weight: 700;" onclick="openModal('addUnitModal')">+ New Unit</button>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Unit Name</th>
                    <th class="hide-mobile">Code</th>
                    <th>Point</th>
                    <th class="hide-mobile">Branches</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Dummy Units for the selected LGA
                $units = [
                    ['Central Unit 1', 'C01', 'Main Terminal', 4, 'Active'],
                    ['Market Square', 'M02', 'North Gate', 2, 'Active'],
                    ['High School Road', 'H05', 'Junction A', 1, 'Active'],
                    ['River Side', 'R09', 'Waterfront', 3, 'Active'],
                ];

                foreach($units as $unit): ?>
                <tr>
                    <td style="font-weight: 700; font-size: 0.9rem;"><?php echo $unit[0]; ?></td>
                    <td class="hide-mobile" style="font-family: monospace; font-weight: 700; color: var(--text-muted);"><?php echo $unit[1]; ?></td>
                    <td style="font-weight: 600; font-size: 0.85rem;"><?php echo $unit[2]; ?></td>
                    <td class="hide-mobile" style="font-weight: 600; font-size: 0.8rem;"><?php echo $unit[3]; ?> B</td>
                    <td><span class="status-check paid" style="font-size: 0.6rem; padding: 2px 8px; font-weight: 800;">ACTIVE</span></td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <button class="btn btn-outline" style="padding: 0.4rem; font-size: 0.75rem;">✏️</button>
                            <button class="btn btn-outline" style="padding: 0.4rem; font-size: 0.75rem; color: #ef4444; border-color: #fee2e2;">🗑️</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Unit Modal -->
<div id="addUnitModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px); padding: 1.5rem;">
    <div class="card" style="width: 100%; max-width: 500px; padding: 2rem; position: relative;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">Add Collection Unit</h2>
            <button onclick="closeModal('addUnitModal')" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; opacity: 0.5;">&times;</button>
        </div>
        
        <form onsubmit="handleFormSubmit(event, 'addUnitModal')">
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 0.7rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.5px;">Unit Name</label>
                <input type="text" placeholder="e.g. Market Square Unit" class="form-input" style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
            </div>
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 0.7rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.5px;">Short Code</label>
                <input type="text" placeholder="e.g. MKT" maxlength="3" class="form-input" style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600; text-transform: uppercase;" required>
            </div>
            <div class="form-group" style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 0.7rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.5px;">Primary Point</label>
                <input type="text" placeholder="e.g. North Gate Hub" class="form-input" style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 800; border-radius: 12px;">Complete Infrastructure Setup</button>
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

function handleFormSubmit(e, modalId) {
    e.preventDefault();
    alert('Regional configuration updated successfully!');
    closeModal(modalId);
}
</script>

<?php include 'layouts/footer.php'; ?>
