<?php require APPROOT . '/Views/inc/users/header.php'; ?>

<div class="page-header">
    <h1 class="page-title">Notices & Announcements</h1>
    <p class="page-subtitle">Stay informed about the association's policies and upcoming events.</p>
</div>

<div style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 800px;">
    <div class="card" style="border-left: 4px solid var(--primary);">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
            <span style="background: rgba(5, 150, 105, 0.1); color: var(--primary); padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700;">URGENT</span>
            <span style="font-size: 0.8rem; color: var(--text-muted);">March 24, 2026</span>
        </div>
        <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">E-Naira Integration Notice</h3>
        <p style="color: var(--text-muted); line-height: 1.6; margin-bottom: 1.5rem;">Beginning next month, all members can now pay their association fees directly using E-Naira. This is part of the state government's drive for a fully cashless revenue collection system. Ensure your wallet is set up before the April 1st deadline.</p>
        <a href="#" style="color: var(--primary); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Read Full Directive ➔</a>
    </div>

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
            <span style="background: #f1f5f9; color: var(--text-muted); padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700;">ANNOUNCEMENT</span>
            <span style="font-size: 0.8rem; color: var(--text-muted);">March 20, 2026</span>
        </div>
        <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Annual General Meeting (AGM) 2026</h3>
        <p style="color: var(--text-muted); line-height: 1.6; margin-bottom: 1.5rem;">The 2026 AGM is scheduled for Saturday, 15th April. Attendance is mandatory for all registered owners. Venue: State Headquarters Auditorium, Lokoja. Time: 9:00 AM prompt.</p>
        <a href="#" style="color: var(--primary); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Add to Calendar ➔</a>
    </div>
</div>

<?php require APPROOT . '/Views/inc/users/footer.php'; ?>
