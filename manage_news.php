<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Database connection details
$host = 'localhost';
$dbname = 'philippeneri';
$username = 'root';
$password = '';

$pdo = null; // Initialize PDO object

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Recommended for security
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$delete_message = null;
$delete_message_type = null;

// Handle news deletion
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = filter_var($_GET['delete_id'], FILTER_SANITIZE_NUMBER_INT);
    $sql_delete = "DELETE FROM news_updates WHERE id = :id";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':id', $delete_id, PDO::PARAM_INT);

    try {
        if ($stmt_delete->execute()) {
            $delete_message = "News item deleted successfully.";
            $delete_message_type = "success";
        } else {
            $delete_message = "Error deleting news item.";
            $delete_message_type = "error";
        }
    } catch (PDOException $e) {
        $delete_message = "Database error during deletion: " . $e->getMessage();
        $delete_message_type = "error";
    }
}

// Fetch all news items for display and deletion
$sql_select_news = "SELECT id, title, description, image_data, mime_type, created_at FROM news_updates ORDER BY created_at DESC";
$stmt_select_news = $pdo->query($sql_select_news);
$news_items = $stmt_select_news->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News - GS ST Philippe Neri</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 960px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 20px;
        }

        .actions-bar {
            text-align: center;
            margin-bottom: 20px;
        }

        .action-button {
            display: inline-block;
            background-color: #007bff; /* Blue for Add News */
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 10px;
            transition: background-color 0.3s ease;
            font-size: 0.9rem;
        }

        .action-button:hover {
            background-color: #0056b3;
        }

        .delete-message-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .delete-success {
            color: #27ae60;
            background-color: #d4edda;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
        }

        .delete-error {
            color: #c0392b;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
        }

        h2 {
            color: #3498db;
            margin-top: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .news-list {
            list-style: none;
            padding: 0;
        }

        .news-item {
            background: #f9f9f9;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 15px;
            align-items: center;
        }

        .news-content {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 10px;
            align-items: start;
        }

        .news-image {
            max-width: 150px;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .news-details {
            flex-grow: 1;
        }

        .news-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .news-description {
            font-size: 0.9rem;
            color: #555;
        }

        .delete-button {
            background-color: #e74c3c; /* Red for Delete */
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        .no-news {
            text-align: center;
            font-size: 1rem;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage News</h1>

        <div class="actions-bar">
            <a href="add_news.php" class="action-button">Add New News</a>
            </div>

        <div class="delete-message-container">
            <?php if ($delete_message): ?>
                <div class="<?php echo htmlspecialchars($delete_message_type); ?>">
                    <?php echo htmlspecialchars($delete_message); ?>
                </div>
            <?php endif; ?>
        </div>

        <h2>Existing News</h2>
        <?php if (!empty($news_items)): ?>
            <ul class="news-list">
                <?php foreach ($news_items as $news): ?>
                    <li class="news-item">
                        <div class="news-content">
                            <?php if ($news['image_data']): ?>
                                <img src="data:<?php echo htmlspecialchars($news['mime_type']); ?>;base64,<?php echo htmlspecialchars($news['image_data']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" class="news-image">
                            <?php else: ?>
                                <div style="width: 150px; height: auto; background-color: #eee; border-radius: 4px; display: flex; justify-content: center; align-items: center;">No Image</div>
                            <?php endif; ?>
                            <div class="news-details">
                                <h3 class="news-title"><?php echo htmlspecialchars($news["title"]); ?></h3>
                                <p class="news-description"><?php echo nl2br(htmlspecialchars($news["description"])); ?></p>
                                <p style="font-size: 0.8rem; color: #777;">Posted on: <?php echo htmlspecialchars(date('F j, Y, g:i a', strtotime($news["created_at"]))); ?></p>
                            </div>
                        </div>
                        <a href="manage_news.php?delete_id=<?php echo htmlspecialchars($news["id"]); ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this news item?')">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="no-news">No news items have been posted yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>