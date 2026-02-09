<?php
$pdo = new PDO("mysql:host=localhost;dbname=philippeneri", "root", "HDLPOahfVpYlhx29SkgMJCsmCMAYj0HL");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$username = "admin";
$password = "admin123"; // you can change this
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$role = "admin";

try {
    $stmt = $pdo->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hashedPassword, $role]);
    echo "Admin user created successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
