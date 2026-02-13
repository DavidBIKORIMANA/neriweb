<?php
session_start();

// DB Connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "philippeneri";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("DB Connection Failed: " . $conn->connect_error);

if(!isset($_GET['id'])) die("ID not specified.");

$id = intval($_GET['id']);

// Fetch image to delete
$row = $conn->query("SELECT image FROM overview WHERE id=$id")->fetch_assoc();
if($row['image'] && file_exists("uploads/" . $row['image'])) {
    unlink("uploads/" . $row['image']);
}

// Delete record
$conn->query("DELETE FROM overview WHERE id=$id");

header("Location: admin_overview.php");
exit;
