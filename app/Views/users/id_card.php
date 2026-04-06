<?php require APPROOT . '/Views/inc/users/header.php'; ?>

<?php $member = $data['member']; ?>

<div class="page-header">
    <h1 class="page-title">Digital ID Card</h1>
    <p class="page-subtitle">Present this card to field agents for quick verification of your tax standing.</p>
</div>

<div style="display: flex; align-items: flex-start; gap: 3rem; flex-wrap: wrap;">
    <!-- The ID Card Visual -->
    <div style="width: 100%; max-width: 400px; background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.1); border: 1px solid var(--glass-border); position: relative;">
        <!-- Header -->
        <div style="background: var(--dark); padding: 2rem; color: white; display: flex; align-items: center; gap: 15px;">
            <img src="<?php echo URLROOT; ?>/images/logo.jpeg" style="height: 40px; border-radius: 4px;">
            <div>
                <h3 style="font-size: 1rem; font-weight: 700;">TOAN KOGI STATE</h3>
                <p style="font-size: 0.65rem; opacity: 0.7; letter-spacing: 1px;">OFFICIAL MEMBERSHIP CARD</p>
            </div>
        </div>
        <!-- Body -->
        <div style="padding: 2.5rem; display: flex; flex-direction: column; align-items: center; text-align: center;">
            <div style="width: 150px; height: 150px; background: #f8fafc; border-radius: 20px; border: 4px solid var(--primary); margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 4rem; overflow: hidden;">
                <?php if(!empty($member->passport_image)): ?>
                    <img src="<?php echo URLROOT . '/' . $member->passport_image; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                    👤
                <?php endif; ?>
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;"><?php echo $member->fullname; ?></h2>
            <p style="color: var(--primary); font-weight: 700; font-size: 0.9rem; margin-bottom: 2rem;"><?php echo $member->unique_id; ?></p>
            
            <div style="width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; text-align: left; margin-bottom: 2rem;">
                <div>
                    <label style="font-size: 0.6rem; color: var(--text-muted); text-transform: uppercase;">Unit / LGA</label>
                    <p style="font-size: 0.8rem; font-weight: 600;"><?php echo $member->unit_name . ' / ' . $member->lga_name; ?></p>
                </div>
                <div>
                    <label style="font-size: 0.6rem; color: var(--text-muted); text-transform: uppercase;">Vehicle Plate</label>
                    <p style="font-size: 0.8rem; font-weight: 600;"><?php echo $member->plate_number; ?></p>
                </div>
            </div>

            <!-- QR Placeholder -->
            <div style="padding: 1rem; background: #fff; border: 1px solid #eee; border-radius: 12px; margin-bottom: 1.5rem;">
                <!-- In a real app, generate a QR code here pointing to verify URL -->
                <div style="width: 80px; height: 80px; background: black; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.5rem; text-align: center;">SCAN TO VERIFY<br><?php echo $member->unique_id; ?></div>
            </div>

            <div style="padding: 0.5rem 1.5rem; background: #d1fae5; color: #059669; border-radius: 50px; font-weight: 700; font-size: 0.8rem;">
                ✓ <?php echo strtoupper($member->status); ?>
            </div>
        </div>
        <!-- Footer Color strip -->
        <div style="height: 10px; display: flex;">
            <div style="flex: 1; background: #059669;"></div>
            <div style="flex: 1; background: #f59e0b;"></div>
            <div style="flex: 1; background: #ef4444;"></div>
        </div>
    </div>

    <!-- Instructions / Sidebar -->
    <div style="flex: 1; max-width: 500px;">
        <div class="card" style="margin-bottom: 2rem;">
            <div class="card-title">How to use your ID</div>
            <ul style="padding-left: 1.2rem; display: flex; flex-direction: column; gap: 1rem; color: var(--text-muted); font-size: 0.95rem;">
                <li>Present this screen to any TOAN Registered Enforcement Agent.</li>
                <li>The agent will scan your QR code to verify your current daily/monthly tax status.</li>
                <li>Ensure your payment is up to date to avoid late fees or enforcement actions.</li>
                <li>If the agent has no scanner, your "VERIFIED" status badge serves as manual proof.</li>
            </ul>
        </div>
        <button class="btn btn-primary print-hidden" style="width: 100%; margin-bottom: 1rem;" onclick="window.print()">⬇ Download PDF Version</button>
        <button class="btn btn-outline print-hidden" style="width: 100%;" onclick="window.print()">🖨️ Print Membership Slip</button>
    </div>
</div>

<style>
@media print {
    /* Hide Everything Unnecessary */
    body { background: white !important; padding: 0 !important; margin: 0 !important; }
    .page-header, .sidebar, .topbar, .bottom-nav, .print-hidden { display: none !important; }
    .main-layout, .page-content { margin: 0 !important; padding: 0 !important; }
    
    /* Layout Adjustments */
    div[style*="max-width: 400px"] {
        margin: 0 auto !important;
        box-shadow: none !important;
        border: 2px solid #000 !important;
        transform: scale(0.9);
        transform-origin: top center;
    }
    
    /* Force Background Colors */
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
}
</style>

<?php require APPROOT . '/Views/inc/users/footer.php'; ?>
