<?php
session_start();

// DB Connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "philippeneri";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("DB Connection Failed: " . $conn->connect_error);

// Handle form submission (Add new)
if(isset($_POST['submit'])) {
    $section = $conn->real_escape_string($_POST['section']);
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $image_name = null;

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
                $image_name = null;
            }
        } else {
            echo "<p style='color:red;'>Only JPG, PNG, GIF allowed.</p>";
            $image_name = null;
        }
    }

    $sql = "INSERT INTO overview (section, title, content, image) VALUES ('$section','$title','$content','$image_name')";
    if($conn->query($sql)) echo "<p style='color:green;'>Overview added successfully!</p>";
    else echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
}

// Fetch all overview content
$overview = $conn->query("SELECT * FROM overview ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin Overview - GS St Philippe Neri</title>
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>Manage Overview</h2>

<!-- Add New Overview -->
<form method="post" enctype="multipart/form-data" class="mb-4">
    <div class="mb-3">
        <label>Section</label>
        <input type="text" name="section" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>
    <div class="mb-3">
        <label>Image (optional)</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Add Overview</button>
</form>

<hr>

<!-- Existing Overviews -->
<h3>Existing Overview Sections</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Section</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $overview->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['section']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['content'])); ?></td>
            <td>
                <?php if($row['image']): ?>
                    <img src="uploads/<?php echo $row['image']; ?>" width="100">
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
            <td><?php echo $row['created_at']; ?></td>
            <td><?php echo $row['updated_at']; ?></td>
            <td>
                <a href="edit_overview.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete_overview.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
    $('textarea[name="content"]').summernote({
        height: 200
    });
});
</script>

</body>
</html>
