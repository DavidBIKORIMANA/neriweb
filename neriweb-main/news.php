<?php
require_once 'db.php';

// Fetch latest news
$sql = "SELECT * FROM news_updates ORDER BY created_at DESC LIMIT 6";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GS St Philippe Neri | Excellence in Education</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="GS St Philippe Neri – Quality education, discipline and excellence in Rwanda.">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body { font-family: 'Poppins', sans-serif; }

    /* HERO */
    .hero {
      min-height: 100vh;
      background: linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
      url("assets/img/school-bg.jpg") center/cover no-repeat;
      color: #fff;
      display: flex;
      align-items: center;
      text-align: center;
    }

    .hero h1 { font-size: 3.5rem; font-weight: 800; }
    .hero p { font-size: 1.2rem; }

    /* STATS */
    .stat-box {
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,.1);
      text-align: center;
      transition: transform .3s;
    }
    .stat-box:hover { transform: translateY(-8px); }

    /* NEWS */
    .news-card {
      border-radius: 15px;
      overflow: hidden;
      transition: transform .3s;
      box-shadow: 0 8px 20px rgba(0,0,0,.08);
    }
    .news-card:hover { transform: translateY(-10px); }
    .news-card img {
      height: 200px;
      object-fit: cover;
    }

    /* ACADEMICS */
    .combo-card {
      background: #f8f9fa;
      padding: 25px;
      border-radius: 15px;
      text-align: center;
      transition: all .3s;
    }
    .combo-card:hover {
      background: #0d6efd;
      color: #fff;
      transform: translateY(-8px);
    }

    /* WHATSAPP */
    .whatsapp-float {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #25D366;
      color: #fff;
      border-radius: 30px;
      padding: 12px 18px;
      z-index: 1000;
      text-decoration: none;
      box-shadow: 0 6px 15px rgba(0,0,0,.25);
    }

    footer { background: #111; color: #aaa; }
  </style>
</head>

<body>

<!-- HERO -->
<section class="hero">
  <div class="container" data-aos="fade-up">
    <h1>GS ST PHILIPPE NERI</h1>
    <p>Discipline • Knowledge • Excellence</p>
    <div class="mt-4">
      <a href="academic.php" class="btn btn-primary btn-lg me-2">Academics</a>
      <a href="news.php" class="btn btn-outline-light btn-lg">Latest News</a>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-3"><div class="stat-box" data-aos="zoom-in"><h2>1200+</h2><p>Students</p></div></div>
      <div class="col-md-3"><div class="stat-box" data-aos="zoom-in" data-aos-delay="100"><h2>60+</h2><p>Teachers</p></div></div>
      <div class="col-md-3"><div class="stat-box" data-aos="zoom-in" data-aos-delay="200"><h2>20+</h2><p>Years</p></div></div>
      <div class="col-md-3"><div class="stat-box" data-aos="zoom-in" data-aos-delay="300"><h2>100%</h2><p>Success</p></div></div>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="py-5">
  <div class="container text-center" data-aos="fade-up">
    <h2>About Our School</h2>
    <p class="mt-3">
      GS St Philippe Neri is committed to nurturing disciplined, knowledgeable,
      and responsible students prepared for a brighter future.
    </p>
  </div>
</section>

<!-- NEWS -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2>Latest News</h2>
      <p>Stay updated with school activities</p>
    </div>

    <div class="row g-4">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="col-md-4">
            <div class="news-card bg-white h-100">
              <?php if (!empty($row['image_data'])): ?>
                <img src="data:<?= htmlspecialchars($row['mime_type']) ?>;base64,<?= htmlspecialchars($row['image_data']) ?>">
              <?php endif; ?>
              <div class="p-3">
                <h5><?= htmlspecialchars($row['title']) ?></h5>
                <p><?= htmlspecialchars(substr($row['description'], 0, 90)) ?>...</p>
                <a href="news_detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Read More</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center">No news available.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ACADEMICS -->
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2>Academic Combinations</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-3"><div class="combo-card">MCB<br><small>Math • Chem • Bio</small></div></div>
      <div class="col-md-3"><div class="combo-card">PCB<br><small>Physics • Chem • Bio</small></div></div>
      <div class="col-md-3"><div class="combo-card">PCM<br><small>Physics • Chem • Math</small></div></div>
      <div class="col-md-3"><div class="combo-card">MPG<br><small>Math • Physics • Geo</small></div></div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="py-5 bg-primary text-white text-center">
  <div class="container" data-aos="fade-up">
    <h2>Enroll Your Child Today</h2>
    <p>Education that shapes the future</p>
    <a href="contact.php" class="btn btn-light btn-lg">Contact Us</a>
  </div>
</section>

<!-- FOOTER -->
<footer class="py-4 text-center">
  <p>© <?= date('Y') ?> GS St Philippe Neri | Designed by Twizeyimana Eric</p>
</footer>

<!-- WHATSAPP -->
<a class="whatsapp-float" href="https://wa.me/250788586802" target="_blank">
  <i class="fab fa-whatsapp"></i> Chat with us
</a>

<!-- JS -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script>AOS.init({ once:true });</script>

</body>
</html>

<?php $conn->close(); ?>
