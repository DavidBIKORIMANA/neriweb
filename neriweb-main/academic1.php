<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Academic Options</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #f4f9ff;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 50px;
        }
        .card {
            display: inline-block;
            background: white;
            padding: 30px 50px;
            margin: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        a.button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
        }
        a.button:hover {
            background-color: #0056b3;
        }
        h2 {
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <h2>Welcome to the Academic Portal</h2>
    <div class="card">
        <h3>📘 Continue to Academic Content</h3>
        <a href="academic.php" class="button">Go to Academic</a>
    </div>

    <div class="card">
        <h3>📝 Apply as a Learner</h3>
        <a href="apply.php" class="button">Go to Application Form</a>
    </div>

</body>
</html>
