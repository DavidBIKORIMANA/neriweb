<?php
require_once 'db.php';

// Get the ID of the news from the URL
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    // Fetch the full news details
    $sql = "SELECT * FROM news_updates WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $news_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $news = $result->fetch_assoc();
    } else {
        die("News article not found.");
    }
} else {
    die("Invalid request.");
}

?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>GS ST PHILIPPE NERI</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon"> -->
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">


      <a href="index.php" class="logo d-flex align-items-center me-auto">

      <a href="index.php" class="logo d-flex align-items-center me-auto">

        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename" style="font-size: 26px;">GS ST PHILIPPE NERI</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>

        <li><a href="index.php" class="active">Home<br></a></li>
         
          
        <li><a href="academic.php" class="academic">Academic</a></li>
        <li><a href="holidays_works.php" class="holidaywork">Holidaywork</a></li>
        <li><a href="announcement.php" class="Annoucement">Annoucement</a></li>
         <li><a href="news.php" class="news">News</a></li> 
          <li><a href="contact.php">Contact</a></li>

          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

        </ul>
       
      </nav>

      <!-- <a class="btn-getstarted" href="courses.html">Get Started</a> -->

    </div>
  </header>

    <div class="news-detail-container py-4"> <!-- Added padding around the container -->
    <div class="news-detail bg-light p-4 rounded shadow-sm"> <!-- Light background, padding, and rounded corners -->
        <h2 class="fs-4 text-primary"><?php echo htmlspecialchars($news["title"]); ?></h2> <!-- Smaller font for title with primary color -->
        <p class="date fs-6 text-muted"><strong>Date:</strong> <?php echo date('F j, Y', strtotime($news["created_at"])); ?></p> <!-- Smaller font for date with muted color -->
        <div class="content fs-6 text-dark">
            <?php echo nl2br(htmlspecialchars($news["description"])); ?>
        </div>
        
        <?php if (!empty($news["image_data"])): ?>
            <img src="data:<?php echo htmlspecialchars($news["mime_type"]); ?>;base64,<?php echo htmlspecialchars($news["image_data"]); ?>"
                alt="News Image" class="img-fluid mt-3 rounded"> <!-- Image with margin-top and rounded corners -->
        <?php endif; ?>
    </div>
</div>


    <footer id="footer" class="footer position-relative light-background">

      <div class="container footer-top">
        <div class="row gy-4">

          <!-- About Section -->
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.php" class="logo d-flex align-items-center">
              <span class="sitename">GS St Philippe Neri</span>
            </a>
            <div class="footer-contact pt-3">
              <p>GISAGARA District</p>
              <p>NDORA Sector</p>
              <p class="mt-3"><strong>Phone:</strong> <span>+250 788 123 456</span></p>
              <p><strong>Email:</strong> <span>philippenerigisagara@gmail.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href="#"><i class="bi bi-twitter-x"></i></a>
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-instagram"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <!-- Quick Links -->
          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="index.php" class="active">Home</a></li>
              <li><a href="academic.php" class="academic">Academic</a></li>
              <li><a href="holidays_works.php" class="holidaywork">Holidaywork</a></li>
              <li><a href="announcement.php" class="Annoucement">Annoucement</a></li>
              <li><a href="news.php" class="news">News</a></li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </div>

          <!-- Courses -->
          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Courses</h4>
            <ul>
              <li><a href="#">Mathematics</a></li>
              <li><a href="#">Entrepreneurship</a></li>
              <li><a href="#">Chemistry</a></li>
              <li><a href="#">Biology</a></li>
              <li><a href="#">Physics</a></li>
              <li><a href="#">Geography</a></li>
              <li><a href="#">Entrepreneurship</a></li>
              <li><a href="#">English</a></li>
            </ul>
          </div>

          <!-- Newsletter -->
          <div class="col-lg-4 col-md-12 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Stay updated with our latest courses, events, and career tips!</p>
            <form action="forms/newsletter.php" method="post" class="php-email-form">
              <div class="newsletter-form">
                <input type="email" name="email" placeholder="Your Email">
                <input type="submit" value="Subscribe">
              </div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>

          <!-- WhatsApp Floating Button -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
          <style>
            .whatsapp-float {
              position: fixed;
              bottom: 20px;
              right: 20px;
              background-color: #25D366;
              color: white;
              border-radius: 30px;
              height: 45px;
              padding: 0 15px;
              display: flex;
              align-items: center;
              text-decoration: none;
              box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
              z-index: 1000;
              overflow: hidden;
              transition: width 0.3s ease, background 0.3s ease;
              width: 45px;
            }

            .whatsapp-float i {
              font-size: 20px;
              transition: margin-right 0.3s ease;
            }

            .whatsapp-float span {
              white-space: nowrap;
              margin-left: 10px;
              opacity: 0;
              transition: opacity 0.3s ease;
            }

            .whatsapp-float:hover {
              width: 140px;
              background-color: #1ebe5d;
            }

            .whatsapp-float:hover span {
              opacity: 1;
            }
          </style>

          <a class="whatsapp-float" href="https://wa.me/+25788586802?text=Hello%2C%20I%20visited%20your%20website%20and%20I%20would%20like%20to%20chat." target="_blank">
            <i class="fab fa-whatsapp"></i>
            <span>Chat with us</span>
          </a>

        </div>
      </div>

      <!-- Footer Copyright -->
      <div class="text-center mt-4">
        <p>©2025 <span>Copyright</span> <strong class="px-1 sitename">GS St Philippe Neri</strong> <span>All Rights Reserved</span></p>
        <div class="">
          
          Designed by <a href="https://www.instagram.com/eric_phonix_unicon/">Twizeyimana Eric</a>
        </div>
      </div>

    </footer>

</body>

</html>