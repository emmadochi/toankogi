<?php include 'layouts/header.php'; 

// Fetch data from GET parameters for dynamic preview
$member_id = $_GET['id'] ?? 'KOG-LOK-' . rand(10000, 99999);
$member_name = $_GET['name'] ?? 'Ameh Sunday';
$plate_no = $_GET['plate'] ?? 'LKJ-123-AB';
$lga = $_GET['lga'] ?? 'Lokoja';
$unit = $_GET['unit'] ?? 'Central Park';
$status = $_GET['status'] ?? 'Verified';
$expiry = $_GET['expiry'] ?? date('Y-m-d', strtotime('+1 year'));
?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; gap: 1rem; align-items: center;">
        <a href="members.php" style="text-decoration: none; font-size: 1.5rem; color: var(--text-muted); padding: 0.5rem;">←</a>
        <div>
            <h1 class="page-title">Member ID Card</h1>
            <p class="page-subtitle">Official Digital Identity for TOAN Kogi State</p>
        </div>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-outline" onclick="window.print()">🖨️ Print ID Card</button>
        <button class="btn btn-primary">📩 Download Digital Copy</button>
    </div>
</div>

<div style="display: flex; justify-content: center; padding: 3rem 0; perspective: 1000px;">
    <!-- ID Card Container -->
    <div id="id-card-render" style="width: 400px; height: 580px; background: white; border-radius: 24px; position: relative; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.12); border: 1px solid rgba(0,0,0,0.05); transform-style: preserve-3d;">
        
        <!-- Header Branding -->
        <div style="background: linear-gradient(135deg, #059669 0%, #047857 100%); padding: 1.5rem; text-align: center; color: white;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 0.5rem;">
                <img src="../images/logo.jpeg" alt="TOAN Logo" style="height: 40px; border-radius: 4px; background: white; padding: 2px;">
                <div style="text-align: left;">
                    <h2 style="font-size: 0.9rem; font-weight: 800; letter-spacing: 0.5px; margin: 0;">TOAN KOGI STATE</h2>
                    <p style="font-size: 0.6rem; opacity: 0.9; margin: 0; font-weight: 600;">TRICYCLE OWNERS ASSOCIATION OF NIGERIA</p>
                </div>
            </div>
        </div>

        <!-- Decorative Stripes (Kogi Colors: Green, Yellow, Red) -->
        <div style="display: flex; height: 6px;">
            <div style="flex: 1; background: #059669;"></div>
            <div style="flex: 1; background: #fbbf24;"></div>
            <div style="flex: 1; background: #ef4444;"></div>
        </div>

        <div style="padding: 2rem; display: flex; flex-direction: column; align-items: center;">
            <!-- Photo Section -->
            <div style="width: 140px; height: 140px; border-radius: 12px; border: 4px solid white; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; background: #f1f5f9; margin-bottom: 1.5rem; position: relative;">
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 4rem;">👤</div>
                <div style="position: absolute; bottom: 0; width: 100%; background: rgba(5, 150, 105, 0.9); color: white; font-size: 0.6rem; text-align: center; padding: 4px 0; font-weight: 700;">ACTIVE MEMBER</div>
            </div>

            <!-- Member Info -->
            <h3 style="font-size: 1.5rem; font-weight: 800; color: var(--dark); margin-bottom: 0.2rem;"><?php echo $member_name; ?></h3>
            <p style="font-size: 0.85rem; color: var(--primary); font-weight: 700; font-family: monospace; letter-spacing: 1px; margin-bottom: 2rem;"><?php echo $member_id; ?></p>

            <!-- Details Grid -->
            <div style="width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 0.3rem;">Plate Number</label>
                    <p style="font-size: 0.9rem; font-weight: 700; color: var(--dark);"><?php echo $plate_no; ?></p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 0.3rem;">LGA / Unit</label>
                    <p style="font-size: 0.9rem; font-weight: 700; color: var(--dark);"><?php echo $lga; ?> / <?php echo $unit; ?></p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 0.3rem;">Valid Until</label>
                    <p style="font-size: 0.9rem; font-weight: 700; color: #ef4444;"><?php echo $expiry; ?></p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 0.3rem;">Membership</label>
                    <p style="font-size: 0.9rem; font-weight: 700; color: #059669;">Verified</p>
                </div>
            </div>

            <!-- Security QR and Signature Area -->
            <div style="width: 100%; border-top: 1px dashed var(--glass-border); padding-top: 1.5rem; display: flex; justify-content: space-between; align-items: flex-end;">
                <div style="text-align: left;">
                    <p style="font-size: 0.6rem; color: var(--text-muted); margin-bottom: 0.5rem; font-style: italic;">Authorized Signature</p>
                    <div style="width: 120px; height: 30px; border-bottom: 1px solid var(--dark); opacity: 0.3;"></div>
                    <p style="font-size: 0.55rem; font-weight: 700; margin-top: 4px; color: var(--dark-alt);">STATE CHAIRMAN, TOAN KOGI</p>
                </div>
                <div id="id-qrcode" style="width: 80px; height: 80px; background: white; padding: 5px; border: 1px solid var(--glass-border); border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                    <!-- Real QR will be rendered here -->
                    <div style="width: 100%; height: 100%; background: linear-gradient(45deg, #000 25%, transparent 25%, transparent 50%, #000 50%, #000 75%, transparent 75%, transparent); background-size: 6px 6px; opacity: 0.2;"></div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="position: absolute; bottom: 0; width: 100%; padding: 0.75rem; text-align: center; background: var(--bg-alt); border-top: 1px solid var(--glass-border);">
            <p style="font-size: 0.6rem; color: var(--text-muted); font-weight: 600;">SCAN FOR VERIFICATION | www.toankogi.org</p>
        </div>
    </div>
</div>

<style>
@media print {
    .page-header, .sidebar, .topbar { display: none !important; }
    body { background: white !important; padding: 0 !important; margin: 0 !important; }
    #id-card-render { 
        box-shadow: none !important; 
        border: 1px solid #eee !important;
        transform: scale(1) !important;
        margin: 0 auto;
    }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrcodeElement = document.getElementById("id-qrcode");
    qrcodeElement.innerHTML = "";
    
    new QRCode(qrcodeElement, {
        text: "MEMBER:<?php echo $member_id; ?>|NAME:<?php echo $member_name; ?>",
        width: 68,
        height: 68,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
});
</script>

<?php include 'layouts/footer.php'; ?>
