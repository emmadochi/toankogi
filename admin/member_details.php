<?php include 'layouts/header.php'; 

// Fetch member data from GET (simulation)
$member_id = $_GET['id'] ?? 'KOG-LOK-00124';
$member_name = $_GET['name'] ?? 'Ameh Sunday';

// Simulation of member details and history
$member_profile = [
    'plate_no' => 'LKJ-123-AB',
    'lga' => 'Lokoja',
    'unit' => 'Central Park',
    'registered_on' => '2025-10-15',
    'tax_cycle' => 'Daily',
    'last_payment' => '2026-03-26',
    'phone' => '08034567890',
    'status' => 'Verified'
];

$payments = [
    ['2026-03-26 08:30 AM', 'TRX-102938', 'Daily Tax', '₦200.00', 'Paid'],
    ['2026-03-25 09:15 AM', 'TRX-102847', 'Daily Tax', '₦200.00', 'Paid'],
    ['2026-03-24 07:45 AM', 'TRX-102756', 'Daily Tax', '₦200.00', 'Paid'],
    ['2026-03-23 08:05 AM', 'TRX-102665', 'Daily Tax', '₦200.00', 'Paid'],
    ['2026-03-20 02:30 PM', 'TRX-102574', 'Weekly Tax', '₦1,200.00', 'Paid'],
];

// Calculation simulation
$total_paid = "₦3,500.00";
$total_unpaid = "₦0.00"; // Assuming they are up to date for this demo
?>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-end;">
    <div style="display: flex; gap: 1rem; align-items: center;">
        <a href="members.php" style="text-decoration: none; font-size: 1.5rem; color: var(--text-muted); padding: 0.5rem;">←</a>
        <div>
            <h1 class="page-title">Member Profile & History</h1>
            <p class="page-subtitle"><?php echo $member_name; ?> (<?php echo $member_id; ?>)</p>
        </div>
    </div>
    <div style="display: flex; gap: 1rem;">
        <a href="id_card.php?id=<?php echo urlencode($member_id); ?>&name=<?php echo urlencode($member_name); ?>" class="btn btn-outline">📇 ID Card</a>
        <button class="btn btn-primary">✏️ Edit Profile</button>
    </div>
</div>

<div class="content-grid" style="grid-template-columns: 350px 1fr; gap: 2rem;">
    <!-- Profile Sidebar -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card" style="text-align: center; padding: 2rem;">
            <div style="width: 120px; height: 120px; background: var(--bg-alt); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 4rem; margin: 0 auto 1.5rem; border: 4px solid white; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">👤</div>
            <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;"><?php echo $member_name; ?></h3>
            <span class="status-check paid" style="font-size: 0.75rem; padding: 4px 12px;"><?php echo $member_profile['status']; ?></span>
            
            <div style="margin-top: 2rem; text-align: left; display: flex; flex-direction: column; gap: 1rem;">
                <div>
                    <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Unique ID</span>
                    <p style="font-weight: 700; color: var(--primary); font-family: monospace;"><?php echo $member_id; ?></p>
                </div>
                <div>
                    <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Plate Number</span>
                    <p style="font-weight: 700;"><?php echo $member_profile['plate_no']; ?></p>
                </div>
                <div>
                    <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Location</span>
                    <p style="font-weight: 600; font-size: 0.85rem;"><?php echo $member_profile['lga']; ?> / <?php echo $member_profile['unit']; ?></p>
                </div>
                <div>
                    <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Phone Number</span>
                    <p style="font-weight: 600; font-size: 0.85rem;"><?php echo $member_profile['phone']; ?></p>
                </div>
            </div>
        </div>

        <!-- Tax Statistics -->
        <div class="card" style="background: var(--dark); color: white; border: none;">
            <h4 style="color: rgba(255,255,255,0.6); font-size: 0.75rem; text-transform: uppercase; margin-bottom: 1.5rem; letter-spacing: 1px;">Tax Standing Summary</h4>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div>
                    <p style="font-size: 0.75rem; opacity: 0.7; margin-bottom: 4px;">Total Revenue Paid</p>
                    <p style="font-size: 1.75rem; font-weight: 800; color: var(--accent);"><?php echo $total_paid; ?></p>
                </div>
                <div style="height: 1px; background: rgba(255,255,255,0.1);"></div>
                <div>
                    <p style="font-size: 0.75rem; opacity: 0.7; margin-bottom: 4px;">Arrears / Unpaid Task</p>
                    <p style="font-size: 1.25rem; font-weight: 700; color: #ef4444;"><?php echo $total_unpaid; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Breakdown -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card" style="padding: 0;">
            <div style="padding: 1.5rem; border-bottom: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 1.1rem; font-weight: 700;">Revenue Payment Breakdown</h3>
                <div style="display: flex; gap: 0.5rem;">
                    <button class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;">Filter Date</button>
                    <button class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem;">Export CSV</button>
                </div>
            </div>
            
            <div class="table-container">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date / Time</th>
                            <th>Transaction ID</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($payments as $p): ?>
                        <tr>
                            <td style="font-size: 0.85rem;"><?php echo $p[0]; ?></td>
                            <td style="font-family: monospace; font-size: 0.8rem; font-weight: 600;"><?php echo $p[1]; ?></td>
                            <td style="font-size: 0.85rem;"><?php echo $p[2]; ?></td>
                            <td style="font-weight: 700; font-size: 0.85rem; color: var(--dark);"><?php echo $p[3]; ?></td>
                            <td><span class="status-check paid" style="font-size: 0.65rem;"><?php echo $p[4]; ?></span></td>
                            <td style="text-align: right;">
                                <a href="receipt.php?trx=<?php echo $p[1]; ?>&id=<?php echo $member_id; ?>&name=<?php echo urlencode($member_name); ?>" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.7rem;">Print Receipt</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div style="padding: 1.5rem; text-align: center; border-top: 1px solid var(--glass-border);">
                <button style="border: none; background: none; color: var(--primary); font-weight: 700; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; margin: 0 auto;">
                    Expand Full History <span>↓</span>
                </button>
            </div>
        </div>

        <!-- Compliance Calendar / Note -->
        <div class="card" style="background: #fffbeb; border-color: #fef3c7;">
            <div style="display: flex; gap: 1rem; align-items: flex-start;">
                <div style="font-size: 1.5rem;">⚠️</div>
                <div>
                    <h4 style="color: #92400e; margin-bottom: 0.4rem; font-size: 0.9rem; font-weight: 700;">Operational Compliance Note</h4>
                    <p style="font-size: 0.8rem; color: #b45309; line-height: 1.6;">
                        This member is currently in good standing. Next daily tax collection is expected tomorrow before 10:00 AM. Failure to pay will result in 'Expired Tax' status and may lead to vehicle impoundment by field agents.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
