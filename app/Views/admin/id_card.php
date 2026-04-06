<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<?php $member = $data['member']; ?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; gap: 1rem; align-items: center;">
        <a href="<?php echo URLROOT; ?>/admin/members" style="text-decoration: none; font-size: 1.5rem; color: var(--text-muted); padding: 0.5rem;">←</a>
        <div>
            <h1 class="page-title">Digital ID Card</h1>
            <p class="page-subtitle">Present this card for quick member verification.</p>
        </div>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-outline" onclick="window.print()">🖨️ Print ID Card</button>
    </div>
</div>

<div style="display: flex; align-items: flex-start; gap: 3rem; flex-wrap: wrap;">
    <!-- The ID Card Visual -->
    <div id="printable-id-card" style="width: 100%; max-width: 400px; background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.1); border: 1px solid var(--glass-border); position: relative;">
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

            <!-- QR Verification -->
            <div style="padding: 1rem; background: #fff; border: 1px solid #eee; border-radius: 12px; margin-bottom: 1.5rem;">
                <div id="id-qrcode" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;"></div>
            </div>

            <div style="padding: 0.5rem 1.5rem; background: #d1fae5; color: #059669; border-radius: 50px; font-weight: 700; font-size: 0.8rem;">
                ✓ <?php echo strtoupper($member->status); ?>
            </div>
        </div>
        <!-- Footer Stripe -->
        <div style="height: 10px; display: flex;">
            <div style="flex: 1; background: #059669;"></div>
            <div style="flex: 1; background: #f59e0b;"></div>
            <div style="flex: 1; background: #ef4444;"></div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrcodeElement = document.getElementById("id-qrcode");
    new QRCode(qrcodeElement, {
        text: "MEMBER:<?php echo $member->unique_id; ?>",
        width: 80,
        height: 80,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
});
</script>

<style>
@media print {
    .page-header, .sidebar, .topbar { display: none !important; }
    #printable-id-card { 
        box-shadow: none !important; 
        border: 1px solid #000 !important;
        margin: 0 auto;
        -webkit-print-color-adjust: exact;
    }
    body { background: white !important; }
}
</style>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
