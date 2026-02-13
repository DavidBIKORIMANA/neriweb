<?php
session_start();

// Admin check
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: teacher_login.php");
    exit();
}

$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = 'teacher';

    if ($username === "" || $password === "") {
        $message = "All fields are required.";
        $messageType = "error";
    } else {
        try {
            $pdo = new PDO(
                "mysql:host=localhost;dbname=philippeneri;charset=utf8",
                "root",
                "",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            // Check username
            $check = $pdo->prepare("SELECT id FROM user WHERE username = ?");
            $check->execute([$username]);

            if ($check->rowCount() > 0) {
                $message = "Username already exists.";
                $messageType = "error";
            } else {
                // NO HASH (as requested)
                $stmt = $pdo->prepare(
                    "INSERT INTO user (username, password, role) VALUES (?, ?, ?)"
                );
                $stmt->execute([$username, $password, $role]);

                $message = "Teacher registered successfully.";
                $messageType = "success";
            }
        } catch (PDOException $e) {
            $message = "Database error.";
            $messageType = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Teacher</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="container">
    <h2>Register Teacher</h2>

    <?php if ($message): ?>
        <div class="message <?= $messageType ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
    </form>

    <a href="admin_dashboard.php" class="back-link">Back to Dashboard</a>
</div>

</body>
</html>
