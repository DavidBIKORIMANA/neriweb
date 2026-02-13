<?php
// Include your database connection
require 'db.php';

// Set timezone to Rwanda
date_default_timezone_set('Africa/Kigali');

// Sanitize and fetch form data - Using null coalescing operator (??) to prevent Undefined Key warnings
$fullname = mysqli_real_escape_string($conn, $_POST['fullname'] ?? '');

// Split fullname into first and last name for the database columns
$name_parts = explode(' ', trim($fullname), 2);
$first_name = $name_parts[0] ?? '';
$last_name = $name_parts[1] ?? '';

// Mapping other form fields to match the database columns shown in phpMyAdmin
$email = mysqli_real_escape_string($conn, $_POST['email'] ?? ''); // Map to 'email' column
$parent_phone = mysqli_real_escape_string($conn, $_POST['parent_phone'] ?? ''); // Map to 'phone' column
$applied_class = mysqli_real_escape_string($conn, $_POST['class'] ?? ''); // Map to 'applied_class' column

// Other fields (Note: If these aren't in your 'learners' table, you'll need to add them via SQL)
$gender = mysqli_real_escape_string($conn, $_POST['gender'] ?? '');
$birthday = mysqli_real_escape_string($conn, $_POST['birthday'] ?? '');
$whatsapp = isset($_POST['whatsapp']) ? 'Yes' : 'No';
$province = mysqli_real_escape_string($conn, $_POST['province'] ?? '');
$district = mysqli_real_escape_string($conn, $_POST['district'] ?? '');
$sector = mysqli_real_escape_string($conn, $_POST['sector'] ?? '');
$prev_school = mysqli_real_escape_string($conn, $_POST['prev_school'] ?? '');
$school_background = mysqli_real_escape_string($conn, $_POST['school_background'] ?? '');
$sports = mysqli_real_escape_string($conn, $_POST['sports'] ?? '');
$combination = mysqli_real_escape_string($conn, $_POST['combination'] ?? '');
$question1 = mysqli_real_escape_string($conn, $_POST['question1'] ?? '');
$question2 = mysqli_real_escape_string($conn, $_POST['question2'] ?? '');
$question3 = mysqli_real_escape_string($conn, $_POST['question3'] ?? '');
$submitted_at = date('Y-m-d H:i:s');

// Handle file upload
$report_path = '';
if (isset($_FILES['school_report']) && $_FILES['school_report']['error'] === UPLOAD_ERR_OK) {
    $filename = basename($_FILES['school_report']['name']);
    $target_dir = "uploads/";
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    
    $newfilename = $target_dir . time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);

    if (move_uploaded_file($_FILES['school_report']['tmp_name'], $newfilename)) {
        $report_path = $newfilename;
    } else {
        die("❌ Failed to upload school report.");
    }
} else {
    die("❌ No school report uploaded or upload error.");
}

/**
 * DATABASE INSERTION
 * UPDATED: Using column names from your phpMyAdmin screenshot:
 * first_name, last_name, email, phone, applied_class, submitted_at
 */
$sql = "INSERT INTO learners (
    first_name, 
    last_name, 
    email, 
    phone, 
    applied_class, 
    submitted_at
) VALUES (
    ?, ?, ?, ?, ?, ?
)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("❌ SQL error: " . mysqli_error($conn) . " | Verify that the table structure contains these specific columns.");
}

// Bind 6 parameters to match your current visible database structure
mysqli_stmt_bind_param($stmt, 'ssssss', 
    $first_name, 
    $last_name, 
    $email, 
    $parent_phone, 
    $applied_class, 
    $submitted_at
);

if (!mysqli_stmt_execute($stmt)) {
    die("❌ Database insert failed: " . mysqli_error($stmt));
}

// Close resources
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Show success message
echo "
<div style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; text-align: center; margin-top: 50px; padding: 20px;'>
    <div style='max-width: 500px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 10px; padding: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
        <h2 style='color: #28a745;'>🎉 Application submitted successfully!</h2>
        <p style='font-size: 16px; color: #555;'>Murakoze kwiyandikisha, tuzabamenyesha ibisubizo vuba.</p>
        <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
        <a href='index.php' style='display: inline-block; background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Return to Homepage</a>
    </div>
</div>";
?>