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

<div class="page-header" style="flex-wrap: wrap; gap: 1.5rem;">
    <div style="display: flex; gap: 0.8rem; align-items: center;">
        <a href="members.php" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 1.2rem;">←</a>
        <div>
            <h1 class="page-title">Member Profile</h1>
            <p class="page-subtitle"><?php echo $member_name; ?></p>
        </div>
    </div>
    <div style="display: flex; gap: 0.8rem; width: 100%; justify-content: flex-start;">
        <a href="id_card.php?id=<?php echo urlencode($member_id); ?>&name=<?php echo urlencode($member_name); ?>" class="btn btn-outline" style="flex: 1; text-align: center; font-size: 0.85rem; padding: 0.8rem;">📇 ID Card</a>
        <button class="btn btn-primary" style="flex: 1; font-size: 0.85rem; padding: 0.8rem;">✏️ Edit</button>
    </div>
</div>

<div class="content-grid">
    <!-- Profile Sidebar -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card" style="text-align: center; padding: 2rem 1.5rem;">
            <div style="width: 100px; height: 100px; background: var(--bg-alt); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; margin: 0 auto 1.25rem; border: 4px solid white; box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow: hidden;">👤</div>
            <h3 style="font-size: 1.2rem; font-weight: 800; margin-bottom: 0.5rem;"><?php echo $member_name; ?></h3>
            <span class="status-check paid" style="font-size: 0.7rem; padding: 4px 12px; font-weight: 800;"><?php echo strtoupper($member_profile['status']); ?></span>
            
            <div class="admin-grid" style="margin-top: 2rem; text-align: left; grid-template-columns: 1fr;">
                <div style="padding: 1rem; background: var(--bg-alt); border-radius: 12px; border: 1px solid var(--glass-border);">
                    <span style="display: block; font-size: 0.6rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Unique ID</span>
                    <p style="font-weight: 800; color: var(--primary); font-family: monospace; font-size: 0.95rem;"><?php echo $member_id; ?></p>
                </div>
                <div style="padding: 1rem; background: var(--bg-alt); border-radius: 12px; border: 1px solid var(--glass-border);">
                    <span style="display: block; font-size: 0.6rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Plate Number</span>
                    <p style="font-weight: 700; font-size: 0.95rem;"><?php echo $member_profile['plate_no']; ?></p>
                </div>
                <div style="padding: 1rem; background: var(--bg-alt); border-radius: 12px; border: 1px solid var(--glass-border);">
                    <span style="display: block; font-size: 0.6rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Unit</span>
                    <p style="font-weight: 600; font-size: 0.9rem;"><?php echo $member_profile['lga']; ?> / <?php echo $member_profile['unit']; ?></p>
                </div>
                <div style="padding: 1rem; background: var(--bg-alt); border-radius: 12px; border: 1px solid var(--glass-border);">
                    <span style="display: block; font-size: 0.6rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; margin-bottom: 4px;">Phone</span>
                    <p style="font-weight: 600; font-size: 0.9rem;"><?php echo $member_profile['phone']; ?></p>
                </div>
            </div>
        </div>

        <!-- Tax Statistics -->
        <div class="card" style="background: var(--dark); color: white; border: none; padding: 2rem;">
            <h4 style="color: rgba(255,255,255,0.6); font-size: 0.7rem; text-transform: uppercase; margin-bottom: 1.5rem; letter-spacing: 1px; font-weight: 700;">Revenue Standing</h4>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div>
                    <p style="font-size: 0.75rem; opacity: 0.7; margin-bottom: 4px;">Total Paid To-Date</p>
                    <p style="font-size: 2rem; font-weight: 800; color: var(--accent);"><?php echo $total_paid; ?></p>
                </div>
                <div style="height: 1px; background: rgba(255,255,255,0.1);"></div>
                <div>
                    <p style="font-size: 0.75rem; opacity: 0.7; margin-bottom: 4px;">Outstanding Arrears</p>
                    <p style="font-size: 1.25rem; font-weight: 800; color: #f87171;"><?php echo $total_unpaid; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Breakdown -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card" style="padding: 0;">
            <div style="padding: 1.25rem; border-bottom: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <h3 style="font-size: 1rem; font-weight: 800;">Payment History</h3>
                <div style="display: flex; gap: 0.5rem; width: 100%; sm-width: auto;">
                    <button class="btn btn-outline" style="flex: 1; padding: 0.5rem; font-size: 0.75rem;">Filter</button>
                    <button class="btn btn-outline" style="flex: 1; padding: 0.5rem; font-size: 0.75rem;">Export</button>
                </div>
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th class="hide-mobile">Ref</th>
                            <th class="hide-mobile">Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($payments as $p): ?>
                        <tr>
                            <td style="font-size: 0.8rem; white-space: nowrap;"><?php echo date('d M, Y', strtotime($p[0])); ?></td>
                            <td class="hide-mobile" style="font-family: monospace; font-size: 0.75rem;"><?php echo $p[1]; ?></td>
                            <td class="hide-mobile" style="font-size: 0.8rem;"><?php echo $p[2]; ?></td>
                            <td style="font-weight: 800; font-size: 0.85rem; color: var(--dark);"><?php echo $p[3]; ?></td>
                            <td><span class="status-check paid" style="font-size: 0.6rem; padding: 2px 8px;"><?php echo $p[4]; ?></span></td>
                            <td>
                                <a href="receipt.php?trx=<?php echo $p[1]; ?>&id=<?php echo $member_id; ?>&name=<?php echo urlencode($member_name); ?>" class="btn btn-outline" style="padding: 0.4rem; font-size: 0.75rem;">📄</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div style="padding: 1.25rem; text-align: center; border-top: 1px solid var(--glass-border);">
                <button style="border: none; background: none; color: var(--primary); font-weight: 800; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; margin: 0 auto;">
                    See All Transactions <span>↓</span>
                </button>
            </div>
        </div>

        <!-- Compliance Note -->
        <div class="card" style="background: #fffbeb; border-color: #fef3c7; padding: 1.25rem;">
            <div style="display: flex; gap: 1rem; align-items: flex-start;">
                <div style="font-size: 1.5rem;">⚠️</div>
                <div>
                    <h4 style="color: #92400e; margin-bottom: 0.4rem; font-size: 0.9rem; font-weight: 800;">Notice</h4>
                    <p style="font-size: 0.8rem; color: #b45309; line-height: 1.6;">
                        Member is in good standing. Failure to pay the next daily tax may result in vehicle impoundment.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
