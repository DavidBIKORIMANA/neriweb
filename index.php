<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>GS ST PHILIPPE NERI</title>
  <meta name="description" content="Official website for GS ST PHILIPPE NERI, offering comprehensive secondary education and digital solutions for O'Level and A'Level programs.">
  <meta name="keywords" content="GS ST PHILIPPE NERI, school, education, Rwanda, O'Level, A'Level, MCB, MPG, PCB, PCM, secondary school, digital solutions">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon"> -->
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-icon"> -->

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- Custom Styles for Enhanced Design -->
  <style>
    /* General Body and Typography */
    body {
      font-family: 'Open Sans', sans-serif;
      color: #444444;
      background-color: #f8f9fa; /* Light background for overall page */
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: 'Poppins', sans-serif;
      color: #333333;
    }

    p {
      font-family: 'Open Sans', sans-serif;
      line-height: 1.6;
    }

    .section-title h2 {
      font-size: 3rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 10px;
      position: relative;
    }

    .section-title h2::after {
      content: '';
      position: absolute;
      display: block;
      width: 60px;
      height: 3px;
      background: #ff6600;
      bottom: -5px;
      left: 50%;
      transform: translateX(-50%);
    }

    .section-title p {
      font-size: 1.2rem;
      color: #666;
      margin-bottom: 50px;
    }

    /* Header Enhancements */
    .header {
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      padding: 15px 0;
      transition: all 0.3s ease-in-out;
    }

    .header .container-xl {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .school-icon-main {
      height: 70px; /* Slightly larger for prominence */
      width: 70px;
      border-radius: 50%;
      border: 4px solid #ff6600; /* Prominent accent border */
      object-fit: cover;
      object-position: center;
      margin-right: 15px;
      flex-shrink: 0;
      transition: transform 0.3s ease;
    }

    .school-icon-main:hover {
      transform: rotate(5deg) scale(1.05); /* Subtle hover effect */
    }

    .sitename {
      font-family: 'Raleway', sans-serif;
      font-size: 28px; /* Slightly larger sitename */
      font-weight: 700;
      color: #333;
      white-space: nowrap;
      margin: 0;
      transition: color 0.3s ease;
    }

    .logo:hover .sitename {
      color: #ff6600; /* Accent color on hover */
    }

    .hero-image-right-large {
      height: 70px;
      width: 70px;
      border-radius: 12px; /* More rounded */
      object-fit: cover;
      object-position: center;
      flex-shrink: 0;
      margin-left: 15px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .hero-image-right-large:hover {
      transform: scale(1.05);
    }

    /* Navigation Hover Effect and Spacing */
    .navmenu ul li a {
      position: relative;
      font-weight: 600;
      padding: 10px 18px; /* Added horizontal padding for spacing */
      text-decoration: none; /* Ensure no default underline */
      display: inline-block; /* Essential for background-size to work */
      overflow: hidden; /* Crucial for background sliding effect */
      border-radius: 5px; /* Subtle rounded corners for the background slide */
      
      /* Default state for links without specific image */
      background-image: linear-gradient(to right, #ff6600 50%, transparent 50%);
      background-size: 200% 100%;
      background-position: 100% 0; /* Start with transparent half visible */
      color: #555; /* Default text color */
      transition: background-position 0.4s ease-out, color 0.3s ease, transform 0.2s ease;
    }

    /* Specific image for 'Home' link */
    .navmenu ul li .home-link.sliding-bg {
        background-image: linear-gradient(to right, #ff6600 50%, url('assets/img/whatsapp1.jpg') 50%);
        background-repeat: no-repeat;
        background-size: 200% 100%; /* Ensure proper scaling for the image part */
        background-position: 100% 0;
        transition: background-position 0.4s ease-out, color 0.3s ease, transform 0.2s ease;
    }

    /* Specific image for 'Academic' link */
    .navmenu ul li .academic-link.sliding-bg {
        background-image: linear-gradient(to right, #ff6600 50%, url('assets/img/whatsapp2.jpg') 50%);
        background-repeat: no-repeat;
        background-size: 200% 100%; /* Ensure proper scaling for the image part */
        background-position: 100% 0;
        transition: background-position 0.4s ease-out, color 0.3s ease, transform 0.2s ease;
    }

    /* Hover and Active state for all links with sliding background */
    .navmenu ul li a:hover,
    .navmenu ul li a.active {
        color: #fff; /* Text becomes white on orange/image background */
        background-position: 0 0; /* Slide the left half (orange or image) into view */
        transform: translateY(-2px); /* Slight lift on hover */
    }

    /* Underline effect (kept for consistency with previous request) */
    .navmenu ul li a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 3px; /* Thicker underline */
      bottom: -8px; /* More space below text */
      left: 0;
      background-color: #ff6600;
      transition: width 0.3s ease;
    }

    .navmenu ul li a:hover::after,
    .navmenu ul li .active::after {
      width: 100%;
    }

    @media (max-width: 991px) {
      .navmenu {
        display: none;
      }
      .school-icon-main,
      .hero-image-right-large {
        height: 55px;
        width: 55px;
      }
      .sitename {
        font-size: 22px;
      }
    }
    @media (max-width: 576px) {
      .school-icon-main,
      .hero-image-right-large {
        height: 40px;
        width: 40px;
      }
      .sitename {
        font-size: 18px;
      }
    }


    /* Hero Section Enhancements */
    .hero {
      position: relative;
      overflow: hidden;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      background-color: #000;
    }

    .swiper-container {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 1;
    }

    .swiper-slide {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .swiper-slide img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: contain; /* Changed to contain for full image visibility */
      object-position: center;
      display: block;
    }

    .swiper-slide::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8)); /* Darker gradient overlay */
      z-index: 1;
    }

    .hero-text {
      position: relative;
      z-index: 2;
      text-align: center;
      padding: 2rem;
      max-width: 900px; /* Wider text area */
      margin: 0 auto;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7); /* Text shadow for pop */
    }

    .hero-text h2 {
      font-family: 'Raleway', sans-serif;
      font-size: 4.5rem; /* Larger hero title */
      font-weight: 800;
      line-height: 1.1;
      margin-bottom: 20px;
      color: #fff;
      animation: fadeInText 1.5s ease-out forwards;
    }

    .hero-text p {
      font-size: 1.5rem; /* Larger hero paragraph */
      line-height: 1.6;
      margin-bottom: 40px;
      color: rgba(255, 255, 255, 0.9);
      animation: fadeInText 1.5s ease-out forwards;
    }

    @keyframes fadeInText {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .btn-get-started {
      background: linear-gradient(45deg, #ff6600, #ff9933); /* Gradient button */
      color: #fff;
      padding: 15px 35px; /* Larger padding */
      border-radius: 30px; /* Pill shape */
      text-decoration: none;
      font-weight: 700;
      font-size: 1.1rem;
      transition: all 0.3s ease-in-out;
      display: inline-block;
      box-shadow: 0 6px 15px rgba(255, 102, 0, 0.4); /* Prominent shadow */
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .btn-get-started:hover {
      background: linear-gradient(45deg, #e65c00, #ff8000);
      transform: translateY(-5px) scale(1.02); /* More pronounced lift */
      box-shadow: 0 10px 25px rgba(255, 102, 0, 0.6);
    }

    .swiper-button-next,
    .swiper-button-prev {
      color: #fff !important;
      font-size: 2.5rem !important; /* Larger arrows */
      opacity: 0.8;
      transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
      opacity: 1;
      transform: scale(1.1);
    }

    .swiper-pagination-bullet {
      background-color: rgba(255, 255, 255, 0.6) !important;
      opacity: 0.8;
      transition: all 0.3s ease;
    }

    .swiper-pagination-bullet-active {
      background-color: #ff6600 !important;
      opacity: 1;
      transform: scale(1.2);
    }

    /* About Section Enhancements (Now with Parallax Background) */
    .about.section {
      padding: 80px 0;
      /* Removed previous background to allow for dedicated image in HTML */
      background-color: #f8f9fa; /* Light background for the section */
      position: relative;
    }
    .about .container {
      position: relative;
      z-index: 2; /* Ensure content is above the background */
    }
    .about .content {
      background-color: rgba(255, 255, 255, 0.95); /* Semi-transparent white background for readability */
      padding: 40px; /* Increased padding */
      border-radius: 15px; /* More rounded */
      box-shadow: 0 10px 30px rgba(0,0,0,0.15); /* Stronger shadow */
      margin: 20px auto; /* Add vertical margin and auto horizontal for centering */
      display: flex; /* Use flexbox to center content vertically if needed */
      flex-direction: column;
      justify-content: center;
      min-height: 350px; /* Ensure a decent height for the content box */
    }
    .about h3 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 20px;
    }
    .about p {
      font-size: 1.1rem;
      color: #666;
    }
    .about ul {
      list-style: none;
      padding: 0;
      margin-top: 20px;
    }
    .about ul li {
      padding: 8px 0;
      display: flex;
      align-items: flex-start;
    }
    .about ul i {
      font-size: 1.5rem;
      color: #ff6600;
      margin-right: 10px;
      flex-shrink: 0;
      margin-top: 4px;
    }
    .about .read-more {
      display: inline-flex;
      align-items: center;
      margin-top: 30px;
      color: #ff6600;
      font-weight: 600;
      transition: all 0.3s ease;
      text-decoration: none;
      font-size: 1.1rem;
    }
    .about .read-more:hover {
      color: #e65c00;
      letter-spacing: 1px;
    }
    .about .read-more i {
      margin-left: 8px;
      transition: margin-left 0.3s ease;
    }
    .about .read-more:hover i {
      margin-left: 15px;
    }

    /* Counts Section Enhancements */
    .counts.section {
      /* Removed background image as per user request */
      background-color: #3498db; /* A solid blue background for the section */
      padding: 100px 0; /* More vertical space */
      color: #fff;
    }
    .counts .stats-item {
      background: rgba(255, 255, 255, 0.1); /* Subtle transparent background */
      border-radius: 15px; /* More rounded */
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Deeper shadow */
      transition: all 0.3s ease;
    }
    .counts .stats-item:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
    }
    .counts .stats-item span {
      font-size: 4rem; /* Larger numbers */
      font-weight: 800;
      color: #ff6600; /* Accent color */
      display: block;
      margin-bottom: 5px;
    }
    .counts .stats-item p {
      font-size: 1.4rem; /* Larger text */
      font-weight: 600;
      color: rgba(255, 255, 255, 0.9);
    }

    /* Why Us Section Enhancements */
    .why-us.section {
      padding: 80px 0;
      background-color: #f0f8ff; /* Light blue background */
    }
    .why-box {
      background-color: #ff6600;
      color: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(255, 102, 0, 0.3);
      height: 100%; /* Ensure consistent height */
      display: flex;
      flex-direction: column;
      justify-content: center;
      transition: all 0.4s ease;
    }
    .why-box:hover {
      transform: translateY(-8px) scale(1.01);
      box-shadow: 0 15px 40px rgba(255, 102, 0, 0.5);
    }
    .why-box h3 {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 20px;
      color: #fff;
    }
    .why-box p {
      font-size: 1.1rem;
      line-height: 1.7;
      color: rgba(255, 255, 255, 0.9);
      margin-bottom: 30px;
    }
    .why-box .more-btn {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
      padding: 10px 25px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      border: 2px solid rgba(255, 255, 255, 0.5);
    }
    .why-box .more-btn:hover {
      background-color: rgba(255, 255, 255, 0.3);
      border-color: #fff;
    }
    .icon-box {
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease-in-out;
      height: 100%;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .icon-box:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      border-color: #ff6600;
    }
    .icon-box i {
      font-size: 3.5rem; /* Larger icons */
      color: #ff6600;
      margin-bottom: 20px;
      transition: transform 0.3s ease;
    }
    .icon-box:hover i {
      transform: scale(1.1);
    }
    .icon-box h4 {
      font-size: 1.6rem;
      font-weight: 700;
      margin-bottom: 15px;
      color: #333;
    }
    .icon-box p {
      font-size: 1rem;
      color: #666;
    }

    /* Features Section Enhancements */
    .features.section {
      padding: 80px 0;
      background-color: #f8f9fa; /* Light grey background */
    }
    .features-item {
        background: #ffffff;
        padding: 35px; /* More padding */
        border-radius: 15px; /* More rounded */
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08); /* Deeper, softer shadow */
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); /* Smoother bezier curve transition */
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        border: 2px solid transparent; /* Border for hover effect */
    }

    .features-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 0%;
      background: linear-gradient(to bottom right, #ff6600, #ff9933); /* Gradient background on hover */
      opacity: 0;
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      z-index: 0;
    }

    .features-item:hover::before {
      height: 100%;
      opacity: 1;
    }

    .features-item:hover {
        transform: translateY(-10px) scale(1.03); /* More pronounced lift and scale */
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2); /* Even deeper shadow on hover */
        border-color: #ff6600; /* Accent border on hover */
        color: #fff; /* Text color change on hover */
    }
    
    .features-item i {
        font-size: 60px; /* Even larger icons */
        line-height: 1;
        margin-bottom: 25px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        color: #ff6600; /* Primary icon color */
        position: relative;
        z-index: 1; /* Ensure icon is above pseudo-element */
    }

    .features-item:hover i {
        transform: translateY(-8px) scale(1.2) rotate(5deg); /* More dynamic icon animation */
        color: #fff !important; /* White icon on hover */
    }

    .features-item h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 28px; /* Larger, bolder titles */
        font-weight: 700;
        margin-bottom: 15px;
        line-height: 1.3;
        color: #333;
        position: relative;
        z-index: 1;
    }

    .features-item h3 a {
        color: #333;
        transition: color 0.3s ease;
        text-decoration: none;
    }

    .features-item:hover h3 a {
        color: #fff; /* White title on hover */
    }

    .features-item p {
        font-size: 17px; /* Slightly larger paragraph */
        line-height: 1.8;
        color: #555;
        flex-grow: 1;
        position: relative;
        z-index: 1;
        transition: color 0.3s ease;
    }
    .features-item:hover p {
      color: rgba(255, 255, 255, 0.9); /* Lighter paragraph on hover */
    }

    /* Courses Section Enhancements */
    .courses.section {
      padding: 80px 0;
      background-color: #fff;
    }
    .course-item {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: all 0.4s ease-in-out;
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    .course-item:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    .course-item img {
      width: 100%;
      height: 220px; /* Consistent image height */
      object-fit: cover;
      transition: transform 0.4s ease-in-out;
    }
    .course-item:hover img {
      transform: scale(1.05); /* Zoom image on hover */
    }
    .course-content {
      padding: 25px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }
    .course-content .category {
      background-color: #ff6600;
      color: #fff;
      font-size: 0.9rem;
      font-weight: 600;
      padding: 4px 10px;
      border-radius: 5px;
      display: inline-block;
      margin-bottom: 10px;
      align-self: flex-start; /* Align category to start */
    }
    .course-content h3 {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 10px;
      line-height: 1.3;
    }
    .course-content h3 a {
      color: #333;
      transition: color 0.3s ease;
      text-decoration: none;
    }
    .course-content h3 a:hover {
      color: #ff6600;
    }
    .course-content .description {
      font-size: 1rem;
      color: #666;
      flex-grow: 1;
    }

    /* Testimonials Section Enhancements */
    .testimonials.section {
      background-color: #f0f8ff; /* Light blue background */
      padding: 80px 0;
    }
    .testimonial-item {
      background: #fff;
      padding: 40px; /* More padding */
      border-radius: 15px; /* More rounded */
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      min-height: 300px; /* Increased height for content */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
    }
    .testimonial-item .quote-icon-left,
    .testimonial-item .quote-icon-right {
      color: #fcc293;
      font-size: 3rem; /* Larger quote icons */
      position: absolute;
      opacity: 0.2;
    }
    .testimonial-item .quote-icon-left { top: 15px; left: 20px; }
    .testimonial-item .quote-icon-right { bottom: 15px; right: 20px; }
    .testimonial-item p {
      font-style: italic;
      margin: 20px 0;
      color: #555;
      line-height: 1.8; /* Better readability */
      font-size: 1.15rem; /* Larger text */
      padding: 0 30px;
    }
    .testimonial-item img {
      width: 100px; /* Larger image */
      height: 100px;
      border-radius: 50%;
      border: 6px solid #fff; /* Thicker border */
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      margin: 0 auto 15px auto;
    }
    .testimonial-item h3 {
      font-size: 1.4rem; /* Larger name */
      font-weight: bold;
      color: #333;
      margin-bottom: 5px;
    }
    .testimonial-item h4 {
      font-size: 1rem; /* Larger title */
      color: #999;
    }
    .testimonials .swiper-pagination-bullet {
      background-color: #ff6600 !important;
    }
    .testimonials-loading {
      text-align: center;
      padding: 60px 0;
      font-size: 1.5rem;
      color: #666;
    }

    /* Head Teacher's Message Enhancements */
    .head-teacher-message.section {
        background-color: #e6f2ff; /* Lighter blue background */
        padding: 80px 0;
        text-align: center;
        border-top: 6px solid #ff6600;
        border-bottom: 6px solid #ff6600;
        position: relative;
        overflow: hidden;
    }
    .head-teacher-message::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('https://placehold.co/1920x600/DDA0DD/ffffff?text=Inspiring+Future') no-repeat center center;
        background-size: cover;
        opacity: 0.1;
        z-index: 0;
        filter: grayscale(50%); /* Subtle desaturation */
    }
    .head-teacher-message h2 {
        font-family: 'Raleway', sans-serif;
        font-size: 3.5rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 30px;
        position: relative;
        z-index: 1;
    }
    .head-teacher-message p {
        font-size: 1.3rem; /* Larger message text */
        color: #444;
        line-height: 1.9; /* Improved readability */
        max-width: 900px; /* Wider text area */
        margin: 0 auto 40px auto;
        font-style: italic;
        position: relative;
        z-index: 1;
    }
    .head-teacher-message .author-info img {
        width: 180px; /* Even larger image */
        height: 180px;
        border-radius: 50%;
        border: 8px solid #fff; /* Thicker white border */
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25); /* Deeper shadow */
        margin-bottom: 0;
        margin-top: 30px;
        position: relative;
        z-index: 1;
        transition: transform 0.4s ease;
    }
    .head-teacher-message .author-info img:hover {
      transform: scale(1.05) rotate(-3deg);
    }
    @media (max-width: 768px) {
        .head-teacher-message h2 { font-size: 2.8rem; }
        .head-teacher-message p { font-size: 1.1rem; }
        .head-teacher-message .author-info img { width: 120px; height: 120px; }
    }

    /* WhatsApp Floating Button Enhancements */
    .whatsapp-float {
      position: fixed;
      bottom: 30px; /* Lift slightly from bottom */
      right: 30px; /* Move slightly from right */
      background: linear-gradient(45deg, #25D366, #128C7E); /* WhatsApp gradient */
      color: white;
      border-radius: 40px; /* More rounded */
      height: 55px; /* Larger button */
      padding: 0 20px;
      display: flex;
      align-items: center;
      text-decoration: none;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Prominent shadow */
      z-index: 1000;
      overflow: hidden;
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); /* Smoother transition */
      width: 55px; /* Initial width (circle) */
    }

    .whatsapp-float i {
      font-size: 28px; /* Larger icon */
      transition: margin-right 0.3s ease;
    }

    .whatsapp-float span {
      white-space: nowrap;
      margin-left: 15px; /* More space */
      opacity: 0;
      transition: opacity 0.3s ease;
      font-weight: 600;
    }

    .whatsapp-float:hover {
      width: 190px; /* Expanded width */
      background: linear-gradient(45deg, #128C7E, #25D366); /* Reverse gradient on hover */
      transform: translateY(-8px) scale(1.05); /* More lift and subtle scale */
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5);
    }

    .whatsapp-float:hover span {
      opacity: 1;
    }

    /* Footer Enhancements */
    .footer {
      background-color: #333; /* Darker footer */
      color: #f8f8f8;
      padding: 60px 0;
      font-size: 1rem;
    }
    .footer .footer-top {
      padding-bottom: 40px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .footer h4 {
      font-family: 'Poppins', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: #ff6600; /* Accent color for headings */
      margin-bottom: 20px;
    }
    .footer .logo .sitename {
      color: #fff; /* White sitename in footer */
      font-size: 2.2rem;
    }
    .footer .footer-contact p {
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 8px;
    }
    .footer .footer-contact strong {
      color: #ff6600;
    }
    .footer .footer-links ul {
      list-style: none;
      padding: 0;
    }
    .footer .footer-links ul li {
      padding: 6px 0;
    }
    .footer .footer-links ul li a {
      color: rgba(255, 255, 255, 0.7);
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .footer .footer-links ul li a:hover {
      color: #ff6600;
    }
    .footer .text-center {
      padding-top: 30px;
      font-size: 0.9rem;
      color: rgba(255, 255, 255, 0.6);
    }
    .footer .text-center a {
      color: #ff6600;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .footer .text-center a:hover {
      color: #e65c00;
    }

    /* Preloader */
    #preloader {
      background: #fff;
      position: fixed;
      inset: 0;
      width: 100%;
      height: 100vh;
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #preloader::after {
      content: '';
      display: block;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      border: 5px solid #ff6600;
      border-top-color: transparent;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

  </style>

  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GS ST PHILIPPE NERI</title>

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <style>
    /* Global Styles */
    body {
      background-color: white;
      color: green;
    }

    /* Header and Navigation Styles */
    #header {
      background-color: white; /* Ensures header background is also white */
    }
    
    .logo, .logo:hover {
      text-decoration: none; /* Removes underline from logo link */
    }

    .sitename {
      color: green; /* Sets the school name to green */
    }

    .navmenu a {
      color: green; /* Sets all navigation links to green */
      text-decoration: none; /* Removes underline from links */
    }
    
    /* Removes active and hover color changes on links */
    .navmenu a:hover,
    .navmenu .active,
    .navmenu .active:hover {
      color: green !important;
      background-color: transparent !important;
    }
  </style>

  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">GS ST PHILIPPE NERI</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="home-link active">Home</a></li>
          <li><a href="academic.php" class="academic-link">Academic</a></li>
          <li><a href="holidays_works.php" class="holidaywork-link">Holidaywork</a></li>
          <li><a href="announcement.php" class="announcement-link">Announcement</a></li>
          <li><a href="news.php" class="news-link">News</a></li>
          <li><a href="entertainment.php" class="entertainment-link">Entertainment</a></li>
          <li><a href="contact.php" class="contact-link">Contact</a></li>
          <li><a href="login2.php" class="login-link">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <img src="assets/img/phillippeneri.gif" alt="GS ST PHILIPPE NERI Main Image" class="hero-image-right-large">

    </div>
  </header>
</body>
</html>

  <main class="main">

    <!-- Hero Section with Swiper Slider -->
    <section id="hero" class="hero section dark-background">
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <!-- Slide 1: Original Hero Background Image -->
          <div class="swiper-slide">
            <img src="assets/img/phillippeneri.gif" alt="secondary school" class="swiper-image">
            <div class="container hero-text">
              <h2 data-aos="fade-up" data-aos-delay="100">Learning Today,<br>Leading Tomorrow</h2>
              <p data-aos="fade-up" data-aos-delay="200">
                We are dedicated to enhancing secondary education with digital solutions for O'Level and A'Level programs like MCB, MPG, PCB, and PCM.
              </p>
              <div class="d-flex" data-aos="fade-up" data-aos-delay="300">
                <a href="#about" class="btn-get-started">Get Started</a>
              </div>
            </div>
          </div>

          <!-- Slide 2: WhatsApp Image 2 - Tournament Focused -->
          <div class="swiper-slide">
            <img src="assets/img/whatsapp2.jpg" class="img-fluid" alt="Students Participating in Sports Tournament" class="swiper-image">
            <div class="container hero-text">
              <h2 data-aos="fade-up" data-aos-delay="100">Unleash Your Potential<br>in the School Tournament!</h2>
              <p data-aos="fade-up" data-aos-delay="200">
                Join our annual sports spectacular, where skill, teamwork, and spirit shine. Compete for glory and make unforgettable memories!
              </p>
              <div class="d-flex" data-aos="fade-up" data-aos-delay="300">
                <a href="#about" class="btn-get-started">View Tournament Details</a>
              </div>
            </div>
          </div>

          <!-- Slide 3: WhatsApp Image 1 - Tournament Focused -->
          <div class="swiper-slide">
            <img src="assets/img/whatsapp1.jpg" alt="Winning Team Celebrating in School Tournament" class="swiper-image">
            <div class="container hero-text">
              <h2 data-aos="fade-up" data-aos-delay="100">Championship Victories<br>and Sporting Excellence</h2>
              <p data-aos="fade-up" data-aos-delay="200">
                Celebrate our athletic achievements and the dedication of our students. Experience the thrill of competition and sportsmanship!
              </p>
              <div class="d-flex" data-aos="fade-up" data-aos-delay="300">
                <a href="#about" class="btn-get-started">View Tournament Details</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </section><!-- /Hero Section -->



    <section class="head-teacher-message section">
      <div class="container" data-aos="fade-up">
        <h2>Welcome to GS ST PHILIPPE NERI</h2>
        <p>
          "At GS ST PHILIPPE NERI, we are committed to fostering a vibrant learning environment that nurtures intellectual curiosity, personal growth, and academic excellence. We believe in empowering every student to reach their full potential and become responsible citizens of tomorrow."
        </p>
        <div class="author-info">
          <!-- Placeholder image for a general school representative, or can be removed if not needed for a general message 
          <img src="https://placehold.co/100x100/87CEEB/000000?text=welcome+message" alt="school Image">-->
        </div>
      </div>
    </section><!-- End School General Message Section -->

  </main>



<!-- ======= Overview / School Background Section ======= -->
<section id="school-overview" class="py-5 bg-light">
  <div class="container" data-aos="fade-up">
    <div class="row align-items-center">

      <!-- Image -->
      <div class="col-lg-6 mb-4 mb-lg-0">
        <img src="assets/img/download.jpg" 
             alt="GS St Philippe Neri" 
             class="img-fluid rounded shadow" 
             style="border: 2px solid #007bff; max-height: 400px; object-fit: cover;">
      </div>

      <!-- Overview Text -->
      <div class="col-lg-6">
        <h2 class="mb-3" style="color:#007bff;">Our School Background</h2>
        <p class="lead" style="font-size:1.1rem; line-height:1.6;">
          GS St Philippe Neri has a proud history of nurturing learners into responsible, skilled, and knowledgeable citizens. 
          Since its foundation, our school has consistently prioritized academic excellence, extracurricular activities, and strong moral values.
        </p>
        <p style="line-height:1.6;">
          Our legacy is built on years of dedicated teaching, modern learning facilities, and a supportive environment where every learner can thrive. 
          We aim to empower each learner to reach their full potential and make meaningful contributions to society.
        </p>
        <a href="overview.php" class="btn btn-primary mt-3">Read Full Overview</a>
      </div>

    </div>
  </div>
</section>
<!-- End Overview Section -->


<!-- About Section -->
<section id="about" class="about section">
  <div class="container">
    <div class="row gy-4">
      
      <!-- Image -->
      <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">            
        <img src="assets/img/download.jpg" class="img-fluid rounded shadow" alt="Mission Vision Values for education.">          
      </div>

      <!-- Text Content -->
      <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">            
        <h3 style="color:#007bff;">Our Educational Services for Secondary Programs</h3>            
        <p class="fst-italic">              
          We provide comprehensive support for learners in Secondary (O'Level) and A'Level programs, focusing on subjects like MCB, MPG, PCB, and PCM.            
        </p>            
        <ul>
          <li><i class="bi bi-check-circle"></i> Structured learning for Secondary (O'Level) and A'Level courses.</li>              
          <li><i class="bi bi-check-circle"></i> Expert guidance in subjects like MCB, MPG, PCB, and PCM.</li>              
          <li><i class="bi bi-check-circle"></i> Enhancing academic performance through personalized support and resources.</li>            
        </ul>            
      </div>

    </div>
  </div>
</section>










    <section id="courses" class="courses section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Courses</h2>
        <p>Popular Courses</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row">

          <!-- FIRST LEFT: Mathematics -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="course-item">
              <img src="assets/img/course-1.jpg" class="img-fluid" alt="Mathematics Course">
              <div class="course-content">
                <p class="category">Mathematics</p>
                <h3><a href="course-details.html">Mathematics</a></h3>
                <p class="description">Learn essential topics in Mathematics including algebra, geometry, calculus, and trigonometry for O'Level exams.</p>
              </div>
            </div>
          </div>

          <!-- SECOND LEFT: Chemistry -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
            <div class="course-item">
              <img src="assets/img/course-2.jpg" class="img-fluid" alt="Chemistry Course">
              <div class="course-content">
                <p class="category">Chemistry</p>
                <h3><a href="course-details.html">Chemistry</a></h3>
                <p class="description">Master the fundamentals of Chemistry, including atomic structure, chemical reactions, and more for O'Level exams.</p>
              </div>
            </div>
          </div>

          <!-- THIRD LEFT (Placeholder or Optional) -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="250">
            <div class="course-item">
              <img src="assets/img/course-3.jpg" class="img-fluid" alt="Physics Course">
              <div class="course-content">
                <p class="category">Physics</p>
                <h3><a href="#">Physics</a></h3>
                <p class="description">Content for this course will be available shortly.</p>
              </div>
            </div>
          </div>

          <!-- FOURTH LEFT: O'Level -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
            <div class="course-item">
              <img src="https://placehold.co/600x400/8A2BE2/ffffff?text=OLevel+Preparation" class="img-fluid" alt="O'Level Preparation">
              <div class="course-content">
                <p class="category">O'Level</p>
                <h3><a href="course-details.php">O'Level Preparation</a></h3>
                <p class="description">A comprehensive course designed to help you prepare for all O'Level subjects and excel in your exams.</p>
              </div>
            </div>
          </div>
        </div> <!-- End of row with 4 on same line -->
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




  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File (Placeholder, assuming custom scripts here) -->
  <script src="assets/js/main.js"></script>

  <!-- Inline JavaScript for dynamic content loading and Swiper initialization -->
  <script type="module">
    // Firebase related variables (if Firebase is still intended for future use or local testing)
    let db;
    let auth;
    let currentUserId = "anonymous";
    let isFirebaseReady = false;
    let isDomReady = false;

    // These variables would typically be defined by the Canvas environment or a server-side include
    const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
    const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};

    // Function to initialize the app (load testimonials) once both Firebase and DOM are ready
    function initApp() {
      if (isFirebaseReady && isDomReady) {
        console.log("Both Firebase and DOM are ready. Initializing app components.");
        loadTestimonials(); // Load dynamic testimonials
      } else {
        console.log("Waiting for Firebase or DOM readiness. Firebase Ready:", isFirebaseReady, "DOM Ready:", isDomReady);
      }
    }

    // Initialize Firebase (only if config is provided, otherwise run without it)
    if (Object.keys(firebaseConfig).length > 0) {
      try {
        // Dynamic import of Firebase modules
        Promise.all([
          import("https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js"),
          import("https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js"),
          import("https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js")
        ]).then(([firebaseAppModule, firebaseAuthModule, firebaseFirestoreModule]) => {
          const { initializeApp } = firebaseAppModule;
          const { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged } = firebaseAuthModule;
          const { getFirestore, collection, getDocs, addDoc, query } = firebaseFirestoreModule;

          const app = initializeApp(firebaseConfig);
          db = getFirestore(app);
          auth = getAuth(app);
          console.log("Firebase app initialized with provided config.");

          onAuthStateChanged(auth, async (user) => {
            if (user) {
              currentUserId = user.uid;
              console.log("User authenticated:", currentUserId);
            } else {
              console.log("No user signed in. Attempting anonymous or custom token sign-in.");
              try {
                if (typeof __initial_auth_token !== 'undefined') {
                  await signInWithCustomToken(auth, __initial_auth_token);
                  currentUserId = auth.currentUser.uid;
                  console.log("Signed in with custom token:", currentUserId);
                } else {
                  await signInAnonymously(auth);
                  currentUserId = auth.currentUser.uid;
                  console.log("Signed in anonymously:", currentUserId);
                }
              } catch (error) {
                console.error("Firebase authentication error:", error);
                currentUserId = crypto.randomUUID();
                console.warn("Falling back to random UUID for user ID due to authentication failure:", currentUserId);
              }
            }
            const userIdDisplay = document.getElementById('user-id-display');
            if (userIdDisplay) {
              userIdDisplay.textContent = currentUserId;
            }
            isFirebaseReady = true;
            initApp();
          });
        }).catch(e => {
          console.error("Failed to import Firebase modules or initialize Firebase:", e);
          console.warn("Running without Firebase backend. Dynamic content (testimonials) will only be generated via LLM and NOT saved/loaded from Firestore.");
          const userIdDisplay = document.getElementById('user-id-display');
          if (userIdDisplay) {
            userIdDisplay.textContent = "Firebase not configured/failed.";
          }
          isFirebaseReady = true; // Still mark as ready to proceed with LLM generation
          initApp();
        });
      } catch (e) {
        console.error("Direct import syntax error or other sync error:", e);
        console.warn("Running without Firebase backend. Dynamic content (testimonials) will only be generated via LLM and NOT saved/loaded from Firestore.");
        const userIdDisplay = document.getElementById('user-id-display');
        if (userIdDisplay) {
          userIdDisplay.textContent = "Firebase not configured/failed.";
        }
        isFirebaseReady = true; // Still mark as ready to proceed with LLM generation
        initApp();
      }
    } else {
      console.warn("Firebase config not found. Running without Firebase backend. Dynamic content (testimonials) will only be generated via LLM and NOT saved/loaded from Firestore.");
      const userIdDisplay = document.getElementById('user-id-display');
      if (userIdDisplay) {
        userIdDisplay.textContent = "Firebase not configured.";
      }
      isFirebaseReady = true;
      initApp();
    }

    let testimonialsSwiper = null; // Declare Swiper instance globally

    async function loadTestimonials() {
      const swiperWrapper = document.querySelector('.testimonials-swiper .swiper-wrapper');
      const loadingIndicator = document.querySelector('.testimonials-loading');

      if (loadingIndicator) {
        loadingIndicator.style.display = 'block';
        loadingIndicator.textContent = 'Loading testimonials...';
        console.log("Loading indicator displayed for testimonials.");
      }
      swiperWrapper.innerHTML = ''; // Clear existing content
      console.log("Attempting to load testimonials...");

      try {
        let testimonialsData = [];

        // Dynamic import of Firestore functions within this scope
        const { collection, getDocs, addDoc, query } = await import("https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js");

        // Check if db and auth are defined and user is authenticated for Firestore operations
        if (db && auth && auth.currentUser && auth.currentUser.uid === currentUserId && currentUserId !== "anonymous") {
          console.log("Firebase Firestore is initialized and user authenticated. Attempting to load testimonials from Firestore.");
          const testimonialsColRef = collection(db, `artifacts/${appId}/public/data/testimonials`);
          const q = query(testimonialsColRef);
          const querySnapshot = await getDocs(q);

          if (!querySnapshot.empty) {
            querySnapshot.forEach(doc => {
              testimonialsData.push(doc.data());
            });
            console.log("Testimonials loaded from Firestore:", testimonialsData);
          } else {
            console.log("No testimonials found in Firestore. Generating testimonials via LLM and saving to Firestore...");
            const generatedTestimonials = await generateTestimonialsFromLLM();
            if (generatedTestimonials && generatedTestimonials.length > 0) {
              for (const testimonial of generatedTestimonials) {
                await addDoc(testimonialsColRef, testimonial);
                console.log("Added testimonial to Firestore:", testimonial);
              }
              testimonialsData = generatedTestimonials;
              console.log("Generated and saved testimonials to Firestore.");
            } else {
              console.warn("LLM generated no testimonials or an empty array.");
            }
          }
        } else {
          console.warn("Firebase Firestore not fully available or user not authenticated. Generating testimonials from LLM only (not saved).");
          testimonialsData = await generateTestimonialsFromLLM();
          if (testimonialsData && testimonialsData.length > 0) {
            console.log("Testimonials generated from LLM (not saved to Firestore):", testimonialsData);
          } else {
            console.warn("LLM generated no testimonials or an empty array (Firebase not used).");
          }
        }

        if (testimonialsData && testimonialsData.length > 0) {
          console.log("Rendering testimonials...");
          testimonialsData.forEach(testimonial => {
            const slide = document.createElement('div');
            slide.classList.add('swiper-slide');

            const item = document.createElement('div');
            item.classList.add('testimonial-item');

            const imgAltText = testimonial.imagePlaceholder || testimonial.name || 'Testimonial Author';
            const imgPlaceholderUrl = `https://placehold.co/100x100/CCCCCC/333333?text=${encodeURIComponent(imgAltText.replace(/\s/g, '+'))}`; // Replace spaces for URL encoding

            item.innerHTML = `
              <i class="bi bi-quote quote-icon-left"></i>
              <i class="bi bi-quote quote-icon-right"></i>
              <p>${testimonial.quote}</p>
              <img src="${imgPlaceholderUrl}" class="img-fluid" alt="${imgAltText}">
              <h3>${testimonial.name}</h3>
              <h4>${testimonial.title}</h4>
            `;

            slide.appendChild(item);
            swiperWrapper.appendChild(slide);
          });

          // Reinitialize Swiper after new slides are added
          if (testimonialsSwiper) {
            testimonialsSwiper.destroy(true, true);
            console.log("Destroyed existing Swiper instance.");
          }
          testimonialsSwiper = new window.Swiper('.testimonials-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
              delay: 7000,
              disableOnInteraction: false,
            },
            pagination: {
              el: '.swiper-pagination',
              clickable: true,
            },
            breakpoints: {
              640: { slidesPerView: 1, },
              768: { slidesPerView: 2, spaceBetween: 30, },
              1024: { slidesPerView: 3, spaceBetween: 30, },
            }
          });
          console.log("Swiper reinitialized with new testimonials.");
        } else {
          console.log("No testimonials data received or generated.");
          swiperWrapper.innerHTML = '<p style="text-align: center; color: red;">No testimonials available.</p>';
        }

      } catch (error) {
        console.error("Caught error during loadTestimonials:", error);
        swiperWrapper.innerHTML = '<p style="text-align: center; color: red;">Failed to load testimonials. Please check your network connection and browser console for errors.</p>';
      } finally {
        if (loadingIndicator) {
          loadingIndicator.remove();
          console.log("Testimonials loading indicator removed.");
        }
      }
    }

    async function generateTestimonialsFromLLM() {
      console.log("Calling LLM to generate testimonials...");
      try {
        const chatHistory = [];
        const prompt = "Generate 4 diverse testimonials for a school website. Each testimonial should include a quote, the person's name, their role/title, and an image placeholder description. The names should be Rwandan names. The roles should be 'O\'Level Graduate', 'A\'Level Student (PCM)', 'Parent', and 'Head of Science Department'.";
        chatHistory.push({ role: "user", parts: [{ text: prompt }] });

        const payload = {
          contents: chatHistory,
          generationConfig: {
            responseMimeType: "application/json",
            responseSchema: {
              type: "ARRAY",
              items: {
                type: "OBJECT",
                properties: {
                  "quote": { "type": "STRING" },
                  "name": { "type": "STRING" },
                  "title": { "type": "STRING" },
                  "imagePlaceholder": { "type": "STRING" }
                },
                "propertyOrdering": ["quote", "name", "title", "imagePlaceholder"]
              }
            }
          }
        };

        const apiKey = typeof __api_key__ !== 'undefined' ? __api_key__ : '';
        const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

        const response = await fetch(apiUrl, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });

        if (!response.ok) {
            const errorText = await response.text();
            if (response.status === 401) {
                throw new Error(`LLM API HTTP error! status: ${response.status}, Unauthorized. Please ensure your API key is valid and correctly configured.`);
            }
            throw new Error(`LLM API HTTP error! status: ${response.status}, response: ${errorText}`);
        }

        const result = await response.json();
        if (result.candidates && result.candidates.length > 0 &&
            result.candidates[0].content && result.candidates[0].content.parts &&
            result.candidates[0].content.parts.length > 0) {
          const jsonString = result.candidates[0].content.parts[0].text;
          console.log("Raw LLM JSON response:", jsonString);
          return JSON.parse(jsonString);
        }
        console.warn("LLM response missing expected candidate structure.");
        return [];
      } catch (error) {
        console.error("Error generating testimonials from LLM:", error);
        return [];
      }
    }

    // Initialize Swiper for the Hero Section on DOMContentLoaded
    document.addEventListener('DOMContentLoaded', function() {
      isDomReady = true;
      // Hero Section Swiper
      if (typeof window.Swiper !== 'undefined') {
        new window.Swiper('.swiper-container', {
          slidesPerView: 1,
          spaceBetween: 0,
          loop: true,
          autoplay: {
            delay: 5000,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          speed: 1000,
          effect: 'slide',
        });
        console.log("Hero Swiper initialized.");
      } else {
        console.warn('Swiper.js not loaded. Hero section might not function as expected.');
      }

      // Remove the main preloader as soon as the DOM is ready and hero section is attempted to be initialized
      const preloader = document.getElementById('preloader');
      if (preloader) {
        preloader.remove();
        console.log("Main preloader removed (on DOMContentLoaded).");
      }

      initApp(); // Call initApp after DOM is ready
    });
  </script>
</body>

</html>
