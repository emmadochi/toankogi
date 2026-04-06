<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Reporting & Analytics</h1>
    <p class="page-subtitle">Generate detailed state-wide, LGA-level, or Unit-level reports.</p>
</div>

<style>
.analytics-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.charts-subgrid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

@media (max-width: 1200px) {
    .analytics-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .charts-subgrid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Visual Analytics Grid -->
<div class="analytics-grid">
    <!-- Main Charts -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <div class="card">
            <div class="card-title">Revenue Performance & Trends</div>
            <div style="height: 350px; position: relative;">
                <canvas id="revenueTrendChart"></canvas>
            </div>
        </div>
        
        <div class="charts-subgrid">
            <div class="card">
                <div class="card-title">Collections by LGA (Top 8)</div>
                <div style="height: 250px; position: relative;">
                    <canvas id="lgaRevenueChart"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-title">Payment Compliance</div>
                <div style="height: 250px; position: relative;">
                    <canvas id="complianceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Insights -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card" style="border-left: 4px solid var(--primary);">
            <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem;">Most Productive Day</h4>
            <p style="font-size: 1.5rem; font-weight: 700;"><?php echo htmlspecialchars($data['analytics']->most_productive_day); ?></p>
        </div>
        <div class="card" style="border-left: 4px solid var(--secondary);">
            <h4 style="font-size: 0.9rem; margin-bottom: 0.5rem;">Highest Growth LGA</h4>
            <p style="font-size: 1.5rem; font-weight: 700;"><?php echo htmlspecialchars($data['analytics']->highest_growth_lga); ?></p>
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
        
        <div class="card" style="background: var(--bg-alt); border: 1px dashed var(--glass-border); flex-grow: 1; display: flex; flex-direction: column; justify-content: center; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.3;">📋</div>
            <h5 style="margin-bottom: 0.5rem;">Ready to Export?</h5>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Generate the full itemized report to unlock all metadata.</p>
        </div>
    </div>
</div>

<script>
<?php
// Prepare chart data for JS
$trendLabels = [];
$trendData = [];
foreach($data['analytics']->monthly_trend as $mt) {
    // limit month to 3 chars
    $trendLabels[] = substr($mt->month, 0, 3);
    $trendData[] = $mt->total;
}

$lgaLabels = [];
$lgaData = [];
foreach($data['analytics']->top_lgas as $lga) {
    $lgaLabels[] = $lga->name;
    $lgaData[] = $lga->total;
}

$complianceData = $data['analytics']->compliance; // [paid, unpaid, grace]
?>
document.addEventListener('DOMContentLoaded', function() {
    const ctxTrend = document.getElementById('revenueTrendChart').getContext('2d');
    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($trendLabels); ?>,
            datasets: [{
                label: 'Monthly Revenue (₦)',
                data: <?php echo json_encode($trendData); ?>,
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
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });

    const ctxLga = document.getElementById('lgaRevenueChart').getContext('2d');
    new Chart(ctxLga, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($lgaLabels); ?>,
            datasets: [{
                label: 'Collections (₦)',
                data: <?php echo json_encode($lgaData); ?>,
                backgroundColor: '#059669',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });

    const ctxCompliance = document.getElementById('complianceChart').getContext('2d');
    new Chart(ctxCompliance, {
        type: 'doughnut',
        data: {
            labels: ['Paid members', 'Unpaid members', 'Grace Period'],
            datasets: [{
                data: <?php echo json_encode($complianceData); ?>,
                backgroundColor: ['#059669', '#ef4444', '#f59e0b'],
                borderWidth: 0,
                weight: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { usePointStyle: true, font: { size: 10 } }
                }
            }
        }
    });
});
</script>

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
                    <p style="font-size: 1.25rem; font-weight: 700; color: var(--primary);">₦<?php echo number_format($data['analytics']->total_collections, 2); ?></p>
                </div>
                <div style="padding: 1rem; background: white; border-radius: 10px; border: 1px solid var(--glass-border);">
                    <label style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Unique Members</label>
                    <p style="font-size: 1.25rem; font-weight: 700;"><?php echo number_format($data['analytics']->unique_members); ?></p>
                </div>
                <div style="padding: 1rem; background: white; border-radius: 10px; border: 1px solid var(--glass-border);">
                    <label style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Enforcement Rate</label>
                    <p style="font-size: 1.25rem; font-weight: 700; color: var(--secondary);"><?php echo $data['analytics']->enforcement_rate; ?>%</p>
                </div>
            </div>

            <div style="margin-top: 2rem; border-top: 1px solid var(--glass-border); padding-top: 1.5rem;">
                <p style="font-size: 0.8rem; color: var(--text-muted);">* This is a preview. Click "Excel" or "PDF" to see the full itemized list and raw data.</p>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
