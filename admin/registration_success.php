<?php include 'layouts/header.php'; 

// Simulate fetching data from the previous registration
$member_id = $_GET['id'] ?? 'KOG-LOK-' . rand(10000, 99999);
$member_name = $_GET['name'] ?? 'Ameh Sunday';
$plate_no = $_GET['plate'] ?? 'LKJ-123-ABC';
$lga = $_GET['lga'] ?? 'Lokoja';
$unit = $_GET['unit'] ?? 'Central Park 01';
$date = date('d M Y');
?>

<div class="page-header">
    <h1 class="page-title">Registration Complete</h1>
    <p class="page-subtitle">Member has been successfully onboarded and added to the state revenue database.</p>
</div>

<div class="success-card" style="background: white; border-radius: 20px; padding: 2.5rem 1.5rem; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.05); border: 1px solid var(--glass-border); margin-bottom: 2rem;">
    <div style="width: 80px; height: 80px; background: #ecfdf5; color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 2.5rem; animation: bounce 2s infinite;">✓</div>
    <h2 style="font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--dark);">Success!</h2>
    <p style="color: var(--text-muted); font-size: 1rem; margin-bottom: 2rem;">Registration for <strong><?php echo $member_name; ?></strong> is complete.</p>
    
    <div class="admin-grid" style="text-align: left; background: var(--bg-alt); padding: 1.5rem; border-radius: 15px; border: 1px solid var(--glass-border); max-width: 600px; margin: 0 auto;">
        <div>
            <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Member ID</span>
            <p style="font-weight: 700; color: var(--primary); font-family: monospace; font-size: 1rem;"><?php echo $member_id; ?></p>
        </div>
        <div>
            <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Plate Number</span>
            <p style="font-weight: 700; font-size: 1rem;"><?php echo $plate_no; ?></p>
        </div>
        <div>
            <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Date</span>
            <p style="font-weight: 700; font-size: 1rem;"><?php echo $date; ?></p>
        </div>
    </div>
</div>

<h3 style="margin: 2.5rem 0 1.5rem; font-size: 1.2rem; font-weight: 700;">Member Documents</h3>

<div class="action-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-bottom: 3rem;">
    <!-- Receipt Card -->
    <div class="card" style="padding: 1.25rem; display: flex; align-items: center; gap: 1.25rem; transition: 0.3s; cursor: pointer;" onclick="window.location.href='receipt.php?id=<?php echo $member_id; ?>&name=<?php echo urlencode($member_name); ?>&plate=<?php echo $plate_no; ?>'">
        <div style="width: 50px; height: 50px; background: #eff6ff; color: #3b82f6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">📄</div>
        <div style="flex: 1;">
            <h4 style="margin-bottom: 0.1rem; font-size: 0.95rem;">Official Receipt</h4>
            <p style="font-size: 0.75rem; color: var(--text-muted);">Proof of registration payment.</p>
        </div>
        <i class="fas fa-chevron-right" style="color: var(--glass-border); font-size: 0.8rem;"></i>
    </div>

    <!-- Keke Sticker Card -->
    <div class="card" style="padding: 1.25rem; display: flex; align-items: center; gap: 1.25rem; transition: 0.3s; cursor: pointer;" onclick="window.location.href='sticker.php?id=<?php echo $member_id; ?>&name=<?php echo urlencode($member_name); ?>&plate=<?php echo $plate_no; ?>'">
        <div style="width: 50px; height: 50px; background: #fff7ed; color: #f97316; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">🎫</div>
        <div style="flex: 1;">
            <h4 style="margin-bottom: 0.1rem; font-size: 0.95rem;">Vehicle Sticker</h4>
            <p style="font-size: 0.75rem; color: var(--text-muted);">Physical Keke identification.</p>
        </div>
        <i class="fas fa-chevron-right" style="color: var(--glass-border); font-size: 0.8rem;"></i>
    </div>

    <!-- ID Card Card -->
    <div class="card" style="padding: 1.25rem; display: flex; align-items: center; gap: 1.25rem; transition: 0.3s; cursor: pointer;" onclick="window.location.href='id_card.php?id=<?php echo $member_id; ?>&name=<?php echo urlencode($member_name); ?>&plate=<?php echo $plate_no; ?>'">
        <div style="width: 50px; height: 50px; background: #f0fdf4; color: #10b981; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">🪪</div>
        <div style="flex: 1;">
            <h4 style="margin-bottom: 0.1rem; font-size: 0.95rem;">Member ID Card</h4>
            <p style="font-size: 0.75rem; color: var(--text-muted);">Digital association ID card.</p>
        </div>
        <i class="fas fa-chevron-right" style="color: var(--glass-border); font-size: 0.8rem;"></i>
    </div>
</div>

<div style="text-align: center; border-top: 1px solid var(--glass-border); padding-top: 2rem; display: flex; flex-direction: column; gap: 1rem; align-items: center;">
    <a href="index.php" class="btn btn-outline" style="width: 100%; max-width: 300px;">Back to Dashboard</a>
    <a href="registration.php" class="btn btn-primary" style="width: 100%; max-width: 300px;">Register Another Member</a>
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

<?php include 'layouts/footer.php'; ?>
