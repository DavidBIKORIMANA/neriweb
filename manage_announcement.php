<?php
// FILE: manage_announcements.php

require_once 'db.php'; // Ensure this file properly connects to your database ($conn)

// --- Handle Deletion ---
if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];

    // 1. Get file path before deleting record to remove the physical file
    $file_path_query = "SELECT file_path FROM announcements WHERE id = ?";
    $stmt_fetch = $conn->prepare($file_path_query);
    $stmt_fetch->bind_param("i", $id_to_delete);
    $stmt_fetch->execute();
    $stmt_fetch->bind_result($file_to_delete);
    $stmt_fetch->fetch();
    $stmt_fetch->close();

    // 2. Delete record from database using prepared statements for security
    $sql_delete = "DELETE FROM announcements WHERE id=?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id_to_delete);

    if ($stmt_delete->execute()) {
        // 3. If database record deleted, attempt to delete the physical file (if it exists)
        if (!empty($file_to_delete) && file_exists($file_to_delete)) {
            unlink($file_to_delete); // Delete the actual file
        }
        $message = "Announcement deleted successfully!";
        $alert_type = "success";
    } else {
        $message = "Failed to delete announcement: " . $stmt_delete->error;
        $alert_type = "danger";
    }
    $stmt_delete->close();

    // Redirect to prevent re-submission on refresh and display message
    // You might use sessions for more robust flash messages across redirects
    header("Location: manage_announcements.php?message=" . urlencode($message) . "&type=" . urlencode($alert_type));
    exit(); // Always exit after a header redirect
}

// --- Fetch Announcements for Display ---
$sql_select = "SELECT * FROM announcements ORDER BY uploaded_at DESC";
$result = $conn->query($sql_select);

// Basic error handling for select query
if (!$result) {
    die("Error fetching announcements: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Announcements - GS ST Philippe Neri</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #c5cae9);
            color: #333;
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
            max-width: 1200px; /* Wider container for DataTables */
        }
        h2 {
            text-align: center;
            color: #283593;
            margin-bottom: 30px;
            font-size: 2.5em;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .add-btn {
            margin-bottom: 20px;
            font-weight: 600;
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
            background-color: #283593; /* Darker header for clarity */
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
        /* Action buttons */
        .action-buttons .btn {
            margin-right: 5px;
        }
        .file-icon {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fas fa-bullhorn me-2"></i> Manage Announcements</h2>

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
    ?>

    <a class="btn btn-primary add-btn" href="upload_announcement.php"><i class="fas fa-plus-circle me-2"></i> Add New Announcement</a>

    <?php if ($result->num_rows > 0): ?>
    <table id="announcementsTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>File</th>
                <th>Posted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $row_num = 1; while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row_num++ ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
                <td>
                    <?php
                    $file_path = htmlspecialchars($row['file_path']);
                    if (!empty($file_path) && file_exists($file_path)) {
                        $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                        $file_icon = 'fas fa-file'; // Default icon
                        switch ($file_extension) {
                            case 'pdf': $file_icon = 'far fa-file-pdf'; break;
                            case 'doc':
                            case 'docx': $file_icon = 'far fa-file-word'; break;
                            case 'xls':
                            case 'xlsx': $file_icon = 'far fa-file-excel'; break;
                            case 'ppt':
                            case 'pptx': $file_icon = 'far fa-file-powerpoint'; break;
                            case 'jpg':
                            case 'jpeg':
                            case 'png':
                            case 'gif': $file_icon = 'far fa-file-image'; break;
                            case 'zip':
                            case 'rar': $file_icon = 'far fa-file-archive'; break;
                        }
                        echo '<a class="file-link" href="' . $file_path . '" target="_blank" title="View ' . $row['title'] . '">';
                        echo '<i class="' . $file_icon . ' file-icon"></i> View File';
                        echo '</a>';
                    } else {
                        echo '<span class="text-muted">No file</span>';
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars($row['uploaded_at']) ?></td>
                <td>
                    <a class="btn btn-danger btn-sm" href="?delete=<?= htmlspecialchars($row['id']) ?>" onclick="return confirm('Are you sure you want to delete this announcement? This action cannot be undone.');">
                        <i class="fas fa-trash-alt me-1"></i> Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle me-2"></i> No announcements found. Click "Add New Announcement" to get started!
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
        $('#announcementsTable').DataTable({
            responsive: true, // Enable responsive features
            order: [[4, 'desc']], // Default sort by "Posted At" column (index 4) in descending order
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], // Customize entries per page
            language: {
                search: "Search Announcements:",
                lengthMenu: "Show _MENU_ entries"
            }
        });
    });
</script>

</body>
</html>

<?php
// Close the database connection at the very end
$conn->close();
?>