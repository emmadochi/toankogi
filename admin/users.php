<?php include 'layouts/header.php'; ?>

<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">User Roles & Management</h1>
            <p class="page-subtitle">Manage administrative access across State, LGA, and Unit levels.</p>
        </div>
        <button class="btn btn-primary">Add New Administrator</button>
    </div>
</div>

<div class="card">
    <!-- Role Overview Stats -->
    <div style="display: flex; gap: 2rem; margin-bottom: 2.5rem; border-bottom: 1px solid var(--glass-border); padding-bottom: 1.5rem;">
        <div>
            <span style="display: block; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Total LGA Admins</span>
            <p style="font-size: 1.5rem; font-weight: 700;">21</p>
        </div>
        <div style="width: 1px; height: 35px; background: var(--glass-border);"></div>
        <div>
            <span style="display: block; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Total Unit Admins</span>
            <p style="font-size: 1.5rem; font-weight: 700;">185</p>
        </div>
        <div style="width: 1px; height: 35px; background: var(--glass-border);"></div>
        <div>
            <span style="display: block; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Field Agents</span>
            <p style="font-size: 1.5rem; font-weight: 700;">540</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
        <div class="search-bar" style="width: 300px;">
            <span>🔍</span>
            <input type="text" placeholder="Search by name or email...">
        </div>
        <select style="padding: 0.6rem 1rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-size: 0.9rem;">
            <option>All Roles</option>
            <option>LGA Admin</option>
            <option>Unit Admin</option>
            <option>Field Agent</option>
        </select>
        <select style="padding: 0.6rem 1rem; border-radius: 10px; border: 1px solid var(--glass-border); font-family: inherit; font-size: 0.9rem;">
            <option>All LGAs</option>
            <option>Lokoja</option>
            <option>Okene</option>
            <option>Dekina</option>
        </select>
    </div>

    <!-- Users Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Administrator</th>
                    <th>Role</th>
                    <th>Scope (LGA / Unit)</th>
                    <th>Contact</th>
                    <th>Last Login</th>
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
                            <div style="width: 32px; height: 32px; background: var(--bg-alt); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700;">
                                <?php echo substr($row[0], 0, 1); ?>
                            </div>
                            <span style="font-weight: 600;"><?php echo $row[0]; ?></span>
                        </div>
                    </td>
                    <td>
                        <span class="role-badge" style="font-size: 0.65rem;"><?php echo $row[1]; ?></span>
                    </td>
                    <td style="font-size: 0.85rem;"><?php echo $row[2]; ?></td>
                    <td style="font-size: 0.85rem;"><?php echo $row[3]; ?></td>
                    <td style="font-size: 0.85rem; color: var(--text-muted);"><?php echo rand(2, 59); ?> mins ago</td>
                    <td><span class="status-check paid">Active</span></td>
                    <td>
                        <button style="border: none; background: none; color: var(--primary); font-weight: 600; cursor: pointer;">Edit</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
