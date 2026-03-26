<?php include 'layouts/header.php'; ?>

<?php
$lga_name = isset($_GET['lga']) ? $_GET['lga'] : 'Lokoja';
?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 0.5rem;">
                <a href="lgas.php" style="text-decoration: none; color: var(--text-muted); font-size: 0.9rem;">📍 LGAs</a>
                <span style="color: var(--text-muted); font-size: 0.8rem;">/</span>
                <span style="font-weight: 700; color: var(--primary);"><?php echo htmlspecialchars($lga_name); ?> Units</span>
            </div>
            <h1 class="page-title">Management for <?php echo htmlspecialchars($lga_name); ?></h1>
            <p class="page-subtitle">Configure collection units and assign agents for this division.</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('addUnitModal')">+ Add New Unit</button>
    </div>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Unit Name</th>
                    <th>Unit Code</th>
                    <th>Collection Point</th>
                    <th>Sub-Units</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                    <td style="font-weight: 600;"><?php echo $unit[0]; ?></td>
                    <td style="font-family: monospace; font-weight: 600; color: var(--text-muted);"><?php echo $unit[1]; ?></td>
                    <td><?php echo $unit[2]; ?></td>
                    <td><?php echo $unit[3]; ?> Branches</td>
                    <td><span class="status-check paid"><?php echo $unit[4]; ?></span></td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">✏️ Edit</button>
                            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem; color: #ef4444; border-color: #fee2e2;">🗑️ Delete</button>
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
        <p style="color: var(--text-muted); margin-bottom: 2rem; font-size: 0.9rem;">Register a new revenue collection point in **<?php echo htmlspecialchars($lga_name); ?>**.</p>
        
        <form onsubmit="handleFormSubmit(event, 'addUnitModal')">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Unit Name</label>
                <input type="text" placeholder="e.g. Market Square Unit" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Unit Short Code</label>
                <input type="text" placeholder="e.g. MKT" maxlength="3" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600; text-transform: uppercase;" required>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Primary Collection Point</label>
                <input type="text" placeholder="e.g. North Gate Hub" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 700; border-radius: 12px;">Complete Unit Setup</button>
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
