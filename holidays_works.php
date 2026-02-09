<?php
require_once 'db.php';

// Fetch holiday works from the holiday_work table, ordered by uploaded_at
$sql = "SELECT * FROM holiday_work ORDER BY uploaded_at DESC";
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

        <li><a href="index.php" class="">Home<br></a></li>
         
          
        <li><a href="academic.php" class="academic">Academic</a></li>
        <li><a href="holidays_works.php" class="holidaywork active">Holidaywork</a></li>
        <li><a href="announcement.php" class="Annoucement">Annoucement</a></li>
         <li><a href="news.php" class="news">News</a></li> 
         <li><a href="entertainment.php" class="news">News</a></li>

          <li><a href="contact.php">Contact</a></li>

          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

        </ul>
       
      </nav>

      <!-- <a class="btn-getstarted" href="courses.html">Get Started</a> -->

    </div>
  </header>

<!-- <div style="background-color: #ffffff; padding: 30px; max-width: 1000px; margin: 40px auto; font-family: Arial, sans-serif;"> -->

  <!-- Page Title -->
  <div style="text-align: center; margin-bottom: 30px; background-color: #5fcf80;">
    <h2 style="color: white; font-size: 28px; margin-bottom: 10px;">Holiday Works</h2>
    <p style="color: #444444; font-size: 16px;">Review assignments and academic content during the holidays</p>
  </div>

  <!-- Holiday List Container -->
  <div class="row">
  <?php
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo '<div class="col-12 col-sm-6 col-md-4" style="margin-bottom: 20px;">';
          echo '<div style="
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            height: 100%;
            font-size: 13px;
          ">';

          // LEFT SIDE (Title and Description)
          echo '<h5 style="color: #37423b; margin: 0 0 6px; font-size: 15px;">' . htmlspecialchars($row['title']) . '</h5>';
          echo '<p style="color: #444; margin: 0 0 8px; font-size: 13px;">' . htmlspecialchars($row['description']) . '</p>';
          echo '<p style="font-size: 12px; color: #5fcf80; margin-bottom: 12px;">#Holiday #Education #Review</p>';

          // Download button
          echo '<a href="download_holiday.php?id=' . $row['id'] . '" target="_blank" style="
            display: inline-block;
            background-color: #5fcf80;
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            font-size: 12px;
          ">Download Work</a>';

          echo '</div>';
          echo '</div>';
      }
  } else {
      echo '<p style="color: #444444; text-align: center;">No holiday works available at the moment.</p>';
  }
  ?>
</div>


<!-- </div> -->

  <footer id="footer" class="footer position-relative light-background">
    <div class="container footer-top">
      <div class="row gy-4">

        <!-- About Section -->
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.php" class="logo d-flex align-items-center">
            <span class="sitename">GS St Philippe Neri</span>
          </a>
          <div class="footer-contact pt-3">
            <p><strong>Location:</strong> Our school is ideally situated in the serene and accessible region of:</p>
            <p>GISAGARA District, Southern Province</p>
            <p>NDORA Sector, close to local amenities and transport links.</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+250 788586802</span></p>
            <p><strong>Email:</strong> <span>philippenerigisagara@gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <!-- Social media links here if desired -->
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="holidays_works.php">Holidaywork</a></li>
            <li><a href="announcement.php">Announcement</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="holidays_works.php">Holidaywork</a></li>
          </ul>
        </div>

        <!-- Combinations -->
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Combinations</h4>
          <ul>
            <li><a href="#">MCB - Mathematics Chemistry Biology</a></li>
            <li><a href="#">PCB - Physics Chemistry Biology</a></li>
            <li><a href="#">PCM - Physics Chemistry Mathematics</a></li>
            <li><a href="#">MPG - Mathematics Physics Geography</a></li>
          </ul>
        </div>

        <!-- O'Level -->
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>O'Level</h4>
          <ul>
            <li><a href="#">Senior 1</a></li>
            <li><a href="#">Senior 2</a></li>
            <li><a href="#">Senior 3</a></li>
          </ul>
        </div>

        <!-- WhatsApp Floating Button -->
        <a class="whatsapp-float" href="https://wa.me/+25788586802?text=Hello%2C%20I%20would%20like%20to%20chat%20about%20the%20school%20tournament." target="_blank">
          <i class="fab fa-whatsapp"></i>
          <span>Join School Tournament Chat</span>
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
