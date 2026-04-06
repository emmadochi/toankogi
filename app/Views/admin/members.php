<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">Member Management</h1>
            <p class="page-subtitle">View and manage all registered tricycle owners across the state.</p>
        </div>
        <a href="<?php echo URLROOT; ?>/admin/registration" class="btn btn-primary">+ Register New Member</a>
    </div>
</div>

<!-- Summary Cards -->
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-value"><?php echo number_format($data['stats']->active + $data['stats']->inactive); ?></div>
        <div class="stat-label">Total Members</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: var(--primary);"><?php echo number_format($data['stats']->active); ?></div>
        <div class="stat-label">Verified (Active)</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: var(--secondary);">0</div>
        <div class="stat-label">Pending Status</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: var(--accent-red);"><?php echo number_format($data['stats']->inactive); ?></div>
        <div class="stat-label">Suspended/Expired</div>
    </div>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Owner / ID</th>
                    <th>Plate No</th>
                    <th>Location (LGA / Unit)</th>
                    <th>Phone</th>
                    <th>Date Joined</th>
                    <th>Compliance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['members'] as $m): ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 35px; height: 35px; border-radius: 8px; background: var(--bg-alt); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">👤</div>
                            <div>
                                <p style="font-weight: 700; font-size: 0.85rem;"><?php echo $m->fullname; ?></p>
                                <p style="font-size: 0.7rem; color: var(--text-muted); font-family: monospace;"><?php echo $m->unique_id; ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="background: var(--dark); color: white; padding: 0.3rem 0.6rem; border-radius: 6px; font-weight: 700; font-size: 0.75rem;"><?php echo $m->plate_number; ?></span>
                    </td>
                    <td>
                        <p style="font-weight: 600; font-size: 0.85rem;"><?php echo $m->lga_name; ?></p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);"><?php echo $m->unit_name; ?></p>
                    </td>
                    <td style="font-size: 0.85rem;"><?php echo $m->phone; ?></td>
                    <td style="font-size: 0.85rem; font-weight: 500;"><?php echo date('Y-m-d', strtotime($m->created_at)); ?></td>
                    <td>
                        <?php 
                        $status_class = ($m->status == 'active') ? 'paid' : 'owing';
                        ?>
                        <span class="status-check <?php echo $status_class; ?>"><?php echo ucfirst($m->status); ?></span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <a href="<?php echo URLROOT; ?>/admin/member_details?id=<?php echo $m->id; ?>" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.75rem; border-radius: 6px;">View Details</a>
                            <a href="<?php echo URLROOT; ?>/users/sticker?id=<?php echo $m->id; ?>" title="View ID Card" style="text-decoration: none; border: none; background: none; color: var(--primary); cursor: pointer; font-size: 1.1rem;">📇</a>
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

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
