<?php    
require_once 'db.php';

// Fetch entertainment data
$sql = "SELECT * FROM entertainments ORDER BY created_at DESC";
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
  <title>GS ST PHILIPPE NERI - Entertainment</title>
  <meta name="description" content="School Entertainment Activities">
  <meta name="keywords" content="Entertainment, Events, GS St Philippe Neri">

  <!-- Fonts & CSS -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins&family=Raleway&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

<!-- Header -->
<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl d-flex align-items-center">
    <a href="index.php" class="logo d-flex align-items-center me-auto">
      <h1 class="sitename">GS ST PHILIPPE NERI</h1>
    </a>
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="academic.php">Academic</a></li>
        <li><a href="holidays_works.php">Holidaywork</a></li>
        <li><a href="announcement.php">Announcement</a></li>
        <li><a href="news.php">News</a></li>
        <li><a href="entertainment.php" class="active">Entertainment</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>

<!-- Page Title -->
<div class="page-title text-center mt-4">
  <h2>Entertainment Activities</h2>
  <p>Explore the fun, creativity, and talents from our school events</p>
</div>

<!-- Entertainment Section -->
<div class="container my-5">
  <div class="row gy-4">
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100 shadow-sm border-0">
            <?php if (!empty($row['image'])): ?>
              <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" class="card-img-top" alt="Event Image">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
              <p class="card-text"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
              <small class="text-muted">Posted on <?= date('F j, Y', strtotime($row['created_at'])) ?></small>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info text-center">
          No entertainment activities have been posted yet.
        </div>
      </div>
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
     <li><a href="entertainment.php" class=entertainmen>Entertainment</a></li>
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

</body>
</html>
