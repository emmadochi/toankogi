<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<?php
$member = $data['member'];
$trx_id = $data['trx_id'];
$member_id = $member->unique_id;
$member_name = $member->fullname;
$plate_no = $member->plate_number;
$date = date('d M Y', strtotime($member->created_at));
?>

<div class="page-header">
    <h1 class="page-title">Registration Complete</h1>
    <p class="page-subtitle">Member has been successfully onboarded and added to the state revenue database.</p>
</div>

<div class="success-card" style="background: white; border-radius: 20px; padding: 3rem; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.05); border: 1px solid var(--glass-border); margin-bottom: 2rem;">
    <div style="width: 80px; height: 80px; background: #ecfdf5; color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 2.5rem; animation: bounce 2s infinite;">✓</div>
    <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--dark);">Success!</h2>
    <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 2rem;">Registration for <strong><?php echo $member_name; ?></strong> is complete.</p>
    
    <div style="display: inline-flex; gap: 3rem; text-align: left; background: var(--bg-alt); padding: 1.5rem 2.5rem; border-radius: 15px; border: 1px solid var(--glass-border);">
        <div>
            <span style="display: block; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Member ID</span>
            <p style="font-weight: 700; color: var(--primary); font-family: monospace; font-size: 1.1rem;"><?php echo $member_id; ?></p>
        </div>
        <div>
            <span style="display: block; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Plate Number</span>
            <p style="font-weight: 700; font-size: 1.1rem;"><?php echo $plate_no; ?></p>
        </div>
        <div>
            <span style="display: block; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Date</span>
            <p style="font-weight: 700; font-size: 1.1rem;"><?php echo $date; ?></p>
        </div>
    </div>
</div>

<h3 style="margin: 2.5rem 0 1.5rem; font-size: 1.25rem;">Available Documents</h3>

<div class="action-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
    <!-- Receipt Card -->
    <div class="card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1.5rem; transition: 0.3s; cursor: pointer;" onclick="window.location.href='<?php echo URLROOT; ?>/admin/receipt?trx_id=<?php echo $trx_id; ?>'">
        <div style="width: 60px; height: 60px; background: #eff6ff; color: #3b82f6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📄</div>
        <div style="flex: 1;">
            <h4 style="margin-bottom: 0.2rem;">Official Receipt</h4>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Digital proof of registration payment.</p>
        </div>
        <button class="btn btn-primary" style="padding: 0.5rem 1rem;">View</button>
    </div>

    <!-- Keke Sticker Card -->
    <div class="card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1.5rem; transition: 0.3s; cursor: pointer;" onclick="window.location.href='<?php echo URLROOT; ?>/admin/sticker?id=<?php echo $member->id; ?>'">
        <div style="width: 60px; height: 60px; background: #fff7ed; color: #f97316; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🎫</div>
        <div style="flex: 1;">
            <h4 style="margin-bottom: 0.2rem;">Vehicle Sticker</h4>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Verification sticker for the Keke.</p>
        </div>
        <button class="btn btn-primary" style="padding: 0.5rem 1rem;">View</button>
    </div>

    <!-- ID Card Card -->
    <div class="card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1.5rem; transition: 0.3s; cursor: pointer;" onclick="window.location.href='<?php echo URLROOT; ?>/admin/id_card?id=<?php echo $member->id; ?>'">
        <div style="width: 60px; height: 60px; background: #f0fdf4; color: #10b981; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🪪</div>
        <div style="flex: 1;">
            <h4 style="margin-bottom: 0.2rem;">Member ID Card</h4>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Digital identity for the association.</p>
        </div>
        <button class="btn btn-primary" style="padding: 0.5rem 1rem;">View</button>
    </div>
</div>

<div style="text-align: center; border-top: 1px solid var(--glass-border); padding-top: 2rem;">
    <a href="<?php echo URLROOT; ?>/admin/index" class="btn btn-outline" style="margin-right: 1rem;">Back to Dashboard</a>
    <a href="<?php echo URLROOT; ?>/admin/registration" class="btn btn-primary">Register Another Member</a>
</div>

<style>
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}
.card:hover {
    transform: translateY(-5px);
    border-color: var(--primary);
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}
</style>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
