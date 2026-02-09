<?php
require_once 'db.php';

// Handle delete request
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM holiday_work WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  if ($stmt->execute()) {
    $message = "Holiday work deleted successfully.";
  } else {
    $message = "Error deleting: " . $stmt->error;
  }
  $stmt->close();
}

// Fetch all holiday works
$sql = "SELECT * FROM holiday_work ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Holiday Work</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #4A90E2;
      --secondary-color: #50E3C2;
      --danger-color: #FF6161;
      --text-color: #333;
      --light-bg: #F9FAFB;
      --card-bg: #fff;
      --border-color: #E2E8F0;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: var(--light-bg);
      padding: 30px;
      color: var(--text-color);
      line-height: 1.6;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background: var(--card-bg);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    h2 {
      text-align: center;
      color: var(--primary-color);
      font-weight: 700;
      margin-bottom: 30px;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .top-bar .add-btn {
      background-color: var(--primary-color);
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 15px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(74, 144, 226, 0.3);
    }
    
    .top-bar .add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(74, 144, 226, 0.4);
    }

    .message {
      text-align: center;
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 8px;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .message.success {
      background-color: #E6FFFA;
      color: #38A169;
    }

    .message.error {
      background-color: #FEEBCB;
      color: #DD6B20;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid var(--border-color);
    }

    th {
      background-color: var(--primary-color);
      color: white;
      font-weight: 600;
      text-transform: uppercase;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:nth-child(even) {
      background-color: #F7F9FC;
    }

    tr:hover {
      background-color: #ECF2F9;
    }

    td .delete-btn {
      background-color: var(--danger-color);
      color: white;
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
      transition: background-color 0.3s ease;
      font-weight: 500;
    }

    td .delete-btn:hover {
      background-color: #d13d3d;
    }

    .no-results {
      text-align: center;
      color: #999;
      font-style: italic;
      margin-top: 30px;
    }
    
    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    .modal-content h3 {
        margin-top: 0;
        color: var(--text-color);
    }
    
    .modal-content p {
        color: #555;
    }

    .modal-buttons {
        margin-top: 20px;
        display: flex;
        justify-content: space-around;
    }
    
    .modal-buttons button {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }

    .modal-buttons .cancel {
        background-color: #ccc;
        color: #333;
    }
    
    .modal-buttons .confirm-delete {
        background-color: var(--danger-color);
        color: white;
    }
  </style>
</head>
<body>

<div class="container">
    <div class="top-bar">
        <h2>Manage Holiday Work</h2>
        <a class="add-btn" href="upload_holiday.php">
            <i class="fas fa-plus-circle"></i> Add New Holiday Work
        </a>
    </div>

    <?php if (isset($message)): ?>
        <div class="message success">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Posted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= $row['uploaded_at'] ?></td>
                <td>
                    <a class="delete-btn" href="#" data-id="<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="no-results">No holiday work found.</p>
    <?php endif; ?>
</div>

<div id="confirmModal" class="modal">
    <div class="modal-content">
        <h3>Confirm Deletion</h3>
        <p>Are you sure you want to delete this holiday work? This action cannot be undone.</p>
        <div class="modal-buttons">
            <button class="cancel">Cancel</button>
            <button class="confirm-delete">Delete</button>
        </div>
    </div>
</div>

<script>
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const modal = document.getElementById('confirmModal');
    const confirmDeleteBtn = document.querySelector('.confirm-delete');
    const cancelBtn = document.querySelector('.cancel');
    let deleteId = null;

    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            deleteId = e.target.getAttribute('data-id');
            modal.style.display = 'flex';
        });
    });

    confirmDeleteBtn.addEventListener('click', () => {
        if (deleteId) {
            window.location.href = `?delete=${deleteId}`;
        }
    });

    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
        deleteId = null;
    });

    // Close modal if user clicks outside of it
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
            deleteId = null;
        }
    });
</script>

<?php $conn->close(); ?>
