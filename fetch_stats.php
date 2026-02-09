<?php 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow access from any origin

// Database connection settings
$host = 'localhost';
$dbname = 'philippeneri';
$username = 'root';
$password = '';

try {
    // Establish PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch user role counts
    $adminCount = $pdo->query("SELECT COUNT(*) FROM user WHERE role = 'admin'")->fetchColumn();
    $teacherCount = $pdo->query("SELECT COUNT(*) FROM user WHERE role = 'teacher'")->fetchColumn();

    // Fetch content type counts
    $newsCount = $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn();
    $announcementCount = $pdo->query("SELECT COUNT(*) FROM academic_announcements")->fetchColumn();
    $holidayCount = $pdo->query("SELECT COUNT(*) FROM holidays")->fetchColumn();

    // Return JSON data
    echo json_encode([
        'adminCount' => (int) $adminCount,
        'teacherCount' => (int) $teacherCount,
        'newsCount' => (int) $newsCount,
        'announcementCount' => (int) $announcementCount,
        'holidayCount' => (int) $holidayCount
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'error' => 'Database Error: ' . $e->getMessage()
    ]);
}
?>
