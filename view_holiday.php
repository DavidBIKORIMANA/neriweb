<?php
$servername = "localhost";
$username = "root";
$password = "HDLPOahfVpYlhx29SkgMJCsmCMAYj0HL";
$dbname = "philippeneri";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, title, class_name, subject_name, description, file_name FROM holiday_work ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Holiday Work - GS ST Philippe Neri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef1f4;
            padding: 30px;
        }

        .holiday-table {
            background: #fff;
            max-width: 90%;
            margin: auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        a.download-btn {
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        a.download-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="holiday-table">
    <h2>Uploaded Holiday Work</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Class</th>
            <th>Subject</th>
            <th>Description</th>
            <th>File</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".htmlspecialchars($row['title'])."</td>
                    <td>".htmlspecialchars($row['class_name'])."</td>
                    <td>".htmlspecialchars($row['subject_name'])."</td>
                    <td>".htmlspecialchars($row['description'])."</td>
                    <td><a class='download-btn' href='download_holiday.php?id=".$row['id']."'>Download</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No holiday work uploaded yet.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
