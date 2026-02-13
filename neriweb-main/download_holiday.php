<?php 
require_once 'db.php';

// Check if 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to an integer for security
} else {
    die("Error: 'id' parameter missing in the URL.");
}

// Query to get file data by ID
$sql = "SELECT file_name, mime_type, file_data FROM holiday_work WHERE id=?";
$stmt = $conn->prepare($sql);

// Check if the query preparation was successful
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}

$stmt->bind_param("i", $id); // Bind the ID as an integer
$stmt->execute();
$stmt->store_result();

// Check if file is found
if ($stmt->num_rows > 0) {
    $stmt->bind_result($fileName, $mimeType, $fileData);
    $stmt->fetch();

    // Send appropriate headers to trigger download
    header("Content-Type: " . $mimeType); // Set MIME type (for example: image/jpeg, application/pdf)
    header("Content-Disposition: attachment; filename=\"" . $fileName . "\"");
    header("Content-Length: " . strlen($fileData)); // Set content length (important for large files)

    // Output the file data (contents of file_data column)
    echo $fileData;
} else {
    echo "File not found.";
}

$stmt->close();
$conn->close();
?>
