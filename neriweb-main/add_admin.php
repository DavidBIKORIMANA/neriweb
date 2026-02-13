<?php
// Include database connection
require_once 'db.php';  // Make sure db.php is in the same folder

// Admin user details
$username = "admin";
$password = "admin123"; // Change as needed
$role = "admin";

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hashedPassword, $role]);
    echo "Admin user created successfully!";
} catch (PDOException $e) {
    // Common reason: duplicate username
    echo "Error: " . $e->getMessage();
}
?>
