<?php
include 'db.php'; // Your DB connection file

$sql = "SELECT * FROM academics_apdate ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Academic updates</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap and Custom Styles -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

<!-- Header -->
<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl d-flex align-items-center">
    <a href="index.php" class="logo d-flex align-items-center me-auto">
      <h1 class="sitename" style="font-size: 26px;">GS ST PHILIPPE NERI</h1>
    </a>
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="academic1.php" class="active">Academic</a></li>
        <li><a href="holidays_works.php">Holidaywork</a></li>
        <li><a href="announcement.php">Annoucement</a></li>
        
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- Main Academic Section -->
<section class="container my-5">
  <h2 class="text-center mb-4">Academic updates</h2>
  <div class="row g-4">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <?php if (!empty($row['image_data'])): ?>
            <img src="data:<?= htmlspecialchars($row['mime_type']) ?>;base64,<?= $row['image_data'] ?>" class="card-img-top" alt="Academic Image">
          <?php else: ?>
            <img src="default.png" class="card-img-top" alt="No Image Available">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
            <p class="card-text"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
          </div>
          <div class="card-footer bg-white text-muted small">
            Posted on: <?= htmlspecialchars($row['created_at']) ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>

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

      <a class="whatsapp-float" href="https://wa.me/+250788586802?text=Hello%2C%20I%20visited%20your%20website%20and%20I%20would%20like%20to%20chat." target="_blank">
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



