<?php include 'layouts/header.php'; 

// Dummy member data for preview (similar to id_card.php)
$member_id = $_GET['id'] ?? 'KOG-LOK-00124';
$member_name = $_GET['name'] ?? 'Ameh Sunday';
$plate_no = $_GET['plate'] ?? 'LKJ-123-AB';
$lga = $_GET['lga'] ?? 'Lokoja';
$unit = $_GET['unit'] ?? 'Central Park';
$expiry = $_GET['expiry'] ?? '2026-03-26';
?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; gap: 1rem; align-items: center;">
        <a href="registration_success.php" style="text-decoration: none; font-size: 1.5rem; color: var(--text-muted); padding: 0.5rem;">←</a>
        <div>
            <h1 class="page-title">Vehicle Sticker (Keke Pass)</h1>
            <p class="page-subtitle">Official transit authorization for Kogi State tricycles.</p>
        </div>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-outline" onclick="window.print()">🖨️ Print Sticker</button>
        <button class="btn btn-primary">📩 Download Image</button>
    </div>
</div>

<div style="display: flex; justify-content: center; padding: 4rem 0;">
    <!-- The Sticker Container (Landscape) -->
    <div id="keke-sticker" style="width: 600px; height: 380px; background: white; border-radius: 15px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); border: 2px solid #eee; position: relative; overflow: hidden; display: flex; flex-direction: column;">
        
        <!-- Top Branding Bar (Green) -->
        <div style="background: #059669; color: white; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <img src="../images/logo.jpeg" alt="TOAN" style="height: 45px; border-radius: 6px; background: white; padding: 2px;">
                <div>
                    <h2 style="font-size: 1.1rem; font-weight: 800; margin: 0; letter-spacing: 1px;">TOAN KOGI STATE</h2>
                    <p style="font-size: 0.6rem; margin: 0; opacity: 0.9; font-weight: 600;">TRICYCLE OWNERS ASSOCIATION OF NIGERIA</p>
                </div>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 0.8rem; font-weight: 800; border: 1.5px solid white; padding: 4px 10px; border-radius: 6px;">VEHICLE PASS</div>
            </div>
        </div>

        <!-- Kogi Stripe (Yellow & Red) -->
        <div style="display: flex; height: 8px;">
            <div style="flex: 1; background: #fbbf24;"></div>
            <div style="flex: 1; background: #ef4444;"></div>
        </div>

        <!-- Main Content Area -->
        <div style="flex: 1; display: grid; grid-template-columns: 1.2fr 1fr; padding: 1.5rem 2rem; gap: 1.5rem;">
            
            <!-- Left Side: Member & Vehicle Info -->
            <div style="display: flex; flex-direction: column; justify-content: center; gap: 1rem;">
                <div>
                    <label style="display: block; font-size: 0.7rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin-bottom: 2px;">Plate Number</label>
                    <div style="font-size: 2.8rem; font-weight: 900; color: #0f172a; line-height: 1; letter-spacing: -1px;"><?php echo $plate_no; ?></div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; border-top: 1px solid #f1f5f9; padding-top: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.65rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Member ID</label>
                        <p style="font-size: 0.9rem; font-weight: 700; color: #059669; font-family: monospace;"><?php echo $member_id; ?></p>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.65rem; color: #64748b; font-weight: 700; text-transform: uppercase;">LGA / Unit</label>
                        <p style="font-size: 0.85rem; font-weight: 700; color: #334155;"><?php echo $lga; ?>/<?php echo substr($unit, 0, 8); ?></p>
                    </div>
                </div>
            </div>

            <!-- Right Side: QR Code & Verification -->
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; background: #f8fafc; border-radius: 12px; padding: 1.25rem; border: 1px solid #e2e8f0;">
                <div id="qrcode" style="width: 140px; height: 140px; background: white; padding: 10px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
                    <!-- Real QR will be rendered here -->
                    <div style="width: 100%; height: 100%; background: linear-gradient(45deg, #000 25%, transparent 25%, transparent 50%, #000 50%, #000 75%, transparent 75%, transparent); background-size: 10px 10px; opacity: 0.2;"></div>
                </div>
                <p style="font-size: 0.65rem; font-weight: 800; color: #0f172a; text-align: center; margin-bottom: 2px;">SCAN TO VERIFY</p>
                <p style="font-size: 0.55rem; color: #64748b; text-align: center;">Official Road Enforcement Scan</p>
            </div>

        </div>

        <!-- Expiry Bar (Red) -->
        <div style="background: #fee2e2; color: #b91c1c; padding: 0.6rem 1.5rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #fecaca;">
            <div style="font-size: 0.7rem; font-weight: 700;">VALID UNTIL: <span style="font-size: 0.85rem;"><?php echo $expiry; ?></span></div>
            <div style="font-size: 0.6rem; font-weight: 600; opacity: 0.7;">FEDERAL REPUBLIC OF NIGERIA | KOGI STATE</div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Generate actual QR Code
    const qrcodeElement = document.getElementById("qrcode");
    qrcodeElement.innerHTML = ""; // Clear placeholder
    
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
    body { background: white !important; font-family: 'Outfit', sans-serif !important; }
    #keke-sticker { 
        box-shadow: none !important; 
        border: 1.5px solid #000 !important;
        margin: 0 auto;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}
</style>

<?php include 'layouts/footer.php'; ?>
