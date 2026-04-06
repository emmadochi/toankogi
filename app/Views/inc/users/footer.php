<!-- Bottom Navigation (Mobile Only) -->
<?php $active_page = $data['active_page'] ?? ''; ?>
<nav class="bottom-nav">
    <a href="<?php echo URLROOT; ?>/users/index" class="bottom-nav-item <?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
        <i>📊</i>
        <span>Home</span>
    </a>
    <a href="<?php echo URLROOT; ?>/users/pay" class="bottom-nav-item <?php echo ($active_page == 'pay') ? 'active' : ''; ?>">
        <i>💳</i>
        <span>Pay</span>
    </a>
    <a href="<?php echo URLROOT; ?>/users/id_card" class="bottom-nav-item <?php echo ($active_page == 'id_card') ? 'active' : ''; ?>">
        <i>🆔</i>
        <span>ID Card</span>
    </a>
    <a href="<?php echo URLROOT; ?>/users/payments" class="bottom-nav-item <?php echo ($active_page == 'payments') ? 'active' : ''; ?>">
        <i>📜</i>
        <span>History</span>
    </a>
    <a href="<?php echo URLROOT; ?>/users/profile" class="bottom-nav-item <?php echo ($active_page == 'profile') ? 'active' : ''; ?>">
        <i>👤</i>
        <span>Profile</span>
    </a>
</nav>

    </main>
</div>
<script src="<?php echo URLROOT; ?>/assets/users/js/user.js"></script>
</body>
</html>
