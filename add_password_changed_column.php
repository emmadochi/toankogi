<?php
require_once 'app/bootstrap.php';

use App\Core\Database;

try {
    $db = new Database();
    
    // Check if is_default_password column exists in members
    $db->query("DESCRIBE members");
    $result = $db->resultSet();
    $columnExists = false;
    foreach($result as $row) {
        if($row->Field === 'is_default_password') {
            $columnExists = true;
            break;
        }
    }
    
    if(!$columnExists) {
        echo "Adding is_default_password column to members table...\n";
        $db->query("ALTER TABLE members ADD COLUMN is_default_password TINYINT(1) NOT NULL DEFAULT 1");
        if($db->execute()) {
            echo "Column added successfully. All existing members are set to 1 (default password).\n";
        } else {
            echo "Error adding column.\n";
        }
    } else {
        echo "is_default_password column already exists in members table.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
