<?php
// Include your database connection
require 'db.php';

// Sanitize and fetch form data
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
$parent_phone = mysqli_real_escape_string($conn, $_POST['parent_phone']);
$whatsapp = isset($_POST['whatsapp']) ? 'Yes' : 'No';
$province = mysqli_real_escape_string($conn, $_POST['province']);
$district = mysqli_real_escape_string($conn, $_POST['district']);
$sector = mysqli_real_escape_string($conn, $_POST['sector']);
$prev_school = mysqli_real_escape_string($conn, $_POST['prev_school']);
$school_background = mysqli_real_escape_string($conn, $_POST['school_background']);
$sports = mysqli_real_escape_string($conn, $_POST['sports']);
$class = mysqli_real_escape_string($conn, $_POST['class']); // Get class from form
$combination = mysqli_real_escape_string($conn, $_POST['combination']); // Get combination from form
$question1 = mysqli_real_escape_string($conn, $_POST['question1']);
$question2 = mysqli_real_escape_string($conn, $_POST['question2']);
$question3 = mysqli_real_escape_string($conn, $_POST['question3']);
$submitted_at = date('Y-m-d H:i:s');

// Handle file upload
$report_path = '';
if (isset($_FILES['school_report']) && $_FILES['school_report']['error'] === UPLOAD_ERR_OK) {
    $filename = basename($_FILES['school_report']['name']);
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);
    $newfilename = $target_dir . time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);

    if (move_uploaded_file($_FILES['school_report']['tmp_name'], $newfilename)) {
        $report_path = $newfilename;
    } else {
        die("❌ Failed to upload school report.");
    }
} else {
    die("❌ No school report uploaded or upload error.");
}

// Insert into database
$sql = "INSERT INTO learners (
    fullname, gender, birthday, parent_phone, whatsapp, province, district, sector, prev_school, 
    school_background, sports, school_report, question1, question2, question3, submitted_at,
    class, combination
) VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)"; // Add class and combination to the query

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("❌ SQL error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, 'ssssssssssssssssss',  // Add two 's' for class and combination
    $fullname, $gender, $birthday, $parent_phone, $whatsapp, $province, $district, $sector,
    $prev_school, $school_background, $sports, $report_path, $question1, $question2, $question3, $submitted_at,
    $class, $combination
);  // Pass $class and $combination

if (!mysqli_stmt_execute($stmt)) {
    die("❌ Database insert failed: " . mysqli_error($stmt));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

// Show success message
echo "<h2 style='color: green;'>🎉 Application submitted successfully!</h2>";
echo "<p style='font-size: 16px;'>Murakoze kwiyandikisha, tuzabamenyesha ibisubizo vuba.</p>";
?>
