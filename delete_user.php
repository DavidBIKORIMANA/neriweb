<?php
// FILE: manage_users.php - For deleting existing user accounts

session_start();

// --- Access Control: Only allow logged-in administrators ---
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Redirect to a login page or display an access denied message
    header("Location: admin_login.php"); // Assuming you have an admin_login.php
    exit();
}

// Database connection parameters
$host = 'localhost';
$dbname = 'philippeneri';
$username_db = 'root';
$password_db = 'HDLPOahfVpYlhx29SkgMJCsmCMAYj0HL';

$message = '';
$message_type = ''; // 'success' or 'danger'

// --- Handle User Deletion ---
if (isset($_GET['delete_id'])) {
    $id_to_delete = filter_var($_GET['delete_id'], FILTER_VALIDATE_INT); // Sanitize ID

    if ($id_to_delete === false || $id_to_delete <= 0) {
        $message = "Invalid user ID provided.";
        $message_type = "danger";
    } elseif ($id_to_delete == $_SESSION['id']) {
        // Prevent deleting the currently logged-in admin user
        $message = "You cannot delete your own account while logged in.";
        $message_type = "danger";
    } else {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username_db, $password_db);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the DELETE statement
            $stmt_delete = $pdo->prepare("DELETE FROM user WHERE id = :id");
            $stmt_delete->bindParam(':id', $id_to_delete, PDO::PARAM_INT);

            if ($stmt_delete->execute()) {
                $message = "User deleted successfully!";
                $message_type = "success";
            } else {
                $message = "Failed to delete user. " . $stmt_delete->errorInfo()[2]; // Get PDO error message
                $message_type = "danger";
            }
        } catch (PDOException $e) {
            error_log("User deletion failed: " . $e->getMessage());
            $message = "An unexpected database error occurred during deletion. Please try again later.";
            $message_type = "danger";
        }
    }
    // Redirect to clear GET parameters and display message
    header("Location: manage_users.php?message=" . urlencode($message) . "&type=" . urlencode($message_type));
    exit();
}

// --- Fetch Users for Display ---
$users = [];
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username_db, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Fetch all users, excluding the current admin's ID
    $stmt_fetch = $pdo->prepare("SELECT id, username, role FROM user WHERE id != :current_user_id ORDER BY username ASC");
    $stmt_fetch->bindParam(':current_user_id', $_SESSION['id'], PDO::PARAM_INT);
    $stmt_fetch->execute();
    $users = $stmt_fetch->fetchAll();

} catch (PDOException $e) {
    error_log("Failed to fetch users: " . $e->getMessage());
    $message = "Error loading users. Please try again later.";
    $message_type = "danger";
    // If fetching fails, the $users array will remain empty.
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - GS ST Philippe Neri</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #c5cae9);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
            margin-top: 20px;
            max-width: 900px; /* Slightly narrower than announcement table */
        }
        h2 {
            text-align: center;
            color: #283593;
            margin-bottom: 30px;
            font-size: 2.5em;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        /* DataTables specific styling */
        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter,
        div.dataTables_wrapper div.dataTables_info,
        div.dataTables_wrapper div.dataTables_paginate {
            padding-top: 1em;
            padding-bottom: 1em;
        }
        table.dataTable thead th {
            background-color: #283593;
            color: white;
            padding: 12px 18px !important;
            border-bottom: 2px solid #1a237e !important;
        }
        table.dataTable tbody td {
            padding: 10px 18px;
            vertical-align: middle;
        }
        /* Responsive DataTables expand/collapse icon color */
        table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child:before {
            background-color: #283593;
        }
        .action-buttons .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fas fa-users-cog me-2"></i> Manage Users</h2>

    <?php
    // Display flash message if set (from redirection after delete)
    if (isset($_GET['message']) && isset($_GET['type'])) {
        $message_text = htmlspecialchars($_GET['message']);
        $alert_class = ($_GET['type'] == 'success') ? 'alert-success' : 'alert-danger';
        echo '<div class="alert ' . $alert_class . ' alert-dismissible fade show" role="alert">';
        echo $message_text;
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    // Also display messages from initial fetch if there was an error
    elseif (!empty($message) && !empty($message_type)) {
        echo '<div class="alert ' . ($message_type == 'success' ? 'alert-success' : 'alert-danger') . ' alert-dismissible fade show" role="alert">';
        echo htmlspecialchars($message);
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    ?>

    <?php if (count($users) > 0): ?>
    <table id="usersTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $row_num = 1; foreach($users as $user): ?>
            <tr>
                <td><?= $row_num++ ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars(ucfirst($user['role'])) ?></td>
                <td>
                    <a class="btn btn-danger btn-sm" href="?delete_id=<?= htmlspecialchars($user['id']) ?>" onclick="return confirm('Are you sure you want to delete user \'<?= htmlspecialchars($user['username']) ?>\'? This action cannot be undone.');">
                        <i class="fas fa-trash-alt me-1"></i> Delete
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle me-2"></i> No other users found to manage.
        </div>
    <?php endif; ?>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#usersTable').DataTable({
            responsive: true, // Enable responsive features
            order: [[1, 'asc']], // Default sort by Username column (index 1) in ascending order
            lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]], // Customize entries per page
            language: {
                search: "Search Users:",
                lengthMenu: "Show _MENU_ entries"
            }
        });
    });
</script>

</body>
</html>