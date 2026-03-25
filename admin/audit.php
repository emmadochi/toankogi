<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Audit & Activity Logs</h1>
    <p class="page-subtitle">Detailed tracking of all system actions for transparency and dispute resolution.</p>
</div>

<!-- Audit Stats -->
<div class="stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 2rem;">
    <div class="stat-card" style="background: var(--dark); color: white;">
        <div class="stat-value">1,540</div>
        <div class="stat-label" style="color: rgba(255,255,255,0.6);">Total Actions Today</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">12</div>
        <div class="stat-label">Security Alerts</div>
        <div class="stat-trend trend-down">Resolved</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">99.9%</div>
        <div class="stat-label">Data Integrity</div>
        <div class="stat-trend trend-up">System Healthy</div>
    </div>
</div>

<div class="card">
    <div class="card-title">
        <span>Activity History</span>
        <button class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;">Filter by User</button>
    </div>

    <!-- Audit Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>User (Admin/Agent)</th>
                    <th>Action Type</th>
                    <th>Target Entity</th>
                    <th>Specific Detail</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $audit_data = [
                    ['2026-03-25 12:45:10', 'Agent_04 (Lokoja)', 'Payment Record', 'LKJ-123-AB', '₦200 Daily Tax collected', '192.168.1.45'],
                    ['2026-03-25 12:40:05', 'State_Admin', 'User Created', 'LGA_Admin_Grace', 'Kabba LGA Admin access granted', '10.0.0.1'],
                    ['2026-03-25 12:35:22', 'Unit_Admin_Musa', 'New Registration', 'ID: KOG-OKN-098', 'Owner: John Ibrahim registered', '192.168.2.112'],
                    ['2026-03-25 12:20:15', 'Agent_12 (Idah)', 'Verification', 'IDH-456-XY', 'Owner details fetched for enforcement', '172.16.5.90'],
                    ['2026-03-25 12:15:00', 'State_Admin', 'Report Export', 'Revenue_Lokoja', 'Excel report generated for Lokoja', '10.0.0.1'],
                    ['2026-03-25 11:58:34', 'Agent_04 (Lokoja)', 'Payment Record', 'LKJ-888-ZZ', '₦1,200 Weekly Tax collected', '192.168.1.45'],
                ];

                foreach($audit_data as $row): ?>
                <tr>
                    <td style="font-size: 0.8rem; color: var(--text-muted); font-family: monospace;"><?php echo $row[0]; ?></td>
                    <td>
                        <p style="font-weight: 600; font-size: 0.85rem;"><?php echo $row[1]; ?></p>
                    </td>
                    <td>
                        <span class="role-badge" style="background: var(--bg-alt); color: var(--dark); font-size: 0.65rem; border: 1px solid var(--glass-border);"><?php echo $row[2]; ?></span>
                    </td>
                    <td style="font-weight: 500; font-size: 0.85rem;"><?php echo $row[3]; ?></td>
                    <td style="font-size: 0.85rem;"><?php echo $row[4]; ?></td>
                    <td style="font-size: 0.8rem; color: var(--text-muted); font-family: monospace;"><?php echo $row[5]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Audit Footer -->
    <div style="margin-top: 2rem; padding: 1.5rem; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 12px; display: flex; align-items: flex-start; gap: 1rem;">
        <div style="font-size: 1.5rem;">🛡️</div>
        <div>
            <h4 style="font-size: 0.9rem; color: #92400e; margin-bottom: 0.3rem;">Tamper-Proof Logging</h4>
            <p style="font-size: 0.85rem; color: #b45309; line-height: 1.4;">
                All system logs are cryptographically hashed and cannot be altered or deleted by any user level, including Super Admins. This ensures a transparent audit trail for state revenue governance.
            </p>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
