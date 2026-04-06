<?php
require_once '../app/bootstrap.php';

echo "<h1>Session Diagnostic Tool</h1>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Session Status:</strong> " . (session_status() === PHP_SESSION_ACTIVE ? "ACTIVE" : "INACTIVE") . "</p>";
echo "<p><strong>Session ID:</strong> " . session_id() . "</p>";
echo "<p><strong>Save Path:</strong> " . ini_get('session.save_path') . "</p>";

if (isset($_GET['set'])) {
    $_SESSION['test_value'] = "Kogi-App-Session-Test-" . time();
    echo "<p style='color: green;'>Test value set! <a href='session_test.php'>Click here to check persistence</a></p>";
} else {
    if (isset($_SESSION['test_value'])) {
        echo "<p style='color: green;'><strong>SUCCESS:</strong> Test value persisted: " . $_SESSION['test_value'] . "</p>";
    } else {
        echo "<p style='color: orange;'>No test value found. <a href='?set=1'>Click here to set one</a></p>";
    }
}

echo "<h2>Session Variables:</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h2>Server Variables (Partial):</h2>";
echo "<pre>";
echo "HTTP_HOST: " . ($_SERVER['HTTP_HOST'] ?? 'N/A') . "\n";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n";
echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'N/A') . "\n";
echo "</pre>";
