<?php include 'layouts/header.php'; ?>

<div class="page-header" style="flex-wrap: wrap; gap: 1rem;">
    <div style="flex: 1; min-width: 250px;">
        <h1 class="page-title">User Management</h1>
        <p class="page-subtitle">Administrative access across State, LGA, and Unit levels.</p>
    </div>
    <button class="btn btn-primary" style="width: 100%; sm-width: auto; padding: 0.8rem 1.5rem; font-weight: 700;">+ New Administrator</button>
</div>

<div class="card">
    <!-- Role Overview Stats -->
    <div class="admin-grid" style="margin-bottom: 2.5rem; border-bottom: 1px solid var(--glass-border); padding-bottom: 1.5rem; grid-template-columns: repeat(3, 1fr);">
        <div>
            <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 800; text-transform: uppercase; margin-bottom: 4px;">LGA Admins</span>
            <p style="font-size: 1.5rem; font-weight: 800; color: var(--primary);">21</p>
        </div>
        <div>
            <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 800; text-transform: uppercase; margin-bottom: 4px;">Unit Admins</span>
            <p style="font-size: 1.5rem; font-weight: 800; color: var(--primary);">185</p>
        </div>
        <div>
            <span style="display: block; font-size: 0.65rem; color: var(--text-muted); font-weight: 800; text-transform: uppercase; margin-bottom: 4px;">Field Agents</span>
            <p style="font-size: 1.5rem; font-weight: 800; color: var(--primary);">540</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-row" style="margin-bottom: 2rem;">
        <div class="filter-item" style="flex: 1.5;">
            <label>Search Directory</label>
            <div style="position: relative; display: flex; align-items: center;">
                <span style="position: absolute; left: 12px; font-size: 0.9rem; opacity: 0.5;">🔍</span>
                <input type="text" placeholder="Name or email..." class="form-input" style="padding-left: 2.25rem;">
            </div>
        </div>
        <div class="filter-item">
            <label>Access Level</label>
            <select class="form-input">
                <option>All Roles</option>
                <option>LGA Admin</option>
                <option>Unit Admin</option>
                <option>Field Agent</option>
            </select>
        </div>
        <div class="filter-item">
            <label>Governance Scope</label>
            <select class="form-input">
                <option>All LGAs</option>
                <option>Lokoja</option>
                <option>Okene</option>
                <option>Dekina</option>
            </select>
        </div>
        <button class="btn btn-primary" style="padding: 0.75rem 1.25rem; border-radius: 10px; font-weight: 700;">Filter</button>
    </div>

    <!-- Users Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Administrator</th>
                    <th>Role</th>
                    <th class="hide-mobile">Scope</th>
                    <th class="hide-mobile">Contact</th>
                    <th class="hide-mobile">Active</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users_data = [
                    ['Usman Garba', 'LGA Admin', 'Lokoja / FULL', '080345...'],
                    ['Aminu Sani', 'Unit Admin', 'Okene / Market Unit 1', '080765...'],
                    ['Paul Obaka', 'Field Agent', 'Dekina / Anyigba A', '090123...'],
                    ['Victor Musa', 'Field Agent', 'Idah / Waterfront', '081234...'],
                    ['Grace Ocholi', 'LGA Admin', 'Kabba / FULL', '080987...'],
                    ['Samuel Iko', 'Unit Admin', 'Ankpa / Park A', '070345...'],
                ];

                foreach($users_data as $row): ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; background: var(--bg-alt); color: var(--primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; border: 1px solid var(--glass-border);">
                                <?php echo substr($row[0], 0, 1); ?>
                            </div>
                            <span style="font-weight: 700; font-size: 0.9rem;"><?php echo $row[0]; ?></span>
                        </div>
                    </td>
                    <td>
                        <span class="role-badge" style="font-size: 0.6rem; font-weight: 700;"><?php echo strtoupper($row[1]); ?></span>
                    </td>
                    <td style="font-size: 0.8rem; font-weight: 600;" class="hide-mobile"><?php echo $row[2]; ?></td>
                    <td style="font-size: 0.8rem;" class="hide-mobile"><?php echo $row[3]; ?></td>
                    <td style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;" class="hide-mobile"><?php echo rand(2, 59); ?>m ago</td>
                    <td><span class="status-check paid" style="font-size: 0.6rem; padding: 2px 10px; font-weight: 800;">ACTIVE</span></td>
                    <td>
                        <button class="btn btn-outline" style="padding: 0.4rem; font-size: 0.75rem; border-radius: 8px;">⚙️</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
