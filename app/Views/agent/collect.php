<?php require APPROOT . '/Views/inc/agent/header.php'; ?>

<div class="collect-section" style="margin-top: 1rem;">
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1.8rem;">
        <a href="<?php echo URLROOT; ?>/agent/verify" style="text-decoration: none; width: 40px; height: 40px; background: var(--glass-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; border: 1px solid var(--glass-border); color: var(--text-main);">
            ←
        </a>
        <h2 style="font-weight: 800; color: var(--text-main); margin: 0; letter-spacing: -0.8px; font-size: 1.5rem;">Collection Point</h2>
    </div>

    <!-- Member Info Card (Stunning Glass Design) -->
    <div class="card-mobile" style="margin: 0 0 1.5rem 0; padding: 1.5rem; position: relative; border: none; background: linear-gradient(145deg, rgba(255,255,255,0.05), rgba(255,255,255,0.02)); box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
        <!-- Side Accent -->
        <div style="position: absolute; left: 0; top: 20%; bottom: 20%; width: 5px; background: var(--accent-primary); border-radius: 0 5px 5px 0;"></div>
        
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
            <div>
                <p style="font-size: 0.65rem; font-weight: 800; color: var(--accent-primary); text-transform: uppercase; margin: 0; letter-spacing: 1.2px;">IDENTITY VERIFIED</p>
                <h3 style="font-size: 1.4rem; font-weight: 800; margin: 6px 0 0 0; color: var(--text-main); letter-spacing: -0.3px;"><?php echo $data['member']->fullname; ?></h3>
            </div>
            <div class="status-pill-mobile status-active" style="display: flex; align-items: center; gap: 6px;">
                <div class="verify-indicator"></div>
                ACTIVE
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1.2rem;">
            <div>
                <p style="font-size: 0.6rem; color: var(--text-muted); margin: 0; font-weight: 700; letter-spacing: 0.5px;">PLATE NUMBER</p>
                <p style="font-weight: 800; font-size: 1rem; margin: 4px 0 0 0; color: var(--text-main); text-transform: uppercase;"><?php echo $data['member']->plate_number; ?></p>
            </div>
            <div>
                <p style="font-size: 0.6rem; color: var(--text-muted); margin: 0; font-weight: 700; letter-spacing: 0.5px;">JURISDICTION</p>
                <p style="font-weight: 800; font-size: 1rem; margin: 4px 0 0 0; color: var(--text-main);"><?php echo explode(' ', $_SESSION['user_lga_name'] ?? 'Lokoja')[0]; ?></p>
            </div>
        </div>
    </div>

    <!-- Collection Form -->
    <div class="card-mobile" style="margin: 0; padding: 2rem; border-radius: 28px;">
        <form action="<?php echo URLROOT; ?>/agent/collect/<?php echo $data['member']->id; ?>" method="POST" id="paymentForm">
            <!-- Payment Type Selection -->
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 12px; letter-spacing: 1px; text-align: center;">Collection Type</label>
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
                    <label style="cursor: pointer;">
                        <input type="radio" name="payment_type" value="daily" checked style="display: none;" onchange="updateAmount(200)">
                        <div class="payment-type-card" style="padding: 12px 5px; border-radius: 12px; border: 2px solid var(--glass-border); text-align: center; background: var(--bg-alt); transition: all 0.2s ease;">
                            <p style="font-weight: 800; font-size: 0.75rem; margin: 0; color: var(--text-main);">DAILY</p>
                        </div>
                    </label>
                    <label style="cursor: pointer;">
                        <input type="radio" name="payment_type" value="weekly" style="display: none;" onchange="updateAmount(1400)">
                        <div class="payment-type-card" style="padding: 12px 5px; border-radius: 12px; border: 2px solid var(--glass-border); text-align: center; background: var(--bg-alt); transition: all 0.2s ease;">
                            <p style="font-weight: 800; font-size: 0.75rem; margin: 0; color: var(--text-main);">WEEKLY</p>
                        </div>
                    </label>
                    <label style="cursor: pointer;">
                        <input type="radio" name="payment_type" value="monthly" style="display: none;" onchange="updateAmount(6000)">
                        <div class="payment-type-card" style="padding: 12px 5px; border-radius: 12px; border: 2px solid var(--glass-border); text-align: center; background: var(--bg-alt); transition: all 0.2s ease;">
                            <p style="font-weight: 800; font-size: 0.75rem; margin: 0; color: var(--text-main);">MONTHLY</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 2rem; text-align: center;">
                <label style="display: block; font-size: 0.75rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 12px; letter-spacing: 1px;">AMOUNT TO COLLECT</label>
                <div style="position: relative; display: inline-block; width: 100%;">
                    <span style="position: absolute; left: 24px; top: 50%; transform: translateY(-50%); font-size: 1.6rem; font-weight: 800; color: var(--accent-primary);">₦</span>
                    <input type="number" name="amount" id="amount-input" value="200" required 
                           style="width: 100%; padding: 1.2rem 1.2rem 1.2rem 3.8rem; border-radius: 20px; border: 2.5px solid var(--glass-border); background: var(--bg-alt); color: var(--text-main); font-weight: 900; font-size: 2.2rem; outline: none; text-align: center; transition: all 0.3s ease; box-shadow: inset 0 2px 10px rgba(0,0,0,0.1);"
                           onfocus="this.style.borderColor='var(--accent-primary)'; this.style.boxShadow='0 0 20px rgba(0,161,255,0.1)';"
                           onblur="this.style.borderColor='var(--glass-border)';">
                </div>
                <p style="font-size: 0.8rem; color: #b45309; margin: 12px 0 0 0; font-weight: 700;">⚠️ Payments are processed securely via Paystack.</p>
            </div>

            <div style="background: rgba(0, 161, 255, 0.08); padding: 1.2rem; border-radius: 18px; margin-bottom: 2rem; display: flex; gap: 14px; align-items: center; border: 1px solid rgba(0, 161, 255, 0.15);">
                <span style="font-size: 1.5rem;">💳</span>
                <p style="font-size: 0.75rem; color: var(--accent-primary); font-weight: 700; margin: 0; line-height: 1.4;">Automatic 75/25 revenue split will be triggered on successful confirmation.</p>
            </div>
            
            <button type="submit" class="btn-mobile btn-primary-mobile" style="height: 70px; font-size: 1.1rem; border-radius: 20px; box-shadow: 0 12px 25px rgba(0,161,255,0.35);">
                <span style="font-weight: 800;">CONFIRM & PAY ONLINE</span>
                <span style="font-size: 1.4rem;">🚀</span>
            </button>
        </form>
    </div>
</div>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
function updateAmount(val) {
    document.getElementById('amount-input').value = val;
    
    // Highlight selected card
    const labels = document.querySelectorAll('input[name="payment_type"]');
    labels.forEach(input => {
        const card = input.nextElementSibling;
        if(input.checked) {
            card.style.borderColor = 'var(--accent-primary)';
            card.style.background = 'rgba(0, 161, 255, 0.05)';
            card.style.transform = 'scale(1.05)';
        } else {
            card.style.borderColor = 'var(--glass-border)';
            card.style.background = 'var(--bg-alt)';
            card.style.transform = 'scale(1)';
        }
    });
}
// Init highlight
updateAmount(200);

document.getElementById('paymentForm').addEventListener('submit', function(e) {
    // If we have a reference, let the form submit
    if (document.querySelector('input[name="paystack_reference"]')) {
        return;
    }

    e.preventDefault();

    const paystackKey = '<?php echo $data['paystack_public_key'] ?? ''; ?>';
    if (!paystackKey) {
        alert('Paystack is not configured. Please contact the administrator.');
        return;
    }

    const amount = parseInt(document.getElementById('amount-input').value) * 100;
    const email = 'agent@toankogi.org';
    const subaccount = '<?php echo $data['member']->subaccount_code ?? ''; ?>';

    let handler = PaystackPop.setup({
        key: paystackKey,
        email: email,
        amount: amount,
        currency: 'NGN',
        subaccount: subaccount ? subaccount : undefined,
        ref: 'COL_' + Math.floor((Math.random() * 1000000000) + 1),
        callback: function(response) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'paystack_reference';
            hiddenInput.value = response.reference;
            document.getElementById('paymentForm').appendChild(hiddenInput);
            document.getElementById('paymentForm').submit();
        },
        onClose: function() {
            alert('Collection cancelled. No payment was recorded.');
        }
    });
    handler.openIframe();
});
</script>

<?php require APPROOT . '/Views/inc/agent/footer.php'; ?>
