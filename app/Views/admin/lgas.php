<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">Local Government Areas (LGA)</h1>
            <p class="page-subtitle">Manage regional administrative divisions for revenue collection.</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('addLgaModal')">+ Add New LGA</button>
    </div>
</div>

<?php flash('lga_msg'); ?>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>LGA Name</th>
                    <th>LGA Code</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['lgas'] as $lga): ?>
                <tr>
                    <td style="font-weight: 600;"><?php echo $lga->name; ?></td>
                    <td style="font-family: monospace; font-weight: 600; color: var(--text-muted);"><?php echo $lga->code; ?></td>
                    <td><span class="status-check paid">Active</span></td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <a href="<?php echo URLROOT; ?>/admin/units?lga_id=<?php echo $lga->id; ?>" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem; text-decoration: none;">🏙️ View Units</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add LGA Modal -->
<div id="addLgaModal" class="modal-overlay">
    <div class="card" style="width: 500px; padding: 2.5rem; position: relative; animation: slideUp 0.4s ease;">
        <button onclick="closeModal('addLgaModal')" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted);">×</button>
        <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Add New LGA</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem; font-size: 0.9rem;">Register a new administrative division in the system.</p>
        
        <form action="<?php echo URLROOT; ?>/admin/lgas" method="POST">
            <input type="hidden" name="action" value="add">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">LGA Name</label>
                <input type="text" name="name" placeholder="e.g. Lokoja" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">LGA Short Code</label>
                <input type="text" name="code" placeholder="e.g. LKJ" maxlength="3" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600; text-transform: uppercase;" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-weight: 700; border-radius: 12px;">Create LGA Division</button>
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
</script>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
