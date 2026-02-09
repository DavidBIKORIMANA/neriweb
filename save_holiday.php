<?php
// Connect to the database
require_once 'db.php';

// Get form data
$title = $_POST['title'];
$class_name = $_POST['class_name'];
$subject_name = $_POST['subject_name'];
$description = $_POST['description'];

// File upload
if (isset($_FILES['holiday_file']) && $_FILES['holiday_file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['holiday_file']['tmp_name'];
    $fileName = $_FILES['holiday_file']['name'];
    $fileSize = $_FILES['holiday_file']['size'];
    $fileType = $_FILES['holiday_file']['type'];
    $fileData = file_get_contents($fileTmpPath);

    // Prepare SQL
    $stmt = $conn->prepare("INSERT INTO holiday_work (title, class_name, subject_name, description, file_name, mime_type, file_data, uploaded_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssssss", $title, $class_name, $subject_name, $description, $fileName, $fileType, $fileData);

    if ($stmt->execute()) {
        echo "<script>alert('Holiday work uploaded successfully.'); window.location.href='holidays_works.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No file uploaded or upload error.";
}

$conn->close();
?>
