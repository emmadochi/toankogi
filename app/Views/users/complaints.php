<?php require APPROOT . '/Views/inc/users/header.php'; ?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 class="page-title">Complaints & Support</h1>
        <p class="page-subtitle">Submit and track your complaints through your registered Area/Unit.</p>
    </div>
    <button class="btn btn-primary" onclick="openModal('newComplaintModal')">
        <span>➕</span> New Complaint
    </button>
</div>

<?php
$total_c = count($data['complaints']);
$resolved_c = 0;
$pending_c = 0;
foreach($data['complaints'] as $c) {
    if(strtolower($c->status) == 'resolved') $resolved_c++;
    if(strtolower($c->status) == 'pending' || strtolower($c->status) == 'in progress') $pending_c++;
}
?>
<div class="content-grid">
    <!-- Complaint Stats -->
    <div class="card" style="grid-column: span 12; display: flex; gap: 2rem; padding: 1.5rem; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 150px;">
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">Registered Area</p>
            <h3 style="font-weight: 700; color: var(--primary);">Your Local Unit</h3>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">Total Complaints</p>
            <h3 style="font-weight: 700;"><?php echo $total_c; ?></h3>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">Resolved</p>
            <h3 style="font-weight: 700; color: #059669;"><?php echo $resolved_c; ?></h3>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">Pending</p>
            <h3 style="font-weight: 700; color: #f59e0b;"><?php echo $pending_c; ?></h3>
        </div>
    </div>

    <!-- Complaints Table -->
    <div class="card" style="grid-column: span 12;">
        <div class="card-title">Recent Complaints</div>
        <?php flash('member_success'); flash('member_error'); ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Subject</th>
                        <th>Category</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['complaints'])): ?>
                        <tr><td colspan="6" style="text-align: center;">No complaints found.</td></tr>
                    <?php else: ?>
                        <?php foreach($data['complaints'] as $c): ?>
                        <tr>
                            <td><span style="font-family: monospace; font-weight: 600;">#<?php echo $c->ticket_id; ?></span></td>
                            <td><?php echo htmlspecialchars($c->subject); ?></td>
                            <td><span class="role-badge"><?php echo htmlspecialchars($c->category); ?></span></td>
                            <td><?php echo date('M d, Y', strtotime($c->created_at)); ?></td>
                            <td>
                                <?php 
                                $status_class = 'pending';
                                if(strtolower($c->status) == 'resolved') $status_class = 'paid';
                                if(strtolower($c->status) == 'critical') $status_class = 'owing';
                                ?>
                                <span class="status-check <?php echo $status_class; ?>" style="padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.75rem;"><?php echo $c->status; ?></span>
                            </td>
                            <?php 
                            $json = htmlspecialchars(json_encode([
                                'subject' => $c->subject,
                                'description' => $c->description,
                                'reply' => $c->admin_reply,
                                'status' => $c->status
                            ]), ENT_QUOTES, 'UTF-8'); 
                            ?>
                            <td><button class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.75rem;" onclick="viewUserTicket(<?php echo $json; ?>)">View Info</button></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- New Complaint Modal -->
<div id="newComplaintModal" class="modal-overlay">
    <div class="modal-content" style="max-width: 600px;">
        <div class="modal-header">
            <h3 class="modal-title">New Complaint</h3>
            <span class="close-modal" onclick="closeModal('newComplaintModal')">&times;</span>
        </div>
        <form action="<?php echo URLROOT; ?>/users/submit_complaint" method="POST">
            <div style="background: var(--bg-alt); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; border-left: 4px solid var(--primary);">
                <div>
                    <p style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 2px;">Reporting Through Area</p>
                    <p style="font-weight: 700; font-size: 0.9rem;">Your Local Unit</p>
                </div>
                <span style="font-size: 1.5rem;">📍</span>
            </div>

            <div class="form-group">
                <label>Complaint Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="e.g. Issue with Daily Payment" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-control" required style="appearance: auto; background: white;">
                    <option value="">Select a category</option>
                    <option value="Payment Issue">Payment Issue</option>
                    <option value="Enforcement Harassment">Enforcement Harassment</option>
                    <option value="Verification / ID Card">Verification / ID Card</option>
                    <option value="Unit Management Issue">Unit Management Issue</option>
                    <option value="Other Technical Issues">Other Technical Issues</option>
                </select>
            </div>

            <div class="form-group">
                <label>Detailed Description</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Please describe your complaint in detail..." required></textarea>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="button" class="btn btn-outline" style="flex: 1;" onclick="closeModal('newComplaintModal')">Cancel</button>
                <button type="submit" class="btn btn-primary" style="flex: 1;">Submit Complaint</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).style.display = 'flex';
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

    // Removed handleComplaintSubmit mock logic

function viewUserTicket(data) {
    let msg = "Subject: " + data.subject + "\n\nDescription:\n" + data.description;
    if (data.reply) {
        msg += "\n\n--- OFFICIAL ADMIN REPLY (" + data.status.toUpperCase() + ") ---\n" + data.reply;
    }
    alert(msg);
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.className === 'modal-overlay') {
        event.target.style.display = 'none';
    }
}
</script>

<?php require APPROOT . '/Views/inc/users/footer.php'; ?>
