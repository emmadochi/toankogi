<?php

namespace App\Models;

use App\Core\Database;

class Settings
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get a specific setting value by key
     */
    public function getSetting($key)
    {
        $this->db->query('SELECT setting_value FROM settings WHERE setting_key = :key');
        $this->db->bind(':key', $key);
        $row = $this->db->single();
        return $row ? $row->setting_value : null;
    }

    /**
     * Get all settings as an associative array
     */
    public function getAllSettings()
    {
        $this->db->query('SELECT * FROM settings');
        $results = $this->db->resultSet();
        $settings = [];
        foreach ($results as $row) {
            $settings[$row->setting_key] = $row->setting_value;
        }
        return $settings;
    }

    /**
     * Update a specific setting
     */
    public function updateSetting($key, $value)
    {
        $this->db->query('UPDATE settings SET setting_value = :value WHERE setting_key = :key');
        $this->db->bind(':value', $value);
        $this->db->bind(':key', $key);
        return $this->db->execute();
    }
}
