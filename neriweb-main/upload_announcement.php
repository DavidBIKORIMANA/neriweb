<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "philippeneri");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uploadMessage = "";

// A helper function to get a human-readable error message
function get_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
        case UPLOAD_ERR_FORM_SIZE:
            return "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
        case UPLOAD_ERR_PARTIAL:
            return "The uploaded file was only partially uploaded.";
        case UPLOAD_ERR_NO_FILE:
            return "No file was uploaded.";
        case UPLOAD_ERR_NO_TMP_DIR:
            return "Missing a temporary folder.";
        case UPLOAD_ERR_CANT_WRITE:
            return "Failed to write file to disk.";
        case UPLOAD_ERR_EXTENSION:
            return "A PHP extension stopped the file upload.";
        default:
            return "An unknown error occurred.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    // Check for upload errors first
    if ($_FILES["file"]["error"] > 0) {
        $uploadMessage = "❌ Error during file upload: " . get_upload_error_message($_FILES["file"]["error"]);
    } else {
        $target_dir = "uploads/";
        
        // Generate a unique file name to avoid conflicts
        $fileName = uniqid() . '_' . basename($_FILES["file"]["name"]);
        $target_file = $target_dir . $fileName;
        $file_path = $target_file;
    
        // Check if the uploads directory exists, and create it if not
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
    
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $uploaded_at = date('Y-m-d H:i:s');
    
            $stmt = $conn->prepare("INSERT INTO announcements (title, description, file_path, uploaded_at) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $title, $description, $file_path, $uploaded_at);
    
            if ($stmt->execute()) {
                $uploadMessage = "✅ Announcement uploaded successfully!";
            } else {
                $uploadMessage = "❌ Error: " . $stmt->error;
            }
        } else {
            $uploadMessage = "❌ Error moving the uploaded file. Check directory permissions.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Announcement</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f7f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .upload-form-container {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        .upload-form-container h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            color: #34495e;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            height: 120px;
        }

        input[type="submit"] {
            background-color: #007acc;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #005f99;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 1.05rem;
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="upload-form-container">
    <h2>📢 Upload Announcement</h2>

    <?php if (!empty($uploadMessage)) : ?>
        <div class="message <?php echo strpos($uploadMessage, 'Error') !== false ? 'error' : ''; ?>">
            <?php echo $uploadMessage; ?>
        </div>
    <?php endif; ?>

    <form action="upload_announcement.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <label for="file">Choose a file to upload:</label>
        <input type="file" name="file" required>

        <input type="submit" value="Upload Announcement">
    </form>
</div>

</body>
</html>
