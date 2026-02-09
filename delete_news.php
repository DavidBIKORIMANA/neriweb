<?php
require_once 'db.php';

// Check if the delete ID is set in the GET request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Prepare and bind the delete statement
    $sql = "DELETE FROM news_updates WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    // Execute the deletion
    if ($stmt->execute()) {
        // Deletion successful
        $message = "News item deleted successfully.";
        $message_type = "success";
    } else {
        // Deletion failed
        $message = "Error deleting news item: " . $stmt->error;
        $message_type = "error";
    }

    // Close the statement
    $stmt->close();

} else {
    $message = "Invalid request: No delete ID provided.";
    $message_type = "warning";
}

// Close the database connection
$conn->close();

// You might want to redirect the user back to the news listing page
// or display a confirmation message here.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete News - GS St. Philippe Neri</title>
    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
            background: #e8f5e9;
            color: #386641;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .message-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .success {
            color: #4CAF50;
            border: 1px solid #4CAF50;
            background-color: #e8f5e9;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .error {
            color: #f44336;
            border: 1px solid #f44336;
            background-color: #ffebee;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .warning {
            color: #ff9800;
            border: 1px solid #ff9800;
            background-color: #fffde7;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        a.back-link {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #66bb6a;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
        }

        a.back-link:hover {
            background-color: #5cb85c;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php if (isset($message)): ?>
            <div class="<?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <a href="news.php" class="back-link">Back to News</a>
    </div>
</body>
</html>