<?php
try {
    $db = new PDO('sqlite:lab07.db');
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        username VARCHAR(50) PRIMARY KEY,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL
    )");
    
    // Insert test data
    $stmt = $db->prepare("INSERT OR IGNORE INTO users VALUES (?, ?, ?)");
    $stmt->execute(['john', password_hash('password', PASSWORD_DEFAULT), 'john@example.com']);
    $stmt->execute(['mary', password_hash('password', PASSWORD_DEFAULT), 'mary@example.com']);
    $stmt->execute(['david', password_hash('password', PASSWORD_DEFAULT), 'david@example.com']);
    
    echo "Database setup complete! Delete this file after use.";
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>