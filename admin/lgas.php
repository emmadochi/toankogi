<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">Local Government Areas (LGA)</h1>
            <p class="page-subtitle">Manage regional administrative divisions for revenue collection.</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('addLgaModal')">+ Add New LGA</button>
    </div>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>LGA Name</th>
                    <th>LGA Code</th>
                    <th>Units count</th>
                    <th>Active Members</th>
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
                    <td style="font-weight: 600;"><?php echo $lga[0]; ?></td>
                    <td style="font-family: monospace; font-weight: 600; color: var(--text-muted);"><?php echo $lga[1]; ?></td>
                    <td><?php echo $lga[2]; ?> Units</td>
                    <td><?php echo $lga[3]; ?></td>
                    <td><span class="status-check <?php echo ($lga[4] == 'Active') ? 'paid' : 'owing'; ?>"><?php echo $lga[4]; ?></span></td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <a href="units.php?lga=<?php echo urlencode($lga[0]); ?>" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem; text-decoration: none;">🏙️ View Units</a>
                            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">✏️ Edit</button>
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
        
        <form onsubmit="handleFormSubmit(event, 'addLgaModal')">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">LGA Name</label>
                <input type="text" placeholder="e.g. Lokoja" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;" required>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">LGA Short Code</label>
                <input type="text" placeholder="e.g. LKJ" maxlength="3" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600; text-transform: uppercase;" required>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Admin Assigned</label>
                <select style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;">
                    <option>Select Admin...</option>
                    <option>Admin_Lokoja_01</option>
                    <option>Admin_Okene_01</option>
                </select>
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

function handleFormSubmit(e, modalId) {
    e.preventDefault();
    alert('Action completed successfully!');
    closeModal(modalId);
}
</script>

<?php include 'layouts/footer.php'; ?>
