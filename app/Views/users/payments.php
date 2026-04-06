<?php require APPROOT . '/Views/inc/users/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Tax Payment History</h1>
    <p class="page-subtitle">A transparent log of all contributions to TOAN Kogi State Revenue.</p>
</div>

<div class="card">
    <div class="card-title">
        <span>Payment Log</span>
        <div style="display: flex; gap: 0.5rem;">
            <button class="btn btn-outline" style="font-size: 0.75rem; padding: 0.4rem 0.8rem;">Filter by Month</button>
            <button class="btn btn-primary" style="font-size: 0.75rem; padding: 0.4rem 0.8rem;">Export PDF</button>
        </div>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data['payments'])) : ?>
                    <tr><td colspan="7" style="text-align: center;">No payment history found.</td></tr>
                <?php else : ?>
                    <?php foreach($data['payments'] as $payment) : ?>
                    <tr>
                        <td style="font-family: monospace; font-size: 0.85rem;"><?php echo htmlspecialchars($payment->receipt_number ?? '#N/A'); ?></td>
                        <td><?php echo date('M d, Y', strtotime($payment->payment_date)); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($payment->payment_type)) . ' Tax Levy'; ?></td>
                        <td style="font-weight: 600;">₦<?php echo number_format($payment->amount, 2); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($payment->payment_method ?? 'Gateway')); ?></td>
                        <td>
                            <?php 
                            $status = $payment->status ?? 'completed';
                            if(strtolower($status) == 'completed' || strtolower($status) == 'success'): 
                            ?>
                                <span class="status-check paid">Success</span>
                            <?php else: ?>
                                <span class="status-check pending" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td><a href="<?php echo URLROOT; ?>/users/receipt/<?php echo $payment->id; ?>" style="color: var(--primary);">Receipt</a></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require APPROOT . '/Views/inc/users/footer.php'; ?>
