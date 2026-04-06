<?php

namespace App\Models;

use App\Core\Database;

class Member
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Authenticate a member using Unique ID or Plate Number
     *
     * @param string $identifier
     * @param string $password
     * @return object|false
     */
    public function login($identifier, $password)
    {
        // Check by unique_id or plate_number
        $this->db->query('
            SELECT m.*, l.name AS lga_name, un.name AS unit_name, un.subaccount_code AS unit_subaccount
            FROM members m
            LEFT JOIN lgas l ON m.lga_id = l.id
            LEFT JOIN units un ON m.unit_id = un.id
            WHERE m.unique_id = :identifier OR m.plate_number = :identifier
        ');
        $this->db->bind(':identifier', $identifier);

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
     * Get a member by ID
     *
     * @param int $id
     * @return object|false
     */
    public function getMemberById($id)
    {
        $this->db->query('
            SELECT m.*, l.name as lga_name, un.name as unit_name, un.subaccount_code as unit_subaccount
            FROM members m 
            LEFT JOIN lgas l ON m.lga_id = l.id 
            LEFT JOIN units un ON m.unit_id = un.id 
            WHERE m.id = :id
        ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Get the most recent daily tax payment for a member
     */
    public function getLastDailyPayment($member_id)
    {
        $this->db->query("
            SELECT * FROM payments 
            WHERE member_id = :member_id 
            AND payment_type = 'daily' 
            ORDER BY payment_date DESC LIMIT 1
        ");
        $this->db->bind(':member_id', $member_id);
        return $this->db->single();
    }

    /**
     * Get all payment history for a specific member
     */
    public function getMemberPayments($member_id)
    {
        $this->db->query('
            SELECT p.*, u.fullname as agent_name
            FROM payments p 
            LEFT JOIN users u ON p.agent_id = u.id
            WHERE p.member_id = :member_id 
            ORDER BY p.payment_date DESC
        ');
        $this->db->bind(':member_id', $member_id);
        return $this->db->resultSet();
    }

    /**
     * Get Total Paid by Member in Current Month
     */
    public function getCurrentMonthTotal($member_id)
    {
        $this->db->query("SELECT SUM(amount) as total FROM payments 
                          WHERE member_id = :member_id 
                          AND MONTH(payment_date) = MONTH(CURDATE()) 
                          AND YEAR(payment_date) = YEAR(CURDATE())");
        $this->db->bind(':member_id', $member_id);
        $result = $this->db->single();
        return $result->total ?? 0;
    }

    /**
     * Create a new Complaint
     */
    public function createComplaint($data)
    {
        // Format Ticket ID: CMP-0004
        $this->db->query('SELECT COUNT(*) as count FROM complaints');
        $currentCount = $this->db->single()->count;
        $nextSequence = str_pad($currentCount + 1, 4, '0', STR_PAD_LEFT);
        $ticket_id = 'CMP-' . $nextSequence;

        $this->db->query('INSERT INTO complaints (ticket_id, member_id, lga_id, unit_id, category, subject, description) 
                          VALUES (:ticket_id, :member_id, :lga_id, :unit_id, :category, :subject, :description)');
        
        $this->db->bind(':ticket_id', $ticket_id);
        $this->db->bind(':member_id', $data['member_id']);
        $this->db->bind(':lga_id', $data['lga_id']);
        $this->db->bind(':unit_id', $data['unit_id']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':description', $data['description']);

        return $this->db->execute();
    }

    /**
     * Get member's complaints
     */
    public function getMemberComplaints($member_id)
    {
        $this->db->query('SELECT * FROM complaints WHERE member_id = :member_id ORDER BY created_at DESC');
        $this->db->bind(':member_id', $member_id);
        return $this->db->resultSet();
    }

    /**
     * Get Total Days Paid by Member in Current Month
     */
    public function getCurrentMonthDaysPaid($member_id)
    {
        $this->db->query("
            SELECT COUNT(DISTINCT DATE(payment_date)) as days_paid
            FROM payments 
            WHERE member_id = :member_id 
            AND payment_type = 'daily'
            AND MONTH(payment_date) = MONTH(CURRENT_DATE())
            AND YEAR(payment_date) = YEAR(CURRENT_DATE())
        ");
        $this->db->bind(':member_id', $member_id);
        return $this->db->single()->days_paid ?? 0;
    }

    /**
     * Update member password
     */
    public function updatePassword($id, $hashed_password)
    {
        $this->db->query('UPDATE members SET password = :password, is_default_password = 0 WHERE id = :id');
        $this->db->bind(':password', $hashed_password);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
