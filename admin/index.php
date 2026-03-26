<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Dashboard Overview</h1>
    <p class="page-subtitle">Real-time revenue and membership tracking for Kogi State.</p>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: var(--primary-light); color: var(--primary);">💰</div>
        <div class="stat-value">₦4,250,000</div>
        <div class="stat-label">Today's Revenue</div>
        <div class="stat-trend trend-up">↑ 12.5% from yesterday</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #fef3c7; color: #d97706;">🗓️</div>
        <div class="stat-value">₦28,400,000</div>
        <div class="stat-label">This Week</div>
        <div class="stat-trend trend-up">↑ 8.2% from last week</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">👥</div>
        <div class="stat-value">15,420</div>
        <div class="stat-label">Active Members</div>
        <div class="stat-trend">Total registered tricycles</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #fee2e2; color: #ef4444;">⚠️</div>
        <div class="stat-value">1,205</div>
        <div class="stat-label">Inactive / Expired</div>
        <div class="stat-trend trend-down">Requires enforcement</div>
    </div>
</div>

<div class="content-grid">
    <!-- Revenue Trend Chart -->
    <div class="card">
        <div class="card-title">
            <span>Payment Trends (Last 7 Days)</span>
            <select id="trendFilter" style="padding: 0.4rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit; font-size: 0.8rem;">
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
        <div class="card-title">Revenue by LGA</div>
        <div class="chart-container" style="position: relative; height: 300px; width: 100%;">
            <canvas id="lgaRevenueChart"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Shared Chart Options
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    font: {
                        family: 'Outfit',
                        size: 11
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
                label: 'Revenue (₦)',
                data: [420000, 580000, 310000, 490000, 650000, 210000, 150000],
                borderColor: '#059669',
                backgroundColor: 'rgba(5, 150, 105, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#059669',
                pointRadius: 4
            }]
        },
        options: {
            ...chartOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return '₦' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // 2. Revenue by LGA Chart (Doughnut)
    const lgaCtx = document.getElementById('lgaRevenueChart').getContext('2d');
    new Chart(lgaCtx, {
        type: 'doughnut',
        data: {
            labels: ['Lokoja', 'Okene', 'Dekina', 'Idah', 'Kabba', 'Ankpa'],
            datasets: [{
                data: [1250000, 850000, 720000, 590000, 420000, 420000],
                backgroundColor: [
                    '#059669', // Lokoja (Primary)
                    '#d97706', // Okene (Secondary)
                    '#10b981', // Dekina
                    '#0f172a', // Idah
                    '#3b82f6', // Kabba
                    '#6366f1'  // Ankpa
                ],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            ...chartOptions,
            cutout: '70%',
            plugins: {
                ...chartOptions.plugins,
                legend: {
                    ...chartOptions.plugins.legend,
                    position: 'right'
                }
            }
        }
    });
});
</script>

<!-- Recent Activities -->
<div class="card" style="margin-top: 1.5rem;">
    <div class="card-title">Recent Transactions & Activities</div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Date/Time</th>
                    <th>Member / Plate No</th>
                    <th>LGA / Unit</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>12:45 PM Today</td>
                    <td>
                        <p style="font-weight: 600;">Ameh Sunday</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">LKJ-123-AB</p>
                    </td>
                    <td>Lokoja / Central 1</td>
                    <td>Daily Tax</td>
                    <td style="font-weight: 600;">₦200</td>
                    <td><span class="status-check paid">Paid</span></td>
                </tr>
                <tr>
                    <td>11:20 AM Today</td>
                    <td>
                        <p style="font-weight: 600;">Musa Ibrahim</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">OKN-456-XY</p>
                    </td>
                    <td>Okene / Market</td>
                    <td>Weekly Tax</td>
                    <td style="font-weight: 600;">₦1,200</td>
                    <td><span class="status-check paid">Paid</span></td>
                </tr>
                <tr>
                    <td>09:15 AM Today</td>
                    <td>
                        <p style="font-weight: 600;">John Doe</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">IDH-789-QW</p>
                    </td>
                    <td>Idah / Terminal</td>
                    <td>New Registration</td>
                    <td style="font-weight: 600;">₦5,000</td>
                    <td><span class="status-check pending">Pending Approval</span></td>
                </tr>
                <tr>
                    <td>Yesterday</td>
                    <td>
                        <p style="font-weight: 600;">Usman Ali</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);">KAB-098-MN</p>
                    </td>
                    <td>Kabba / Area A</td>
                    <td>Daily Tax</td>
                    <td style="font-weight: 600;">₦200</td>
                    <td><span class="status-check owing">Owing</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
