<?php
require_once 'db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Delete query
  $sql = "DELETE FROM academics WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    // Redirect after delete
    header("Location: manage_academics.php?deleted=success");
    exit;
  } else {
    echo "Error deleting record: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Invalid request.";
}

$conn->close();
?>
