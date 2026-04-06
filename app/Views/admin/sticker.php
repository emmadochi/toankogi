<?php require APPROOT . '/Views/inc/admin/header.php'; 

$member = $data['member'];
$member_id = $member->unique_id;
$member_name = $member->fullname;
$plate_no = $member->plate_number;
$lga = $member->lga_name;
$unit = $member->unit_name;
$expiry = $data['expiry'];
?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div style="display: flex; gap: 1rem; align-items: center;">
        <a href="<?php echo URLROOT; ?>/admin/members" style="text-decoration: none; font-size: 1.5rem; color: var(--text-muted); padding: 0.5rem;">←</a>
        <div>
            <h1 class="page-title">Vehicle Registration Sticker</h1>
            <p class="page-subtitle">Official 2026 Vehicle Pass for Kogi State tricycles.</p>
        </div>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-outline" onclick="window.print()">🖨️ Print Sticker</button>
    </div>
</div>

<!-- Sticker Container -->
<div style="width: 100%; padding: 2rem 0; display: flex; justify-content: center;">
    <!-- The Sticker Container (Landscape) -->
    <div id="keke-sticker" style="width: 600px; height: 380px; background: white; border-radius: 15px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); border: 1px solid var(--glass-border); position: relative; overflow: hidden; display: flex; flex-direction: column;">
        
        <!-- Top Branding Bar (Green) -->
        <div style="background: #059669; color: white; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="TOAN Logo" style="height: 45px; border-radius: 6px; background: white; padding: 2px;">
                <div>
                    <h2 style="font-size: 1.1rem; font-weight: 800; margin: 0; letter-spacing: 1px;">TOAN KOGI STATE</h2>
                    <p style="font-size: 0.65rem; margin: 0; opacity: 0.9; font-weight: 600;">TRICYCLE OWNERS ASSOCIATION OF NIGERIA</p>
                </div>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 0.8rem; font-weight: 800; border: 1.5px solid white; padding: 4px 10px; border-radius: 6px;">VEHICLE PASS</div>
            </div>
        </div>

        <!-- Kogi Stripe -->
        <div style="display: flex; height: 8px;">
            <div style="flex: 1; background: #fbbf24;"></div>
            <div style="flex: 1; background: #ef4444;"></div>
        </div>

        <!-- Main Content Area -->
        <div style="flex: 1; display: grid; grid-template-columns: 1.2fr 1fr; padding: 1.5rem 2rem; gap: 1.5rem; background: white;">
            
            <!-- Left Side: Member & Vehicle Info -->
            <div style="display: flex; flex-direction: column; justify-content: center; gap: 1rem;">
                <div>
                    <label style="display: block; font-size: 0.75rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin-bottom: 2px;">Plate Number</label>
                    <div style="font-size: 2.8rem; font-weight: 900; color: #0f172a; line-height: 1; letter-spacing: -1px;"><?php echo $plate_no; ?></div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; border-top: 1px solid #f1f5f9; padding-top: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.7rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Member ID</label>
                        <p style="font-size: 0.95rem; font-weight: 700; color: #059669; font-family: monospace;"><?php echo $member_id; ?></p>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.7rem; color: #64748b; font-weight: 700; text-transform: uppercase;">LGA / Unit</label>
                        <p style="font-size: 0.9rem; font-weight: 700; color: #334155;"><?php echo $lga; ?> / <?php echo $unit; ?></p>
                    </div>
                </div>
            </div>

            <!-- Right Side: QR Code & Verification -->
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; background: #f8fafc; border-radius: 12px; padding: 1.25rem; border: 1px solid #e2e8f0;">
                <div id="sticker-qrcode" style="width: 140px; height: 140px; background: white; padding: 10px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
                    <!-- Real QR will be rendered here -->
                </div>
                <p style="font-size: 0.7rem; font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 2px;">SCAN TO VERIFY</p>
                <p style="font-size: 0.6rem; color: #64748b; text-align: center;">Official Road Enforcement Scan</p>
            </div>
        </div>

        <!-- Expiry Bar (Red) -->
        <div style="background: #fee2e2; color: #b91c1c; padding: 0.8rem 1.5rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #fecaca;">
            <div style="font-size: 0.75rem; font-weight: 700;">VALID UNTIL: <span style="font-size: 0.9rem;"><?php echo $expiry; ?></span></div>
            <div style="font-size: 0.65rem; font-weight: 600; opacity: 0.7;">FEDERAL REPUBLIC OF NIGERIA | KOGI STATE</div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrcodeElement = document.getElementById("sticker-qrcode");
    new QRCode(qrcodeElement, {
        text: "VERIFY:<?php echo $member_id; ?>|<?php echo $plate_no; ?>",
        width: 120,
        height: 120,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
});
</script>

<style>
@media print {
    .page-header, .sidebar, .topbar { display: none !important; }
    body { background: white !important; }
    #keke-sticker { 
        box-shadow: none !important; 
        border: 1.5px solid #000 !important;
        margin: 2rem auto;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}
</style>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>

<style>
@media print {
    .page-header, .sidebar, .topbar { display: none !important; }
    body { background: white !important; }
    #printable-sticker { 
        box-shadow: none !important; 
        position: absolute;
        top: 0;
        left: 0;
        -webkit-print-color-adjust: exact;
    }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrcodeElement = document.getElementById("sticker-qrcode");
    qrcodeElement.innerHTML = "";
    
    new QRCode(qrcodeElement, {
        text: "MEMBER:<?php echo $member->unique_id; ?>|PLATE:<?php echo $member->plate_number; ?>",
        width: 44,
        height: 44,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
});
</script>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
