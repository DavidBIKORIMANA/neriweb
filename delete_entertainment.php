<?php
$servername = "localhost";
$username = "root";
$password = "HDLPOahfVpYlhx29SkgMJCsmCMAYj0HL";
$dbname = "philippeneri";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM entertainments WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $message = "Entertainment post deleted successfully.";
        } else {
            $message = "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Error preparing delete statement: " . $conn->error;
    }
} else {
    $message = "Invalid request. No ID provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Entertainment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            padding: 50px;
            text-align: center;
        }

        .message {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            color: #28a745;
            font-size: 18px;
        }

        .error {
            color: #dc3545;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="message <?php if (strpos($message, 'Error') !== false) echo 'error'; ?>">
    <?php echo htmlspecialchars($message); ?>
</div>

<p><a href="manage_entertainment.php">⬅ Back to Manage Entertainments</a></p>

</body>
</html>
