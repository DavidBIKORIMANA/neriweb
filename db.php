<?php
$host = "localhost";
$user = "root";
// $password = "";
$password = "HDLPOahfVpYlhx29SkgMJCsmCMAYj0HL";
$dbname = "philippeneri";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
