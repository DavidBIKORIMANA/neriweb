<?php 
require_once 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];

  // Handle file upload (Base64 encoding)
  if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
    $base64_image = base64_encode($image_data);
    $mime_type = $_FILES["image"]["type"];

    $sql = "INSERT INTO academics (title, description, image_data, mime_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
      $message = "Error preparing the SQL statement: " . $conn->error;
    } else {
      $stmt->bind_param("ssss", $title, $description, $base64_image, $mime_type);
      if ($stmt->execute()) {
        $message = "Academic content added successfully!";
      } else {
        $message = "Error posting content: " . $stmt->error;
      }
      $stmt->close();
    }
  } else {
    $message = "Please upload an image.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Academic</title>
  <style>
    body {
      font-family: Arial;
      background: #f4f4f4;
      padding: 40px;
    }
    .container {
      background: white;
      max-width: 600px;
      margin: auto;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #007bff;
    }
    input[type="text"], textarea, input[type="file"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    input[type="submit"], input[type="button"] {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .message {
      text-align: center;
      color: green;
    }
    #preview {
      border: 1px solid #ccc;
      padding: 15px;
      margin-top: 20px;
      display: none;
    }
    #preview img {
      max-width: 100%;
      height: auto;
    }
  </style>
  <script>
    function previewAcademic() {
      var title = document.getElementById('title').value;
      var description = document.getElementById('description').value;
      var image = document.getElementById('imagePreview');
      var imageFile = document.getElementById('image').files[0];

      document.getElementById('previewTitle').innerText = title;
      document.getElementById('previewDescription').innerText = description;

      if (imageFile) {
        var reader = new FileReader();
        reader.onload = function (e) {
          image.src = e.target.result;
        };
        reader.readAsDataURL(imageFile);
      }
      document.getElementById('preview').style.display = 'block';
    }
  </script>
</head>
<body>

<div class="container">
  <h2>Add Academic</h2>

  <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

  <form method="post" action="add_academic.php" enctype="multipart/form-data">
    <label>Title:</label>
    <input type="text" name="title" id="title" required>

    <label>Description:</label>
    <textarea name="description" id="description" rows="6" required></textarea>

    <label>Upload Image:</label>
    <input type="file" name="image" id="image" required>

    <input type="submit" name="submit" value="Post Academic">
    <input type="button" value="Preview" onclick="previewAcademic()">
  </form>

  <!-- Preview Section -->
  <div id="preview">
    <h3>Preview:</h3>
    <p><strong>Title:</strong> <span id="previewTitle"></span></p>
    <p><strong>Description:</strong> <span id="previewDescription"></span></p>
    <p><strong>Image:</strong></p>
    <img id="imagePreview" alt="Preview Image">
  </div>

  <p style="text-align: center; margin-top: 20px;"><a href="academics.php">➡️ View Academics</a></p>
</div>

</body>
</html>

<?php $conn->close(); ?>
