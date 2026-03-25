<?php include 'layouts/header.php'; ?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; gap: 1rem; align-items: center;">
        <a href="revenue.php" style="text-decoration: none; font-size: 1.5rem; color: var(--text-muted); padding: 0.5rem;">←</a>
        <div>
            <h1 class="page-title">Digital Receipt Preview</h1>
            <p class="page-subtitle">Transaction ID: #TRX-99284-KOGI</p>
        </div>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="btn btn-outline" onclick="window.print()">🖨️ Print Receipt</button>
        <button class="btn btn-primary">📩 Download PDF</button>
    </div>
</div>

<div style="display: flex; justify-content: center; padding: 2rem 0;">
    <!-- The Receipt Container -->
    <div id="printable-receipt" style="width: 450px; background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); border: 1px solid var(--glass-border); position: relative; overflow: hidden;">
        
        <!-- Decorative Header -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 8px; background: linear-gradient(90deg, var(--primary), var(--secondary));"></div>
        
        <!-- Association Branding -->
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <img src="../images/logo.jpeg" alt="TOAN Logo" style="height: 60px; margin-bottom: 1rem; border-radius: 8px;">
            <h2 style="font-size: 1.25rem; margin-bottom: 0.2rem; color: var(--dark);">TOAN KOGI STATE</h2>
            <p style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Official Revenue Receipt</p>
        </div>

        <!-- Success Badge -->
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div style="width: 60px; height: 60px; background: #ecfdf5; color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem;">✓</div>
            <h3 style="font-size: 1.5rem; font-weight: 700; margin: 0;">₦200.00</h3>
            <p style="font-size: 0.85rem; color: var(--primary); font-weight: 600;">Payment Successful</p>
        </div>

        <!-- Transaction Details -->
        <div style="border-top: 1px dashed var(--glass-border); border-bottom: 1px dashed var(--glass-border); padding: 1.5rem 0; margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Member Name</span>
                <span style="font-size: 0.85rem; font-weight: 700;">Ameh Sunday</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Unique ID</span>
                <span style="font-size: 0.85rem; font-weight: 700; color: var(--primary);">KOG-LOK-01-00124</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Plate Number</span>
                <span style="font-size: 0.85rem; font-weight: 700;">LKJ-123-AB</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">LGA / Unit</span>
                <span style="font-size: 0.85rem; font-weight: 700;">Lokoja / Central Park</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Payment Cycle</span>
                <span style="font-size: 0.85rem; font-weight: 700; background: var(--bg-alt); padding: 2px 8px; border-radius: 4px;">Daily Tax</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="font-size: 0.85rem; color: var(--text-muted);">Date & Time</span>
                <span style="font-size: 0.85rem; font-weight: 700;"><?php echo date('d M Y, h:i A'); ?></span>
            </div>
        </div>

        <!-- Verification Section -->
        <div style="display: flex; gap: 1.5rem; align-items: center; background: var(--bg-alt); padding: 1.25rem; border-radius: 12px;">
            <div style="width: 80px; height: 80px; background: white; padding: 6px; border-radius: 8px;">
                <!-- Dummy QR -->
                <div style="width: 100%; height: 100%; background: linear-gradient(45deg, #000 25%, transparent 25%, transparent 50%, #000 50%, #000 75%, transparent 75%, transparent); background-size: 8px 8px; opacity: 0.8;"></div>
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

<?php include 'layouts/footer.php'; ?>
