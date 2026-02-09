<?php 
// Password to hash for admin
$password = "123456";  // Change this to your desired password

// Generate hashed password for admin
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Admin user details
$username = "admin1";  // Change this to your desired username
$role = "admin";       // Change to 'teacher' if needed

// Display SQL to insert admin into `user` table
echo "INSERT INTO user (username, password, role) VALUES ('$username', '$hashedPassword', '$role');";
echo "<br>";

// === Add new teacher ===
$password2 = "1234";  // Teacher password
$hashedPassword2 = password_hash($password2, PASSWORD_DEFAULT);
$username2 = "teacher4";
$role2 = "teacher";

echo "INSERT INTO user (username, password, role) VALUES ('$username2', '$hashedPassword2', '$role2');";
?>
