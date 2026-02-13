<?php
// download_work.php
if (!isset($_GET['id'])) {
    die("❌ No file ID specified.");
}

$id = (int)$_GET['id'];

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "philippeneri";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

// Fetch file from database
$stmt = $conn->prepare("SELECT file_name, file_data, mime_type FROM holiday_work WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    die("❌ File not found.");
}

$stmt->bind_result($file_name, $file_data, $mime_type);
$stmt->fetch();

// Send headers and output the file
header("Content-Description: File Transfer");
header("Content-Type: " . $mime_type);
header("Content-Disposition: attachment; filename=\"" . basename($file_name) . "\"");
header("Content-Length: " . strlen($file_data));
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

echo $file_data;

$stmt->close();
$conn->close();
exit();
?>
