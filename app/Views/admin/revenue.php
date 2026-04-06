<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">Revenue Logs</h1>
            <p class="page-subtitle">Historical transaction data and financial monitoring.</p>
        </div>
        <div style="display: flex; gap: 0.8rem;">
            <a href="<?php echo URLROOT; ?>/admin/payment" class="btn btn-primary" style="padding: 0.6rem 1.2rem; font-size: 0.85rem; text-decoration: none;">💳 Process New Payment</a>
            <button class="btn btn-outline" style="padding: 0.6rem 1.2rem; font-size: 0.85rem;">📅 This Month</button>
            <button class="btn btn-primary" style="padding: 0.6rem 1.2rem; font-size: 0.85rem;">📥 Export CSV</button>
        </div>
    </div>
</div>

<!-- Revenue Summary Row -->
<div class="stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 2rem;">
    <div class="stat-card" style="border-top: 4px solid var(--primary);">
        <div class="stat-value">₦<?php echo number_format($data['stats']->today); ?></div>
        <div class="stat-label">Daily Collection (Today)</div>
    </div>
    <div class="stat-card" style="border-top: 4px solid var(--secondary);">
        <div class="stat-value">₦<?php echo number_format($data['stats']->week); ?></div>
        <div class="stat-label">Weekly Collection</div>
    </div>
    <div class="stat-card" style="border-top: 4px solid var(--dark);">
        <div class="stat-value">-</div>
        <div class="stat-label">Total Jurisdictional Revenue</div>
    </div>
</div>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>Member / Phone</th>
                    <th>Payment Date</th>
                    <th>Method</th>
                    <th>Jurisdiction</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['revenue'] as $row): ?>
                <tr>
                    <td style="font-family: monospace; font-weight: 600;">TX-<?php echo str_pad($row->id, 6, '0', STR_PAD_LEFT); ?></td>
                    <td>
                        <p style="font-weight: 600;"><?php echo $row->member_name; ?></p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);"><?php echo $row->plate_number; ?></p>
                    </td>
                    <td><?php echo date('M d, Y H:i', strtotime($row->payment_date)); ?></td>
                    <td><?php echo ucfirst($row->payment_type); ?></td>
                    <td style="font-size: 0.85rem;">
                        <p style="font-weight: 600;"><?php echo $row->lga_name; ?></p>
                        <p style="font-size: 0.7rem; color: var(--text-muted);"><?php echo $row->unit_name; ?></p>
                    </td>
                    <td style="font-weight: 700; color: var(--primary);">₦<?php echo number_format($row->amount); ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/admin/receipt?id=<?php echo $row->id; ?>" style="color: var(--primary); font-weight: 600; text-decoration: none;">📄 Receipt</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--glass-border);">
        <p style="font-size: 0.85rem; color: var(--text-muted);">Showing 1 to 8 of 1,245 transactions</p>
        <div style="display: flex; gap: 0.5rem;">
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px;">Prev</button>
            <button class="btn btn-primary" style="padding: 0.4rem 0.8rem; border-radius: 8px;">1</button>
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px;">2</button>
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px;">3</button>
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px;">Next</button>
        </div>
    </div>
</div>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
