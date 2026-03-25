<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">Member Management</h1>
            <p class="page-subtitle">View and manage all registered tricycle owners across the state.</p>
        </div>
        <a href="registration.php" class="btn btn-primary">+ Register New Member</a>
    </div>
</div>

<!-- Summary Cards -->
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-value">15,420</div>
        <div class="stat-label">Total Members</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: var(--primary);">14,120</div>
        <div class="stat-label">Verified (Paid)</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: var(--secondary);">850</div>
        <div class="stat-label">Pending Status</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: var(--accent-red);">450</div>
        <div class="stat-label">Suspended/Expired</div>
    </div>
</div>

<div class="card">
    <!-- Hierarchical Filters -->
    <div style="display: flex; gap: 1.5rem; margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-alt); border-radius: 12px; align-items: flex-end;">
        <div style="flex: 1;">
            <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase;">Select LGA</label>
            <select style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); outline: none; background: white; font-family: inherit; font-weight: 600;">
                <option>All 21 LGAs</option>
                <option>Lokoja</option>
                <option>Okene</option>
                <option>Dekina</option>
                <option>Idah</option>
                <option>Ankpa</option>
                <option>Kabba/Bunu</option>
            </select>
        </div>
        <div style="flex: 1;">
            <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase;">Select Unit</label>
            <select style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); outline: none; background: white; font-family: inherit;">
                <option>All Units</option>
                <option>Central Park</option>
                <option>Market Gate</option>
                <option>University Road</option>
                <option>Terminal B</option>
            </select>
        </div>
        <div style="flex: 1;">
            <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase;">Status</label>
            <select style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); outline: none; background: white; font-family: inherit;">
                <option>All Statuses</option>
                <option>Verified</option>
                <option>Pending Approval</option>
                <option>Suspended</option>
                <option>Expired Tax</option>
            </select>
        </div>
        <div style="flex: 1.5;">
            <div class="search-bar" style="width: 100%; padding: 0.7rem; margin: 0;">
                <span>🔍</span>
                <input type="text" placeholder="Search by Plate No or Name...">
            </div>
        </div>
        <button class="btn btn-primary" style="padding: 0.7rem 1.5rem; border-radius: 10px;">Apply Filter</button>
    </div>

    <!-- Member Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Owner / ID</th>
                    <th>Plate No</th>
                    <th>Location (LGA / Unit)</th>
                    <th>Tax Cycle</th>
                    <th>Next Due Date</th>
                    <th>Compliance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $members = [
                    ['Ameh Sunday', 'KOG-LOK-00124', 'LKJ-123-AB', 'Lokoja', 'Central Park', 'Daily', '2026-03-26', 'Verified'],
                    ['Musa Ibrahim', 'KOG-OKN-00456', 'OKN-456-XY', 'Okene', 'Market Area', 'Weekly', '2026-03-29', 'Verified'],
                    ['John Doe', 'KOG-IDH-00789', 'IDH-789-QW', 'Idah', 'Waterfront', 'Daily', '2026-03-24', 'Expired Tax'],
                    ['Sarah James', 'KOG-LOK-00890', 'LKJ-890-MN', 'Lokoja', 'Terminal B', 'Monthly', '2026-04-15', 'Verified'],
                    ['Peter Pan', 'KOG-KAB-00332', 'KAB-332-ZZ', 'Kabba', 'Main Road', 'Daily', '2026-03-25', 'Pending Approval'],
                    ['Blessing Obi', 'KOG-DEK-00111', 'DEK-111-OP', 'Dekina', 'Uni Gate', 'Weekly', '2026-03-28', 'Verified'],
                ];

                foreach($members as $m): ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--bg-alt); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">👤</div>
                            <div>
                                <p style="font-weight: 700; font-size: 0.85rem;"><?php echo $m[0]; ?></p>
                                <p style="font-size: 0.7rem; color: var(--text-muted); font-family: monospace;"><?php echo $m[1]; ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="background: var(--dark); color: white; padding: 0.3rem 0.6rem; border-radius: 6px; font-weight: 700; font-size: 0.75rem;"><?php echo $m[2]; ?></span>
                    </td>
                    <td>
                        <p style="font-weight: 600; font-size: 0.85rem;"><?php echo $m[3]; ?></p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);"><?php echo $m[4]; ?></p>
                    </td>
                    <td style="font-size: 0.85rem;"><?php echo $m[5]; ?></td>
                    <td style="font-size: 0.85rem; font-weight: 500;"><?php echo $m[6]; ?></td>
                    <td>
                        <?php 
                        $status_class = strtolower(str_replace(' ', '-', $m[7]));
                        if($m[7] == 'Verified') $status_class = 'paid';
                        if($m[7] == 'Expired Tax') $status_class = 'owing';
                        if($m[7] == 'Pending Approval') $status_class = 'pending';
                        ?>
                        <span class="status-check <?php echo $status_class; ?>"><?php echo $m[7]; ?></span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <a href="id_card.php?id=<?php echo urlencode($m[1]); ?>&name=<?php echo urlencode($m[0]); ?>&plate=<?php echo urlencode($m[2]); ?>&lga=<?php echo urlencode($m[3]); ?>&unit=<?php echo urlencode($m[4]); ?>&expiry=<?php echo urlencode($m[6]); ?>&status=<?php echo urlencode($m[7]); ?>" title="View ID Card" style="text-decoration: none; border: none; background: none; color: var(--primary); cursor: pointer; font-size: 1.1rem;">📇</a>
                            <button title="Edit Profile" style="border: none; background: none; color: var(--secondary); cursor: pointer; font-size: 1.1rem;">✏️</button>
                            <button title="More Options" style="border: none; background: none; color: var(--text-muted); cursor: pointer; font-size: 1.1rem;">⋯</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--glass-border);">
        <p style="font-size: 0.85rem; color: var(--text-muted);">Showing 1 to 6 of 15,420 members</p>
        <div style="display: flex; gap: 0.4rem;">
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;">« Prev</button>
            <button class="btn btn-primary" style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;">1</button>
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;">2</button>
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;">3</button>
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;">Next »</button>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 2rem; background: var(--primary-light); border-color: rgba(5, 150, 105, 0.1);">
    <h4 style="color: var(--primary); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 8px;">
        💡 <span>Governance Tip for LGA Admins</span>
    </h4>
    <p style="font-size: 0.85rem; color: var(--primary-dark); line-height: 1.5;">
        You can only see and manage units within your specific LGA. For state-wide access or to manage new units, please contact the State Admin Secretariat.
    </p>
</div>

<?php include 'layouts/footer.php'; ?>
