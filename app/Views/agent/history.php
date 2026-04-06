<?php require APPROOT . '/Views/inc/agent/header.php'; ?>

<div class="history-section" style="margin-top: 1rem;">
    <h2 style="font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem; letter-spacing: -0.8px; font-size: 1.6rem;">Transaction Logs</h2>
    <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 1.8rem; font-weight: 500;">Secure history of all revenue collections recorded by your account.</p>

    <div class="card-mobile" style="padding: 0; overflow: hidden; margin: 0; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <?php if(empty($data['history'])): ?>
            <div style="padding: 5rem 2rem; text-align: center; color: var(--text-muted); background: var(--glass-bg);">
                <div style="font-size: 4rem; margin-bottom: 1.2rem; opacity: 0.2;">📜</div>
                <p style="font-weight: 700; font-size: 1.1rem; color: var(--text-main);">Electronic Ledger Empty</p>
                <p style="font-size: 0.85rem; margin-top: 8px; opacity: 0.7;">Verified transactions will appear here in real-time.</p>
                <a href="<?php echo URLROOT; ?>/agent/verify" class="btn-mobile btn-primary-mobile" style="margin-top: 2rem; display: inline-flex; width: auto; padding: 0.8rem 2rem;">
                    START COLLECTION
                </a>
            </div>
        <?php else: ?>
            <?php 
            $currentDate = '';
            foreach($data['history'] as $tx): 
                $txTime = strtotime($tx->payment_date);
                $txDate = date('Y-m-d', $txTime);
                if($txDate != $currentDate):
                    $currentDate = $txDate;
                    $displayDate = (date('Y-m-d') == $txDate) ? 'TODAY' : date('d M Y', $txTime);
            ?>
                <div style="background: rgba(255,255,255,0.03); padding: 0.8rem 1.5rem; font-size: 0.7rem; font-weight: 900; color: var(--accent-primary); text-transform: uppercase; border-bottom: 1px solid var(--glass-border); letter-spacing: 1.5px; display: flex; align-items: center; gap: 8px;">
                    <div style="width: 6px; height: 6px; background: var(--accent-primary); border-radius: 50%;"></div>
                    <?php echo $displayDate; ?>
                </div>
            <?php endif; ?>

            <a href="<?php echo URLROOT; ?>/agent/receipt/<?php echo $tx->id; ?>" style="text-decoration: none; display: block;">
                <div style="padding: 1.4rem 1.5rem; border-bottom: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center; transition: all 0.2s ease; background: var(--glass-bg);" 
                     onmouseover="this.style.background='rgba(255,255,255,0.05)'" 
                     onmouseout="this.style.background='var(--glass-bg)'">
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="width: 46px; height: 46px; background: rgba(0, 161, 255, 0.1); border: 1px solid rgba(0, 161, 255, 0.2); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: var(--accent-primary); font-weight: 700;">
                            ₦
                        </div>
                        <div>
                            <p style="font-weight: 800; font-size: 1rem; margin: 0; color: var(--text-main); letter-spacing: -0.3px;"><?php echo $tx->member_name; ?></p>
                            <p style="font-size: 0.75rem; color: var(--text-muted); margin: 4px 0 0 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                <?php echo $tx->plate_number; ?> <span style="opacity: 0.4; margin: 0 5px;">•</span> <?php echo date('h:i A', $txTime); ?>
                            </p>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <p style="font-weight: 900; color: var(--text-main); margin: 0; font-size: 1.1rem; letter-spacing: -0.5px;">₦<?php echo number_format($tx->amount, 0); ?></p>
                        <div style="display: flex; align-items: center; gap: 4px; justify-content: flex-end; margin-top: 4px;">
                            <span style="width: 6px; height: 6px; background: #00c853; border-radius: 50%;"></span>
                            <span style="font-size: 0.65rem; color: #00c853; font-weight: 800; text-transform: uppercase;">SECURED</span>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/Views/inc/agent/footer.php'; ?>
