<?php
require_once 'db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM holiday_work WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  
  if ($stmt->execute()) {
    header("Location: manage_holiday_work.php?deleted=success");
  } else {
    echo "Error deleting: " . $stmt->error;
  }
  $stmt->close();
}

$conn->close();
?>
