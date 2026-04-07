<?php include 'layouts/header.php'; ?>

<div class="page-header" style="text-align: center; margin-bottom: 2.5rem;">
    <h1 class="page-title">Agent Verification</h1>
    <p class="page-subtitle">Verify tricycle status by Plate No or Unique ID.</p>
</div>

<div class="content-grid" style="grid-template-columns: 1fr;">
    <!-- Search Interface -->
    <div class="card" style="margin-bottom: 2rem; padding: 2.5rem 1.5rem; text-align: center; border-bottom: 4px solid var(--primary);">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.2rem; font-weight: 700;">Lookup Terminal</h3>
        <div style="display: flex; gap: 0.8rem; flex-direction: column; max-width: 500px; margin: 0 auto;">
            <input type="text" placeholder="Plate No or Unique ID" class="form-input" style="text-align: center; font-size: 1.25rem; font-weight: 700; padding: 1.2rem; border-color: var(--primary);">
            <button class="btn btn-primary" style="padding: 1.2rem; font-size: 1.1rem; border-radius: 12px; font-weight: 700;">Verify Status</button>
        </div>
        <p style="margin-top: 1.25rem; font-size: 0.85rem; color: var(--text-muted); opacity: 0.8;">Agents: Cross-check physical plate with digital records.</p>
    </div>

    <!-- Results (Dummy Visibility) -->
    <div id="verification-result">
        <div class="card" style="border-left: 8px solid #ef4444; overflow: hidden; padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
                <div style="flex: 1; min-width: 200px;">
                    <span class="status-check owing" style="padding: 0.6rem 1.2rem; font-size: 0.85rem; margin-bottom: 1rem; display: inline-block; font-weight: 800;">STATUS: OWING TAX</span>
                    <h2 style="font-size: 1.6rem; font-weight: 800;">Ameh Sunday</h2>
                    <p style="color: var(--text-muted); font-size: 0.85rem; font-family: monospace;">ID: KOG-LOK-01-00124 | Plate: LKJ-123-AB</p>
                </div>
                <div style="width: 70px; height: 70px; background: var(--bg-alt); border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 2rem; border: 1px solid var(--glass-border);">👤</div>
            </div>

            <div class="admin-grid" style="margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-alt); border-radius: 15px; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));">
                <div>
                    <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; font-weight: 700;">Last Payment</label>
                    <p style="font-weight: 700; font-size: 1rem;">18 Mar 2026</p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; font-weight: 700;">Cycle</label>
                    <p style="font-weight: 700; font-size: 1rem;">Daily (₦200)</p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; font-weight: 700;">Days Owed</label>
                    <p style="font-weight: 800; color: #ef4444; font-size: 1.1rem;">7 Days</p>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; flex-direction: column;">
                <button class="btn btn-primary" style="padding: 1.25rem; font-size: 1rem; font-weight: 700;">Record New Payment (₦1,400)</button>
                <button class="btn btn-outline" style="padding: 1rem; font-size: 0.9rem;">View History</button>
            </div>
        </div>
    </div>

    <!-- Quick Info -->
    <div class="admin-grid" style="margin-top: 1rem;">
        <div class="card" style="padding: 1.25rem; display: flex; align-items: center; gap: 1.25rem;">
            <div style="font-size: 2rem; opacity: 0.8;">📱</div>
            <div>
                <h4 style="font-size: 0.95rem; font-weight: 700; margin-bottom: 2px;">Field Ready</h4>
                <p style="font-size: 0.8rem; color: var(--text-muted);">Optimized for low-bandwidth mobile devices.</p>
            </div>
        </div>
        <div class="card" style="padding: 1.25rem; display: flex; align-items: center; gap: 1.25rem;">
            <div style="font-size: 2rem; opacity: 0.8;">🛡️</div>
            <div>
                <h4 style="font-size: 0.95rem; font-weight: 700; margin-bottom: 2px;">Secured Audit</h4>
                <p style="font-size: 0.8rem; color: var(--text-muted);">Real-time logging of all verification attempts.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
