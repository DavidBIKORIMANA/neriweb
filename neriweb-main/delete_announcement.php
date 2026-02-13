<?php
require_once 'db.php';

// Check if ID is passed
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get file path to delete file if needed
    $stmt = $conn->prepare("SELECT file_path FROM announcements WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($file_path);
    $stmt->fetch();
    $stmt->close();

    // Delete record
    $stmt = $conn->prepare("DELETE FROM announcements WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Optionally delete the uploaded file too
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        echo "<script>alert('Announcement deleted successfully!'); window.location.href='manage_announcement.php';</script>";
    } else {
        echo "<script>alert('Failed to delete.'); window.location.href='manage_announcement.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No ID provided.'); window.location.href='manage_announcement.php';</script>";
}

$conn->close();
?>
