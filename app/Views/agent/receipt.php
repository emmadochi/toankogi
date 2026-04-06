<?php require APPROOT . '/Views/inc/agent/header.php'; ?>

<div class="receipt-section" style="margin-top: 1rem; text-align: center; padding-bottom: 2rem;">
    <!-- Success Animation Header -->
    <div style="position: relative; height: 120px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
        <div style="position: absolute; width: 100px; height: 100px; background: rgba(0, 200, 83, 0.1); border-radius: 50%; animation: pulse-green 2s infinite;"></div>
        <div style="background: #00c853; width: 75px; height: 75px; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 2; box-shadow: 0 10px 25px rgba(0,200,83,0.3);">
            <span style="font-size: 2.2rem; color: white;">✓</span>
        </div>
    </div>
    
    <h2 style="font-weight: 800; color: var(--text-main); margin: 0; font-size: 1.7rem; letter-spacing: -0.8px;">Collection Success!</h2>
    <p style="color: var(--text-muted); font-size: 0.95rem; margin: 8px 0 2rem 0; font-weight: 500;">Digital tax receipt ready for verification.</p>

    <!-- Receipt Card (Premium "Glass Paper" Look) -->
    <div id="receipt-card" class="card-mobile" style="margin: 0; padding: 0; text-align: left; overflow: hidden; border: none; background: #ffffff; color: #1a1a1a; box-shadow: 0 30px 60px rgba(0,0,0,0.15); border-radius: 32px;">
        <!-- Receipt Top Accent -->
        <div style="height: 12px; background: linear-gradient(90deg, #00c853, #64ffda);"></div>

        <!-- Receipt Header -->
        <div style="padding: 2rem 1.5rem; text-align: center; background: radial-gradient(circle at top right, #fafafa, #ffffff);">
            <p style="font-weight: 900; font-size: 1.3rem; margin: 0; letter-spacing: 1px; color: #000;">KOGI STATE REV.</p>
            <div style="display: inline-block; padding: 4px 12px; background: #f0f0f0; border-radius: 20px; margin-top: 8px;">
                <p style="font-size: 0.65rem; color: #666; margin: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Official E-Receipt</p>
            </div>
        </div>

        <!-- Receipt Body -->
        <div style="padding: 0 2rem 2rem 2rem;">
            <!-- Amount Section -->
            <div style="text-align: center; margin-bottom: 2.5rem; padding: 2rem; background: #f8f9fa; border-radius: 24px; position: relative;">
                <p style="font-size: 0.75rem; color: #8a8a8a; margin: 0; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;">Amount Collected</p>
                <div style="display: flex; align-items: baseline; justify-content: center; gap: 4px; margin-top: 5px;">
                    <span style="font-size: 1.8rem; font-weight: 800; color: #00c853;">₦</span>
                    <h1 style="font-size: 4rem; font-weight: 900; margin: 0; color: #1a1a1a; letter-spacing: -2px;"><?php echo number_format($data['tx']->amount, 0); ?></h1>
                </div>
            </div>

            <!-- Details List -->
            <div style="display: grid; grid-template-columns: 1fr; gap: 18px; margin-bottom: 2.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                    <span style="font-size: 0.75rem; color: #999; font-weight: 600; text-transform: uppercase;">Receipt No</span>
                    <span style="font-size: 0.85rem; font-weight: 800; color: #1a1a1a; font-family: 'Courier New', Courier, monospace;"><?php echo $data['tx']->receipt_number; ?></span>
                </div>
                
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                    <span style="font-size: 0.75rem; color: #999; font-weight: 600; text-transform: uppercase;">Operator</span>
                    <span style="font-size: 0.9rem; font-weight: 800; color: #1a1a1a;"><?php echo $data['tx']->member_name; ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                    <span style="font-size: 0.75rem; color: #999; font-weight: 600; text-transform: uppercase;">Plate No</span>
                    <span style="font-size: 0.9rem; font-weight: 800; color: #00c853; text-transform: uppercase;"><?php echo $data['tx']->plate_number; ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                    <span style="font-size: 0.75rem; color: #999; font-weight: 600; text-transform: uppercase;">Time Stamp</span>
                    <span style="font-size: 0.85rem; font-weight: 700; color: #1a1a1a;"><?php echo date('d M Y | h:i A', strtotime($data['tx']->payment_date)); ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                    <span style="font-size: 0.75rem; color: #999; font-weight: 600; text-transform: uppercase;">Category</span>
                    <span style="font-size: 0.85rem; font-weight: 800; color: #1a1a1a; text-transform: uppercase;"><?php echo $data['tx']->payment_type; ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.75rem; color: #999; font-weight: 600; text-transform: uppercase;">Agent</span>
                    <span style="font-size: 0.85rem; font-weight: 700; color: #1a1a1a;"><?php echo explode(' ', $data['tx']->agent_name)[0]; ?> (ID: <?php echo $_SESSION['user_id']; ?>)</span>
                </div>
            </div>

            <!-- Security QR Code -->
            <div style="text-align: center; padding-top: 1rem;">
                <div style="width: 140px; height: 140px; background: white; margin: 0 auto; padding: 10px; border: 1px solid #f0f0f0; border-radius: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(0,0,0,0.05); position: relative;">
                   <div id="receipt-qrcode"></div>
                   <p style="position: absolute; font-size: 0.45rem; font-weight: 900; color: #000; background: #fff; padding: 2px 6px; border: 1px solid #000; bottom: -5px;">VERIFIED</p>
                </div>
                <p style="font-size: 0.6rem; color: #aaa; margin-top: 15px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;">Encrypted Security Token</p>
            </div>
        </div>

        <!-- Receipt Footer Tag -->
        <div style="padding: 1.5rem; background: #1a1a1a; color: #ffffff; text-align: center; border-radius: 0 0 32px 32px;">
            <p style="font-size: 0.65rem; margin: 0; font-weight: 700; letter-spacing: 1.5px; opacity: 0.8; text-transform: uppercase;">Powered by Kogi State TAMS AI</p>
        </div>
    </div>

    <!-- Actions Grid -->
    <div style="margin-top: 2.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <button class="btn-mobile" style="background: var(--glass-bg); border: 2px solid var(--glass-border); color: var(--text-main); height: 60px; font-weight: 700;" onclick="window.print()">
            <span style="font-size: 1.2rem; margin-right: 8px;">🖨️</span>
            PRINT
        </button>
        <button class="btn-mobile" style="background: var(--glass-bg); border: 2px solid var(--glass-border); color: var(--text-main); height: 60px; font-weight: 700;" onclick="downloadReceipt()">
            <span style="font-size: 1.2rem; margin-right: 8px;">📥</span>
            DOWNLOAD
        </button>
    </div>
    
    <a href="<?php echo URLROOT; ?>/agent/index" class="btn-mobile btn-primary-mobile" style="margin-top: 15px; height: 65px; box-shadow: 0 10px 25px rgba(0,161,255,0.25);">
        <span style="font-weight: 800; letter-spacing: 0.5px;">DONE & GO HOME</span>
    </a>
</div>

<style>
@keyframes pulse-green {
    0% { transform: scale(1); opacity: 0.1; }
    50% { transform: scale(1.5); opacity: 0.3; }
    100% { transform: scale(1); opacity: 0.1; }
}
@media print {
    .header-mobile, .btn-mobile, .btn-primary-mobile { display: none !important; }
    body { background: white !important; }
    .receipt-section { margin-top: 0 !important; padding: 0 !important; }
    #receipt-card { box-shadow: none !important; width: 100% !important; margin: 0 !important; }
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
        text: "RECEIPT:<?php echo $data['tx']->receipt_number; ?>|MEM:<?php echo $data['tx']->unique_id; ?>",
        width: 100,
        height: 100,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
});

async function downloadReceipt() {
    const { jsPDF } = window.jspdf;
    const receipt = document.getElementById('receipt-card');
    const options = {
        scale: 3,
        useCORS: true,
        backgroundColor: '#ffffff',
        borderRadius: 32
    };

    try {
        const canvas = await html2canvas(receipt, options);
        const imgData = canvas.toDataURL('image/png');
        
        const pdf = new jsPDF({
            orientation: 'p',
            unit: 'mm',
            format: [canvas.width / 4, canvas.height / 4]
        });

        pdf.addImage(imgData, 'PNG', 0, 0, pdf.internal.pageSize.getWidth(), pdf.internal.pageSize.getHeight());
        pdf.save('KOGI_Receipt_<?php echo $data['tx']->receipt_number; ?>.pdf');
    } catch (error) {
        console.error('Error:', error);
        alert('Download failed. Please use the Print option.');
    }
}
</script>

<?php require APPROOT . '/Views/inc/agent/footer.php'; ?>
