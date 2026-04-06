<?php require APPROOT . '/Views/inc/users/header.php'; 

$trx = $data['transaction'];
?>

<div class="page-header print-hidden" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 class="page-title">Payment Receipt</h1>
        <p class="page-subtitle">Transaction Ref: <?php echo htmlspecialchars($trx->receipt_number ?? '#N/A'); ?></p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <a href="<?php echo URLROOT; ?>/users/payments" class="btn btn-outline">← Back to History</a>
        <button class="btn btn-primary" onclick="window.print()">🖨️ Print / Save as PDF</button>
    </div>
</div>

<div class="receipt-wrapper" style="display: flex; justify-content: center; padding: 2rem 0;">
    <div class="receipt-card" style="width: 100%; max-width: 450px; background: white; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; overflow: hidden;">
        
        <!-- Receipt Header -->
        <div style="background: var(--dark); padding: 2rem; color: white; text-align: center;">
            <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="Logo" style="height: 50px; border-radius: 6px; margin-bottom: 1rem;">
            <h2 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 0.25rem; letter-spacing: 1px;">KOGI STATE TOAN</h2>
            <p style="font-size: 0.75rem; opacity: 0.8;">OFFICIAL TAX COMPLIANCE RECEIPT</p>
        </div>

        <!-- Receipt Body -->
        <div style="padding: 2rem;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Amount Paid</div>
                <div style="font-size: 2.5rem; font-weight: 800; color: #0f172a; line-height: 1.2;">₦<?php echo number_format($trx->amount, 2); ?></div>
                
                <?php 
                $status = $trx->status ?? 'completed';
                if(strtolower($status) == 'completed' || strtolower($status) == 'success'): 
                ?>
                    <div style="display: inline-block; padding: 0.25rem 1rem; background: #d1fae5; color: #059669; border-radius: 50px; font-weight: 700; font-size: 0.75rem; margin-top: 0.5rem;">SUCCESSFUL</div>
                <?php else: ?>
                    <div style="display: inline-block; padding: 0.25rem 1rem; background: #fef3c7; color: #d97706; border-radius: 50px; font-weight: 700; font-size: 0.75rem; margin-top: 0.5rem;">PENDING</div>
                <?php endif; ?>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 2px dashed #e2e8f0;">
                <div style="display: flex; justify-content: space-between;">
                    <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Date</span>
                    <span style="font-size: 0.9rem; font-weight: 700; color: #0f172a;"><?php echo date('d M, Y h:i A', strtotime($trx->payment_date)); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Tax Category</span>
                    <span style="font-size: 0.9rem; font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars(ucfirst($trx->payment_type)); ?> Levy</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Reference</span>
                    <span style="font-size: 0.9rem; font-weight: 700; font-family: monospace; color: #0f172a;"><?php echo htmlspecialchars($trx->receipt_number ?? '#N/A'); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Payment Method</span>
                    <span style="font-size: 0.9rem; font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars(ucfirst($trx->payment_method ?? 'Gateway')); ?></span>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="display: flex; justify-content: space-between;">
                    <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Member Name</span>
                    <span style="font-size: 0.9rem; font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars($trx->member_name); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Vehicle Plate</span>
                    <span style="font-size: 0.9rem; font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars($trx->plate_number); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Collector</span>
                    <span style="font-size: 0.9rem; font-weight: 700; color: #0f172a; text-align: right;"><?php echo htmlspecialchars($trx->agent_name ?? 'Automated Portal'); ?><br><small style="color:var(--primary);"><?php echo htmlspecialchars(substr($trx->unit_name ?? '', 0, 15)); ?></small></span>
                </div>
            </div>
        </div>
        
        <!-- Receipt Footer -->
        <div style="background: #f8fafc; padding: 1.5rem; text-align: center; border-top: 1px solid #e2e8f0;">
            <p style="font-size: 0.7rem; color: #64748b; margin-bottom: 0.5rem; line-height: 1.4;">Valid only for Kogi State Tricycle Operations. Keep this receipt as proof of payment.</p>
            <p style="font-size: 0.65rem; font-weight: 700; color: #94a3b8;">POWERED BY KOGI STATE IRS & TOAN</p>
        </div>
    </div>
</div>

<style>
@media print {
    /* Hide everything standard UI */
    body { background: white !important; font-family: 'Outfit', sans-serif !important; padding: 0 !important; margin: 0 !important; }
    .sidebar, .topbar, .bottom-nav, .print-hidden { display: none !important; }
    
    /* Reset margins padding */
    .main-layout { margin: 0 !important; padding: 0 !important; }
    .page-content { padding: 0 !important; }
    
    /* Reposition receipt to top left of page for clean printing */
    .receipt-wrapper { padding: 0 !important; display: block !important; margin: 0 auto !important; }
    
    .receipt-card { 
        box-shadow: none !important; 
        border: 1.5px solid #000 !important; /* Black border for print clarity */
        margin: 0 auto;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        max-width: 400px !important;
    }

    /* Force background colors */
    .receipt-card > div:first-child {
        background: #000 !important;
        color: #fff !important;
    }
}
</style>

<?php require APPROOT . '/Views/inc/users/footer.php'; ?>
