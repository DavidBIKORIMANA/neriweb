<?php 
session_start();
include 'db.php';

// Assign multiple classes to teacher
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_id = $_POST['teacher_id'];
    $class_ids = $_POST['class_ids'] ?? [];

    if (empty($class_ids)) {
        $message = "Please select at least one class.";
    } else {
        $success_count = 0;
        $duplicate_count = 0;

        // Loop through each selected class
        foreach ($class_ids as $class_id) {
            // Check if the teacher is already assigned to the class
            $check = $conn->prepare("SELECT * FROM teacher_classes WHERE teacher_id = ? AND class_id = ?");
            $check->bind_param("ii", $teacher_id, $class_id);
            $check->execute();
            $result = $check->get_result();

            // If not assigned, insert the new class assignment
            if ($result->num_rows === 0) {
                $stmt = $conn->prepare("INSERT INTO teacher_classes (teacher_id, class_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $teacher_id, $class_id);
                $stmt->execute();
                $success_count++;
            } else {
                $duplicate_count++;
            }
        }

        // Set the message based on result of the assignment process
        if ($success_count > 0) {
            $message = "$success_count class(es) assigned successfully.";
        }
        if ($duplicate_count > 0) {
            $message .= " $duplicate_count duplicate(s) skipped.";
        }
    }
}

// Fetch teachers for selection
$teachers = $conn->query("SELECT id, username FROM user WHERE role = 'teacher'");

// Fetch all available classes
$classes = $conn->query("SELECT id, class_name FROM classes ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Multiple Classes to a Teacher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
        }
        h2 {
            color: #333;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 12px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .message {
            background: #e0f7e9;
            color: #2a6d4d;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h2>Assign Multiple Classes to a Teacher</h2>

<?php if (isset($message)): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="POST" action="assign_class.php">
    <label>Choose Teacher:</label>
    <select name="teacher_id" required>
        <option value="">-- Select Teacher --</option>
        <?php while ($row = $teachers->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['username']) ?></option>
        <?php endwhile; ?>
    </select>

    <label>Choose Class(es):</label>
    <select name="class_ids[]" multiple size="10" required>
        <?php while ($row = $classes->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['class_name']) ?></option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Assign Classes</button>
</form>

</body>
</html>
