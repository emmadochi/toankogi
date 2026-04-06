<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

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

<?php 
$total_c = count($data['complaints']);
$pending_c = 0;
$resolved_c = 0;
$critical_c = 0;
foreach($data['complaints'] as $c) {
    if ($c->status == 'Pending' || $c->status == 'In Progress') $pending_c++;
    if ($c->status == 'Resolved') $resolved_c++;
    if ($c->status == 'Critical') $critical_c++;
}
?>
<!-- Summary Cards -->
<div class="stats-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 2rem;">
    <div class="stat-card">
        <div id="stat_total" class="stat-value"><?php echo $total_c; ?></div>
        <div class="stat-label">Total Complaints</div>
    </div>
    <div class="stat-card">
        <div id="stat_pending" class="stat-value" style="color: #f59e0b;"><?php echo $pending_c; ?></div>
        <div class="stat-label">Pending Review</div>
    </div>
    <div class="stat-card">
        <div id="stat_resolved" class="stat-value" style="color: var(--primary);"><?php echo $resolved_c; ?></div>
        <div class="stat-label">Resolved Tickets</div>
    </div>
    <div class="stat-card">
        <div id="stat_critical" class="stat-value" style="color: var(--accent-red);"><?php echo $critical_c; ?></div>
        <div class="stat-label">Critical Issues</div>
    </div>
</div>
<?php flash('admin_msg'); ?>

<div class="card">
    <!-- Hierarchical Filters -->
    <div style="display: flex; gap: 1.5rem; margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-alt); border-radius: 12px; align-items: flex-end;">
        <div style="flex: 1;">
            <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase;">LGA Filter</label>
            <select id="filterLga" style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); outline: none; background: white; font-family: inherit;">
                <option value="all">All LGAs</option>
                <?php foreach($data['lgas'] as $lga): ?>
                    <option value="<?php echo $lga->id; ?>"><?php echo $lga->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="flex: 1;">
            <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase;">Category</label>
            <select id="filterCategory" style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); outline: none; background: white; font-family: inherit;">
                <option value="all">All Categories</option>
                <option value="Payment Issue">Payment Issue</option>
                <option value="Enforcement Harassment">Enforcement</option>
                <option value="Verification / ID Card">Verification</option>
                <option value="Unit Management Issue">Unit Management</option>
                <option value="Other Technical Issues">Others</option>
            </select>
        </div>
        <div style="flex: 1;">
            <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; text-transform: uppercase;">Status</label>
            <select id="filterStatus" style="width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid var(--glass-border); outline: none; background: white; font-family: inherit;">
                <option value="all">Any Status</option>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Resolved">Resolved</option>
                <option value="Critical">Critical</option>
            </select>
        </div>
        <div style="flex: 1.5;">
            <div class="search-bar" style="width: 100%; padding: 0.7rem; margin: 0;">
                <span>🔍</span>
                <input type="text" id="filterSearch" placeholder="Search by Ticket ID or Member Name...">
            </div>
        </div>
        <button class="btn btn-primary" style="padding: 0.7rem 1.5rem; border-radius: 10px;" onclick="applyFilters()">Apply Filters</button>
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
            <tbody id="complaintsTableBody">
                <?php if(empty($data['complaints'])): ?>
                    <tr><td colspan="7" style="text-align:center;">No complaints found in your jurisdiction.</td></tr>
                <?php else: ?>
                    <?php foreach($data['complaints'] as $c): ?>
                    <tr>
                        <td><span style="font-family: monospace; font-weight: 700; color: var(--primary);"><?php echo $c->ticket_id; ?></span></td>
                        <td>
                            <p style="font-weight: 700; font-size: 0.85rem;"><?php echo htmlspecialchars($c->member_name); ?></p>
                            <p style="font-size: 0.75rem; color: var(--text-muted);"><?php echo htmlspecialchars($c->lga_name . ' / ' . $c->unit_name); ?></p>
                        </td>
                        <td><span class="role-badge" style="font-size: 0.7rem;"><?php echo htmlspecialchars($c->category); ?></span></td>
                        <td style="font-size: 0.85rem; max-width: 250px;"><?php echo htmlspecialchars($c->subject); ?></td>
                        <td style="font-size: 0.85rem;"><?php echo date('M d, Y', strtotime($c->created_at)); ?></td>
                        <td>
                            <?php 
                            $status_class = 'pending';
                            if($c->status == 'Resolved') $status_class = 'paid';
                            if($c->status == 'Critical') $status_class = 'owing';
                            ?>
                            <span class="status-check <?php echo $status_class; ?>"><?php echo $c->status; ?></span>
                        </td>
                        <td>
                            <?php 
                            $json = base64_encode(json_encode([
                                'ticket_id' => $c->ticket_id,
                                'member' => $c->member_name,
                                'category' => $c->category,
                                'description' => $c->description,
                                'date' => date('M d, Y', strtotime($c->created_at)),
                                'status' => $c->status,
                                'admin_reply' => $c->admin_reply
                            ])); 
                            ?>
                            <button 
                                class="btn btn-outline btn-review" 
                                style="padding: 0.3rem 0.6rem; font-size: 0.75rem; border-radius: 6px;" 
                                data-complaint='<?php echo $json; ?>'
                                onclick="viewComplaint(this)">
                                Review
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- View Complaint Modal -->
<div id="viewModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; clear: both; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div class="card" style="width: 500px; padding: 2rem;">
        <h3 id="modalTicketId" style="margin-bottom: 1rem; color: var(--primary);">Complaint Details</h3>
        <form action="<?php echo URLROOT; ?>/admin/resolve_complaint" method="POST">
            <input type="hidden" name="ticket_id" id="modalTicketIdInput">
            <div id="modalContent" style="font-size: 0.9rem; line-height: 1.6;"></div>
            
            <div class="form-group" style="margin-top: 1rem; background: var(--bg-alt); padding: 1rem; border-radius: 8px;">
                <label style="font-weight: 700; margin-bottom: 0.5rem; display: block;">Official Reply / Resolution Notes</label>
                <textarea name="admin_reply" id="modalAdminReply" class="form-control" rows="4" placeholder="Enter notes or reply to the member here..."></textarea>
                
                <label style="font-weight: 700; margin-bottom: 0.5rem; display: block; margin-top: 1rem;">Update Status</label>
                <select name="status" id="modalStatusSelect" class="form-control" style="appearance: auto; background: white;">
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Critical">Critical</option>
                </select>
            </div>
            
            <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="button" class="btn btn-outline" style="flex: 1;" onclick="closeModal()">Close</button>
                <button type="submit" class="btn btn-primary" style="flex: 1;">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
function viewComplaint(btn) {
    const data = JSON.parse(atob(btn.getAttribute('data-complaint')));
    
    document.getElementById('modalTicketId').innerText = 'Complaint: #' + data.ticket_id;
    document.getElementById('modalTicketIdInput').value = data.ticket_id;
    document.getElementById('modalStatusSelect').value = data.status;
    document.getElementById('modalAdminReply').value = data.admin_reply ? data.admin_reply : '';

    // Sanitize and handle newlines
    let safeDesc = (data.description || "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/\n/g, "<br>");
    
    document.getElementById('modalContent').innerHTML = `
        <div style="margin-bottom: 1rem;">
            <p><strong>Member:</strong> ${data.member}</p>
            <p><strong>Category:</strong> <span class="role-badge">${data.category}</span></p>
        </div>
        <div style="background: white; border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 8px; margin-top: 1rem; color: #1e293b; font-size: 0.85rem; border-left: 4px solid var(--primary);">
            ${safeDesc}
        </div>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 1.5rem;">Submitted on: ${data.date}</p>
    `;
    document.getElementById('viewModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('viewModal').style.display = 'none';
}

async function applyFilters() {
    const lga = document.getElementById('filterLga').value;
    const category = document.getElementById('filterCategory').value;
    const status = document.getElementById('filterStatus').value;
    const search = document.getElementById('filterSearch').value;
    
    const btn = document.querySelector('button[onclick="applyFilters()"]');
    const originalText = btn.innerText;
    btn.innerText = 'Filtering...';
    btn.disabled = true;

    try {
        const url = `<?php echo URLROOT; ?>/admin/complaints?ajax=1&lga_id=${lga}&category=${encodeURIComponent(category)}&status=${status}&search=${encodeURIComponent(search)}`;
        const response = await fetch(url);
        const res = await response.json();

        if (res.success) {
            const tbody = document.getElementById('complaintsTableBody');
            tbody.innerHTML = '';

            let total = res.complaints.length;
            let pending = 0;
            let resolved = 0;
            let critical = 0;

            if (total === 0) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;">No complaints match your filters.</td></tr>';
            } else {
                res.complaints.forEach(c => {
                    if (c.status === 'Pending' || c.status === 'In Progress') pending++;
                    if (c.status === 'Resolved') resolved++;
                    if (c.status === 'Critical') critical++;

                    let statusClass = 'pending';
                    if (c.status === 'Resolved') statusClass = 'paid';
                    if (c.status === 'Critical') statusClass = 'owing';

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td><span style="font-family: monospace; font-weight: 700; color: var(--primary);">${c.ticket_id}</span></td>
                        <td>
                            <p style="font-weight: 700; font-size: 0.85rem;">${c.member_name}</p>
                            <p style="font-size: 0.75rem; color: var(--text-muted);">${c.lga_name} / ${c.unit_name}</p>
                        </td>
                        <td><span class="role-badge" style="font-size: 0.7rem;">${c.category}</span></td>
                        <td style="font-size: 0.85rem; max-width: 250px;">${c.subject}</td>
                        <td style="font-size: 0.85rem;">${c.formatted_date}</td>
                        <td><span class="status-check ${statusClass}">${c.status}</span></td>
                        <td>
                            <button 
                                class="btn btn-outline btn-review" 
                                style="padding: 0.3rem 0.6rem; font-size: 0.75rem; border-radius: 6px;" 
                                data-complaint='${c.json_payload}'
                                onclick="viewComplaint(this)">
                                Review
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            // Update Summary Stats
            document.getElementById('stat_total').innerText = total;
            document.getElementById('stat_pending').innerText = pending;
            document.getElementById('stat_resolved').innerText = resolved;
            document.getElementById('stat_critical').innerText = critical;
        }
    } catch (error) {
        console.error('Filter error:', error);
        alert('An error occurred while filtering. Please try again.');
    } finally {
        btn.innerText = originalText;
        btn.disabled = false;
    }
}

// Optional: Apply filters on enter in search box
document.getElementById('filterSearch').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        applyFilters();
    }
});
</script>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
