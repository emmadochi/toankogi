<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<?php
$transaction = $data['transaction'];
?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; gap: 1rem; align-items: center;">
        <a href="<?php echo URLROOT; ?>/admin/revenue" style="text-decoration: none; font-size: 1.5rem; color: var(--text-muted); padding: 0.5rem;">←</a>
        <div>
            <h1 class="page-title">Digital Receipt Preview</h1>
            <p class="page-subtitle">Transaction ID: #<?php echo $transaction->receipt_number; ?></p>
        </div>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-outline" onclick="window.print()">🖨️ Print Receipt</button>
        <button class="btn btn-primary" onclick="downloadReceipt()">📥 Download PDF</button>
    </div>
</div>

<div style="display: flex; justify-content: center; padding: 2rem 0;">
    <!-- The Receipt Container -->
    <div id="printable-receipt" style="width: 450px; background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); border: 1px solid var(--glass-border); position: relative; overflow: hidden;">
        
        <!-- Decorative Header -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 8px; background: linear-gradient(90deg, var(--primary), var(--secondary));"></div>
        
        <!-- Association Branding -->
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="TOAN Logo" style="height: 60px; margin-bottom: 1rem; border-radius: 8px;">
            <h2 style="font-size: 1.25rem; margin-bottom: 0.2rem; color: var(--dark);">TOAN KOGI STATE</h2>
            <p style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Official Revenue Receipt</p>
        </div>

        <!-- Success Badge -->
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div style="width: 60px; height: 60px; background: #ecfdf5; color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem;">✓</div>
            <h3 style="font-size: 1.5rem; font-weight: 700; margin: 0;">₦<?php echo number_format($transaction->amount, 2); ?></h3>
            <p style="font-size: 0.85rem; color: var(--primary); font-weight: 600;">Payment Successful</p>
        </div>

        <!-- Transaction Details -->
        <div style="border-top: 1px dashed var(--glass-border); border-bottom: 1px dashed var(--glass-border); padding: 1.5rem 0; margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Member Name</span>
                <span style="font-size: 0.85rem; font-weight: 700;"><?php echo $transaction->member_name; ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Unique ID</span>
                <span style="font-size: 0.85rem; font-weight: 700; color: var(--primary);"><?php echo $transaction->unique_id ?? 'N/A'; ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Plate Number</span>
                <span style="font-size: 0.85rem; font-weight: 700;"><?php echo $transaction->plate_number; ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">LGA / Unit</span>
                <span style="font-size: 0.85rem; font-weight: 700;"><?php echo $transaction->lga_name; ?> / <?php echo $transaction->unit_name; ?></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Payment Cycle</span>
                <span style="font-size: 0.85rem; font-weight: 700; background: var(--bg-alt); padding: 2px 8px; border-radius: 4px;"><?php echo ucwords($transaction->payment_type); ?></span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Date & Time</span>
                <span style="font-size: 0.85rem; font-weight: 700;"><?php echo date('d M Y, h:i A', strtotime($transaction->payment_date)); ?></span>
            </div>
        </div>

        <!-- Verification Section -->
        <div style="display: flex; gap: 1.5rem; align-items: center; background: var(--bg-alt); padding: 1.25rem; border-radius: 12px;">
            <div id="receipt-qrcode" style="width: 80px; height: 80px; background: white; padding: 6px; border-radius: 8px;">
                <!-- Real QR will be rendered here -->
            </div>
            <div style="flex: 1;">
                <p style="font-size: 0.75rem; font-weight: 700; margin-bottom: 0.3rem;">SECURITY VERIFICATION</p>
                <p style="font-size: 0.7rem; color: var(--text-muted); line-height: 1.4;">Field agents can scan this code to instantly verify the authenticity of this digital receipt.</p>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 2.5rem;">
            <p style="font-size: 0.7rem; color: var(--text-muted); font-style: italic;">This is a computer-generated receipt. No signature required.</p>
            <p style="font-size: 0.8rem; font-weight: 700; color: var(--primary); margin-top: 0.5rem;">BUILDING KOGI TOGETHER</p>
        </div>

    </div>
</div>

<style>
@media print {
    .page-header, .sidebar, .topbar { display: none !important; }
    #printable-receipt { 
        box-shadow: none !important; 
        border: none !important; 
        width: 100% !important; 
        padding: 0 !important;
    }
    body { background: white !important; }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrcodeElement = document.getElementById("receipt-qrcode");
    qrcodeElement.innerHTML = "";
    
    new QRCode(qrcodeElement, {
        text: "RECEIPT:<?php echo $transaction->receipt_number; ?>|MEMBER:<?php echo $transaction->unique_id; ?>",
        width: 68,
        height: 68,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
});

async function downloadReceipt() {
    const { jsPDF } = window.jspdf;
    const receipt = document.getElementById('printable-receipt');
    const options = {
        scale: 3, // Higher scale for better quality
        useCORS: true,
        backgroundColor: '#ffffff'
    };

    try {
        const canvas = await html2canvas(receipt, options);
        const imgData = canvas.toDataURL('image/png');
        
        const pdf = new jsPDF({
            orientation: 'p',
            unit: 'mm',
            format: [canvas.width / 4, canvas.height / 4] // Fit PDF to canvas size
        });

        pdf.addImage(imgData, 'PNG', 0, 0, pdf.internal.pageSize.getWidth(), pdf.internal.pageSize.getHeight());
        pdf.save('TOAN_Receipt_<?php echo $transaction->receipt_number; ?>.pdf');
    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('Could not generate PDF. Please try the Print option instead.');
    }
}
</script>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
