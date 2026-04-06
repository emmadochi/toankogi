<?php

require_once __DIR__ . '/../app/Config/Config.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents('schema.sql');
    $pdo->exec($sql);

    echo "Database and tables created successfully.";
} catch (PDOException $e) {
    die("Database setup failed: " . $e->getMessage());
}
