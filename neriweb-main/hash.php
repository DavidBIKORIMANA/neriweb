<?php
/*
|--------------------------------------------------------------------------
| PASSWORD HASH GENERATOR
| Use this file ONLY to generate hashes, then delete it.
|--------------------------------------------------------------------------
*/

// ===== ADMIN USER =====
$adminPassword = "123456";   // change password
$adminUsername = "admin1";   // change username
$adminRole     = "admin";

$adminHash = password_hash($adminPassword, PASSWORD_DEFAULT);

// ===== TEACHER USER =====
$teacherPassword = "1234";   // change password
$teacherUsername = "teacher4";
$teacherRole     = "teacher";

$teacherHash = password_hash($teacherPassword, PASSWORD_DEFAULT);

// ===== OUTPUT SQL =====
echo "<h3>ADMIN SQL</h3>";
echo "<pre>";
echo "INSERT INTO user (username, password, role) VALUES ('{$adminUsername}', '{$adminHash}', '{$adminRole}');";
echo "</pre>";

echo "<h3>TEACHER SQL</h3>";
echo "<pre>";
echo "INSERT INTO user (username, password, role) VALUES ('{$teacherUsername}', '{$teacherHash}', '{$teacherRole}');";
echo "</pre>";
?>
