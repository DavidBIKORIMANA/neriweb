
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Holiday Work - GS ST Philippe Neri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .upload-form {
            background: #fff;
            max-width: 600px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="upload-form">
    <h2>Upload Holiday Work</h2>
    <form action="save_holiday.php" method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Class:</label>
        <input type="text" name="class_name" required>

        <label>Subject:</label>
        <input type="text" name="subject_name" required>

        <label>Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Select File (PDF, DOCX, JPG...):</label>
        <input type="file" name="holiday_file" required>

        <button type="submit">Upload Holiday Work</button>
    </form>
</div>

</body>
</html>
