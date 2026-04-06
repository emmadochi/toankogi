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
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-value">124</div>
        <div class="stat-label">Total Complaints</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: #f59e0b;">18</div>
        <div class="stat-label">Pending Review</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: var(--primary);">98</div>
        <div class="stat-label">Resolved Tickets</div>
    </div>
    <div class="stat-card">
        <div class="stat-value" style="color: var(--accent-red);">8</div>
        <div class="stat-label">Critical Issues</div>
    </div>
</div>

<div class="card">
    <!-- Hierarchical Filters -->
    <div style="display: flex; gap: 1.5rem; margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-alt); border-radius: 12px; align-items: flex-end;">
        <div style="flex: 1;">
            <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase;">LGA Filter</label>
            <select style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); outline: none; background: white; font-family: inherit;">
                <option>All LGAs</option>
                <option>Lokoja</option>
                <option>Okene</option>
                <option>Idah</option>
            </select>
        </div>
        <div style="flex: 1;">
            <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase;">Category</label>
            <select style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); outline: none; background: white; font-family: inherit;">
                <option>All Categories</option>
                <option>Payment Issue</option>
                <option>Enforcement</option>
                <option>Verification</option>
                <option>Others</option>
            </select>
        </div>
        <div style="flex: 1;">
            <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase;">Status</label>
            <select style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); outline: none; background: white; font-family: inherit;">
                <option>Any Status</option>
                <option>Pending</option>
                <option>In Progress</option>
                <option>Resolved</option>
            </select>
        </div>
        <div style="flex: 1.5;">
            <div class="search-bar" style="width: 100%; padding: 0.7rem; margin: 0;">
                <span>🔍</span>
                <input type="text" placeholder="Search by Ticket ID or Member Name...">
            </div>
        </div>
        <button class="btn btn-primary" style="padding: 0.7rem 1.5rem; border-radius: 10px;">Apply Filters</button>
    </div>

    <!-- Complaints Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Member Info</th>
                    <th>Category</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $complaints = [
                    ['CMP-9042', 'Ameh Sunday', 'Lokoja / Central', 'Payment Issue', 'Overcharge by Unit Agent', '2026-03-22', 'Pending'],
                    ['CMP-8812', 'Musa Ibrahim', 'Okene / Market', 'Verification', 'ID Card Name Typo', '2026-02-15', 'Resolved'],
                    ['CMP-9105', 'John Doe', 'Idah / Waterfront', 'Enforcement', 'Illegal Seizure of Tricycle', '2026-03-25', 'Critical'],
                    ['CMP-9088', 'Sarah James', 'Lokoja / Terminal B', 'Payment Issue', 'Double payment recorded', '2026-03-24', 'In Progress'],
                    ['CMP-9077', 'Peter Pan', 'Kabba / Main Road', 'Technical', 'App login difficulty', '2026-03-23', 'Pending'],
                ];

                foreach($complaints as $c): ?>
                <tr>
                    <td><span style="font-family: monospace; font-weight: 700; color: var(--primary);"><?php echo $c[0]; ?></span></td>
                    <td>
                        <p style="font-weight: 700; font-size: 0.85rem;"><?php echo $c[1]; ?></p>
                        <p style="font-size: 0.75rem; color: var(--text-muted);"><?php echo $c[2]; ?></p>
                    </td>
                    <td><span class="role-badge" style="font-size: 0.7rem;"><?php echo $c[3]; ?></span></td>
                    <td style="font-size: 0.85rem; max-width: 250px;"><?php echo $c[4]; ?></td>
                    <td style="font-size: 0.85rem;"><?php echo $c[5]; ?></td>
                    <td>
                        <?php 
                        $status_class = 'pending';
                        if($c[6] == 'Resolved') $status_class = 'paid';
                        if($c[6] == 'Critical') $status_class = 'owing';
                        if($c[6] == 'In Progress') $status_class = 'pending';
                        ?>
                        <span class="status-check <?php echo $status_class; ?>"><?php echo $c[6]; ?></span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.75rem; border-radius: 6px;" onclick="viewComplaint('<?php echo $c[0]; ?>')">View</button>
                            <button class="btn btn-primary" style="padding: 0.3rem 0.6rem; font-size: 0.75rem; border-radius: 6px;">Resolve</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--glass-border);">
        <p style="font-size: 0.85rem; color: var(--text-muted);">Showing 1 to 5 of 124 complaints</p>
        <div style="display: flex; gap: 0.4rem;">
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;">« Prev</button>
            <button class="btn btn-primary" style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;">1</button>
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;">2</button>
            <button class="btn btn-outline" style="padding: 0.4rem 0.8rem; border-radius: 8px; font-size: 0.8rem;">Next »</button>
        </div>
    </div>
</div>

<!-- View Complaint Modal -->
<div id="viewModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div class="card" style="width: 500px; padding: 2rem;">
        <h3 id="modalTicketId" style="margin-bottom: 1rem; color: var(--primary);">Complaint Details</h3>
        <div id="modalContent" style="font-size: 0.9rem; line-height: 1.6;">
            <!-- Content filled by JS -->
        </div>
        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <button class="btn btn-outline" style="flex: 1;" onclick="closeModal()">Close</button>
            <button class="btn btn-primary" style="flex: 1;">Update Status</button>
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
