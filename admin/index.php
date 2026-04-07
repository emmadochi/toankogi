<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Dashboard Overview</h1>
    <p class="page-subtitle">Real-time revenue and membership tracking for Kogi State.</p>
</div>

<!-- Stats Grid -->
<div class="stats-grid" style="margin-bottom: 2rem;">
    <div class="stat-card" style="border-left: 4px solid var(--primary);">
        <div class="stat-value" style="font-size: 1.5rem; font-weight: 800;">₦4.2M</div>
        <div class="stat-label" style="font-weight: 700; font-size: 0.65rem; text-transform: uppercase;">Today's Revenue</div>
        <div class="stat-trend trend-up" style="font-weight: 800; font-size: 0.65rem;">↑ 12.5%</div>
    </div>
    <div class="stat-card" style="border-left: 4px solid #f59e0b;">
        <div class="stat-value" style="font-size: 1.5rem; font-weight: 800;">₦28.4M</div>
        <div class="stat-label" style="font-weight: 700; font-size: 0.65rem; text-transform: uppercase;">This Week</div>
        <div class="stat-trend trend-up" style="font-weight: 800; font-size: 0.65rem;">↑ 8.2%</div>
    </div>
    <div class="stat-card" style="border-left: 4px solid var(--secondary);">
        <div class="stat-value" style="font-size: 1.5rem; font-weight: 800;">15,420</div>
        <div class="stat-label" style="font-weight: 700; font-size: 0.65rem; text-transform: uppercase;">Active Members</div>
        <div class="stat-trend" style="font-weight: 800; font-size: 0.65rem; color: var(--text-muted);">TRS VERIFIED</div>
    </div>
    <div class="stat-card" style="border-left: 4px solid #ef4444;">
        <div class="stat-value" style="font-size: 1.5rem; font-weight: 800;">1,205</div>
        <div class="stat-label" style="font-weight: 700; font-size: 0.65rem; text-transform: uppercase;">Inactive</div>
        <div class="stat-trend trend-down" style="font-weight: 800; font-size: 0.65rem;">ENFORCEMENT</div>
    </div>
</div>

<div class="content-grid">
    <!-- Revenue Trend Chart -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1rem; font-weight: 800;">Payment Trends</h3>
            <select class="form-input" style="padding: 0.3rem 0.6rem; font-size: 0.75rem; border-radius: 8px; width: auto;">
                <option>Daily</option>
                <option>Weekly</option>
            </select>
        </div>
        <div class="chart-container" style="position: relative; height: 300px; width: 100%;">
            <canvas id="revenueTrendChart"></canvas>
        </div>
    </div>

    <!-- Revenue by LGA Chart -->
    <div class="card">
        <h3 style="font-size: 1rem; font-weight: 800; margin-bottom: 1.5rem;">Revenue by LGA</h3>
        <div class="chart-container" style="position: relative; height: 300px; width: 100%;">
            <canvas id="lgaRevenueChart"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isMobile = window.innerWidth < 768;

    // Shared Chart Options
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: isMobile ? 'bottom' : 'right',
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    font: {
                        family: 'Outfit',
                        size: 11,
                        weight: '700'
                    }
                }
            }
        }
    };

    // 1. Revenue Trend Chart (Line)
    const trendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Revenue',
                data: [420000, 580000, 310000, 490000, 650000, 210000, 150000],
                borderColor: '#059669',
                backgroundColor: 'rgba(5, 150, 105, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#059669',
                pointBorderWidth: 2,
                pointRadius: 4
            }]
        },
        options: {
            ...chartOptions,
            plugins: { ...chartOptions.plugins, legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                    ticks: {
                        font: { size: 10, weight: '600' },
                        callback: value => '₦' + (value/1000) + 'k'
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: '600' } }
                }
            }
        }
    });

    // 2. Revenue by LGA Chart (Doughnut)
    const lgaCtx = document.getElementById('lgaRevenueChart').getContext('2d');
    new Chart(lgaCtx, {
        type: 'doughnut',
        data: {
            labels: ['Lokoja', 'Okene', 'Dekina', 'Idah', 'Kabba'],
            datasets: [{
                data: [45, 25, 15, 10, 5],
                backgroundColor: ['#059669', '#d97706', '#10b981', '#0f172a', '#3b82f6'],
                borderWidth: 0,
                hoverOffset: 15
            }]
        },
        options: {
            ...chartOptions,
            cutout: '72%',
            plugins: {
                ...chartOptions.plugins,
                legend: {
                    ...chartOptions.plugins.legend,
                    position: isMobile ? 'bottom' : 'right'
                }
            }
        }
    });
});
</script>

<!-- Recent Activities -->
<div class="card" style="margin-top: 1.5rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 style="font-size: 1rem; font-weight: 800;">Recent Transactions</h3>
        <a href="revenue.php" style="font-size: 0.75rem; font-weight: 800; color: var(--primary); text-decoration: none;">VIEW ALL →</a>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Actor</th>
                    <th class="hide-mobile">LGA / Unit</th>
                    <th class="hide-mobile">Type</th>
                    <th>Value</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $recent = [
                    ['Ameh Sunday', 'LKJ-123-AB', 'Lokoja / Central', 'Daily Tax', '₦200', 'Paid'],
                    ['Musa Ibrahim', 'OKN-456-XY', 'Okene / Market', 'Weekly Tax', '₦1,200', 'Paid'],
                    ['John Doe', 'IDH-789-QW', 'Idah / Terminal', 'Registration', '₦5,000', 'Pending'],
                    ['Usman Ali', 'KAB-098-MN', 'Kabba / Area A', 'Daily Tax', '₦200', 'Owing'],
                ];

                foreach($recent as $r): ?>
                <tr>
                    <td>
                        <p style="font-weight: 700; font-size: 0.85rem;"><?php echo $r[0]; ?></p>
                        <p style="font-size: 0.7rem; color: var(--text-muted); font-family: monospace; font-weight: 700;"><?php echo $r[1]; ?></p>
                    </td>
                    <td class="hide-mobile" style="font-size: 0.8rem; font-weight: 600;"><?php echo $r[2]; ?></td>
                    <td class="hide-mobile" style="font-size: 0.75rem;"><span class="role-badge" style="font-size: 0.65rem;"><?php echo $r[3]; ?></span></td>
                    <td style="font-weight: 800; font-size: 0.85rem; color: var(--dark);"><?php echo $r[4]; ?></td>
                    <td>
                        <?php 
                        $s_class = 'paid';
                        if($r[5] == 'Pending') $s_class = 'pending';
                        if($r[5] == 'Owing') $s_class = 'owing';
                        ?>
                        <span class="status-check <?php echo $s_class; ?>" style="font-size: 0.6rem; padding: 2px 10px; font-weight: 800;"><?php echo strtoupper($r[5]); ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
