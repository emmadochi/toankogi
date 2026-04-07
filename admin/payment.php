<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Process Tax Payment</h1>
    <p class="page-subtitle">Lookup member and record revenue collection.</p>
</div>

<div class="content-grid">
    <!-- Payment Form Section -->
    <div class="card">
        <div class="card-title">Transaction Details</div>
        
        <!-- Member Lookup -->
        <div style="margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-alt); border-radius: 15px; border: 1px dashed var(--glass-border);">
            <label style="display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.8rem;">Find Member (Plate No or ID)</label>
            <div style="display: flex; gap: 10px;">
                <input type="text" id="memberSearch" placeholder="e.g. LKJ-123-AB" style="flex: 1; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit;">
                <button type="button" class="btn btn-primary" onclick="lookupMember()" style="padding: 0 1.5rem;">🔍 Search</button>
            </div>
        </div>

        <!-- Payment Form (Hidden by default) -->
        <form id="paymentForm" style="display: none;" onsubmit="processPayment(event)">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Payment Type</label>
                    <select id="paymentType" onchange="updateAmount()" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 600;">
                        <option value="daily">Daily Tax</option>
                        <option value="weekly">Weekly Tax</option>
                        <option value="monthly">Monthly Tax</option>
                        <option value="registration">New Registration</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Amount (₦)</label>
                    <input type="number" id="payAmount" value="200" readonly style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-weight: 700; background: #f1f5f9; color: var(--primary);">
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Payment Method</label>
                <div style="display: flex; gap: 1rem;">
                    <label style="flex: 1; display: flex; align-items: center; gap: 10px; padding: 1rem; border: 1px solid var(--glass-border); border-radius: 10px; cursor: pointer;">
                        <input type="radio" name="method" value="cash" checked>
                        <span>💵 Cash</span>
                    </label>
                    <label style="flex: 1; display: flex; align-items: center; gap: 10px; padding: 1rem; border: 1px solid var(--glass-border); border-radius: 10px; cursor: pointer;">
                        <input type="radio" name="method" value="pos">
                        <span>💳 POS / Card</span>
                    </label>
                    <label style="flex: 1; display: flex; align-items: center; gap: 10px; padding: 1rem; border: 1px solid var(--glass-border); border-radius: 10px; cursor: pointer;">
                        <input type="radio" name="method" value="transfer">
                        <span>🏦 Transfer</span>
                    </label>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Remarks (Optional)</label>
                <textarea rows="2" style="width: 100%; padding: 0.8rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit;" placeholder="Add any notes here..."></textarea>
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
            <div style="width: 80px; height: 80px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; margin: 0 auto 1rem;">AS</div>
            <h3 id="profileName" style="font-size: 1.2rem; font-weight: 700;">Ameh Sunday</h3>
            <p id="profilePlate" style="color: var(--text-muted); font-size: 0.9rem; font-weight: 600;">LKJ-123-AB</p>
        </div>
        
        <div style="background: var(--bg-alt); padding: 1rem; border-radius: 12px; margin-bottom: 1rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="font-size: 0.8rem; color: var(--text-muted);">LGA</span>
                <span style="font-size: 0.85rem; font-weight: 600;">Lokoja</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                <span style="font-size: 0.8rem; color: var(--text-muted);">Unit</span>
                <span style="font-size: 0.85rem; font-weight: 600;">Central 1</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span style="font-size: 0.8rem; color: var(--text-muted);">Status</span>
                <span id="profileStatus" class="status-check paid">Active</span>
            </div>
        </div>

        <div style="padding: 1rem; border: 1px solid #fee2e2; background: #fff1f2; border-radius: 12px;">
            <p style="font-size: 0.75rem; color: #e11d48; font-weight: 700; text-transform: uppercase; margin-bottom: 0.3rem;">Outstanding Balance</p>
            <p style="font-size: 1.2rem; font-weight: 800; color: #e11d48;">₦600</p>
        </div>
    </div>
</div>

<!-- Success Overlay (Hidden) -->
<div id="successOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.9); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
    <div class="card" style="width: 400px; text-align: center; padding: 3rem;">
        <div style="width: 70px; height: 70px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 1.5rem;">✓</div>
        <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Payment Successful!</h2>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">Transaction REF-<?php echo rand(100000, 999999); ?> has been recorded.</p>
        
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <button class="btn btn-primary" onclick="window.location.href='receipt.php?id=TRX-NEW'" style="padding: 0.8rem;">📄 Print Digital Receipt</button>
            <button class="btn btn-outline" onclick="location.reload()" style="padding: 0.8rem;">New Transaction</button>
        </div>
    </div>
</div>

<script>
function lookupMember() {
    const search = document.getElementById('memberSearch').value;
    if(!search) return alert('Please enter a Plate Number or ID');

    // Simulate lookup
    document.getElementById('lookupPlaceholder').style.display = 'none';
    document.getElementById('paymentForm').style.display = 'block';
    document.getElementById('memberInfoCard').style.display = 'block';
}

function updateAmount() {
    const type = document.getElementById('paymentType').value;
    const amountInput = document.getElementById('payAmount');
    
    switch(type) {
        case 'daily': amountInput.value = 200; break;
        case 'weekly': amountInput.value = 1200; break;
        case 'monthly': amountInput.value = 4800; break;
        case 'registration': amountInput.value = 5000; break;
    }
}

function processPayment(e) {
    e.preventDefault();
    document.getElementById('successOverlay').style.display = 'flex';
}
</script>

<?php include 'layouts/footer.php'; ?>
