<?php
// Configuration for the database connection
// IMPORTANT: You must replace these with your actual database credentials.
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "HDLPOahfVpYlhx29SkgMJCsmCMAYj0HL"; // Replace with your MySQL password
$dbname = "philippeneri";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve holiday work data
$sql = "SELECT title, class_name, subject_name, file_name, uploaded_at FROM holiday_work ORDER BY uploaded_at DESC";
$result = $conn->query($sql);

$total_uploaded = 0;
if ($result->num_rows > 0) {
    $total_uploaded = $result->num_rows;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday Work Report</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        :root {
            --primary-color: #4A90E2;
            --secondary-color: #50E3C2;
            --text-color-dark: #333;
            --text-color-light: #fff;
            --bg-light: #f4f7f9;
            --card-bg: #fff;
            --border-color: #e0e6ed;
            --shadow-light: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-strong: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-color-dark);
            margin: 0;
            padding: 2rem;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem;
            background-color: var(--card-bg);
            border-radius: 15px;
            box-shadow: var(--shadow-strong);
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        .summary-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-color-light);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-light);
            animation: fadeIn 1s ease-in-out;
        }

        .summary-card .count {
            font-size: 3rem;
            font-weight: 600;
            margin: 0.5rem 0 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            animation: slideInUp 1s ease-in-out;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: var(--primary-color);
            color: var(--text-color-light);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tr:hover {
            background-color: #f1f7fc;
        }

        .no-data {
            text-align: center;
            padding: 2rem;
            color: #999;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            .container {
                padding: 1rem;
            }
            .header h1 {
                font-size: 2rem;
            }
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            tr {
                border: 1px solid var(--border-color);
                border-radius: 8px;
                margin-bottom: 1rem;
            }
            td {
                border: none;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 1rem;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: 600;
                color: var(--primary-color);
            }
            .no-data {
                border: none;
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Holiday Work Report</h1>
    </div>

    <div class="summary-card">
        <h3>Total Holiday Works Uploaded</h3>
        <p class="count"><?php echo $total_uploaded; ?></p>
    </div>

    <?php if ($total_uploaded > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>File Name</th>
                    <th>Uploaded At</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="Title"><?php echo htmlspecialchars($row['title']); ?></td>
                        <td data-label="Class"><?php echo htmlspecialchars($row['class_name']); ?></td>
                        <td data-label="Subject"><?php echo htmlspecialchars($row['subject_name']); ?></td>
                        <td data-label="File Name"><?php echo htmlspecialchars($row['file_name']); ?></td>
                        <td data-label="Uploaded At"><?php echo htmlspecialchars($row['uploaded_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No holiday work has been uploaded yet.</p>
    <?php endif; ?>

</div>

</body>
</html>
<?php
// Close the database connection
$conn->close();
?>
