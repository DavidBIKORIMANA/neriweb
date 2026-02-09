<?php 
session_start();
include 'db.php';

// Assign class
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_id = $_POST['teacher_id'];
    $class_ids = $_POST['class_ids']; // Array of selected class IDs

    // Avoid duplicate class assignment for each selected class
    foreach ($class_ids as $class_id) {
        $checkQuery = "SELECT * FROM teacher_classes WHERE teacher_id = ? AND class_id = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("ii", $teacher_id, $class_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Insert new class assignment
            $sql = "INSERT INTO teacher_classes (teacher_id, class_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $teacher_id, $class_id);
            $stmt->execute();
        }
    }

    $message = "Class(es) assigned successfully!";
}

// Fetch all teachers
$teachers = $conn->query("SELECT id, username FROM user WHERE role = 'teacher'");

// Fetch all classes (assuming you have a table for classes, adjust this if needed)
$classes = $conn->query("SELECT id, class_name FROM classes");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Class to Teacher</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional -->
</head>
<body>
    <h2>Assign Class to Teacher</h2>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>

    <form method="POST" action="assign_class.php">
        <label>Choose Teacher:</label>
        <select name="teacher_id" required>
            <option value="">-- Select --</option>
            <?php while ($row = $teachers->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['username']) ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Select Classes:</label><br>
        <?php while ($row = $classes->fetch_assoc()): ?>
            <input type="checkbox" name="class_ids[]" value="<?= $row['id'] ?>"> <?= htmlspecialchars($row['class_name']) ?><br>
        <?php endwhile; ?>
        <br>

        <button type="submit">Assign</button>
    </form>
</body>
</html>
