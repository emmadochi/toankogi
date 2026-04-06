<?php require APPROOT . '/Views/inc/users/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Welcome back, <?php echo explode(' ', $data['member']->fullname)[0]; ?>!</h1>
    <p class="page-subtitle">Your TOAN ID: <strong><?php echo $data['member']->unique_id; ?></strong> • <?php echo $data['member']->unit_name; ?></p>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: <?php echo $data['is_compliant'] ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)'; ?>; color: <?php echo $data['is_compliant'] ? '#10b981' : '#ef4444'; ?>;">✓</div>
        <div class="stat-value" style="color: <?php echo $data['is_compliant'] ? '#10b981' : '#ef4444'; ?>;"><?php echo $data['is_compliant'] ? 'Compliant' : 'Owing Tax'; ?></div>
        <div class="stat-label">Tax Standing</div>
        <div class="stat-trend" style="color: <?php echo $data['is_compliant'] ? '#10b981' : '#ef4444'; ?>;"><?php echo $data['is_compliant'] ? 'No Arrears Found' : $data['outstanding_days'] . ' Days Unpaid'; ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">📅</div>
        <div class="stat-value" style="font-size: 1.1rem;"><?php echo $data['paid_until']; ?></div>
        <div class="stat-label">Paid Until</div>
        <div class="stat-trend" style="color: var(--text-muted);"><?php echo $data['is_compliant'] ? 'Active Coverage' : 'Tax Expired'; ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(5, 150, 105, 0.1); color: #059669;">₦</div>
        <div class="stat-value">₦<?php echo number_format($data['total_paid'], 2); ?></div>
        <div class="stat-label">Total Paid (<?php echo date('F'); ?>)</div>
        <div class="stat-trend trend-up">↑ <?php echo round(($data['days_paid'] / max($data['days_in_month'], 1)) * 100); ?>% Compliance</div>
    </div>
    <div class="stat-card" style="background: var(--primary); color: white;">
        <div class="stat-icon" style="background: rgba(255,255,255,0.2); color: white;">💳</div>
        <div class="stat-value" style="font-size: 1.25rem;">Quick Pay</div>
        <div class="stat-label" style="color: rgba(255,255,255,0.8);">Settle your dues</div>
        <a href="<?php echo URLROOT; ?>/users/pay" class="btn btn-outline" style="margin-top: 1rem; width: 100%; border-color: white; color: white; background: transparent;">Make Payment</a>
    </div>
    <div class="stat-card" style="background: white; border: 2px solid var(--secondary);">
        <div class="stat-icon" style="background: rgba(217, 119, 6, 0.1); color: var(--secondary);">🏷️</div>
        <div class="stat-value" style="font-size: 1.25rem; color: var(--dark);">Vehicle Sticker</div>
        <div class="stat-label"><?php echo date('Y'); ?> Official Permit</div>
        <a href="<?php echo URLROOT; ?>/users/sticker" class="btn btn-outline" style="margin-top: 1rem; width: 100%; border-color: var(--secondary); color: var(--secondary);">View & Print</a>
    </div>
</div>

<div class="content-grid">
    <!-- Compliance Chart -->
    <div class="card">
        <div class="card-title">My Compliance Hub</div>
        <div class="grid-stack" style="align-items: center;">
            <div style="height: 200px; position: relative;">
                <canvas id="complianceChart"></canvas>
            </div>
            <div>
                <h4 style="margin-bottom: 1rem;"><?php echo date('F Y'); ?> Standing</h4>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.8rem;">
                    <li style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                        <span>Paid Until:</span>
                        <span style="font-weight: 700; color: <?php echo $data['is_compliant'] ? 'var(--primary)' : '#ef4444'; ?>;"><?php echo $data['paid_until']; ?></span>
                    </li>
                    <li style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                        <span>Arrears:</span>
                        <span style="font-weight: 700; color: #ef4444;">₦<?php echo number_format($data['outstanding_amount'], 2); ?></span>
                    </li>
                    <li style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                        <span>Grace Period:</span>
                        <span style="font-weight: 700; color: #f59e0b;"><?php echo $data['grace_period']; ?> Days</span>
                    </li>
                </ul>
                <button class="btn btn-primary" style="margin-top: 1.5rem; width: 100%;" onclick="window.location.href='<?php echo URLROOT; ?>/users/pay'">Clear Outstanding</button>
            </div>
        </div>
    </div>

    <!-- Recent History -->
    <div class="card">
        <div class="card-title">Recent Tax Payments</div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['recent_payments'])) : ?>
                        <tr><td colspan="3" style="text-align: center;">No recent payments found.</td></tr>
                    <?php else : ?>
                        <?php foreach($data['recent_payments'] as $payment) : ?>
                        <tr>
                            <td><?php echo date('M d, Y', strtotime($payment->payment_date)); ?></td>
                            <td>₦<?php echo number_format($payment->amount, 2); ?></td>
                            <td><span class="status-check paid">Paid</span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="<?php echo URLROOT; ?>/users/payments" style="display: block; text-align: center; margin-top: 1.5rem; color: var(--primary); text-decoration: none; font-size: 0.85rem; font-weight: 600;">View Full History →</a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('complianceChart').getContext('2d');
    const remainingDays = Math.max(0, <?php echo $data['days_in_month'] - $data['current_day']; ?>);
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Pending (Outstanding)', 'Remaining (Not Due)'],
            datasets: [{
                data: [<?php echo $data['days_paid']; ?>, <?php echo $data['outstanding_days']; ?>, remainingDays],
                backgroundColor: ['#059669', '#f59e0b', '#f1f5f9'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '80%',
            plugins: {
                legend: { display: false }
            }
        }
    });
});
</script>

<?php require APPROOT . '/Views/inc/users/footer.php'; ?>
