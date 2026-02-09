<?php
require_once 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];

  if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
    $base64_image = base64_encode($image_data);
    $mime_type = $_FILES["image"]["type"];

    $sql = "INSERT INTO entertainment_updates (title, description, image_data, mime_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
      $message = "Error preparing SQL: " . $conn->error;
    } else {
      $stmt->bind_param("ssss", $title, $description, $base64_image, $mime_type);
      if ($stmt->execute()) {
        $message = "Entertainment post added successfully!";
      } else {
        $message = "Failed to add post: " . $stmt->error;
      }
      $stmt->close();
    }
  } else {
    $message = "Please select a valid image.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Entertainment</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f0f0f0;
      padding: 40px;
    }
    .container {
      background: #fff;
      padding: 20px;
      max-width: 600px;
      margin: auto;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #28a745;
    }
    input[type="text"], textarea, input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    input[type="submit"], input[type="button"] {
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      margin-top: 15px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .message {
      color: green;
      text-align: center;
    }
    #preview {
      display: none;
      margin-top: 20px;
    }
    #preview img {
      max-width: 100%;
      height: auto;
    }
  </style>
  <script>
    function previewEntertainment() {
      const title = document.getElementById("title").value;
      const description = document.getElementById("description").value;
      const file = document.getElementById("image").files[0];

      document.getElementById("previewTitle").innerText = title;
      document.getElementById("previewDescription").innerText = description;

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById("imagePreview").src = e.target.result;
        };
        reader.readAsDataURL(file);
      }

      document.getElementById("preview").style.display = "block";
    }
  </script>
</head>
<body>

<div class="container">
  <h2>Add Entertainment</h2>

  <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

  <form method="post" action="add_entertainment.php" enctype="multipart/form-data">
    <label>Title:</label>
    <input type="text" name="title" id="title" required>

    <label>Description:</label>
    <textarea name="description" id="description" rows="5" required></textarea>

    <label>Upload Image:</label>
    <input type="file" name="image" id="image" required>

    <input type="submit" name="submit" value="Add Entertainment">
    <input type="button" value="Preview" onclick="previewEntertainment()">
  </form>

  <div id="preview">
    <h3>Preview:</h3>
    <p><strong>Title:</strong> <span id="previewTitle"></span></p>
    <p><strong>Description:</strong></p>
    <p id="previewDescription"></p>
    <img id="imagePreview" alt="Preview Image">
  </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
