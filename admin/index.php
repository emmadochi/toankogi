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
    <!-- Revenue Chart Placeholder -->
    <div class="card">
        <div class="card-title">
            <span>Payment Trends (Last 7 Days)</span>
            <select style="padding: 0.4rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit; font-size: 0.8rem;">
                <option>Daily</option>
                <option>Weekly</option>
            </select>
        </div>
        <div class="chart-container" style="height: 300px; display: flex; align-items: flex-end; justify-content: space-between; padding-top: 2rem;">
            <!-- Dummy CSS Chart Bars -->
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div class="dummy-chart-bar" data-height="60" style="width: 40px; background: var(--primary); border-radius: 8px 8px 0 0; transition: height 1s ease; height: 0;"></div>
                <span style="font-size: 0.7rem; color: var(--text-muted);">Mon</span>
            </div>
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div class="dummy-chart-bar" data-height="85" style="width: 40px; background: var(--primary); border-radius: 8px 8px 0 0; transition: height 1s ease; height: 0;"></div>
                <span style="font-size: 0.7rem; color: var(--text-muted);">Tue</span>
            </div>
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div class="dummy-chart-bar" data-height="45" style="width: 40px; background: var(--primary); border-radius: 8px 8px 0 0; transition: height 1s ease; height: 0;"></div>
                <span style="font-size: 0.7rem; color: var(--text-muted);">Wed</span>
            </div>
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div class="dummy-chart-bar" data-height="70" style="width: 40px; background: var(--primary); border-radius: 8px 8px 0 0; transition: height 1s ease; height: 0;"></div>
                <span style="font-size: 0.7rem; color: var(--text-muted);">Thu</span>
            </div>
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div class="dummy-chart-bar" data-height="95" style="width: 40px; background: var(--secondary); border-radius: 8px 8px 0 0; transition: height 1s ease; height: 0;"></div>
                <span style="font-size: 0.7rem; color: var(--text-muted);">Fri</span>
            </div>
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div class="dummy-chart-bar" data-height="30" style="width: 40px; background: var(--primary); border-radius: 8px 8px 0 0; transition: height 1s ease; height: 0;"></div>
                <span style="font-size: 0.7rem; color: var(--text-muted);">Sat</span>
            </div>
            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div class="dummy-chart-bar" data-height="20" style="width: 40px; background: var(--primary); border-radius: 8px 8px 0 0; transition: height 1s ease; height: 0;"></div>
                <span style="font-size: 0.7rem; color: var(--text-muted);">Sun</span>
            </div>
        </div>
    </div>

    <!-- Top Performing Units -->
    <div class="card">
        <div class="card-title">Top Performing Units</div>
        <ul style="list-style: none;">
            <li style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--glass-border);">
                <div>
                    <p style="font-weight: 600; font-size: 0.9rem;">Lokoja Central Unit 1</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Lokoja LGA</p>
                </div>
                <div style="text-align: right;">
                    <p style="font-weight: 700; color: var(--primary);">₦850,400</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">98% Target</p>
                </div>
            </li>
            <li style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--glass-border);">
                <div>
                    <p style="font-weight: 600; font-size: 0.9rem;">Okene Main Market</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Okene LGA</p>
                </div>
                <div style="text-align: right;">
                    <p style="font-weight: 700; color: var(--primary);">₦720,150</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">92% Target</p>
                </div>
            </li>
            <li style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--glass-border);">
                <div>
                    <p style="font-weight: 600; font-size: 0.9rem;">Anyigba University Gate</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Dekina LGA</p>
                </div>
                <div style="text-align: right;">
                    <p style="font-weight: 700; color: var(--primary);">₦680,900</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">88% Target</p>
                </div>
            </li>
            <li style="display: flex; justify-content: space-between; padding: 1rem 0;">
                <div>
                    <p style="font-weight: 600; font-size: 0.9rem;">Idah Waterfront</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Idah LGA</p>
                </div>
                <div style="text-align: right;">
                    <p style="font-weight: 700; color: var(--primary);">₦590,200</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">85% Target</p>
                </div>
            </li>
        </ul>
    </div>
</div>

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
