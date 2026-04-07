<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Audit & Activity Logs</h1>
    <p class="page-subtitle">Detailed tracking of all system actions for transparency and dispute resolution.</p>
</div>

<!-- Audit Stats -->
<div class="stats-grid" style="margin-bottom: 2rem;">
    <div class="stat-card" style="background: var(--dark); color: white; border: none;">
        <div class="stat-value">1,540</div>
        <div class="stat-label" style="color: rgba(255,255,255,0.6); font-weight: 700;">Actions Today</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: #ef4444;">12</div>
        <div class="stat-label" style="font-weight: 700;">Sec Alerts</div>
        <div class="stat-trend trend-down" style="font-weight: 800;">RESOLVED</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: var(--secondary);">99.9%</div>
        <div class="stat-label" style="font-weight: 700;">Integrity</div>
        <div class="stat-trend trend-up" style="font-weight: 800;">STABLE</div>
    </div>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <h3 style="font-size: 1.1rem; font-weight: 800;">Activity History</h3>
        <button class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem; font-weight: 700;">Filter Logs</button>
    </div>

    <!-- Audit Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>User</th>
                    <th>Action</th>
                    <th class="hide-mobile">Entity</th>
                    <th class="hide-mobile">Details</th>
                    <th class="hide-mobile">IP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $audit_data = [
                    ['12:45:10', 'Agent_04 (Lokoja)', 'Payment', 'LKJ-123-AB', '₦200 Daily collected', '192.168.1.45'],
                    ['12:40:05', 'State_Admin', 'User Add', 'LGA_Admin_G', 'Kabba access granted', '10.0.0.1'],
                    ['12:35:22', 'Unit_Admin', 'New Reg', 'KOG-OKN-098', 'John Ibrahim reg', '192.168.2.112'],
                    ['12:20:15', 'Agent_12 (Idah)', 'Verify', 'IDH-456-XY', 'Enforcement fetch', '172.16.5.90'],
                    ['12:15:00', 'State_Admin', 'Export', 'Revenue_LKJ', 'Excel report gen', '10.0.0.1'],
                ];

                foreach($audit_data as $row): ?>
                <tr>
                    <td style="font-size: 0.75rem; color: var(--text-muted); font-family: monospace; font-weight: 700;"><?php echo $row[0]; ?></td>
                    <td>
                        <p style="font-weight: 700; font-size: 0.85rem;"><?php echo $row[1]; ?></p>
                    </td>
                    <td>
                        <span class="role-badge" style="font-size: 0.6rem; font-weight: 800;"><?php echo strtoupper($row[2]); ?></span>
                    </td>
                    <td style="font-weight: 700; font-size: 0.8rem;" class="hide-mobile"><?php echo $row[3]; ?></td>
                    <td style="font-size: 0.8rem; font-weight: 500;" class="hide-mobile"><?php echo $row[4]; ?></td>
                    <td style="font-size: 0.75rem; color: var(--text-muted); font-family: monospace;" class="hide-mobile"><?php echo $row[5]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Audit Footer -->
    <div style="margin-top: 2.5rem; padding: 1.25rem; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 12px; display: flex; align-items: flex-start; gap: 1rem;">
        <div style="font-size: 1.5rem;">🛡️</div>
        <div>
            <h4 style="font-size: 0.9rem; color: #92400e; margin-bottom: 0.3rem; font-weight: 800;">Security Protocol</h4>
            <p style="font-size: 0.75rem; color: #b45309; line-height: 1.5; font-weight: 500;">
                All system logs are cryptographically hashed and immutable. This audit trail is tamper-proof.
            </p>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
