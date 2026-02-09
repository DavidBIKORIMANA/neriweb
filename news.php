<?php
require_once 'db.php';

// Fetch the news from the database
$sql = "SELECT * FROM news_updates ORDER BY created_at DESC";

// Execute the query and check for errors
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>GS ST PHILIPPE NERI</title>
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

            <a href="index.php" class="logo d-flex align-items-center me-auto">

                <h1 class="sitename" style="font-size: 26px;">GS ST PHILIPPE NERI</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>

                <li><a href="index.php" class="">Home<br></a></li>
                    
                    
                <li><a href="academic.php" class="academic">Academic</a></li>
                <li><a href="holidays_works.php" class="holidaywork">Holidaywork</a></li>
                <li><a href="announcement.php" class="Annoucement">Annoucement</a></li>
                    <li><a href="news.php" class="news active">News</a></li>
                    <li><a href="entertainment.php" class="news">entertainment</a></li> 
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login2.php" class="Login">Login</a></li>

                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

                </ul>
                
            </nav>

            </div>
    </header>

<body>

    

    <div class="page-title" style="text-align: center;">
        <h1>Latest News</h1>
        <p>Catch up on all the exciting events and developments at GS St Philippe Neri.</p>
    </div>

    <div> 
    <section id="news-updates" class="py-3"> <div class="container">
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-12 col-md-4 news-item mb-3'>";
                        // Check if there is an image and display it
                        if (!empty($row["image_data"])) {
                            echo "<img src='data:" . htmlspecialchars($row["mime_type"]) . ";base64," . htmlspecialchars($row["image_data"]) . "' alt='News Image' class='img-fluid mb-2' />"; 
                        }
                        echo "<p class='fs-8 text-primary'>" . htmlspecialchars($row["title"]) . "</p>";
                        echo "<p class='fs-8 text-muted'>" . htmlspecialchars(substr($row["description"], 0, 50)) . "...</p>"; // Shortened description

                        

                        echo "<p class='date fs-8 text-secondary'><strong>Date:</strong> " . date('F j, Y', strtotime($row["created_at"])) . "</p>";

                        // "Read More" link with custom color
                        echo "<p class='read-more fs-8 text-info'><a href='news_detail.php?id=" . htmlspecialchars($row["id"]) . "' class='text-decoration-none'>Read More</a></p>";

                        echo "</div>";
                    }
                } else {
                    echo "<p class='no-news fs-8 text-center text-muted'>No news updates available at the moment.</p>";
                }
                ?>
            </div>
        </div>
    </section>
</div>

<footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
        <div class="row gy-4">

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

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    
                    <li><a href="holidays_works.php" class="holidaywork">Holidaywork</a></li>
                    <li><a href="announcement.php" class="Annoucement">Annoucement</a></li>
                    <li><a href="news.php" class="news">News</a></li>
            <li><a href="holidays_works.php" class="holidaywork">Holidaywork</a></li>
                    
                </ul>
            </div>

            
            <div class="col-lg-2 col-md-3 footer-links">
            <h4 >Combinations</h4>
                <ul>
                    <li><a href="#">MCB - Mathematics Chemistry Biology</a></li>
                    <li><a href="#">PCB - physics Chemistry Biology</a></li>
                    <li><a href="#"> PCM - physics Chemistry mathematics</a></li>
                    <li><a href="#">MPG - mathematics physics geography</a></li>
                </ul>
            </div>    


            

                <div class="col-lg-2 col-md-3 footer-links">
            <h4 >Olvel</h4>
                <ul>
                    <li><a href="#">senior1</a></li>
                    <li><a href="#">senior2</a></li>
                    <li><a href="#"> senior3</a></li>
                    
                </ul>
            </div>

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

    <div class="text-center mt-4">
        <p>©2025 <span>Copyright</span> <strong class="px-1 sitename">GS St Philippe Neri</strong> <span>All Rights Reserved</span></p>
        <div class="">
            
            Designed by <a href="https://www.instagram.com/eric_phonix_unicon/">Twizeyimana Eric</a>
        </div>
    </div>

</footer>

<?php $conn->close(); ?>

    <div id="preloader"></div>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>