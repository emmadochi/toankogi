<?php include 'layouts/header.php'; ?>

<div class="page-header" style="text-align: center; max-width: 600px; margin: 0 auto 3rem;">
    <h1 class="page-title">Agent Verification System</h1>
    <p class="page-subtitle">Instantly verify tricycle status by Plate Number or Unique ID.</p>
</div>

<div style="max-width: 800px; margin: 0 auto;">
    <!-- Search Interface -->
    <div class="card" style="margin-bottom: 2rem; padding: 2.5rem; text-align: center;">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Enter Identification</h3>
        <div style="display: flex; gap: 1rem; max-width: 500px; margin: 0 auto;">
            <input type="text" placeholder="e.g. LKJ-123-AB or KOG-LOK-001" style="flex: 1; padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border); outline: none; font-size: 1.1rem; text-align: center; font-family: inherit;">
            <button class="btn btn-primary" style="padding: 0 2rem;">Verify</button>
        </div>
        <p style="margin-top: 1rem; font-size: 0.85rem; color: var(--text-muted);">Agents: Ensure you cross-check physical plate number with system results.</p>
    </div>

    <!-- Results (Dummy Hidden/Visible) -->
    <div id="verification-result">
        <div class="card" style="border-left: 8px solid #ef4444; overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
                <div>
                    <span class="status-check owing" style="padding: 0.5rem 1rem; font-size: 0.9rem; margin-bottom: 1rem; display: inline-block;">STATUS: OWING TAX</span>
                    <h2 style="font-size: 1.5rem;">Ameh Sunday</h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">ID: KOG-LOK-01-00124 | Plate: LKJ-123-AB</p>
                </div>
                <div style="width: 80px; height: 80px; background: var(--bg-alt); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">👤</div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-alt); border-radius: 15px;">
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Last Payment</label>
                    <p style="font-weight: 600;">18 March 2026</p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Payment Cycle</label>
                    <p style="font-weight: 600;">Daily Tax (₦200)</p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Days Owed</label>
                    <p style="font-weight: 700; color: #ef4444;">7 Days</p>
                </div>
            </div>

            <div style="display: flex; gap: 1rem;">
                <button class="btn btn-primary" style="flex: 2; padding: 1.2rem;">Record New Payment (₦1,400)</button>
                <button class="btn btn-outline" style="flex: 1; padding: 1.2rem;">View Full History</button>
            </div>
        </div>
    </div>

    <!-- Quick Info -->
    <div style="margin-top: 3rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <div class="card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem;">
            <div style="font-size: 2rem;">📱</div>
            <div>
                <h4 style="font-size: 0.9rem;">Mobile Optimized</h4>
                <p style="font-size: 0.8rem; color: var(--text-muted);">Specifically designed for easy use by agents on the field.</p>
            </div>
        </div>
        <div class="card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem;">
            <div style="font-size: 2rem;">🛡️</div>
            <div>
                <h4 style="font-size: 0.9rem;">Fraud Protection</h4>
                <p style="font-size: 0.8rem; color: var(--text-muted);">Unique ID verification eliminates fake paper receipts.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
