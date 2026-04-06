<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <a href="<?php echo URLROOT; ?>/admin/members" style="color: var(--primary); text-decoration: none; font-size: 0.9rem; font-weight: 600;">&larr; Back to Members</a>
        <h1 class="page-title" style="margin-top: 0.5rem;">Member Profile</h1>
    </div>
    <div style="display: flex; gap: 10px;">
        <a href="<?php echo URLROOT; ?>/users/id_card?id=<?php echo $data['member']->id; ?>" class="btn btn-outline" target="_blank" style="padding: 0.6rem 1.2rem;">📇 Print ID Card</a>
        <a href="<?php echo URLROOT; ?>/users/sticker?id=<?php echo $data['member']->id; ?>" class="btn btn-outline" target="_blank" style="padding: 0.6rem 1.2rem;">🎫 Print Sticker</a>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: start;">
    <!-- Profile Card -->
    <div class="card" style="text-align: center; border-top: 5px solid <?php echo $data['tax']['is_compliant'] ? '#10b981' : '#ef4444'; ?>;">
        <div style="width: 120px; height: 120px; border-radius: 50%; background: var(--bg-alt); margin: 0 auto 1.5rem; overflow: hidden; border: 3px solid var(--glass-border); display: flex; align-items: center; justify-content: center; font-size: 3rem;">
            <?php if ($data['member']->passport_image): ?>
                <img src="<?php echo URLROOT; ?>/<?php echo $data['member']->passport_image; ?>" style="width: 100%; height: 100%; object-fit: cover;">
            <?php else: ?>
                👤
            <?php endif; ?>
        </div>
        
        <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;"><?php echo $data['member']->fullname; ?></h2>
        <p style="font-family: monospace; font-size: 1.1rem; font-weight: 600; color: var(--primary); margin-bottom: 0.5rem;"><?php echo $data['member']->unique_id; ?></p>
        
        <div style="margin-bottom: 1.5rem;">
            <span class="status-check <?php echo $data['tax']['is_compliant'] ? 'active' : 'owing'; ?>" style="font-size: 0.8rem; padding: 0.3rem 0.8rem; border-radius: 20px; display: inline-block; <?php if($data['tax']['is_compliant']) echo 'background: #d1fae5; color: #065f46; border: 1px solid #10b981;'; else echo 'background: #fee2e2; color: #991b1b; border: 1px solid #ef4444;'; ?>">
                <?php echo $data['tax']['is_compliant'] ? 'COMPLIANT' : 'OWING TAX'; ?>
            </span>
        </div>

        <div style="text-align: left; padding: 1.5rem; background: var(--bg-alt); border-radius: 12px; margin-bottom: 1.5rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.8rem; border-bottom: 1px dashed rgba(0,0,0,0.05); padding-bottom: 0.5rem;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Plate Number</span>
                <span style="font-weight: 600;"><?php echo $data['member']->plate_number; ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.8rem; border-bottom: 1px dashed rgba(0,0,0,0.05); padding-bottom: 0.5rem;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Phone</span>
                <span style="font-weight: 600;"><?php echo $data['member']->phone; ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.8rem; border-bottom: 1px dashed rgba(0,0,0,0.05); padding-bottom: 0.5rem;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">LGA</span>
                <span style="font-weight: 600;"><?php echo $data['member']->lga_name; ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.8rem; border-bottom: 1px dashed rgba(0,0,0,0.05); padding-bottom: 0.5rem;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Unit</span>
                <span style="font-weight: 600;"><?php echo $data['member']->unit_name; ?></span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Paid Until</span>
                <span style="font-weight: 700; color: <?php echo $data['tax']['is_compliant'] ? '#15803d' : '#ef4444'; ?>;"><?php echo $data['tax']['paid_until']; ?></span>
            </div>
        </div>

        <div style="background: <?php echo $data['tax']['is_compliant'] ? '#f0fdf4' : '#fef2f2'; ?>; padding: 1.5rem; border-radius: 12px; border: 1px dashed <?php echo $data['tax']['is_compliant'] ? '#86efac' : '#fca5a5'; ?>;">
            <p style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600; margin-bottom: 0.5rem; letter-spacing: 0.5px;">Current Standing</p>
            <?php if($data['tax']['is_compliant']): ?>
                <h3 style="color: #166534; font-size: 1.5rem; margin-bottom: 0.3rem;">Fully Paid</h3>
                <p style="font-size: 0.85rem; color: #15803d; margin-bottom: 1rem;">Covered until <?php echo $data['tax']['paid_until']; ?></p>
                <a href="<?php echo URLROOT; ?>/admin/payment?id=<?php echo $data['member']->id; ?>&amount=200" class="btn btn-primary" style="width: 100%; display: block; text-decoration: none;">Receive Advance Payment</a>
            <?php else: ?>
                <h3 style="color: #991b1b; font-size: 1.5rem; margin-bottom: 0.3rem;">Owes ₦<?php echo number_format($data['tax']['amount_owed']); ?></h3>
                <p style="font-size: 0.85rem; color: #b91c1c; margin-bottom: 0.3rem;">(<?php echo $data['tax']['days_owed']; ?> days unpaid tax)</p>
                <p style="font-size: 0.75rem; color: #ef4444; margin-bottom: 1rem; font-weight: 600;">Expired on: <?php echo $data['tax']['paid_until']; ?></p>
                <a href="<?php echo URLROOT; ?>/admin/payment?id=<?php echo $data['member']->id; ?>&amount=<?php echo $data['tax']['amount_owed']; ?>" class="btn btn-primary" style="width: 100%; display: block; text-decoration: none; background: #ef4444; border-color: #ef4444;">Record Payment</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Payment History Table -->
    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: 1.5rem 2rem; border-bottom: 1px solid var(--glass-border); background: rgba(248, 250, 252, 0.5);">
            <h3 style="font-size: 1.2rem; margin: 0;">Payment History</h3>
        </div>
        <div class="table-container">
            <?php if (empty($data['payments'])): ?>
                <div style="padding: 4rem 2rem; text-align: center; color: var(--text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;">📭</div>
                    <p>No transactions found for this member.</p>
                </div>
            <?php else: ?>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 0;">
                <thead>
                    <tr style="background: rgba(0,0,0,0.02);">
                        <th style="padding: 1rem 2rem; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Date</th>
                        <th style="padding: 1rem 2rem; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Amount</th>
                        <th style="padding: 1rem 2rem; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Type</th>
                        <th style="padding: 1rem 2rem; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Ref No</th>
                        <th style="padding: 1rem 2rem; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Agent</th>
                        <th style="padding: 1rem 2rem; text-align: right; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['payments'] as $pay): ?>
                        <tr style="border-bottom: 1px solid var(--glass-border); transition: background 0.2s;">
                            <td style="padding: 1rem 2rem; font-size: 0.9rem; font-weight: 500;"><?php echo date('d M Y, h:i A', strtotime($pay->payment_date)); ?></td>
                            <td style="padding: 1rem 2rem; font-weight: 700; color: var(--primary);">₦<?php echo number_format($pay->amount); ?></td>
                            <td style="padding: 1rem 2rem; font-size: 0.85rem;"><span style="background: var(--bg-alt); padding: 0.3rem 0.6rem; border-radius: 4px; font-weight: 600;"><?php echo ucfirst($pay->payment_type); ?></span></td>
                            <td style="padding: 1rem 2rem; font-family: monospace; font-size: 0.85rem; color: var(--text-muted);"><?php echo $pay->receipt_number; ?></td>
                            <td style="padding: 1rem 2rem; font-size: 0.85rem; color: var(--text-muted);"><?php echo $pay->agent_name ?? 'System'; ?></td>
                            <td style="padding: 1rem 2rem; text-align: right;"><a href="<?php echo URLROOT; ?>/admin/receipt?id=<?php echo $pay->id; ?>" style="color: var(--primary); font-size: 0.85rem; font-weight: 600; text-decoration: none;">Receipt &rarr;</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    tbody tr:hover {
        background: #f8fafc;
    }
</style>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
