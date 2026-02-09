<?php
require_once 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];

  // Handle file upload (Base64 encoding)
  if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    // Get the file's contents and encode it as base64
    $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
    $base64_image = base64_encode($image_data);
    
    // Get the image's mime type (e.g., image/jpeg)
    $mime_type = $_FILES["image"]["type"];
    
    // Prepare the SQL statement to insert the image data
    $sql = "INSERT INTO news_updates (title, description, image_data, mime_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
      $message = "Error preparing the SQL statement: " . $conn->error;
    } else {
      $stmt->bind_param("ssss", $title, $description, $base64_image, $mime_type);

      if ($stmt->execute()) {
        $message = "News posted successfully!";
      } else {
        $message = "Error posting news: " . $stmt->error;
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
  <title>Add News</title>
  <!-- Summernote CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

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

    a {
      text-decoration: none;
      color: #007bff;
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
</head>
<body>

<div class="container">
  <h2>Add News</h2>

  <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

  <form method="post" action="add_news.php" enctype="multipart/form-data">
    <label>Title:</label>
    <input type="text" name="title" id="title" required>

    <label>Description:</label>
    <textarea name="description" id="description" rows="6" required></textarea>

    <label>Upload Image:</label>
    <input type="file" name="image" id="image" required>

    <input type="submit" name="submit" value="Post News">
    <input type="button" value="Preview" onclick="previewNews()">
  </form>

  <!-- Preview Section -->
  <div id="preview">
    <h3>Preview:</h3>
    <p><strong>Title:</strong> <span id="previewTitle"></span></p>
    <p><strong>Description:</strong> <span id="previewDescription"></span></p>
    <p><strong>Image:</strong></p>
    <img id="imagePreview" alt="Preview Image">
  </div>

  <p style="text-align: center; margin-top: 20px;"><a href="news.php">➡️ View News</a></p>
</div>

<!-- jQuery & Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
  // Initialize Summernote for description field
  $(document).ready(function() {
    $('#description').summernote({
      placeholder: 'Write the news description here...',
      tabsize: 2,
      height: 200
    });
  });

  // Preview function
  function previewNews() {
    var title = document.getElementById('title').value;
    var description = $('#description').summernote('code'); // get HTML content
    var image = document.getElementById('imagePreview');
    var imageFile = document.getElementById('image').files[0];

    document.getElementById('previewTitle').innerText = title;
    document.getElementById('previewDescription').innerHTML = description;

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

</body>
</html>

<?php $conn->close(); ?>
