<?php require APPROOT . '/Views/inc/admin/header.php'; ?>
<script src="https://js.paystack.co/v1/inline.js"></script>

<div class="page-header">
    <h1 class="page-title">Process Tax Payment</h1>
    <p class="page-subtitle">Lookup member and record revenue collection.</p>
</div>

<div class="content-grid" style="grid-template-columns: 1.5fr 1fr;">
    <!-- Payment Form Section -->
    <div class="card">
        <div class="card-title">Transaction Details</div>
        
        <!-- Member Lookup -->
        <div style="margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-alt); border-radius: 15px; border: 1px dashed var(--glass-border);">
            <label style="display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.8rem;">Find Member (Plate No or ID)</label>
            <div style="display: flex; gap: 10px; position: relative;">
                <input type="text" id="memberSearch" placeholder="e.g. LKJ-123-AB or KOG-LOK-00001" style="flex: 1; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit;">
                <button type="button" id="searchBtn" class="btn btn-primary" onclick="lookupMember()" style="padding: 0 1.5rem;">🔍 Search</button>
                <div id="autocomplete_dropdown" style="display: none; position: absolute; top: 100%; left: 0; right: 120px; background: white; border: 1px solid var(--glass-border); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1000; margin-top: 5px; max-height: 200px; overflow-y: auto; text-align: left;">
                </div>
            </div>
            <div id="search_error" style="color: #ef4444; font-size: 0.9rem; margin-top: 1rem; display: none;"></div>
        </div>

        <!-- Payment Form (Hidden by default) -->
        <form action="<?php echo URLROOT; ?>/admin/payment" method="POST" id="paymentForm" style="display: none;">
            <input type="hidden" name="member_id" id="hiddenMemberId" value="">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Payment Type</label>
                    <select name="payment_type" id="paymentType" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;">
                        <option value="daily">Daily Tax</option>
                        <option value="weekly">Weekly Tax</option>
                        <option value="monthly">Monthly Tax</option>
                        <option value="registration">New Registration</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Amount (₦)</label>
                    <input type="number" name="amount" id="payAmount" value="200" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 700; background: #fff; color: var(--primary);">
                    <p id="amountHelper" style="font-size: 0.7rem; color: #64748b; margin-top: 5px; font-weight: 600;"></p>
                </div>
            </div>

            <div style="margin-bottom: 2rem; padding: 1.5rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
                <p style="font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 0.8rem; letter-spacing: 0.5px;">Mandatory Payment Method</p>
                <div style="display: inline-flex; align-items: center; gap: 12px; padding: 0.8rem 1.5rem; background: white; border: 2px solid var(--primary); border-radius: 10px; color: var(--primary); font-weight: 700;">
                    <span style="font-size: 1.2rem;">💳</span>
                    <span>Secure Online Payment (Paystack)</span>
                </div>
                <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 1rem;">Cash handling is disabled. All revenue must be processed digitally for 75/25 automated distribution.</p>
                <!-- Hidden input to maintain compatibility with backend if needed, although we'll force it in the controller -->
                <input type="hidden" name="method" value="online">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1rem; font-weight: 700; border-radius: 12px; box-shadow: 0 10px 20px rgba(5, 150, 105, 0.2);">
                Confirm & Record Payment
            </button>
        </form>

        <!-- Initial Placeholder -->
        <div id="lookupPlaceholder" style="text-align: center; padding: 3rem 0; color: var(--text-muted);">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🔎</div>
            <p>Please enter a Plate Number or Member ID to begin.</p>
        </div>
    </div>

    <!-- Member Info Card (Side) -->
    <div id="memberInfoCard" class="card" style="display: none; align-self: flex-start;">
        <div class="card-title">Member Profile</div>
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <div id="profilePhoto" style="width: 80px; height: 80px; background: var(--bg-alt); color: var(--text-muted); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; border: 2px solid var(--glass-border); margin: 0 auto 1rem; overflow:hidden;">👤</div>
            <h3 id="profileName" style="font-size: 1.2rem; font-weight: 700;"></h3>
            <p id="profilePlate" style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600; font-family: monospace;"></p>
        </div>
        
        <div style="background: var(--bg-alt); padding: 1rem; border-radius: 12px; margin-bottom: 1rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="font-size: 0.8rem; color: var(--text-muted);">LGA</span>
                <span id="profileLga" style="font-size: 0.85rem; font-weight: 600;"></span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="font-size: 0.8rem; color: var(--text-muted);">Unit</span>
                <span id="profileUnit" style="font-size: 0.85rem; font-weight: 600;"></span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="font-size: 0.8rem; color: var(--text-muted);">Status</span>
                <span id="profileStatus" class="status-check" style="padding: 0.3rem 0.8rem;"></span>
            </div>
        </div>

        <div id="debtContainer" style="padding: 1rem; border-radius: 12px;">
            <p style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.3rem;" id="debtLabel">Outstanding Balance</p>
            <p style="font-size: 1.2rem; font-weight: 800;" id="debtAmount"></p>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px solid rgba(0,0,0,0.05);">
                <span style="font-size: 0.7rem; color: var(--text-muted); font-weight: 600;">PAID UNTIL:</span>
                <span id="profilePaidUntil" style="font-size: 0.75rem; font-weight: 700;"></span>
            </div>
            <p style="font-size: 0.75rem; margin-top: 0.2rem;" id="debtSubtext"></p>
        </div>
    </div>
</div>

<script>
let currentMember = null;
let currentTax = null;
const regFee = <?php echo $data['registration_fee'] ?? 2000; ?>;
const dailyRate = <?php echo $data['daily_rate'] ?? 200; ?>;

// Global helper to update the "Days Covered" text
function updateAmountHelper() {
    const payAmountInput = document.getElementById('payAmount');
    if (!payAmountInput) return;

    const amount = parseInt(payAmountInput.value) || 0;
    const serverRate = (currentTax && currentTax.daily_rate) ? currentTax.daily_rate : dailyRate;
    const helper = document.getElementById('amountHelper');
    
    if (!helper) return;

    if (amount <= 0) {
        helper.textContent = '';
        return;
    }

    const days = Math.floor(amount / serverRate);
    const weeks = Math.floor(days / 7);
    const remainingDays = days % 7;

    let text = `Covers ${days} day(s)`;
    if (weeks > 0) {
        text += ` (${weeks} week${weeks > 1 ? 's' : ''}${remainingDays > 0 ? ` and ${remainingDays} day${remainingDays > 1 ? 's' : ''}` : ''})`;
    }
    
    helper.textContent = `⚡ ${text}`;
    helper.style.color = days > 0 ? 'var(--primary)' : '#ef4444';
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('memberSearch');
    const autocompleteDropdown = document.getElementById('autocomplete_dropdown');
    const paymentTypeSelect = document.getElementById('paymentType');
    const payAmountInput = document.getElementById('payAmount');
    const paymentForm = document.getElementById('paymentForm');
    
    let debounceTimer;

    // Handle autocomplete search
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        clearTimeout(debounceTimer);
        
        if (query.length < 2) {
            autocompleteDropdown.style.display = 'none';
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch('<?php echo URLROOT; ?>/admin/verification?autocomplete=' + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    autocompleteDropdown.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'autocomplete-item';
                            div.style.padding = '10px 15px';
                            div.style.cursor = 'pointer';
                            div.style.borderBottom = '1px solid #f1f5f9';
                            div.innerHTML = `<div style="font-weight: 600; color: #1e293b;">${item.unique_id}</div><div style="font-size: 0.8rem; color: #64748b;">${item.plate_number} - ${item.fullname}</div>`;
                            
                            div.addEventListener('mouseover', () => div.style.backgroundColor = '#f8fafc');
                            div.addEventListener('mouseout', () => div.style.backgroundColor = 'transparent');
                            div.addEventListener('click', () => {
                                searchInput.value = item.unique_id;
                                autocompleteDropdown.style.display = 'none';
                                lookupMember();
                            });
                            autocompleteDropdown.appendChild(div);
                        });
                        autocompleteDropdown.style.display = 'block';
                    } else {
                        autocompleteDropdown.style.display = 'none';
                    }
                })
                .catch(err => console.error('Autocomplete error:', err));
        }, 300);
    });

    document.addEventListener('click', function(e) {
        if (e.target !== searchInput && e.target !== autocompleteDropdown) {
            autocompleteDropdown.style.display = 'none';
        }
    });

    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') lookupMember();
    });

    // Handle Amount Changes based on Type
    paymentTypeSelect.addEventListener('change', function() {
        if (!currentMember) return;
        
        const type = this.value;
        const serverRate = (currentTax && currentTax.daily_rate) ? currentTax.daily_rate : dailyRate;
        let amount = serverRate;
        
        switch(type) {
            case 'daily':
                amount = (currentTax && currentTax.amount_owed > 0) ? currentTax.amount_owed : serverRate;
                break;
            case 'weekly':
                amount = serverRate * 7;
                break;
            case 'monthly':
                amount = serverRate * 30;
                break;
            case 'registration':
                amount = regFee;
                break;
        }
        
        payAmountInput.value = amount;
        updateAmountHelper();
    });

    // Handle manual amount input
    payAmountInput.addEventListener('input', updateAmountHelper);

    // Paystack Handler
    paymentForm.addEventListener('submit', function(e) {
        const method = document.querySelector('input[name="method"]:checked').value;
        
        if (method === 'online') {
            if (document.querySelector('input[name="paystack_reference"]')) {
                return; 
            }

            e.preventDefault();

            const paystackKey = '<?php echo $data['paystack_public_key'] ?? ''; ?>';
            if (!paystackKey) {
                alert('Paystack is not configured.');
                return;
            }

            const amount = parseInt(payAmountInput.value) * 100;
            const email = 'agent@toankogi.org';
            const subaccount = currentMember ? currentMember.subaccount_code : null;

            let handler = PaystackPop.setup({
                key: paystackKey,
                email: email,
                amount: amount,
                currency: 'NGN',
                subaccount: subaccount || undefined,
                ref: 'PYM_' + Math.floor((Math.random() * 1000000000) + 1),
                callback: function(response) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'paystack_reference';
                    hiddenInput.value = response.reference;
                    paymentForm.appendChild(hiddenInput);
                    paymentForm.submit();
                },
                onClose: function() {
                    alert('Payment window closed.');
                }
            });
            handler.openIframe();
        }
    });
});

function lookupMember() {
    const search = document.getElementById('memberSearch').value.trim();
    if(!search) return;

    const btn = document.getElementById('searchBtn');
    const searchError = document.getElementById('search_error');
    
    btn.disabled = true;
    btn.textContent = '...';
    searchError.style.display = 'none';

    fetch('<?php echo URLROOT; ?>/admin/verification?search=' + encodeURIComponent(search))
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                currentMember = data.member;
                currentTax = data.tax;
                const member = data.member;
                const tax = data.tax;

                document.getElementById('lookupPlaceholder').style.display = 'none';
                document.getElementById('paymentForm').style.display = 'block';
                document.getElementById('memberInfoCard').style.display = 'block';

                document.getElementById('hiddenMemberId').value = member.id;
                const serverDailyRate = tax.daily_rate || dailyRate;
                document.getElementById('payAmount').value = tax.amount_owed > 0 ? tax.amount_owed : serverDailyRate;

                let warningEl = document.getElementById('paidTodayWarning');
                if (!warningEl) {
                    warningEl = document.createElement('div');
                    warningEl.id = 'paidTodayWarning';
                    warningEl.style.cssText = 'padding: 0.8rem 1rem; border-radius: 10px; font-size: 0.85rem; font-weight: 600; margin-bottom: 1rem;';
                    document.getElementById('paymentForm').insertBefore(warningEl, document.getElementById('paymentForm').firstChild.nextSibling);
                }
                if (tax.paid_today) {
                    warningEl.style.display = 'block';
                    warningEl.style.backgroundColor = '#fef3c7';
                    warningEl.style.border = '1px solid #f59e0b';
                    warningEl.style.color = '#92400e';
                    warningEl.innerHTML = '⚠️ This member has already been recorded for a payment today. Proceed with caution to avoid duplicates.';
                } else {
                    warningEl.style.display = 'none';
                }

                document.getElementById('profileName').textContent = member.fullname;
                document.getElementById('profilePlate').textContent = `${member.unique_id} | ${member.plate_number}`;
                document.getElementById('profileLga').textContent = member.lga;
                document.getElementById('profileUnit').textContent = member.unit;
                
                if (member.passport_image) {
                    document.getElementById('profilePhoto').innerHTML = `<img src="<?php echo URLROOT; ?>/${member.passport_image}" style="width: 100%; height: 100%; object-fit: cover;">`;
                }

                const statusEl = document.getElementById('profileStatus');
                const debtContainer = document.getElementById('debtContainer');
                const debtLabel = document.getElementById('debtLabel');
                const debtAmount = document.getElementById('debtAmount');
                const debtSubtext = document.getElementById('debtSubtext');

                if (tax.is_compliant) {
                    statusEl.textContent = 'COMPLIANT';
                    statusEl.style.backgroundColor = '#ecfdf5';
                    statusEl.style.color = '#059669';
                    statusEl.style.border = '1px solid #10b981';
                    
                    debtContainer.style.backgroundColor = '#f0fdf4';
                    debtContainer.style.border = '1px solid #bbf7d0';
                    debtLabel.style.color = '#15803d';
                    debtLabel.textContent = 'Account Status';
                    debtAmount.style.color = '#166534';
                    debtAmount.textContent = 'Fully Paid';
                    debtSubtext.style.color = '#15803d';
                    debtSubtext.textContent = `Last Pmt: ${tax.last_payment_date}`;
                    document.getElementById('profilePaidUntil').textContent = tax.paid_until;
                    document.getElementById('profilePaidUntil').style.color = '#059669';
                } else {
                    statusEl.textContent = 'OWING';
                    statusEl.style.backgroundColor = '#fee2e2';
                    statusEl.style.color = '#b91c1c';
                    statusEl.style.border = '1px solid #ef4444';

                    debtContainer.style.backgroundColor = '#fff1f2';
                    debtContainer.style.border = '1px solid #fecdd3';
                    debtLabel.style.color = '#e11d48';
                    debtLabel.textContent = 'Outstanding Balance';
                    debtAmount.style.color = '#e11d48';
                    debtAmount.textContent = `₦${tax.amount_owed}`;
                    debtSubtext.style.color = '#ef4444';
                    debtSubtext.textContent = `${tax.days_owed} day(s) unpaid`;
                    document.getElementById('profilePaidUntil').textContent = tax.paid_until;
                    document.getElementById('profilePaidUntil').style.color = '#e11d48';
                }
                updateAmountHelper();

            } else {
                searchError.textContent = data.message;
                searchError.style.display = 'block';
                document.getElementById('lookupPlaceholder').style.display = 'block';
                document.getElementById('paymentForm').style.display = 'none';
                document.getElementById('memberInfoCard').style.display = 'none';
            }
        })
        .catch(err => {
            console.error(err);
            searchError.textContent = 'Connection error. Please try again.';
            searchError.style.display = 'block';
        })
        .finally(() => {
            btn.disabled = false;
            btn.textContent = '🔍 Search';
        });
}
</script>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
