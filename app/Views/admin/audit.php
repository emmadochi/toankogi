<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Audit & Activity Logs</h1>
    <p class="page-subtitle">Detailed tracking of all system actions for transparency and dispute resolution.</p>
</div>

<!-- Audit Stats -->
<div class="stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 2rem;">
    <div class="stat-card" style="background: var(--dark); color: white;">
        <div class="stat-value"><?php echo number_format($data['audit_stats']->today); ?></div>
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
                <?php if(empty($data['audit_logs'])): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">No audit logs found.</td>
                </tr>
                <?php else: ?>
                <?php foreach($data['audit_logs'] as $row): ?>
                <tr>
                    <td style="font-size: 0.8rem; color: var(--text-muted); font-family: monospace;"><?php echo date('Y-m-d H:i:s', strtotime($row->created_at)); ?></td>
                    <td>
                        <p style="font-weight: 600; font-size: 0.85rem;"><?php echo htmlspecialchars($row->fullname ?: ($row->username ?: 'System')); ?></p>
                    </td>
                    <td>
                        <span class="role-badge" style="background: var(--bg-alt); color: var(--dark); font-size: 0.65rem; border: 1px solid var(--glass-border);"><?php echo htmlspecialchars($row->action_type); ?></span>
                    </td>
                    <td style="font-weight: 500; font-size: 0.85rem;"><?php echo htmlspecialchars($row->target_entity); ?></td>
                    <td style="font-size: 0.85rem;"><?php echo htmlspecialchars($row->details); ?></td>
                    <td style="font-size: 0.8rem; color: var(--text-muted); font-family: monospace;"><?php echo htmlspecialchars($row->ip_address ?: 'N/A'); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
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

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
