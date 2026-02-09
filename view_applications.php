<?php
// Include DB connection
require 'db.php';

// Fetch all learner applications
$sql = "SELECT * FROM learners ORDER BY submitted_at DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Applications - GS ST Philippe Neri</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #c5cae9);
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            color: #283593;
            margin-bottom: 30px;
            font-size: 2.5em;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .application-list {
            width: 90%;
            max-width: 1200px;
        }

        .application-item {
            background: #fff;
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            transition: transform 0.2s ease-in-out;
        }

        .application-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .app-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .app-details div {
            padding: 15px;
            background-color: #f8f8f8;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .app-details strong {
            font-weight: 600;
            color: #1a237e;
            display: block;
            margin-bottom: 5px;
        }

        .report-container {
            margin-bottom: 25px;
            border: 1px solid #d4d4d4;
            border-radius: 8px;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .report-container strong {
            font-weight: 600;
            color: #1a237e;
            display: block;
            margin-bottom: 10px;
        }

        .report-preview {
            width: 100%;
            height: 350px;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .view-link {
            color: #1976d2;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        .view-link:hover {
            text-decoration: underline;
            color: #0d47a1;
        }

        .no-report {
            color: #777;
            font-style: italic;
        }

        /* Subtle animation for list items */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .application-item {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
            transform: translateY(10px);
        }

        /* Stagger the animation */
        .application-item:nth-child(odd) {
            animation-delay: 0.1s;
        }

        .application-item:nth-child(even) {
            animation-delay: 0.2s;
        }

        .question-answer {
            margin-top: 10px;
            margin-bottom: 15px;
            border-left: 3px solid #1976d2;
            padding-left: 10px;
            white-space: pre-line;
            border-radius: 4px;
            background-color: #f3f6fb;
        }

        .submitted-at {
            font-size: 0.9em;
            color: #555;
            margin-top: 15px;
            text-align: right;
            font-style: italic;
        }

    </style>
</head>
<body>

    <h2>All Applications - GS ST Philippe Neri</h2>

    <div class="application-list">
        <?php
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="application-item">';
            echo '<h3>Application #' . $count++ . ' - ' . htmlspecialchars($row['fullname']) . '</h3>';
            echo '<div class="app-details">';
            echo '<div><strong>Full Name:</strong> ' . htmlspecialchars($row['fullname']) . '</div>';
            echo '<div><strong>Gender:</strong> ' . htmlspecialchars($row['gender']) . '</div>';
            echo '<div><strong>Birthday:</strong> ' . htmlspecialchars($row['birthday']) . '</div>';
            echo '<div><strong>Parent\'s Phone:</strong> ' . htmlspecialchars($row['parent_phone']) . ' ' . (htmlspecialchars($row['whatsapp']) == 1 ? '(WhatsApp)' : '') . '</div>';
            echo '<div><strong>Province:</strong> ' . htmlspecialchars($row['province']) . '</div>';
            echo '<div><strong>District:</strong> ' . htmlspecialchars($row['district']) . '</div>';
            echo '<div><strong>Sector:</strong> ' . htmlspecialchars($row['sector']) . '</div>';
            echo '<div><strong>Previous School:</strong> ' . htmlspecialchars($row['prev_school']) . '</div>';
            echo '<div><strong>Sports:</strong> ' . htmlspecialchars($row['sports']) . '</div>';
            echo '<div><strong>Class:</strong> ' . htmlspecialchars($row['class']) . '</div>';
            echo '<div><strong>Combination:</strong> ' . htmlspecialchars($row['combination']) . '</div>';
            echo '</div>';

            echo '<div class="report-container">';
            echo '<strong>School Report:</strong> ';
            $report_path = htmlspecialchars($row['school_report']);
            $file_extension = pathinfo($report_path, PATHINFO_EXTENSION);

            if (!empty($report_path)) {
                if (strtolower($file_extension) === 'pdf') {
                    echo '<iframe src="' . $report_path . '" class="report-preview"></iframe>';
                } else {
                    echo '<a href="' . $report_path . '" target="_blank" class="view-link">View File</a> (.' . $file_extension . ')';
                }
            } else {
                echo '<span class="no-report">No report uploaded.</span>';
            }
            echo '</div>';

            echo '<div><strong>Critical Thinking Questions:</strong></div>';
            echo '<div><strong>1. If you are given 10,000 RWF to help your community, what would you do and why?:</strong><div class="question-answer">' . nl2br(htmlspecialchars($row['question1'])) . '</div></div>';
            echo '<div><strong>2. Imagine your class has no teacher for one week. How would you help your classmates learn?:</strong><div class="question-answer">' . nl2br(htmlspecialchars($row['question2'])) . '</div></div>';
            echo '<div><strong>3. You see a friend cheating during a test. What do you do and why?:</strong><div class="question-answer">' . nl2br(htmlspecialchars($row['question3'])) . '</div></div>';

            echo '<p class="submitted-at">Submitted at: ' . htmlspecialchars($row['submitted_at']) . '</p>';
            echo '</div>';
        }
        ?>
    </div>

</body>
</html>

<?php
mysqli_close($conn);
?>