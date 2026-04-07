<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">Revenue Logs</h1>
            <p class="page-subtitle">Historical transaction data and financial monitoring.</p>
        </div>
        <div style="display: flex; gap: 0.8rem;">
            <a href="payment.php" class="btn btn-primary" style="padding: 0.6rem 1.2rem; font-size: 0.85rem; text-decoration: none;">💳 Process New Payment</a>
            <button class="btn btn-outline" style="padding: 0.6rem 1.2rem; font-size: 0.85rem;">📅 This Month</button>
            <button class="btn btn-primary" style="padding: 0.6rem 1.2rem; font-size: 0.85rem;">📥 Export CSV</button>
        </div>
    </div>
</div>

<!-- Revenue Summary Row -->
<div class="stats-grid" style="margin-bottom: 2rem;">
    <div class="stat-card" style="border-top: 4px solid var(--primary);">
        <div class="stat-value">₦450,200</div>
        <div class="stat-label">Daily Collection (Today)</div>
    </div>
    <div class="stat-card" style="border-top: 4px solid var(--secondary);">
        <div class="stat-value">₦2,840,000</div>
        <div class="stat-label">Weekly Collection</div>
    </div>
    <div class="stat-card" style="border-top: 4px solid var(--dark);">
        <div class="stat-value">₦12,450,000</div>
        <div class="stat-label">Monthly Total</div>
    </div>
</div>

<div class="card">
    <!-- Filters Bar -->
    <div class="filter-row" style="margin-bottom: 2rem;">
        <div class="filter-item">
            <label>Filter by LGA</label>
            <select>
                <option>All LGAs</option>
                <option>Lokoja</option>
                <option>Okene</option>
                <option>Dekina</option>
                <option>Idah</option>
            </select>
        </div>
        <div class="filter-item">
            <label>Payment Type</label>
            <select>
                <option>All Types</option>
                <option>Daily Tax</option>
                <option>Weekly Tax</option>
                <option>Registration</option>
            </select>
        </div>
        <div class="filter-item" style="flex: 1.5;">
            <label>Date Range</label>
            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                <input type="date" value="2026-03-25" class="form-input" style="flex: 1; min-width: 120px; padding: 0.6rem;">
                <span class="hide-mobile">to</span>
                <input type="date" value="2026-03-25" class="form-input" style="flex: 1; min-width: 120px; padding: 0.6rem;">
            </div>
        </div>
        <button class="btn btn-primary" style="padding: 0.75rem 1.5rem;">Apply</button>
    </div>

    <!-- Transaction Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>Member</th>
                    <th class="hide-mobile">Cycle</th>
                    <th class="hide-mobile">Method</th>
                    <th class="hide-mobile">Agent</th>
                    <th>LGA / Unit</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dummy_data = [
                    ['REF-001', 'Ameh Sunday', 'Daily Tax', 'Cash', 'Agent_04', 'Lokoja/C1', '₦200'],
                    ['REF-002', 'Musa Ibrahim', 'Weekly Tax', 'Online', 'System', 'Okene/MKT', '₦1,200'],
                    ['REF-003', 'John Doe', 'Registration', 'Cash', 'Agent_12', 'Idah/TRM', '₦5,000'],
                    ['REF-004', 'Usman Ali', 'Daily Tax', 'Cash', 'Agent_04', 'Lokoja/C1', '₦200'],
                    ['REF-005', 'Blessing Obi', 'Monthly Tax', 'Online', 'System', 'Dekina/UNI', '₦4,800'],
                    ['REF-006', 'Peter Pan', 'Daily Tax', 'Cash', 'Agent_09', 'Kabba/AR1', '₦200'],
                    ['REF-007', 'Sarah James', 'Daily Tax', 'Cash', 'Agent_04', 'Lokoja/C1', '₦200'],
                    ['REF-008', 'Mohammed Salihu', 'Weekly Tax', 'Cash', 'Agent_07', 'Ankpa/PK1', '₦1,200']
                ];

                foreach($dummy_data as $row): ?>
                <tr>
                    <td style="font-family: monospace; font-weight: 600; font-size: 0.8rem;"><?php echo $row[0]; ?></td>
                    <td>
                        <p style="font-weight: 700; font-size: 0.9rem;"><?php echo $row[1]; ?></p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);" class="hide-mobile">08012345***</p>
                    </td>
                    <td class="hide-mobile"><span class="role-badge" style="background: var(--bg-alt); color: var(--dark); border: 1px solid var(--glass-border); text-transform: none;"><?php echo $row[2]; ?></span></td>
                    <td class="hide-mobile"><?php echo $row[3]; ?></td>
                    <td class="hide-mobile" style="font-size: 0.85rem; font-weight: 500;"><?php echo $row[4]; ?></td>
                    <td style="font-size: 0.85rem;"><?php echo $row[5]; ?></td>
                    <td style="font-weight: 700; color: var(--primary);"><?php echo $row[6]; ?></td>
                    <td>
                        <a href="receipt.php?id=TRX-<?php echo rand(10000, 99999); ?>" style="color: var(--primary); font-weight: 700; text-decoration: none; font-size: 0.8rem;">📄 Receipt</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--glass-border); flex-wrap: wrap; gap: 1rem;">
        <p style="font-size: 0.85rem; color: var(--text-muted);">Showing 1-8 of 1,245 logs</p>
        <div style="display: flex; gap: 0.5rem;">
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px;">Prev</button>
            <button class="btn btn-primary" style="padding: 0.4rem 0.8rem; border-radius: 8px;">1</button>
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px;">Next</button>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
