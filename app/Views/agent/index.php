<?php require APPROOT . '/Views/inc/agent/header.php'; ?>

<div class="welcome-section" style="margin-bottom: 2rem; margin-top: 1rem;">
    <h1 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 0.2rem; color: var(--text-main);">Hello, <?php echo explode(' ', $_SESSION['user_fullname'])[0]; ?>!</h1>
    <p style="color: var(--text-muted); font-size: 0.95rem;">Ready for today's collection?</p>
</div>

<!-- Stats Card -->
<div class="card-mobile" style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); color: white; border: none; position: relative; overflow: hidden; height: 200px; display: flex; flex-direction: column; justify-content: center; padding: 2rem; margin: 0;">
    <!-- Decorative Circle -->
    <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
    
    <p style="font-size: 0.85rem; opacity: 0.9; margin-bottom: 0.5rem; font-weight: 500;">YOUR TOTAL COLLECTIONS today</p>
    <h2 style="font-size: 2.8rem; font-weight: 800; margin: 0; letter-spacing: -1px;">₦<?php echo number_format($data['stats']->today, 0); ?></h2>
    
    <div style="display: flex; gap: 25px; margin-top: 1.5rem; padding-top: 1.2rem; border-top: 1px solid rgba(255,255,255,0.2);">
        <div>
            <p style="font-size: 0.7rem; opacity: 0.8; margin: 0; font-weight: 500;">THIS WEEK</p>
            <p style="font-weight: 700; font-size: 1rem; margin-top: 2px;">₦<?php echo number_format($data['stats']->week, 0); ?></p>
        </div>
        <div>
            <p style="font-size: 0.7rem; opacity: 0.8; margin: 0; font-weight: 500;">REGISTRATIONS by you</p>
            <p style="font-weight: 700; font-size: 1rem; margin-top: 2px; text-align: center;"><?php echo $data['stats']->active; ?></p>
        </div>
    </div>

</div>

<!-- Quick Actions -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 1.5rem;">
    <a href="<?php echo URLROOT; ?>/agent/verify" style="text-decoration: none;">
        <div class="card-mobile" style="margin: 0; text-align: center; padding: 1.5rem; display: flex; flex-direction: column; align-items: center; justify-content: center; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 50px; height: 50px; background: rgba(0, 161, 255, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 12px;">🔍</div>
            <p style="font-weight: 700; color: var(--text-main); margin: 0; font-size: 0.95rem;">Verify Plate</p>
            <p style="font-size: 0.7rem; color: var(--text-muted); margin-top: 4px;">Real-time Search</p>
        </div>
    </a>
    <a href="<?php echo URLROOT; ?>/agent/history" style="text-decoration: none;">
        <div class="card-mobile" style="margin: 0; text-align: center; padding: 1.5rem; display: flex; flex-direction: column; align-items: center; justify-content: center; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="width: 50px; height: 50px; background: rgba(255, 171, 0, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 12px;">📜</div>
            <p style="font-weight: 700; color: var(--text-main); margin: 0; font-size: 0.95rem;">Logs</p>
            <p style="font-size: 0.7rem; color: var(--text-muted); margin-top: 4px;">Collection History</p>
        </div>
    </a>
</div>

<!-- Recent Collections -->
<div style="margin-top: 2.5rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem; padding: 0 5px;">
        <h3 style="font-weight: 800; font-size: 1.2rem; color: var(--text-main); letter-spacing: -0.5px;">Recent Work</h3>
        <a href="<?php echo URLROOT; ?>/agent/history" style="font-size: 0.85rem; color: var(--accent-primary); text-decoration: none; font-weight: 700;">SEE ALL</a>
    </div>
    
    <div class="card-mobile" style="padding: 0; overflow: hidden; margin: 0;">
        <?php if(empty($data['history'])): ?>
            <div style="padding: 3rem 2rem; text-align: center; color: var(--text-muted);">
                <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;">📋</div>
                <p style="font-weight: 500;">No collections recorded today</p>
                <p style="font-size: 0.8rem; margin-top: 5px;">Records will appear here after verification</p>
            </div>
        <?php else: ?>
            <?php foreach(array_slice($data['history'], 0, 5) as $tx): ?>
                <div style="padding: 1.2rem; border-bottom: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <div style="width: 40px; height: 40px; background: var(--bg-alt); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--accent-primary); font-size: 0.8rem;">
                            TX
                        </div>
                        <div>
                            <p style="font-weight: 700; font-size: 0.95rem; margin: 0; color: var(--text-main);"><?php echo $tx->member_name; ?></p>
                            <p style="font-size: 0.75rem; color: var(--text-muted); margin: 2px 0 0 0; font-weight: 500;"><?php echo $tx->plate_number; ?> • <?php echo date('h:i A', strtotime($tx->payment_date)); ?></p>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <p style="font-weight: 800; color: #00c853; margin: 0; font-size: 1rem;">₦<?php echo number_format($tx->amount, 0); ?></p>
                        <span style="font-size: 0.65rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase;">Paid</span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/Views/inc/agent/footer.php'; ?>
