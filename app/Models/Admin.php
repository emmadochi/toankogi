<?php

namespace App\Models;

use App\Core\Database;

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Authenticate an admin user
     *
     * @param string $username
     * @param string $password
     * @return object|false
     */
    public function login($username, $password)
    {
        $this->db->query('
            SELECT u.*, l.name AS lga_name, un.name AS unit_name 
            FROM users u
            LEFT JOIN lgas l ON u.lga_id = l.id
            LEFT JOIN units un ON u.unit_id = un.id
            WHERE u.username = :username
        ');
        $this->db->bind(':username', $username);

        $row = $this->db->single();


        if ($row) {
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            }
        }

        return false;
    }

    /**
     * Create a new Admin or Agent
     *
     * @param array $data
     * @return boolean
     */
    public function register($data)
    {
        $this->db->query('INSERT INTO users (fullname, email, username, password, role, lga_id, unit_id, status) VALUES (:fullname, :email, :username, :password, :role, :lga_id, :unit_id, :status)');
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':lga_id', $data['lga_id']);
        $this->db->bind(':unit_id', $data['unit_id']);
        $this->db->bind(':status', 'active');

        if ($this->db->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Update an Administrator's details
     */
    public function updateAdmin($id, $data)
    {
        $updateFields = "fullname = :fullname, email = :email, username = :username, role = :role, lga_id = :lga_id, unit_id = :unit_id";
        
        // Only update password if provided
        if(!empty($data['password'])) {
            $updateFields .= ", password = :password";
        }

        if(isset($data['status'])) {
            $updateFields .= ", status = :status";
        }

        $this->db->query("UPDATE users SET $updateFields WHERE id = :id");
        
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':lga_id', $data['lga_id']);
        $this->db->bind(':unit_id', $data['unit_id']);
        $this->db->bind(':id', $id);

        if(!empty($data['password'])) {
            $this->db->bind(':password', $data['password']);
        }

        if(isset($data['status'])) {
            $this->db->bind(':status', $data['status']);
        }

        return $this->db->execute();
    }

    /**
     * Delete (Deactivate) an Administrator
     */
    public function deleteAdmin($id)
    {
        // We use soft delete / deactivation for data integrity
        $this->db->query("UPDATE users SET status = 'inactive' WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Check if username already exists
     */
    public function checkUsernameExists($username, $excludeId = null)
    {
        $sql = "SELECT id FROM users WHERE username = :username";
        if($excludeId) $sql .= " AND id != :excludeId";
        
        $this->db->query($sql);
        $this->db->bind(':username', $username);
        if($excludeId) $this->db->bind(':excludeId', $excludeId);
        
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    /**
     * Check if email already exists
     */
    public function checkEmailExists($email, $excludeId = null)
    {
        $sql = "SELECT id FROM users WHERE email = :email";
        if($excludeId) $sql .= " AND id != :excludeId";
        
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        if($excludeId) $this->db->bind(':excludeId', $excludeId);
        
        $this->db->single();
        return $this->db->rowCount() > 0;
    }


    /**
     * Get all administrators based on requester's role and jurisdiction
     *
     * @param string $role Requester's role
     * @param int|null $lga_id Requester's LGA ID
     * @param int|null $unit_id Requester's Unit ID
     * @return array
     */
    public function getAdmins($role = 'superadmin', $lga_id = null, $unit_id = null)
    {
        $where = " WHERE 1=1";
        $params = [];

        if ($role === 'lga_admin') {
            $where .= " AND u.lga_id = :lga_id AND u.role IN ('unit_admin', 'agent')";
            $params[':lga_id'] = $lga_id;
        } elseif ($role === 'unit_admin') {
            $where .= " AND u.unit_id = :unit_id AND u.role = 'agent'";
            $params[':unit_id'] = $unit_id;
        }

        $sql = "SELECT u.*, l.name as lga_name, un.name as unit_name 
                FROM users u 
                LEFT JOIN lgas l ON u.lga_id = l.id 
                LEFT JOIN units un ON u.unit_id = un.id 
                $where ORDER BY u.created_at DESC";

        $this->db->query($sql);
        foreach($params as $key => $val) $this->db->bind($key, $val);

        return $this->db->resultSet();
    }

    /**
     * Get counts of administrators by role within a jurisdiction
     *
     * @param string $role Requester's role
     * @param int|null $lga_id Requester's LGA ID
     * @param int|null $unit_id Requester's Unit ID
     * @return object
     */
    public function getScopedAdminStats($role = 'superadmin', $lga_id = null, $unit_id = null)
    {
        $where = " WHERE 1=1";
        $params = [];

        if ($role === 'lga_admin') {
            $where .= " AND lga_id = :lga_id";
            $params[':lga_id'] = $lga_id;
        } elseif ($role === 'unit_admin') {
            $where .= " AND unit_id = :unit_id";
            $params[':unit_id'] = $unit_id;
        }

        $sql = "SELECT 
                COUNT(CASE WHEN role = 'lga_admin' THEN 1 END) as lga_admins,
                COUNT(CASE WHEN role = 'unit_admin' THEN 1 END) as unit_admins,
                COUNT(CASE WHEN role = 'agent' THEN 1 END) as agents,
                COUNT(*) as total
                FROM users $where";

        $this->db->query($sql);
        foreach($params as $key => $val) $this->db->bind($key, $val);

        return $this->db->single();
    }

    /**
     * Get all LGAs
     *
     * @return array
     */
    public function getLgas()
    {
        $this->db->query('SELECT * FROM lgas ORDER BY name ASC');
        return $this->db->resultSet();
    }

    /**
     * Get units for a specific LGA
     *
     * @param int $lga_id
     * @return array
     */
    public function getUnitsByLga($lga_id)
    {
        $this->db->query('SELECT * FROM units WHERE lga_id = :lga_id ORDER BY name ASC');
        $this->db->bind(':lga_id', $lga_id);
        return $this->db->resultSet();
    }

    /**
     * Get aggregate statistics for the dashboard with jurisdictional scoping
     *
     * @param string $role
     * @param int|null $lga_id
     * @param int|null $unit_id
     * @return object
     */
    public function getScopedDashboardStats($role = 'superadmin', $lga_id = null, $unit_id = null, $agent_id = null)

    {
        $where = " WHERE 1=1";
        $params = [];

        if ($role === 'lga_admin') {
            $where .= " AND m.lga_id = :lga_id";
            $params[':lga_id'] = $lga_id;
        } elseif ($role === 'agent') {
            $where .= " AND p.agent_id = :agent_id";
            $params[':agent_id'] = $agent_id; 
        } elseif ($role === 'unit_admin') {
            $where .= " AND m.unit_id = :unit_id";
            $params[':unit_id'] = $unit_id;
        }



        // Total Today (Joined with members for scoping)
        $sql = "SELECT SUM(p.amount) as total FROM payments p 
                INNER JOIN members m ON p.member_id = m.id 
                $where AND DATE(p.payment_date) = CURDATE()";
        $this->db->query($sql);
        foreach($params as $key => $val) $this->db->bind($key, $val);
        $today = $this->db->single()->total ?? 0;

        // Total This Week
        $sql = "SELECT SUM(p.amount) as total FROM payments p 
                INNER JOIN members m ON p.member_id = m.id 
                $where AND YEARWEEK(p.payment_date, 1) = YEARWEEK(CURDATE(), 1)";
        $this->db->query($sql);
        foreach($params as $key => $val) $this->db->bind($key, $val);
        $week = $this->db->single()->total ?? 0;

        // Members Count
        $mWhere = $where;
        if ($role === 'agent') {
            $mWhere = " WHERE m.added_by = :agent_id";
        }

        
        $sql = "SELECT 
                COUNT(CASE WHEN m.status = 'active' THEN 1 END) as active,
                COUNT(CASE WHEN m.status != 'active' THEN 1 END) as inactive
                FROM members m $mWhere";

        $this->db->query($sql);
        foreach($params as $key => $val) {
            if ($role === 'agent' && $key === ':unit_id') continue; // Skip unit_id for agent member count
            // Actually, my $params for agent currently has :agent_id mapped to $lga_id
            $this->db->bind($key, $val);
        }
        $counts = $this->db->single();


        return (object)[
            'today' => $today,
            'week' => $week,
            'active' => $counts->active ?? 0,
            'inactive' => $counts->inactive ?? 0
        ];
    }

    /**
     * Get members with jurisdictional scoping
     */
    public function getScopedMembers($role = 'superadmin', $lga_id = null, $unit_id = null)
    {
        $where = " WHERE 1=1";
        $params = [];

        if ($role === 'lga_admin') {
            $where .= " AND m.lga_id = :lga_id";
            $params[':lga_id'] = $lga_id;
        } elseif ($role === 'unit_admin' || $role === 'agent') {
            $where .= " AND m.unit_id = :unit_id";
            $params[':unit_id'] = $unit_id;
        }

        $this->db->query("SELECT m.*, l.name as lga_name, un.name as unit_name 
                          FROM members m 
                          LEFT JOIN lgas l ON m.lga_id = l.id 
                          LEFT JOIN units un ON m.unit_id = un.id 
                          $where ORDER BY m.created_at DESC");
        
        foreach($params as $key => $val) $this->db->bind($key, $val);
        
        return $this->db->resultSet();
    }

    /**
     * Get revenue logs with jurisdictional scoping
     */
    public function getScopedRevenue($role = 'superadmin', $lga_id = null, $unit_id = null, $agent_id = null)

    {
        $where = " WHERE 1=1";
        $params = [];

        if ($role === 'lga_admin') {
            $where .= " AND m.lga_id = :lga_id";
            $params[':lga_id'] = $lga_id;
        } elseif ($role === 'agent') {
            $where .= " AND p.agent_id = :agent_id";
            $params[':agent_id'] = $agent_id; 
        } elseif ($role === 'unit_admin') {
            $where .= " AND m.unit_id = :unit_id";
            $params[':unit_id'] = $unit_id;
        }



        $this->db->query("SELECT p.*, m.fullname as member_name, m.plate_number, l.name as lga_name, un.name as unit_name 
                          FROM payments p 
                          INNER JOIN members m ON p.member_id = m.id 
                          LEFT JOIN lgas l ON m.lga_id = l.id 
                          LEFT JOIN units un ON m.unit_id = un.id 
                          $where ORDER BY p.payment_date DESC LIMIT 50");
        
        foreach($params as $key => $val) $this->db->bind($key, $val);
        
        return $this->db->resultSet();
    }

    /**
     * Get revenue by LGA for charts (Super Admin only or Scoped for LGA Admin)
     */
    public function getScopedLgaRevenue($role = 'superadmin', $lga_id = null)
    {
        if ($role === 'superadmin') {
            $this->db->query('SELECT l.name, SUM(p.amount) as total 
                              FROM lgas l 
                              LEFT JOIN members m ON l.id = m.lga_id 
                              LEFT JOIN payments p ON m.id = p.member_id 
                              GROUP BY l.id 
                              ORDER BY total DESC');
        } else {
            $this->db->query('SELECT l.name, SUM(p.amount) as total 
                              FROM lgas l 
                              LEFT JOIN members m ON l.id = m.lga_id 
                              LEFT JOIN payments p ON m.id = p.member_id 
                              WHERE l.id = :lga_id 
                              GROUP BY l.id');
            $this->db->bind(':lga_id', $lga_id);
        }
        return $this->db->resultSet();
    }

    /**
     * Find a member by plate number for verification
     *
     * @param string $plate
     * @return object|false
     */
    public function getMemberByPlate($plate)
    {
        $this->db->query('SELECT m.*, l.name as lga_name, un.name as unit_name 
                          FROM members m 
                          LEFT JOIN lgas l ON m.lga_id = l.id 
                          LEFT JOIN units un ON m.unit_id = un.id 
                          WHERE m.plate_number = :plate');
        $this->db->bind(':plate', $plate);
        return $this->db->single();
    }

    /**
     * Get a specific member by ID
     *
     * @param int $id
     * @return object|false
     */
    public function getMemberById($id)
    {
        $this->db->query('SELECT m.*, l.name as lga_name, un.name as unit_name, un.subaccount_code 
                          FROM members m 
                          LEFT JOIN lgas l ON m.lga_id = l.id 
                          LEFT JOIN units un ON m.unit_id = un.id 
                          WHERE m.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Search member by plate number or unique ID
     */
    public function getMemberBySearch($search)
    {
        $this->db->query('SELECT m.*, l.name as lga_name, un.name as unit_name, un.subaccount_code 
                          FROM members m 
                          LEFT JOIN lgas l ON m.lga_id = l.id 
                          LEFT JOIN units un ON m.unit_id = un.id 
                          WHERE TRIM(m.plate_number) = :search OR TRIM(m.unique_id) = :search');
        $this->db->bind(':search', trim($search));
        return $this->db->single();
    }

    /**
     * Search member for autocomplete dropdown
     */
    public function searchMembersAutocomplete($q)
    {
        $this->db->query("SELECT id, unique_id, plate_number, fullname 
                          FROM members 
                          WHERE TRIM(plate_number) LIKE :q OR TRIM(unique_id) LIKE :q
                          LIMIT 5");
        $this->db->bind(':q', '%' . trim($q) . '%');
        return $this->db->resultSet();
    }

    /**
     * Get the most recent tax payment for a member (any type: daily, weekly, monthly)
     */
    public function getLastPayment($member_id)
    {
        $this->db->query("SELECT * FROM payments 
                          WHERE member_id = :member_id 
                          AND payment_type IN ('daily', 'weekly', 'monthly') 
                          ORDER BY payment_date DESC LIMIT 1");
        $this->db->bind(':member_id', $member_id);
        return $this->db->single();
    }

    /**
     * Get the number of days a payment type covers
     */
    public function getPaymentCoverageDays($payment_type, $amount = 0, $dailyRate = 200)
    {
        if ($dailyRate <= 0) $dailyRate = 200; // Fallback

        switch ($payment_type) {
            case 'registration':
                return 0;
            case 'weekly':
                return 7;
            case 'monthly':
                return 30;
            case 'daily':
            default:
                // For daily/exact amount, we calculate how many full days it covers
                return (int)floor($amount / $dailyRate);
        }
    }

    /**
     * Check if a member already has a daily payment recorded today
     */
    public function hasPaidToday($member_id)
    {
        $this->db->query("SELECT COUNT(*) as cnt FROM payments 
                          WHERE member_id = :member_id 
                          AND DATE(payment_date) = CURDATE()
                          AND payment_type IN ('daily', 'weekly', 'monthly')");
        $this->db->bind(':member_id', $member_id);
        $result = $this->db->single();
        return ($result && $result->cnt > 0);
    }

    /**
     * Record a new revenue payment
     *
     * @param array $data
     * @return int|false The ID of the inserted record or false
     */
    public function recordPayment($data)
    {
        // 1. Generate receipt number
        $receipt_number = 'TX-' . strtoupper(substr(uniqid(), 7)) . '-' . date('His');

        // 2. Insert payment record
        $this->db->query('INSERT INTO payments (member_id, amount, payment_type, receipt_number, agent_id, payment_date) 
                          VALUES (:member_id, :amount, :payment_type, :receipt_number, :agent_id, NOW())');
        
        $this->db->bind(':member_id', $data['member_id']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':payment_type', $data['payment_type']);
        $this->db->bind(':receipt_number', $receipt_number);
        $this->db->bind(':agent_id', $data['agent_id']);

        if ($this->db->execute()) {
            $paymentId = $this->db->lastInsertId();

            // 3. Update member's paid_until date
            $member = $this->getMemberById($data['member_id']);
            if ($member) {
                // Get daily rate for calculation
                $this->db->query("SELECT setting_value FROM settings WHERE setting_key = 'daily_rate'");
                $row = $this->db->single();
                $dailyRate = $row ? (int)$row->setting_value : 200;

                $daysToAdd = $this->getPaymentCoverageDays($data['payment_type'], $data['amount'], $dailyRate);

                if ($daysToAdd > 0) {
                    $currentPaidUntil = $member->paid_until;
                    $today = date('Y-m-d');

                    // Arrears-aware stacking: always stack from the existing expiry date if available
                    // This ensures members clear old debts before moving their status to 'Compliant'
                    if (!$currentPaidUntil) {
                        $baseDate = $today;
                    } else {
                        $baseDate = $currentPaidUntil;
                    }

                    $newPaidUntil = date('Y-m-d', strtotime($baseDate . " + {$daysToAdd} days"));

                    $this->db->query("UPDATE members SET paid_until = :paid_until WHERE id = :id");
                    $this->db->bind(':paid_until', $newPaidUntil);
                    $this->db->bind(':id', $member->id);
                    $this->db->execute();
                }
            }

            return $paymentId;
        }
        return false;
    }

    /**
     * Get payment history for a specific member
     *
     * @param int $member_id
     * @return array
     */
    public function getMemberPayments($member_id)
    {
        $this->db->query('SELECT p.*, u.fullname as agent_name
                          FROM payments p 
                          LEFT JOIN users u ON p.agent_id = u.id
                          WHERE p.member_id = :member_id 
                          ORDER BY p.payment_date DESC');
        $this->db->bind(':member_id', $member_id);
        return $this->db->resultSet();
    }

    /**
     * Get transaction details for receipt generation
     *
     * @param int $id
     * @return object|false
     */
    public function getTransactionById($id)
    {
        $this->db->query('SELECT p.*, m.fullname as member_name, m.unique_id, m.plate_number, l.name as lga_name, un.name as unit_name, u.fullname as agent_name
                          FROM payments p 
                          INNER JOIN members m ON p.member_id = m.id 
                          LEFT JOIN lgas l ON m.lga_id = l.id 
                          LEFT JOIN units un ON m.unit_id = un.id 
                          LEFT JOIN users u ON p.agent_id = u.id
                          WHERE p.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Create a new LGA
     */
    public function createLga($data)
    {
        $this->db->query('INSERT INTO lgas (name, code) VALUES (:name, :code)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':code', $data['code']);
        return $this->db->execute();
    }

    /**
     * Update an LGA
     */
    public function updateLga($id, $data)
    {
        $this->db->query('UPDATE lgas SET name = :name, code = :code WHERE id = :id');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':code', $data['code']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Delete an LGA
     */
    public function deleteLga($id)
    {
        $this->db->query('DELETE FROM lgas WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    private function createPaystackSubaccount($unitName, $bankCode, $accountNumber)
    {
        $this->db->query("SELECT setting_value FROM settings WHERE setting_key = 'paystack_secret_key'");
        $row = $this->db->single();
        $secretKey = $row ? $row->setting_value : '';

        if (empty($secretKey) || empty($bankCode) || empty($accountNumber)) {
            return null;
        }

        $url = "https://api.paystack.co/subaccount";
        $fields = [
            "business_name" => $unitName . " Unit",
            "settlement_bank" => $bankCode,
            "account_number" => $accountNumber,
            "percentage_charge" => 75.0 // Subaccount (Unit) gets 25%, Main account (State) charges 75%
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $secretKey,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return null;
        }

        $result = json_decode($response);
        if ($result && isset($result->status) && $result->status) {
            return $result->data->subaccount_code;
        }
        
        return null; // Return null if failed so we don't crash
    }

    /**
     * Create a new Unit
     */
    public function createUnit($data)
    {
        $subaccount_code = null;
        if (!empty($data['bank_code']) && !empty($data['account_number'])) {
            $subaccount_code = $this->createPaystackSubaccount($data['name'], $data['bank_code'], $data['account_number']);
        }

        $this->db->query('INSERT INTO units (lga_id, name, code, bank_code, account_number, subaccount_code) VALUES (:lga_id, :name, :code, :bank_code, :account_number, :subaccount_code)');
        $this->db->bind(':lga_id', $data['lga_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':code', $data['code']);
        $this->db->bind(':bank_code', $data['bank_code'] ?? null);
        $this->db->bind(':account_number', $data['account_number'] ?? null);
        $this->db->bind(':subaccount_code', $subaccount_code);
        return $this->db->execute();
    }

    /**
     * Update a Unit
     */
    public function updateUnit($id, $data)
    {
        // For simplicity, we just create a new subaccount code if details changed
        $subaccount_code = null;
        if (!empty($data['bank_code']) && !empty($data['account_number'])) {
            $subaccount_code = $this->createPaystackSubaccount($data['name'], $data['bank_code'], $data['account_number']);
        }

        $query = 'UPDATE units SET lga_id = :lga_id, name = :name, code = :code';
        if ($subaccount_code) {
             $query .= ', bank_code = :bank_code, account_number = :account_number, subaccount_code = :subaccount_code';
        }
        $query .= ' WHERE id = :id';

        $this->db->query($query);
        $this->db->bind(':lga_id', $data['lga_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':code', $data['code']);
        if ($subaccount_code) {
            $this->db->bind(':bank_code', $data['bank_code']);
            $this->db->bind(':account_number', $data['account_number']);
            $this->db->bind(':subaccount_code', $subaccount_code);
        }
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Delete a Unit
     */
    public function deleteUnit($id)
    {
        $this->db->query('DELETE FROM units WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Register a new member (Tricycle Operator)
     */
    public function createMember($data)
    {
        // 1. Fetch LGA code
        $this->db->query('SELECT code FROM lgas WHERE id = :id');
        $this->db->bind(':id', $data['lga_id']);
        $lga = $this->db->single();
        $lga_code = ($lga) ? strtoupper(trim($lga->code)) : 'KOG';

        // 2. Count existing members in this LGA to get sequence
        $this->db->query('SELECT COUNT(*) as count FROM members WHERE lga_id = :lga_id');
        $this->db->bind(':lga_id', $data['lga_id']);
        $currentCount = $this->db->single()->count;
        $nextSequence = str_pad($currentCount + 1, 5, '0', STR_PAD_LEFT);

        // 3. Format Unique ID: KOG-ADA-00004
        $unique_id = 'KOG-' . $lga_code . '-' . $nextSequence;

        $this->db->query('INSERT INTO members (unique_id, plate_number, fullname, phone, lga_id, unit_id, password, status, added_by, passport_image) 
                          VALUES (:unique_id, :plate_number, :fullname, :phone, :lga_id, :unit_id, :password, :status, :added_by, :passport_image)');

        $this->db->bind(':unique_id', $unique_id);
        $this->db->bind(':plate_number', $data['plate_number']);
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':lga_id', $data['lga_id']);
        $this->db->bind(':unit_id', $data['unit_id']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':status', $data['status'] ?? 'active');
        $this->db->bind(':added_by', $data['added_by'] ?? null);
        $this->db->bind(':passport_image', $data['passport_image'] ?? null);



        if ($this->db->execute()) {

            return $this->db->lastInsertId();
        }
        return false;
    }

    /**
     * Get all audit logs
     */
    public function getAuditLogs()
    {
        $this->db->query("SELECT a.*, u.fullname, u.username, u.role
                          FROM audit_logs a 
                          LEFT JOIN users u ON a.user_id = u.id 
                          ORDER BY a.created_at DESC");
        return $this->db->resultSet();
    }

    /**
     * Get aggregate statistics for the audit dashboard
     */
    public function getAuditStats()
    {
        // Total Actions Today
        $this->db->query("SELECT COUNT(*) as total FROM audit_logs WHERE DATE(created_at) = CURDATE()");
        $today = $this->db->single()->total ?? 0;

        return (object)[
            'today' => $today
        ];
    }
    /**
     * Get real-time reporting analytics
     */
    public function getReportsAnalytics()
    {
        $analytics = [];

        // 1. Monthly Revenue Trend (Last 6 Months)
        $this->db->query("SELECT MONTHNAME(payment_date) as month, SUM(amount) as total 
                          FROM payments 
                          WHERE payment_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
                          GROUP BY YEAR(payment_date), MONTH(payment_date), MONTHNAME(payment_date)
                          ORDER BY YEAR(payment_date) ASC, MONTH(payment_date) ASC");
        $analytics['monthly_trend'] = $this->db->resultSet();

        // 2. Collections by LGA (Top 8)
        $this->db->query("SELECT l.name, SUM(p.amount) as total 
                          FROM payments p
                          INNER JOIN members m ON p.member_id = m.id
                          INNER JOIN lgas l ON m.lga_id = l.id
                          GROUP BY l.id
                          ORDER BY total DESC
                          LIMIT 8");
        $analytics['top_lgas'] = $this->db->resultSet();

        // 3. Payment Compliance
        $this->db->query("SELECT COUNT(DISTINCT member_id) as compliant_members 
                          FROM payments 
                          WHERE payment_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)");
        $compliant = $this->db->single()->compliant_members ?? 0;

        $this->db->query("SELECT COUNT(*) as total_members FROM members WHERE status = 'active'");
        $total = $this->db->single()->total_members ?? 0;
        
        $grace_period = floor($total * 0.1); 
        $compliant_members = (int)$compliant;
        $unpaid_members = max(0, $total - $compliant_members - $grace_period);

        $analytics['compliance'] = [
            $compliant_members,
            $unpaid_members,
            $grace_period
        ];

        // 4. Most Productive Day
        $this->db->query("SELECT DAYNAME(payment_date) as day_name, SUM(amount) as total 
                          FROM payments 
                          GROUP BY day_name
                          ORDER BY total DESC LIMIT 1");
        $productive = $this->db->single();
        $analytics['most_productive_day'] = $productive && $productive->day_name ? $productive->day_name : 'No Data';

        // 5. Highest Growth LGA
        $this->db->query("SELECT l.name, SUM(p.amount) as total 
                          FROM payments p
                          INNER JOIN members m ON p.member_id = m.id
                          INNER JOIN lgas l ON m.lga_id = l.id
                          WHERE MONTH(p.payment_date) = MONTH(NOW()) AND YEAR(p.payment_date) = YEAR(NOW())
                          GROUP BY l.id
                          ORDER BY total DESC
                          LIMIT 1");
        $growth = $this->db->single();
        $analytics['highest_growth_lga'] = $growth && $growth->name ? $growth->name : 'No Data';

        // 6. Quick Preview Stats
        $this->db->query("SELECT SUM(amount) as total_collections FROM payments");
        $analytics['total_collections'] = $this->db->single()->total_collections ?? 0;
        $analytics['unique_members'] = $total; 

        $denominator = max(1, $total - $grace_period);
        $enforcement_rate = min(100, round(($compliant_members / $denominator) * 100, 1));
        $analytics['enforcement_rate'] = $enforcement_rate;

        return (object)$analytics;
    }

    /**
     * Get complaints with jurisdictional scoping and dynamic filtering
     */
    public function getScopedComplaints($role = 'superadmin', $jurisdiction_lga_id = null, $jurisdiction_unit_id = null, $filters = [])
    {
        $where = " WHERE 1=1";
        $params = [];

        // 1. Jurisdictional Scoping
        if ($role === 'lga_admin') {
            $where .= " AND c.lga_id = :j_lga_id";
            $params[':j_lga_id'] = $jurisdiction_lga_id;
        } elseif ($role === 'unit_admin' || $role === 'agent') {
            $where .= " AND c.unit_id = :j_unit_id";
            $params[':j_unit_id'] = $jurisdiction_unit_id;
        }

        // 2. Dynamic Attribute Filtering
        if (!empty($filters['lga_id']) && $filters['lga_id'] !== 'all') {
            $where .= " AND c.lga_id = :f_lga_id";
            $params[':f_lga_id'] = $filters['lga_id'];
        }
        if (!empty($filters['category']) && $filters['category'] !== 'all') {
            $where .= " AND c.category = :f_category";
            $params[':f_category'] = $filters['category'];
        }
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $where .= " AND c.status = :f_status";
            $params[':f_status'] = $filters['status'];
        }
        if (!empty($filters['search'])) {
            $where .= " AND (c.ticket_id LIKE :f_search OR m.fullname LIKE :f_search OR m.unique_id LIKE :f_search)";
            $params[':f_search'] = '%' . $filters['search'] . '%';
        }

        $this->db->query("SELECT c.*, m.fullname as member_name, m.unique_id, l.name as lga_name, un.name as unit_name 
                          FROM complaints c 
                          JOIN members m ON c.member_id = m.id
                          LEFT JOIN lgas l ON c.lga_id = l.id 
                          LEFT JOIN units un ON c.unit_id = un.id 
                          $where ORDER BY c.created_at DESC");
        
        foreach($params as $key => $val) $this->db->bind($key, $val);
        
        return $this->db->resultSet();
    }

    public function updateComplaintStatus($ticket_id, $status, $admin_reply = null)
    {
        $this->db->query("UPDATE complaints SET status = :status, admin_reply = :admin_reply WHERE ticket_id = :ticket_id");
        $this->db->bind(':status', $status);
        $this->db->bind(':admin_reply', $admin_reply);
        $this->db->bind(':ticket_id', $ticket_id);
        return $this->db->execute();
    }
}
