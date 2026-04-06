<?php
require 'app/bootstrap.php';

echo "<h2>Session & Configuration Diagnosis</h2>";
echo "<p><strong>URLROOT:</strong> " . URLROOT . "</p>";
echo "<p><strong>APPROOT:</strong> " . APPROOT . "</p>";
echo "<p><strong>Session Status:</strong> " . (session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Inactive') . "</p>";

if (isset($_GET['set'])) {
    $_SESSION['test_value'] = 'Hello Kogi 2026';
    echo "<p style='color: green;'>Session variable set! <a href='?check'>Click here to check if it persists</a></p>";
} elseif (isset($_GET['check'])) {
    if (isset($_SESSION['test_value']) && $_SESSION['test_value'] === 'Hello Kogi 2026') {
        echo "<p style='color: green;'>SUCCESS: Session persisted across requests!</p>";
    } else {
        echo "<p style='color: red;'>FAILURE: Session lost across requests.</p>";
    }
    echo "<p><a href='?set'>Try setting again</a></p>";
} else {
    echo "<p><a href='?set'>Start Session Test</a></p>";
}

echo "<h3>Superadmin Check</h3>";
$db = new App\Core\Database();
$db->query("SELECT id, username, role FROM users WHERE username = 'superadmin'");
$user = $db->single();
if ($user) {
    echo "<p style='color: green;'>Superadmin found in database (ID: " . $user->id . ")</p>";
} else {
    echo "<p style='color: red;'>Superadmin NOT FOUND in database.</p>";
}
