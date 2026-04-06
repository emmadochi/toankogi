<?php require APPROOT . '/Views/inc/admin/header.php'; ?>

<div class="page-header" style="text-align: center; max-width: 600px; margin: 0 auto 3rem;">
    <h1 class="page-title">Agent Verification System</h1>
    <p class="page-subtitle">Instantly verify tricycle status by Plate Number or Unique ID.</p>
</div>

<div style="max-width: 800px; margin: 0 auto;">
    <!-- Search Interface -->
    <div class="card" style="margin-bottom: 2rem; padding: 2.5rem; text-align: center;">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Enter Identification</h3>
        <div style="display: flex; gap: 1rem; max-width: 500px; margin: 0 auto;">
            <div style="position: relative; flex: 1; text-align: left;">
                <input type="text" id="search_input" placeholder="e.g. LKJ-123-AB or KOG-LOK-001" style="width: 100%; padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border); outline: none; font-size: 1.1rem; text-align: center; font-family: inherit;">
                <div id="autocomplete_dropdown" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid var(--glass-border); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1000; margin-top: 5px; max-height: 200px; overflow-y: auto; text-align: left;">
                </div>
            </div>
            <button id="search_btn" class="btn btn-primary" style="padding: 0 2rem;">Verify</button>
        </div>
        <div id="search_error" style="color: #ef4444; font-size: 0.9rem; margin-top: 1rem; display: none;"></div>
        <p style="margin-top: 1rem; font-size: 0.85rem; color: var(--text-muted);">Agents: Ensure you cross-check physical plate number with system results.</p>
    </div>

    <!-- Results (Initially Hidden) -->
    <div id="verification-result" style="display: none;">
        <div class="card" id="result_card" style="border-left: 8px solid #ef4444; overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
                <div>
                    <span id="result_status" class="status-check" style="padding: 0.5rem 1rem; font-size: 0.9rem; margin-bottom: 1rem; display: inline-block;"></span>
                    <h2 id="result_name" style="font-size: 1.5rem;"></h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">ID: <span id="result_id" style="font-weight: 600;"></span> | Plate: <span id="result_plate" style="font-weight: 600;"></span></p>
                    <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.5rem;"><span id="result_lga"></span> / <span id="result_unit"></span></p>
                </div>
                <div id="result_photo" style="width: 100px; height: 100px; background: var(--bg-alt); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; overflow: hidden; border: 2px solid var(--glass-border);">
                    👤
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2rem; padding: 1.5rem; background: var(--bg-alt); border-radius: 15px;">
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Last Payment</label>
                    <p id="result_last_pay" style="font-weight: 600;"></p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Paid Until</label>
                    <p id="result_paid_until" style="font-weight: 700;"></p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Tax Cycle</label>
                    <p style="font-weight: 600;">Daily (₦200)</p>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Compliance</label>
                    <p id="result_owed" style="font-weight: 700;"></p>
                </div>
            </div>

            <div style="display: flex; gap: 1rem;">
                <button id="pay_btn" class="btn btn-primary" style="flex: 2; padding: 1.2rem;">Record New Payment</button>
                <button id="history_btn" class="btn btn-outline" style="flex: 1; padding: 1.2rem;">Full History</button>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchBtn = document.getElementById('search_btn');
    const searchInput = document.getElementById('search_input');
    const resultContainer = document.getElementById('verification-result');
    const resultCard = document.getElementById('result_card');
    const searchError = document.getElementById('search_error');
    const autocompleteDropdown = document.getElementById('autocomplete_dropdown');

    let debounceTimer;

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
                                search();
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

    function search() {
        const query = searchInput.value.trim();
        if (!query) return;

        searchBtn.disabled = true;
        searchBtn.textContent = 'Searching...';
        searchError.style.display = 'none';
        resultContainer.style.display = 'none';

        fetch('<?php echo URLROOT; ?>/admin/verification?search=' + encodeURIComponent(query))
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const member = data.member;
                    const tax = data.tax;

                    // Fill Data
                    document.getElementById('result_name').textContent = member.fullname;
                    document.getElementById('result_id').textContent = member.unique_id;
                    document.getElementById('result_plate').textContent = member.plate_number;
                    document.getElementById('result_lga').textContent = member.lga;
                    document.getElementById('result_unit').textContent = member.unit;
                    document.getElementById('result_last_pay').textContent = tax.last_payment_date;

                    // Photo
                    if (member.passport_image) {
                        document.getElementById('result_photo').innerHTML = `<img src="<?php echo URLROOT; ?>/${member.passport_image}" style="width: 100%; height: 100%; object-fit: cover;">`;
                    } else {
                        document.getElementById('result_photo').innerHTML = '👤';
                    }

                    // Status and Colors
                    const statusEl = document.getElementById('result_status');
                    const owedEl = document.getElementById('result_owed');
                    const paidUntilEl = document.getElementById('result_paid_until');
                    
                    paidUntilEl.textContent = tax.paid_until;

                    if (tax.is_compliant) {
                        statusEl.textContent = 'STATUS: VERIFIED / COMPLIANT';
                        statusEl.className = 'status-check active'; // Using existing CSS classes or inline style
                        statusEl.style.backgroundColor = '#ecfdf5';
                        statusEl.style.color = '#059669';
                        resultCard.style.borderLeftColor = '#059669';
                        owedEl.textContent = 'No Debt Found';
                        owedEl.style.color = '#059669';
                        paidUntilEl.style.color = '#059669';
                        document.getElementById('pay_btn').textContent = 'Collect Advance Payment (₦200)';
                    } else {
                        statusEl.textContent = 'STATUS: OWING TAX';
                        statusEl.style.backgroundColor = '#fee2e2';
                        statusEl.style.color = '#b91c1c';
                        resultCard.style.borderLeftColor = '#ef4444';
                        owedEl.textContent = `${tax.days_owed} Day(s) - ₦${tax.amount_owed}`;
                        owedEl.style.color = '#ef4444';
                        paidUntilEl.style.color = '#ef4444';
                        document.getElementById('pay_btn').textContent = `Record Payment (₦${tax.amount_owed})`;
                    }

                    // Button Links
                    document.getElementById('pay_btn').onclick = () => window.location.href = `<?php echo URLROOT; ?>/admin/payment?id=${member.id}&amount=${tax.amount_owed || 200}`;
                    document.getElementById('history_btn').onclick = () => window.location.href = `<?php echo URLROOT; ?>/admin/revenue?search=${member.unique_id}`;

                    resultContainer.style.display = 'block';
                } else {
                    searchError.textContent = data.message;
                    searchError.style.display = 'block';
                }
            })
            .catch(err => {
                console.error(err);
                searchError.textContent = 'Connection error. Please try again.';
                searchError.style.display = 'block';
            })
            .finally(() => {
                searchBtn.disabled = false;
                searchBtn.textContent = 'Verify';
            });
    }

    searchBtn.addEventListener('click', search);
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') search();
    });
});
</script>

    <!-- Quick Info -->
    <div style="margin-top: 3rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <div class="card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem;">
            <div style="font-size: 2rem;">📱</div>
            <div>
                <h4 style="font-size: 0.9rem;">Mobile Optimized</h4>
                <p style="font-size: 0.8rem; color: var(--text-muted);">Specifically designed for easy use by agents on the field.</p>
            </div>
        </div>
        <div class="card" style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem;">
            <div style="font-size: 2rem;">🛡️</div>
            <div>
                <h4 style="font-size: 0.9rem;">Fraud Protection</h4>
                <p style="font-size: 0.8rem; color: var(--text-muted);">Unique ID verification eliminates fake paper receipts.</p>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/Views/inc/admin/footer.php'; ?>
