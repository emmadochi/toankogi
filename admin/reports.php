<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Reporting & Analytics</h1>
    <p class="page-subtitle">Generate detailed state-wide, LGA-level, or Unit-level reports.</p>
</div>

<!-- Report Configuration -->
<div class="card" style="margin-bottom: 2rem;">
    <div class="card-title">Filter Report Data</div>
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; background: var(--bg-alt); padding: 1.5rem; border-radius: 12px;">
        <div class="form-group">
            <label style="display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem;">Time Range</label>
            <select style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit;">
                <option>Custom Range</option>
                <option>Today</option>
                <option>This Week</option>
                <option>This Month</option>
                <option>Last Quarter</option>
                <option>Year to Date</option>
            </select>
        </div>
        <div class="form-group">
            <label style="display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem;">LGA Scope</label>
            <select style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit;">
                <option>All 21 LGAs</option>
                <option>Lokoja</option>
                <option>Okene</option>
                <option>Dekina</option>
            </select>
        </div>
        <div class="form-group">
            <label style="display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem;">Report Type</label>
            <select style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit;">
                <option>Revenue Summary</option>
                <option>Member Compliance</option>
                <option>Agent Performance</option>
                <option>Enrollment Trends</option>
            </select>
        </div>
        <div class="form-group" style="display: flex; align-items: flex-end;">
            <button class="btn btn-primary" style="width: 100%; padding: 0.7rem;">Generate Report</button>
        </div>
    </div>
</div>

<div class="content-grid">
    <!-- Report Preview -->
    <div class="card">
        <div class="card-title">
            <span>Report Preview</span>
            <div style="display: flex; gap: 0.5rem;">
                <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">🖨️ Print</button>
                <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">📂 PDF</button>
                <button class="btn btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">📊 Excel</button>
            </div>
        </div>
        
        <div style="padding: 2rem; text-align: center; border: 2px dashed var(--glass-border); border-radius: 15px; background: var(--bg-alt);">
            <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.2;">📊</div>
            <h3 style="margin-bottom: 0.5rem;">Revenue Summary: All LGAs</h3>
            <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 2rem;">Period: 01 March 2026 - 25 March 2026</p>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; text-align: left;">
                <div style="padding: 1rem; background: white; border-radius: 10px; border: 1px solid var(--glass-border);">
                    <label style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Total Collections</label>
                    <p style="font-size: 1.25rem; font-weight: 700; color: var(--primary);">₦12,450,200</p>
                </div>
                <div style="padding: 1rem; background: white; border-radius: 10px; border: 1px solid var(--glass-border);">
                    <label style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Unique Members</label>
                    <p style="font-size: 1.25rem; font-weight: 700;">8,450</p>
                </div>
                <div style="padding: 1rem; background: white; border-radius: 10px; border: 1px solid var(--glass-border);">
                    <label style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Enforcement Rate</label>
                    <p style="font-size: 1.25rem; font-weight: 700; color: var(--secondary);">94.2%</p>
                </div>
            </div>

            <div style="margin-top: 2rem; border-top: 1px solid var(--glass-border); padding-top: 1.5rem;">
                <p style="font-size: 0.8rem; color: var(--text-muted);">* This is a preview. Click "Excel" or "PDF" to see the full itemized list and raw data.</p>
            </div>
        </div>
    </div>

    <!-- Quick Insights -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card" style="border-left: 4px solid var(--primary);">
            <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem;">Most Productive Day</h4>
            <p style="font-size: 1.5rem; font-weight: 700;">Friday</p>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Average: ₦1.8M / Friday</p>
        </div>
        <div class="card" style="border-left: 4px solid var(--secondary);">
            <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem;">Highest Growth LGA</h4>
            <p style="font-size: 1.5rem; font-weight: 700;">Adavi</p>
            <p style="font-size: 0.8rem; color: var(--text-muted);">↑ 22% increase this month</p>
        </div>
        <div class="card" style="background: var(--dark); color: white;">
            <h4 style="font-size: 0.9rem; margin-bottom: 1rem;">System Health</h4>
            <div style="display: flex; align-items: center; gap: 10px; font-size: 0.85rem; margin-bottom: 0.5rem;">
                <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--accent);"></div>
                <span>Server Status: Online</span>
            </div>
            <div style="display: flex; align-items: center; gap: 10px; font-size: 0.85rem;">
                <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--accent);"></div>
                <span>Last Sync: 2 mins ago</span>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
