<?php require APPROOT . '/Views/inc/users/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Settle Your Tax</h1>
    <p class="page-subtitle">Securely pay your daily levy or association fees to stay in good standing.</p>
</div>

<div class="grid-stack">
    <!-- Payment Form -->
    <div class="card">
        <div class="card-title">Select Tax Category</div>
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div style="padding: 1.5rem; border: 2px solid var(--primary); border-radius: 15px; position: relative; background: rgba(5, 150, 105, 0.02);">
                <span style="position: absolute; top: 10px; right: 15px; background: var(--primary); color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.65rem; font-weight: 700;">RECOMMENDED</span>
                <label style="display: flex; align-items: center; gap: 15px; cursor: pointer;">
                    <input type="radio" name="tax_type" value="200" checked style="width: 20px; height: 20px; accent-color: var(--primary);">
                    <div>
                        <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Daily Tax Levy</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted);">Pay for today (<?php echo date('M d, Y'); ?>)</p>
                    </div>
                </label>
                <div style="margin-top: 1rem; text-align: right;">
                    <span style="font-size: 1.25rem; font-weight: 700;">₦200.00</span>
                </div>
            </div>

            <div style="padding: 1.5rem; border: 1px solid var(--glass-border); border-radius: 15px;">
                <label style="display: flex; align-items: center; gap: 15px; cursor: pointer;">
                    <input type="radio" name="tax_type" value="1400" style="width: 20px; height: 20px; accent-color: var(--primary);">
                    <div>
                        <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Weekly Bundle</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted);">Covers 7 days of operations</p>
                    </div>
                </label>
                <div style="margin-top: 1rem; text-align: right;">
                    <span style="font-size: 1.25rem; font-weight: 700;">₦1,400.00</span>
                </div>
            </div>

            <div style="padding: 1.5rem; border: 1px solid var(--glass-border); border-radius: 15px;">
                <label style="display: flex; align-items: center; gap: 15px; cursor: pointer;">
                    <input type="radio" name="tax_type" value="6000" style="width: 20px; height: 20px; accent-color: var(--primary);">
                    <div>
                        <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Monthly Compliance</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted);">Full monthly tax + Association dues</p>
                    </div>
                </label>
                <div style="margin-top: 1rem; text-align: right;">
                    <span style="font-size: 1.25rem; font-weight: 700;">₦6,000.00</span>
                </div>
            </div>

            <button id="pay-btn" class="btn btn-primary" style="padding: 1.2rem; font-size: 1rem; margin-top: 1rem;">
                Securely Pay with Paystack ➔
            </button>
        </div>
    </div>

    <!-- Payment Summary -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card" style="background: var(--dark); color: white;">
            <div class="card-title" style="color: white; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 1rem;">Payment Summary</div>
            <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                <div style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                    <span style="opacity: 0.7;">Member</span>
                    <span><?php echo htmlspecialchars($data['member']->fullname); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                    <span style="opacity: 0.7;">ID</span>
                    <span><?php echo htmlspecialchars($data['member']->unique_id); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                    <span style="opacity: 0.7;">Unit</span>
                    <span><?php echo htmlspecialchars($data['member']->unit_name); ?></span>
                </div>
                <div style="height: 1px; background: rgba(255,255,255,0.1); margin: 0.5rem 0;"></div>
                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 700;">
                    <span style="opacity: 0.7;">Total Payable</span>
                    <span id="summary-total">₦200.00</span>
                </div>
            </div>
        </div>

        <div class="card" style="background: #f8fafc; border: 1px dashed var(--glass-border);">
            <div style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2rem; margin-bottom: 1rem;">🔒</div>
                <h4 style="margin-bottom: 0.5rem;">Secure Encryption</h4>
                <p style="font-size: 0.8rem; color: var(--text-muted);">Your transaction is processed using 256-bit SSL encryption. We do not store your card details.</p>
            </div>
        </div>
    </div>
</div>

<form id="verify-payment-form" action="<?php echo URLROOT; ?>/users/verify_payment" method="POST" style="display: none;">
    <input type="hidden" name="reference" id="verify_reference">
    <input type="hidden" name="amount" id="verify_amount">
    <input type="hidden" name="tax_type" id="verify_tax_type" value="daily">
</form>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
document.querySelectorAll('input[name="tax_type"]').forEach(input => {
    input.addEventListener('change', function() {
        document.getElementById('summary-total').innerText = '₦' + parseInt(this.value).toLocaleString() + '.00';
        
        // Update hidden tax_type label for recording
        let label = 'daily';
        if(this.value == '1400') label = 'weekly';
        if(this.value == '6000') label = 'monthly';
        document.getElementById('verify_tax_type').value = label;
    });
});

document.getElementById('pay-btn').addEventListener('click', function() {
    const amount = document.querySelector('input[name="tax_type"]:checked').value;
    const koboAmount = parseInt(amount) * 100;
    const email = '<?php echo htmlspecialchars($data['member']->email ?? $data['member']->phone . "@toan.kogi.ng"); ?>';
    const subaccount = '<?php echo htmlspecialchars($data['member']->unit_subaccount ?? ''); ?>';
    const paystackKey = '<?php echo $data['paystack_public_key'] ?? ''; ?>';

    if (!paystackKey) {
        alert('Warning: Paystack is not configured. Generating a simulated test payment.');
        document.getElementById('verify_reference').value = 'TEST_REF_' + Math.floor((Math.random() * 1000000000) + 1);
        document.getElementById('verify_amount').value = amount;
        document.getElementById('verify-payment-form').submit();
        return;
    }

    let handlerOptions = {
        key: paystackKey,
        email: email,
        amount: koboAmount,
        ref: 'TTRTS_' + Math.floor((Math.random() * 1000000000) + 1),
        onClose: function(){
            alert('Window closed.');
        },
        callback: function(response){
            let message = 'Payment complete! Reference: ' + response.reference;
            document.getElementById('verify_reference').value = response.reference;
            document.getElementById('verify_amount').value = amount;
            // tax_type is already updated by the radio listener
            document.getElementById('verify-payment-form').submit();
        }
    };

    if (subaccount) {
        handlerOptions.subaccount = subaccount;
        // Depending on Paystack settings, you might want to specify transaction charge logic here
    }

    let handler = PaystackPop.setup(handlerOptions);
    handler.openIframe();
});
</script>

<?php require APPROOT . '/Views/inc/users/footer.php'; ?>
