<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">Complaints & Compliance</h1>
            <p class="page-subtitle">Track and resolve issues reported by members across all LGAs and Units.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <button class="btn btn-outline" onclick="window.print()">🖨️ Export Report</button>
            <button class="btn btn-primary">Refresh Data</button>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="stats-grid" style="margin-bottom: 2rem;">
    <div class="stat-card" style="border-top: 4px solid var(--primary);">
        <div class="stat-value">124</div>
        <div class="stat-label">Total Complaints</div>
    </div>
    <div class="stat-card" style="border-top: 4px solid #f59e0b;">
        <div class="stat-value" style="color: #f59e0b;">18</div>
        <div class="stat-label">Pending Review</div>
    </div>
    <div class="stat-card" style="border-top: 4px solid var(--secondary);">
        <div class="stat-value" style="color: var(--secondary);">98</div>
        <div class="stat-label">Resolved Tickets</div>
    </div>
    <div class="stat-card" style="border-top: 4px solid #ef4444;">
        <div class="stat-value" style="color: #ef4444;">8</div>
        <div class="stat-label">Critical Issues</div>
    </div>
</div>

<div class="card">
    <!-- Hierarchical Filters -->
    <div class="filter-row" style="margin-bottom: 2rem;">
        <div class="filter-item">
            <label>LGA Filter</label>
            <select class="form-input">
                <option>All LGAs</option>
                <option>Lokoja</option>
                <option>Okene</option>
                <option>Idah</option>
            </select>
        </div>
        <div class="filter-item">
            <label>Category</label>
            <select class="form-input">
                <option>All Categories</option>
                <option>Payment Issue</option>
                <option>Enforcement</option>
                <option>Verification</option>
                <option>Others</option>
            </select>
        </div>
        <div class="filter-item">
            <label>Status</label>
            <select class="form-input">
                <option>Any Status</option>
                <option>Pending</option>
                <option>In Progress</option>
                <option>Resolved</option>
            </select>
        </div>
        <div class="filter-item" style="flex: 1.5;">
            <label>Search Terminal</label>
            <div style="position: relative; display: flex; align-items: center;">
                <span style="position: absolute; left: 12px; font-size: 0.9rem; opacity: 0.5;">🔍</span>
                <input type="text" placeholder="Ticket ID or Name..." class="form-input" style="padding-left: 2.25rem;">
            </div>
        </div>
        <button class="btn btn-primary" style="padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 700;">Apply</button>
    </div>

    <!-- Complaints Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Ticket</th>
                    <th>Member</th>
                    <th class="hide-mobile">Category</th>
                    <th class="hide-mobile">Subject</th>
                    <th class="hide-mobile">Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $complaints = [
                    ['CMP-9042', 'Ameh Sunday', 'Lokoja / Central', 'Payment', 'Overcharge by Unit Agent', '2026-03-22', 'Pending'],
                    ['CMP-8812', 'Musa Ibrahim', 'Okene / Market', 'Verification', 'ID Card Name Typo', '2026-02-15', 'Resolved'],
                    ['CMP-9105', 'John Doe', 'Idah / Waterfront', 'Enforcement', 'Illegal Seizure of Tricycle', '2026-03-25', 'Critical'],
                    ['CMP-9088', 'Sarah James', 'Lokoja / Terminal B', 'Payment', 'Double payment recorded', '2026-03-24', 'In Progress'],
                    ['CMP-9077', 'Peter Pan', 'Kabba / Main Road', 'Technical', 'App login difficulty', '2026-03-23', 'Pending'],
                ];

                foreach($complaints as $c): ?>
                <tr>
                    <td style="font-family: monospace; font-weight: 800; color: var(--primary); font-size: 0.8rem;"><?php echo $c[0]; ?></td>
                    <td>
                        <p style="font-weight: 700; font-size: 0.9rem;"><?php echo $c[1]; ?></p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);" class="hide-mobile"><?php echo $c[2]; ?></p>
                    </td>
                    <td class="hide-mobile"><span class="role-badge" style="font-size: 0.7rem; font-weight: 700;"><?php echo $c[3]; ?></span></td>
                    <td style="font-size: 0.85rem;" class="hide-mobile"><?php echo $c[4]; ?></td>
                    <td style="font-size: 0.8rem; font-weight: 600;" class="hide-mobile"><?php echo $c[5]; ?></td>
                    <td>
                        <?php 
                        $status_class = 'pending';
                        if($c[6] == 'Resolved') $status_class = 'paid';
                        if($c[6] == 'Critical') $status_class = 'owing';
                        if($c[6] == 'In Progress') $status_class = 'pending';
                        ?>
                        <span class="status-check <?php echo $status_class; ?>" style="font-size: 0.65rem; padding: 2px 10px; font-weight: 800;"><?php echo strtoupper($c[6]); ?></span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 6px;">
                            <button class="btn btn-outline" style="padding: 0.4rem; font-size: 0.75rem; border-radius: 8px;" onclick="viewComplaint('<?php echo $c[0]; ?>')">👁️</button>
                            <button class="btn btn-primary" style="padding: 0.4rem; font-size: 0.75rem; border-radius: 8px;">✓</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--glass-border); flex-wrap: wrap; gap: 1rem;">
        <p style="font-size: 0.85rem; color: var(--text-muted);">Showing 5 of 124 logs</p>
        <div style="display: flex; gap: 0.4rem;">
            <button class="btn btn-outline" style="padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.8rem;">Prev</button>
            <button class="btn btn-primary" style="padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.8rem;">1</button>
            <button class="btn btn-outline" style="padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.8rem;">Next</button>
        </div>
    </div>
</div>

<!-- View Complaint Modal -->
<div id="viewModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px); padding: 1.5rem;">
    <div class="card" style="width: 100%; max-width: 500px; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 id="modalTicketId" style="color: var(--primary); font-weight: 800; font-size: 1.25rem;">Complaint Details</h3>
            <button onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; opacity: 0.5;">&times;</button>
        </div>
        <div id="modalContent" style="font-size: 0.95rem; line-height: 1.6; color: var(--dark);">
            <!-- Content filled by JS -->
        </div>
        <div style="margin-top: 2.5rem; display: flex; flex-direction: column; gap: 1rem;">
            <button class="btn btn-primary" style="padding: 1rem; font-weight: 700;">Update Status</button>
            <button class="btn btn-outline" style="padding: 1rem; font-size: 0.9rem;" onclick="closeModal()">Close Preview</button>
        </div>
    </div>
</div>

<script>
function viewComplaint(id) {
    document.getElementById('modalTicketId').innerText = 'Complaint: #' + id;
    document.getElementById('modalContent').innerHTML = `
        <p><strong>Member:</strong> Ameh Sunday</p>
        <p><strong>Category:</strong> Payment Issue</p>
        <p><strong>Description:</strong> Member claims that a field agent at Lokoja Central Park collected ₦500 but only issued a receipt for ₦200. He provided a handwritten note from the agent as proof.</p>
        <hr style="margin: 1rem 0; border: none; border-top: 1px solid var(--glass-border);">
        <p style="font-size: 0.8rem; color: var(--text-muted);">Submitted on: 2026-03-22 14:30:15</p>
    `;
    document.getElementById('viewModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('viewModal').style.display = 'none';
}
</script>

<?php include 'layouts/footer.php'; ?>
