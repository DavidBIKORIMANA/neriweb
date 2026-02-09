<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'philippeneri';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_EMULATE_PREPARES => false]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$delete_message      = null;
$delete_message_type = null;

// Handle deletion
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $sql       = "DELETE FROM entertainment_updates WHERE id = :id";
    $stmt      = $pdo->prepare($sql);
    $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);

    try {
        if ($stmt->execute()) {
            $delete_message      = "Entertainment item deleted successfully.";
            $delete_message_type = "delete-success";
        } else {
            $delete_message      = "Failed to delete entertainment item.";
            $delete_message_type = "delete-error";
        }
    } catch (PDOException $e) {
        $delete_message      = "Error: " . $e->getMessage();
        $delete_message_type = "delete-error";
    }
}

// Fetch all entertainment updates
$sql    = "SELECT * FROM entertainment_updates ORDER BY created_at DESC";
$stmt   = $pdo->query($sql);
$items  = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Entertainment Updates</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <style>
    body { font-family: Arial, sans-serif; background: #f4f7f9; padding: 20px; }
    .container { max-width: 960px; margin: auto; background: #fff; padding: 20px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
    h1 { text-align: center; color: #c0392b; margin-bottom: 20px; }
    .actions { text-align: center; margin-bottom: 20px; }
    .btn-add { background: #007bff; color: #fff; padding: 10px 15px; border-radius:5px; text-decoration:none; }
    .btn-add:hover { background: #0056b3; }
    .message { text-align:center; padding:10px; border-radius:5px; margin-bottom:20px; }
    .delete-success { background: #d4edda; color: #155724; border:1px solid #c3e6cb; }
    .delete-error   { background: #f8d7da; color: #721c24; border:1px solid #f5c6cb; }
    .item { display: grid; grid-template-columns:1fr auto; gap:15px; background:#f9f9f9; padding:15px; margin-bottom:15px; border:1px solid #ddd; border-radius:5px; }
    .item-content { display:grid; grid-template-columns:auto 1fr; gap:10px; }
    .item-image { width:150px; height:auto; border-radius:4px; object-fit:cover; box-shadow:0 1px 3px rgba(0,0,0,0.1); }
    .item-text h3 { margin:0 0 5px; color:#333; }
    .item-text p { font-size:0.9rem; color:#555; }
    .item-text .date { font-size:0.8rem; color:#777; }
    .btn-delete { background: #e74c3c; color: #fff; padding:8px 12px; border:none; border-radius:5px; text-decoration:none; font-size:0.9rem; cursor:pointer; }
    .btn-delete:hover { background: #c0392b; }
    .no-data { text-align:center; color:#777; font-size:1rem; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Manage Entertainment Updates</h1>

    <div class="actions">
      <a href="add_entertainment.php" class="btn-add">Add New Entertainment</a>
    </div>

    <?php if ($delete_message): ?>
      <div class="message <?= htmlspecialchars($delete_message_type) ?>">
        <?= htmlspecialchars($delete_message) ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($items)): ?>
      <?php foreach ($items as $row): ?>
        <div class="item">
          <div class="item-content">
            <?php if (!empty($row['image_data'])): ?>
              <img src="data:<?= htmlspecialchars($row['mime_type']) ?>;base64,<?= $row['image_data'] ?>"
                   alt="<?= htmlspecialchars($row['title']) ?>" class="item-image">
            <?php else: ?>
              <div style="width:150px;height:100px;background:#eee;border-radius:4px;display:flex;align-items:center;justify-content:center;">
                No Image
              </div>
            <?php endif; ?>

            <div class="item-text">
              <h3><?= htmlspecialchars($row['title']) ?></h3>
              <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
              <p class="date">Posted on: <?= htmlspecialchars($row['created_at']) ?></p>
            </div>
          </div>

          <a href="?delete_id=<?= $row['id'] ?>"
             class="btn-delete"
             onclick="return confirm('Are you sure you want to delete this item?')">
             Delete
          </a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="no-data">No entertainment updates available yet.</p>
    <?php endif; ?>
  </div>
</body>
</html>
