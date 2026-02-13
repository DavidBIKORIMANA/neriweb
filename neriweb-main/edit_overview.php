<?php
session_start();

// DB Connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "philippeneri";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("DB Connection Failed: " . $conn->connect_error);

// Get overview ID
if(!isset($_GET['id'])) {
    die("ID not specified.");
}

$id = intval($_GET['id']);

// Fetch current data
$result = $conn->query("SELECT * FROM overview WHERE id=$id");
if($result->num_rows == 0) die("Overview not found.");

$row = $result->fetch_assoc();

// Handle update
if(isset($_POST['update'])) {
    $section = $conn->real_escape_string($_POST['section']);
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $image_name = $row['image'];

    // Image upload
    if(isset($_FILES['image']) && $_FILES['image']['name'] != "") {
        $target_dir = "uploads/";
        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if(in_array($imageFileType, $allowed)) {
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "<p style='color:red;'>Failed to upload image.</p>";
            } else {
                // Remove old image
                if($row['image'] && file_exists($target_dir . $row['image'])) {
                    unlink($target_dir . $row['image']);
                }
            }
        } else {
            echo "<p style='color:red;'>Only JPG, PNG, GIF allowed.</p>";
        }
    }

    $sql = "UPDATE overview SET section='$section', title='$title', content='$content', image='$image_name', updated_at=NOW() WHERE id=$id";
    if($conn->query($sql)) {
        echo "<p style='color:green;'>Overview updated successfully!</p>";
        $row = $conn->query("SELECT * FROM overview WHERE id=$id")->fetch_assoc();
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit Overview</title>
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>Edit Overview Section</h2>

<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Section</label>
        <input type="text" name="section" class="form-control" value="<?php echo htmlspecialchars($row['section']); ?>" required>
    </div>
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($row['title']); ?>" required>
    </div>
    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($row['content']); ?></textarea>
    </div>
    <div class="mb-3">
        <label>Current Image</label><br>
        <?php if($row['image']): ?>
            <img src="uploads/<?php echo $row['image']; ?>" width="150">
        <?php else: ?>
            N/A
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label>Change Image (optional)</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update Overview</button>
    <a href="admin_overview.php" class="btn btn-secondary">Back</a>
</form>

</body>
</html>
