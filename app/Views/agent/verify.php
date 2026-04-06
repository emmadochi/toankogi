<?php require APPROOT . '/Views/inc/agent/header.php'; ?>

<div class="verify-section" style="margin-top: 1rem;">
    <h2 style="font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem; letter-spacing: -0.5px;">Verify Operator</h2>
    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem; line-height: 1.4;">Scan QR code or enter the plate number manually to check registration and payment status.</p>

    <div class="card-mobile" style="padding: 1.5rem; margin: 0;">
        <form action="<?php echo URLROOT; ?>/agent/verify" method="POST">
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.7rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 10px; letter-spacing: 1px;">Plate Number</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); font-size: 1.2rem; opacity: 0.7;">🪪</span>
                    <input type="text" name="plate_number" placeholder="KGI-000-XX" required 
                           value="<?php echo $data['plate'] ?? ''; ?>"
                           style="width: 100%; padding: 1.1rem 1.1rem 1.1rem 3.5rem; border-radius: 16px; border: 2px solid var(--glass-border); background: var(--bg-alt); color: var(--text-main); font-weight: 800; font-size: 1.2rem; text-transform: uppercase; outline: none; transition: border-color 0.2s ease;"
                           onfocus="this.style.borderColor='var(--accent-primary)'"
                           onblur="this.style.borderColor='var(--glass-border)'">
                </div>
            </div>
            
            <button type="submit" class="btn-mobile btn-primary-mobile" style="height: 60px; font-size: 1rem; letter-spacing: 0.5px;">
                <span>SEARCH OPERATOR</span>
                <span style="font-size: 1.2rem;">🔍</span>
            </button>
        </form>
    </div>

    <!-- Results Section (Traffic Light Design) -->
    <?php if(!empty($data['plate'])): ?>
        <div style="margin-top: 2rem; animation: slideUp 0.4s ease-out;">
            <?php if($data['member']): ?>
                <!-- GREEN: Operator Found & Active -->
                <div class="card-mobile" style="border: 2px solid #00c853; background: rgba(0, 200, 83, 0.05); padding: 1.5rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem;">
                        <span style="background: #00c853; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">✅ VERIFIED ACTIVE</span>
                        <span style="font-size: 1.1rem; opacity: 0.8;">🟢</span>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <h3 style="font-size: 1.3rem; font-weight: 800; margin: 0; color: var(--text-main);"><?php echo $data['member']->fullname; ?></h3>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 4px 0 0 0; font-weight: 600; text-transform: uppercase;"><?php echo $data['member']->plate_number; ?></p>
                    </div>

                    <div style="display: flex; gap: 15px; margin-bottom: 1.5rem; padding-top: 1rem; border-top: 1px solid rgba(0,0,0,0.05);">
                        <div>
                            <p style="font-size: 0.6rem; color: var(--text-muted); margin: 0; font-weight: 700;">LGA</p>
                            <p style="font-weight: 700; font-size: 0.9rem; margin: 2px 0 0 0;"><?php echo $data['member']->lga_name; ?></p>
                        </div>
                        <div>
                            <p style="font-size: 0.6rem; color: var(--text-muted); margin: 0; font-weight: 700;">UNIT</p>
                            <p style="font-weight: 700; font-size: 0.9rem; margin: 2px 0 0 0;"><?php echo $data['member']->unit_name; ?></p>
                        </div>
                    </div>

                    <a href="<?php echo URLROOT; ?>/agent/collect/<?php echo $data['member']->id; ?>" class="btn-mobile btn-primary-mobile" style="height: 55px; background: #00c853; box-shadow: 0 10px 20px rgba(0,200,83,0.25);">
                        PROCEED TO COLLECTION ₦
                    </a>
                </div>
            <?php else: ?>
                <!-- RED: Not Found -->
                <div class="card-mobile" style="border: 2px solid #ff1744; background: rgba(255, 23, 68, 0.05); padding: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem;">
                        <span style="background: #ff1744; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">❌ NOT FOUND</span>
                        <span style="font-size: 1.1rem; opacity: 0.8;">🔴</span>
                    </div>
                    
                    <div style="margin-bottom: 1.2rem; text-align: center; padding: 1rem 0;">
                        <p style="font-weight: 700; color: var(--text-main); margin: 0; font-size: 1.1rem; line-height: 1.4;">The plate number <strong><?php echo htmlspecialchars($data['plate']); ?></strong> is not registered in our database.</p>
                    </div>

                    <p style="font-size: 0.8rem; color: var(--text-muted); text-align: center; margin-bottom: 1.5rem; font-weight: 500;">Please advise the operator to register at the nearest LGA Revenue Office.</p>

                    <a href="<?php echo URLROOT; ?>/agent/verify" class="btn-mobile" style="border: 1.5px solid var(--glass-border); background: var(--bg-alt); color: var(--text-main);">
                        CLEAR & SEARCH AGAIN
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if(empty($data['plate'])): ?>
    <div style="margin: 2rem 0; display: flex; align-items: center; gap: 15px;">
        <div style="flex: 1; height: 1px; background: var(--glass-border);"></div>
        <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted);">OR SCAN QR</span>
        <div style="flex: 1; height: 1px; background: var(--glass-border);"></div>
    </div>

    <!-- Scanner Mockup -->
    <div style="text-align: center; padding: 2.5rem 1.5rem; border: 2px dashed var(--accent-primary); border-radius: 24px; background: rgba(0, 161, 255, 0.03); position: relative; overflow: hidden;">
        <!-- Scanner Animation Effect -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: var(--accent-primary); box-shadow: 0 0 15px var(--accent-primary); animation: scanMove 3s infinite ease-in-out; opacity: 0.5;"></div>
        
        <span style="font-size: 3.5rem; display: block; margin-bottom: 12px; filter: drop-shadow(0 0 10px rgba(0,161,255,0.2));">📸</span>
        <p style="font-weight: 800; color: var(--text-main); margin: 0; font-size: 1.1rem;">Digital Scan</p>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 6px; font-weight: 500;">Position the QR code within the frame</p>
        
        <button class="btn-mobile" style="margin-top: 1.5rem; border: 1.5px solid var(--accent-primary); color: var(--accent-primary); background: rgba(0,161,255,0.05); font-size: 0.85rem; font-weight: 700; padding: 0.8rem;" onclick="alert('Camera initialization: Accessing mobile camera for AI scan...')">
            ENABLE CAMERA
        </button>
    </div>
    <?php endif; ?>
</div>

<style>
@keyframes scanMove {
    0% { top: 10%; }
    50% { top: 90%; }
    100% { top: 10%; }
}
</style>

<?php require APPROOT . '/Views/inc/agent/footer.php'; ?>
