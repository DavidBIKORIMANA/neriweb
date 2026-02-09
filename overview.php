<?php
// DB Connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "philippeneri";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("DB Connection Failed: " . $conn->connect_error);

// Fetch overview content
$overview = $conn->query("SELECT * FROM overview ORDER BY created_at ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Overview - GS St Philippe Neri</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins&family=Raleway&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="overview-page">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <h1 class="sitename">GS St Philippe Neri</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="overview.php" class="active">Overview</a></li>
          <li><a href="academic.php">Academic</a></li>
          <li><a href="holidays_works.php">Holidaywork</a></li>
          <li><a href="announcement.php">Announcement</a></li>
          <li><a href="news.php">News</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main id="main">

    <!-- ===== Page Title ===== -->
    <div class="page-title" data-aos="fade">
      <div class="container text-center">
        <h1>Overview</h1>
        <p>Learn about our school's history and legacy at GS St Philippe Neri.</p>
      </div>
    </div>

    <!-- ===== Overview Sections ===== -->
    <section class="overview section">
      <div class="container" data-aos="fade-up">
        <?php if($overview->num_rows > 0): ?>
          <?php while($row = $overview->fetch_assoc()): ?>
            <div class="row align-items-center mb-5">
              <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
              </div>
              <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <?php if($row['image'] && file_exists('uploads/'.$row['image'])): ?>
                  <img src="uploads/<?php echo $row['image']; ?>" class="img-fluid rounded shadow-sm" alt="<?php echo htmlspecialchars($row['title']); ?>">
                <?php endif; ?>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center">No overview content available yet.</p>
        <?php endif; ?>
      </div>
    </section>

  </main>

 <!-- Bootstrap JS (optional for interactivity) -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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
          <p class="mt-3"><strong>Phone:</strong> <span>+250 788586802</span></p>
          <p><strong>Email:</strong> <span>philippenerigisagara@gmail.com</span></p>
        </div>
        <div class="social-links d-flex mt-4">

         
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          
          <li><a href="holidays_works.php" class="holidaywork">Holidaywork</a></li>
          <li><a href="announcement.php" class="Annoucement">Annoucement</a></li>
          <li><a href="news.php" class="news">News</a></li>
                <li><a href="news.php" class="news">News</a></li>
     <li><a href="entertainment.php" class="entertainment">entertainment</a></li>
     <li><a href="login2.php" class="Login">Login</a></li>
          
        </ul>
      </div>

      
      <!-- combinations --> 
       <div class="col-lg-2 col-md-3 footer-links">
      <h4 >Combinations</h4>
        <ul>
          <li><a href="#">MCB - Mathematics Chemistry Biology</a></li>
          <li><a href="#">PCB - physics Chemistry Biology</a></li>
          <li><a href="#"> PCM - physics Chemistry mathematics</a></li>
          <li><a href="#">MPG - mathematics physics geography</a></li>
        </ul>
      </div>   


      

       <!-- olvel -->
        <div class="col-lg-2 col-md-3 footer-links">
      <h4 >Olvel</h4>
        <ul>
          <li><a href="#">senior1</a></li>
          <li><a href="#">senior2</a></li>
          <li><a href="#"> senior3</a></li>
          
        </ul>
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




  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>
