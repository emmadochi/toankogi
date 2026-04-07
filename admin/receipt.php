<?php include 'layouts/header.php'; 

// Fetch data from GET parameters
$transaction_id = $_GET['trx'] ?? 'TRX-' . rand(10000, 99999) . '-KOGI';
$member_id = $_GET['id'] ?? 'KOG-LOK-00124';
$member_name = $_GET['name'] ?? 'Ameh Sunday';
$plate_no = $_GET['plate'] ?? 'LKJ-123-AB';
$lga = $_GET['lga'] ?? 'Lokoja';
$unit = $_GET['unit'] ?? 'Central Park';
?>

<div class="page-header" style="flex-wrap: wrap; gap: 1.5rem;">
    <div style="display: flex; gap: 0.8rem; align-items: center;">
        <a href="index.php" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 1.2rem;">←</a>
        <div>
            <h1 class="page-title">Digital Receipt</h1>
            <p class="page-subtitle" style="font-family: monospace; font-size: 0.8rem;">#<?php echo $transaction_id; ?></p>
        </div>
    </div>
    <div style="display: flex; gap: 0.8rem; width: 100%; justify-content: flex-start;">
        <button class="btn btn-outline" onclick="window.print()" style="flex: 1; font-size: 0.85rem; padding: 0.8rem;">🖨️ Print</button>
        <button class="btn btn-primary" style="flex: 1; font-size: 0.85rem; padding: 0.8rem;">📩 Download</button>
    </div>
</div>

<div style="display: flex; justify-content: center; padding: 1.5rem 0 3rem;">
    <!-- The Receipt Container -->
    <div id="printable-receipt" style="max-width: 450px; width: 100%; background: white; padding: 2.5rem 1.5rem; border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); border: 1px solid var(--glass-border); position: relative; overflow: hidden; margin: 0 auto;">
        
        <!-- Decorative Header -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 8px; background: var(--primary);"></div>
        
        <!-- Association Branding -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <img src="../images/logo.jpeg" alt="Logo" style="height: 50px; margin-bottom: 1rem; border-radius: 8px;">
            <h2 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 0.2rem; color: var(--dark);">TOAN KOGI STATE</h2>
            <p style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700;">Official Revenue Receipt</p>
        </div>

        <!-- Success Badge -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 50px; height: 50px; background: #ecfdf5; color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.25rem; border: 1px solid rgba(5, 150, 105, 0.2);">✓</div>
            <h3 style="font-size: 1.75rem; font-weight: 800; margin: 0; color: var(--dark);">₦200.00</h3>
            <p style="font-size: 0.8rem; color: var(--primary); font-weight: 700; text-transform: uppercase;">Payment Confirmed</p>
        </div>

        <!-- Transaction Details -->
        <div style="border-top: 1px dashed #e2e8f0; border-bottom: 1px dashed #e2e8f0; padding: 1.5rem 0; margin-bottom: 2rem;">
            <div class="receipt-row" style="display: flex; justify-content: space-between; margin-bottom: 0.8rem;">
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Member Name</span>
                <span style="font-size: 0.75rem; font-weight: 700; text-align: right;"><?php echo $member_name; ?></span>
            </div>
            <div class="receipt-row" style="display: flex; justify-content: space-between; margin-bottom: 0.8rem;">
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Unique ID</span>
                <span style="font-size: 0.75rem; font-weight: 800; color: var(--primary); font-family: monospace;"><?php echo $member_id; ?></span>
            </div>
            <div class="receipt-row" style="display: flex; justify-content: space-between; margin-bottom: 0.8rem;">
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Plate Number</span>
                <span style="font-size: 0.75rem; font-weight: 700;"><?php echo $plate_no; ?></span>
            </div>
            <div class="receipt-row" style="display: flex; justify-content: space-between; margin-bottom: 0.8rem;">
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">LGA / Unit</span>
                <span style="font-size: 0.75rem; font-weight: 700; text-align: right;"><?php echo $lga; ?> / <?php echo $unit; ?></span>
            </div>
            <div class="receipt-row" style="display: flex; justify-content: space-between; margin-bottom: 0.8rem;">
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Payment Cycle</span>
                <span style="font-size: 0.75rem; font-weight: 700; background: var(--bg-alt); padding: 2px 8px; border-radius: 4px; border: 1px solid var(--glass-border);">Daily Tax</span>
            </div>
            <div class="receipt-row" style="display: flex; justify-content: space-between;">
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Processed On</span>
                <span style="font-size: 0.75rem; font-weight: 700;"><?php echo date('d M Y, h:i A'); ?></span>
            </div>
        </div>

        <!-- Verification Section -->
        <div style="display: flex; gap: 1rem; align-items: center; background: #fafafa; padding: 1.25rem; border-radius: 12px; border: 1px solid #f1f1f1;">
            <div id="receipt-qrcode" style="width: 70px; height: 70px; background: white; padding: 4px; border-radius: 6px; flex-shrink: 0;">
                <!-- Real QR -->
            </div>
            <div style="flex: 1;">
                <p style="font-size: 0.65rem; font-weight: 800; margin-bottom: 0.2rem; text-transform: uppercase;">Security Verification</p>
                <p style="font-size: 0.6rem; color: var(--text-muted); line-height: 1.5; font-weight: 500;">Field agents can scan this code to verify authenticity instantly.</p>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 2rem;">
            <p style="font-size: 0.65rem; color: var(--text-muted); font-style: italic; margin-bottom: 0.5rem;">Digital copy. No signature required.</p>
            <p style="font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px;">KOGI STATE REVENUE APP</p>
        </div>

    </div>
</div>

<style>
@media print {
    .page-header, .sidebar, .topbar, .bottom-nav { display: none !important; }
    body { background: white !important; padding: 0 !important; margin: 0 !important; }
    .main-content { padding: 0 !important; margin: 0 !important; }
    #printable-receipt { 
        box-shadow: none !important; 
        border: 1px solid #eee !important; 
        max-width: 400px !important;
        margin: 20px auto !important;
    }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrcodeElement = document.getElementById("receipt-qrcode");
    qrcodeElement.innerHTML = "";
    
    new QRCode(qrcodeElement, {
        text: "RECEIPT:<?php echo $transaction_id; ?>|MEMBER:<?php echo $member_id; ?>",
        width: 68,
        height: 68,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
});
</script>

<?php include 'layouts/footer.php'; ?>
