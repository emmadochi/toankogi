<?php include 'layouts/header.php'; ?>

<div class="page-header" style="flex-wrap: wrap; gap: 1rem;">
    <div style="flex: 1; min-width: 250px;">
        <h1 class="page-title">Local Governance</h1>
        <p class="page-subtitle">Manage regional administrative divisions.</p>
    </div>
    <button class="btn btn-primary" style="width: 100%; sm-width: auto; padding: 0.8rem 1.5rem; font-weight: 700;" onclick="openModal('addLgaModal')">+ New LGA</button>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>LGA Name</th>
                    <th class="hide-mobile">Code</th>
                    <th>Units</th>
                    <th class="hide-mobile">Members</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lgas = [
                    ['Lokoja', 'LKJ', 12, '4,250', 'Active'],
                    ['Okene', 'OKN', 8, '3,120', 'Active'],
                    ['Dekina', 'DKN', 15, '2,840', 'Active'],
                    ['Idah', 'IDH', 6, '1,950', 'Active'],
                    ['Kabba/Bunu', 'KBB', 10, '2,100', 'Active'],
                    ['Ankpa', 'ANK', 9, '2,300', 'Active'],
                    ['Ajaokuta', 'AJK', 7, '1,450', 'Inactive'],
                ];

                foreach($lgas as $lga): ?>
                <tr>
                    <td style="font-weight: 700; font-size: 0.9rem;"><?php echo $lga[0]; ?></td>
                    <td class="hide-mobile" style="font-family: monospace; font-weight: 700; color: var(--text-muted);"><?php echo $lga[1]; ?></td>
                    <td style="font-weight: 600; font-size: 0.85rem;"><?php echo $lga[2]; ?> <span class="hide-mobile">Units</span></td>
                    <td class="hide-mobile" style="font-weight: 600; font-size: 0.85rem;"><?php echo $lga[3]; ?></td>
                    <td><span class="status-check <?php echo ($lga[4] == 'Active') ? 'paid' : 'owing'; ?>" style="font-size: 0.6rem; padding: 2px 8px; font-weight: 800;"><?php echo strtoupper($lga[4]); ?></span></td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <a href="units.php?lga=<?php echo urlencode($lga[0]); ?>" class="btn btn-outline" style="padding: 0.4rem; font-size: 0.75rem;">🏙️</a>
                            <button class="btn btn-outline" style="padding: 0.4rem; font-size: 0.75rem;">✏️</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add LGA Modal -->
<div id="addLgaModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px); padding: 1.5rem;">
    <div class="card" style="width: 100%; max-width: 500px; padding: 2rem; position: relative;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">Add New LGA</h2>
            <button onclick="closeModal('addLgaModal')" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; opacity: 0.5;">&times;</button>
        </div>
        
        <form onsubmit="handleFormSubmit(event, 'addLgaModal')">
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 0.7rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.5px;">LGA Name</label>
                <input type="text" placeholder="e.g. Lokoja" class="form-input" style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
            </div>
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label style="display: block; font-size: 0.7rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.5px;">Short Code</label>
                <input type="text" placeholder="e.g. LKJ" maxlength="3" class="form-input" style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600; text-transform: uppercase;" required>
            </div>
            <div class="form-group" style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 0.7rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.5px;">Assigned Admin</label>
                <select class="form-input" style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;">
                    <option>Select Admin...</option>
                    <option>Admin_Lokoja_01</option>
                    <option>Admin_Okene_01</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 800; border-radius: 12px;">Create Division</button>
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
    alert('Action completed successfully!');
    closeModal(modalId);
}
</script>

<?php include 'layouts/footer.php'; ?>
