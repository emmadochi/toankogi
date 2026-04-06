<?php

namespace App\Core;

use App\Core\Database;

class AuditLogger
{
    /**
     * Log an action to the database
     *
     * @param string $actionType  Short category (e.g. 'Login', 'Payment Record')
     * @param string $target      What was affected (e.g. 'LKJ-123-AB', 'System Settings')
     * @param string $details     Detailed sentence about the action
     */
    public static function log($actionType, $target, $details)
    {
        try {
            $db = new Database();
            $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            $ipAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';

            $db->query('INSERT INTO audit_logs (user_id, action_type, target_entity, details, ip_address) 
                        VALUES (:user_id, :action_type, :target_entity, :details, :ip_address)');
            
            $db->bind(':user_id', $userId);
            $db->bind(':action_type', $actionType);
            $db->bind(':target_entity', $target);
            $db->bind(':details', $details);
            $db->bind(':ip_address', $ipAddress);

            $db->execute();
        } catch (\Exception $e) {
            // Fail silently or log to error log to avoid breaking the main application flow
            error_log("Audit Logger Failed: " . $e->getMessage());
        }
    }
}
