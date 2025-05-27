<?php
header('Content-Type: text/plain');

// Database configuration
$db_host = 'webdev.aut.ac.nz';
$db_user = 'ync5389';          // Change to your MySQL username
$db_pass = 'ydadurzgsufoivatseaizakokzwbcrme';              // Change to your MySQL password
$db_name = 'ync5389';

// Get POST data
$name = $_POST['name'] ?? '';
$pwd = $_POST['pwd'] ?? '';

// Validate input
if (empty($name) || empty($pwd)) {
    die("Error: Both fields are required");
}

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Error: Database connection failed");
}

// Prepare and execute query
$stmt = $conn->prepare("SELECT password, email FROM users WHERE name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Error: User not found";
} else {
    $row = $result->fetch_assoc();
    if (password_verify($pwd, $row['password'])) {
        echo $row['email'];
    } else {
        echo "Error: Incorrect password";
    }
}

$stmt->close();
$conn->close();
?>