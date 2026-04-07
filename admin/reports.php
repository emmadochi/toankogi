<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Reporting & Analytics</h1>
    <p class="page-subtitle">Generate detailed state-wide, LGA-level, or Unit-level reports.</p>
</div>

<style>
.analytics-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.charts-subgrid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

@media (max-width: 1024px) {
    .analytics-grid { grid-template-columns: 1fr; }
    .charts-subgrid { grid-template-columns: 1fr; }
}
</style>

<!-- Visual Analytics Grid -->
<div class="analytics-grid">
    <!-- Main Charts -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card">
            <div class="card-title">Revenue Performance & Trends</div>
            <div style="height: 300px; position: relative;">
                <canvas id="revenueTrendChart"></canvas>
            </div>
        </div>
        
        <div class="charts-subgrid">
            <div class="card">
                <div class="card-title">Collections by LGA (Top 8)</div>
                <div style="height: 220px; position: relative;">
                    <canvas id="lgaRevenueChart"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-title">Payment Compliance</div>
                <div style="height: 220px; position: relative;">
                    <canvas id="complianceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Insights -->
    <div class="admin-grid" style="grid-template-columns: 1fr;">
        <div class="card" style="border-left: 4px solid var(--primary);">
            <h4 style="font-size: 0.85rem; margin-bottom: 0.5rem; color: var(--text-muted);">Most Productive Day</h4>
            <p style="font-size: 1.5rem; font-weight: 700;">Friday</p>
            <p style="font-size: 0.75rem; color: var(--text-muted);">Average: ₦1.8M / Friday</p>
        </div>
        <div class="card" style="border-left: 4px solid var(--secondary);">
            <h4 style="font-size: 0.85rem; margin-bottom: 0.5rem; color: var(--text-muted);">Highest Growth LGA</h4>
            <p style="font-size: 1.5rem; font-weight: 700;">Adavi</p>
            <p style="font-size: 0.75rem; color: var(--text-muted);">↑ 22% increase this month</p>
        </div>
        <div class="card" style="background: var(--dark); color: white;">
            <h4 style="font-size: 0.85rem; margin-bottom: 1rem; opacity: 0.8;">System Health</h4>
            <div style="display: flex; align-items: center; gap: 10px; font-size: 0.8rem; margin-bottom: 0.6rem;">
                <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></div>
                <span>Server Status: Online</span>
            </div>
            <div style="display: flex; align-items: center; gap: 10px; font-size: 0.8rem;">
                <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></div>
                <span>Last Sync: 2 mins ago</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const trendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'],
            datasets: [{
                label: 'Revenue (M ₦)',
                data: [8.5, 9.2, 12.8, 10.5, 11.8, 14.5],
                borderColor: '#059669',
                backgroundColor: 'rgba(5, 150, 105, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.03)' } },
                x: { grid: { display: false } }
            }
        }
    });

    const lgaCtx = document.getElementById('lgaRevenueChart').getContext('2d');
    new Chart(lgaCtx, {
        type: 'bar',
        data: {
            labels: ['Lokoja', 'Okene', 'Adavi', 'Ajaokuta', 'Dekina', 'Idah', 'Kabba', 'Ankpa'],
            datasets: [{
                data: [1200000, 950000, 880000, 720000, 650000, 580000, 520000, 480000],
                backgroundColor: '#059669',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.03)' } },
                x: { grid: { display: false } }
            }
        }
    });

    const compCtx = document.getElementById('complianceChart').getContext('2d');
    new Chart(compCtx, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Unpaid', 'Grace'],
            datasets: [{
                data: [65, 25, 10],
                backgroundColor: ['#059669', '#ef4444', '#f59e0b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, font: { size: 10 } } }
            }
        }
    });
});
</script>

<div class="content-grid" style="grid-template-columns: 1fr;">
    <!-- Report Preview -->
    <div class="card">
        <div class="card-title" style="flex-wrap: wrap; gap: 0.8rem;">
            <span>Report Preview</span>
            <div style="display: flex; gap: 0.4rem;">
                <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">🖨️</button>
                <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">PDF</button>
                <button class="btn btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">Excel</button>
            </div>
        </div>
        
        <div style="padding: 2rem; text-align: center; border: 2px dashed var(--glass-border); border-radius: 15px; background: var(--bg-alt);">
            <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.2;">📊</div>
            <h3 style="margin-bottom: 0.4rem; font-size: 1.1rem;">Revenue Summary: All LGAs</h3>
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 2rem;">Period: 01 March 2026 - 25 March 2026</p>
            
            <div class="admin-grid" style="text-align: left;">
                <div style="padding: 1.25rem; background: white; border-radius: 12px; border: 1px solid var(--glass-border); border-left: 4px solid var(--primary);">
                    <label style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Total Collections</label>
                    <p style="font-size: 1.4rem; font-weight: 700; color: var(--primary);">₦12,450,200</p>
                </div>
                <div style="padding: 1.25rem; background: white; border-radius: 12px; border: 1px solid var(--glass-border); border-left: 4px solid var(--dark);">
                    <label style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Unique Members</label>
                    <p style="font-size: 1.4rem; font-weight: 700;">8,450</p>
                </div>
                <div style="padding: 1.25rem; background: white; border-radius: 12px; border: 1px solid var(--glass-border); border-left: 4px solid var(--secondary);">
                    <label style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Enforcement Rate</label>
                    <p style="font-size: 1.4rem; font-weight: 700; color: var(--secondary);">94.2%</p>
                </div>
            </div>

            <div style="margin-top: 2rem; border-top: 1px solid var(--glass-border); padding-top: 1.5rem;">
                <p style="font-size: 0.75rem; color: var(--text-muted);">* Itemized metadata available in export formats.</p>
            </div>
        </div>
    </div>
</div>
      </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
