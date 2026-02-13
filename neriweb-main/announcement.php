<?php
require_once 'db.php';

// Fetch the announcements from the database
$sql = "SELECT * FROM announcements ORDER BY uploaded_at DESC";

// Execute the query and check for errors
$result = $conn->query($sql);

if ($result === false) {
die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Announcements</title>
<meta name="description" content="">
<meta name="keywords" content="">

<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/aos/aos.css" rel="stylesheet">
<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

<link href="assets/css/main.css" rel="stylesheet">


</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.php" class="logo d-flex align-items-center me-auto">
            <h1 class="sitename" style="font-size: 26px;">GS ST PHILIPPE NERI</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php">Home<br></a></li>
                <li><a href="academic.php" class="academic">Academic</a></li>
                <li><a href="holidays_works.php" class="holidaywork">Holidaywork</a></li>
                <li><a href="announcement.php" class="Announcement active">Announcement</a></li>
                <li><a href="news.php" class="news">News</a></li>
                <li><a href="entertainment.php" class="entertainment">Entertainment</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login2.php" class="Login">Login</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>

<div class="page-title py-5" style="text-align: center;">
    <h1>School Announcements</h1>
    <p>Stay up-to-date with all the latest school announcements.</p>
</div>

<section id="announcements" class="py-5">
    <div class="container">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-12 col-md-4 news-item mb-4'>";
                    echo "<div style='
                        background-color: #f9f9f9;
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        padding: 20px;
                        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                        height: 100%;
                    '>";
                    echo "<h5 class='text-primary'>" . htmlspecialchars($row["title"]) . "</h5>";
                    echo "<p class='text-muted'>" . htmlspecialchars($row["description"]) . "</p>";

                    // Display the download link if a file is attached
                    if (!empty($row["file_path"])) {
                        echo "<p class='mt-2'><a href='" . htmlspecialchars($row["file_path"]) . "' download class='text-decoration-none' style='color: #5fcf80;'>📎 Download Attachment</a></p>";
                    }
                    echo "<p class='date text-secondary mt-auto'><strong>Posted:</strong> " . date('F j, Y - H:i', strtotime($row["uploaded_at"])) . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div class='col-12 text-center'><p class='text-muted'>No announcements available at the moment. Stay tuned for updates!</p></div>";
            }
            ?>
        </div>
    </div>
</section>

<?php $conn->close(); ?>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>