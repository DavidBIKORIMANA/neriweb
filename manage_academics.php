<?php
require_once 'db.php';// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch all academic content
$sql = "SELECT * FROM academics ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Academics</title>
  <style>
    body {
      font-family: Arial;
      background: #f4f4f4;
      padding: 40px;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #007bff;
    }
    .academic-item {
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    .academic-item img {
      max-width: 100%;
      height: auto;
      margin-top: 10px;
      border-radius: 6px;
    }
    .actions {
      margin-top: 15px;
    }
    .delete-btn {
      background-color: red;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
    }
    .delete-btn:hover {
      background-color: darkred;
    }
    .message {
      text-align: center;
      color: green;
      margin-bottom: 15px;
    }
    a.add-link {
      display: inline-block;
      text-align: center;
      margin-bottom: 20px;
      color: #007bff;
      text-decoration: none;
    }
    a.add-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Manage Academic Content</h2>

  <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'success') : ?>
    <p class="message">Academic content deleted successfully!</p>
  <?php endif; ?>

  <a href="add_academic.php" class="add-link">➕ Add New Academic Content</a>

  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="academic-item">
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
        <?php if (!empty($row['image_data']) && !empty($row['mime_type'])): ?>
          <img src="data:<?= $row['mime_type'] ?>;base64,<?= $row['image_data'] ?>" alt="Academic Image">
        <?php endif; ?>
        <div class="actions">
          <form method="get" action="delete_academic.php" onsubmit="return confirm('Are you sure you want to delete this academic item?');">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" class="delete-btn">Delete</button>
          </form>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No academic content found.</p>
  <?php endif; ?>

</div>

</body>
</html>

<?php $conn->close(); ?>
