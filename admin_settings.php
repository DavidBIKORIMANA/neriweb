
<?php
session_start();

// Only admin can access this page
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: teacher_login.php");
    exit();
}

$host = 'localhost';
$dbname = 'philippeneri';
$db_username = 'root';
$db_password = "HDLPOahfVpYlhx29SkgMJCsmCMAYj0HL";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$success = '';
$error = '';
$filterRole = $_GET['role'] ?? '';

// Handle update credentials
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_credentials'])) {
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match!";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE user SET username = ?, password = ? WHERE username = ?");
        if ($stmt->execute([$newUsername, $hashedPassword, $_SESSION['username']])) {
            $_SESSION['username'] = $newUsername;
            $success = "Credentials updated successfully!";
        } else {
            $error = "Failed to update credentials.";
        }
    }
}

// Handle delete user
if (isset($_GET['delete_user'])) {
    $deleteId = $_GET['delete_user'];
    $stmt = $pdo->prepare("DELETE FROM user WHERE id = ? AND role != 'admin'");
    $stmt->execute([$deleteId]);
    header("Location: admin_settings.php");
    exit();
}

// Fetch all users with optional role filter
if ($filterRole && in_array($filterRole, ['admin', 'teacher'])) {
    $stmt = $pdo->prepare("SELECT id, username, role FROM user WHERE role = ? ORDER BY id DESC");
    $stmt->execute([$filterRole]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $users = $pdo->query("SELECT id, username, role FROM user ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Settings</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f6f8fa;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        h2, h3 {
            margin-bottom: 20px;
        }
        .btns {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }
        .btns a {
            text-decoration: none;
            padding: 10px 18px;
            background: #3498db;
            color: white;
            border-radius: 6px;
        }
        form {
            margin-bottom: 40px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button[type="submit"] {
            padding: 10px 16px;
            background-color: #2ecc71;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #27ae60;
        }
        .message {
            margin-bottom: 15px;
            font-weight: bold;
        }
        .success { color: green; }
        .error { color: red; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .action-btns a {
            margin-right: 8px;
            text-decoration: none;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
        }
        .delete-btn {
            background-color: #e74c3c;
        }
        .edit-btn {
            background-color: #f1c40f;
        }
        .filter-links {
            margin-bottom: 15px;
        }
        .filter-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Settings</h2>

    <div class="btns">
        <a href=" dashboard.php">← Back to Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>

    <?php if ($success): ?>
        <div class="message success"> <?= $success ?> </div>
    <?php elseif ($error): ?>
        <div class="message error"> <?= $error ?> </div>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="update_credentials" value="1">
        <label>New Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($_SESSION['username']) ?>" required>

        <label>New Password</label>
        <input type="password" name="password" required>

        <label>Confirm New Password</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">Update Admin Info</button>
    </form>

    <h3>All Users</h3>
    <div class="filter-links">
        <a href="admin_settings.php">All</a>
        <a href="admin_settings.php?role=teacher">Only Teachers</a>
        <a href="admin_settings.php?role=admin">Only Admins</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= ucfirst($user['role']) ?></td>
                <td class="action-btns">
                    <a class="edit-btn" href="edit_user.php?id=<?= $user['id'] ?>">Edit</a>
                    <?php if ($user['role'] !== 'admin'): ?>
                      
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
