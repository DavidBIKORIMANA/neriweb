<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Holiday Works - GS ST PHILIPPE NERI</title>
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

  <style>
    :root {
      --primary: #5fcf80;
      --secondary: #37423b;
      --text-muted: #777777;
      --bg-light: #f8f9fa;
    }

    body {
      font-family: "Open Sans", sans-serif;
      color: #444444;
      overflow-x: hidden;
      background: var(--bg-light);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Header & Nav */
    .header {
      background: #fff;
      transition: all 0.5s;
      z-index: 997;
      padding: 15px 0;
      box-shadow: 0px 2px 20px rgba(1, 41, 112, 0.1);
    }

    .sitename {
      font-size: 26px;
      font-weight: 700;
      color: var(--secondary);
      margin: 0;
      text-decoration: none;
    }

    .navmenu ul {
      margin: 0;
      padding: 0;
      display: flex;
      list-style: none;
      align-items: center;
    }

    .navmenu a {
      color: var(--secondary);
      padding: 10px 15px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    .navmenu a:hover, .navmenu .active {
      color: var(--primary);
    }

    /* Page Title Section */
    .page-header {
      background: var(--primary);
      padding: 60px 0;
      text-align: center;
      color: white;
    }

    .page-header h2 {
      font-weight: 700;
      font-size: 36px;
    }

    .page-header p {
      font-style: italic;
      opacity: 0.9;
    }

    /* Holiday Work Cards */
    .work-container {
      padding: 60px 0;
      flex: 1; 
    }

    .work-card {
      background: #fff;
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      padding: 25px;
      transition: transform 0.3s, box-shadow 0.3s;
      height: 100%;
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .work-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .work-card h5 {
      color: var(--secondary);
      font-weight: 700;
      margin-bottom: 5px;
      text-transform: capitalize;
    }

    .work-card .description {
      color: #555;
      font-size: 14px;
      flex-grow: 1;
      margin-bottom: 15px;
    }

    .work-card .tags {
      font-size: 12px;
      color: var(--primary);
      font-weight: 600;
      margin-bottom: 15px;
    }

    .btn-download {
      background-color: var(--primary);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 14px;
      text-align: center;
      transition: 0.3s;
      width: fit-content;
      text-decoration: none;
      cursor: pointer;
    }

    .btn-download:hover {
      background-color: #3ac162;
      color: white;
      transform: scale(1.05);
    }

    .whatsapp-float {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #25d366;
      color: white;
      padding: 12px 20px;
      border-radius: 50px;
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      z-index: 1000;
      transition: 0.3s;
    }

    .whatsapp-float:hover {
      background: #128c7e;
      color: white;
      transform: scale(1.05);
    }

    /* Custom Toast for Downloads */
    .download-toast {
      position: fixed;
      bottom: 80px;
      left: 50%;
      transform: translateX(-50%);
      background: var(--secondary);
      color: white;
      padding: 12px 24px;
      border-radius: 8px;
      display: none;
      z-index: 2000;
      animation: fadeInUp 0.3s ease;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translate(-50%, 20px); }
      to { opacity: 1; transform: translate(-50%, 0); }
    }

    /* Search Bar */
    .search-container {
      max-width: 600px;
      margin: -30px auto 40px;
      position: relative;
      z-index: 10;
    }

    .search-input {
      border-radius: 50px;
      padding: 15px 30px;
      border: none;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      width: 100%;
    }
  </style>
</head>

<body>

  <header id="header" class="header sticky-top">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center text-decoration-none">
        <h1 class="sitename">GS ST PHILIPPE NERI</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul class="d-none d-lg-flex">
          <li><a href="index.php" class="home-link active">Home</a></li>
          <li><a href="academic1.php" class="academic-link">Academic</a></li>
          <li><a href="holidays_works.php" class="holidaywork-link">Holidaywork</a></li>
          <li><a href="announcement.php" class="announcement-link">Announcement</a></li>
          <li><a href="news.php" class="news-link">News</a></li>
          <li><a href="contact.php" class="contact-link">Contact</a></li>
          <li><a href="login2.php" class="login-link">Login</a></li>
        </ul>
        </ul>
        <i class="bi bi-list d-lg-none fs-2 ms-3" style="cursor: pointer;"></i>
      </nav>
    </div>
  </header>

  <main>
    <section class="page-header">
      <div class="container" data-aos="fade-up">
        <h2>Holiday Works</h2>
        <p>Access your assignments and study materials anywhere, anytime.</p>
      </div>
    </section>

    <section class="work-container">
      <div class="container">
        
        <div class="search-container" data-aos="fade-up" data-aos-delay="100">
          <input type="text" id="searchInput" class="search-input" placeholder="Search by title, class or subject...">
        </div>

        <div class="row g-4" id="holidayWorksGrid">
          <!-- Dynamically populated from database query result -->
        </div>

        <div id="noResults" class="text-center py-5 d-none">
          <i class="bi bi-search fs-1 text-muted"></i>
          <p class="mt-3 text-muted">No holiday works found matching your search.</p>
        </div>
      </div>
    </section>
  </main>

  <!-- WhatsApp -->
  <a class="whatsapp-float" href="https://wa.me/+250788586802" target="_blank">
    <i class="bi bi-whatsapp"></i>
    <span>Student Support Chat</span>
  </a>

  <!-- Toast -->
  <div id="downloadToast" class="download-toast">
    <i class="bi bi-check-circle-fill me-2"></i> <span id="toastMessage">Preparing your download...</span>
  </div>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  
  <script>
    /**
     * Data updated from the provided SQL query results.
     */
    const holidayWorks = [
      {
        id: 2,
        title: "biology holiday",
        description: "holiday work to submit at start of dchool",
        tags: ["#Biology", "#s6mcb1"],
        file_name: "S6 Biology holiday package_Phoenix.pdf",
        date: "2025-04-13"
      },
      {
        id: 4,
        title: "holiday for ent s6",
        description: "to be submited on start of school",
        tags: ["#ENT", "#s6"],
        file_name: "S6_MCB1-2_Chemistry_Holiday_Answers.pdf",
        date: "2025-04-13"
      },
      {
        id: 5,
        title: "holiday chemistry for s6",
        description: "to be submited on start of school",
        tags: ["#Chemistry", "#s6mcb1"],
        file_name: "S6 MCB1,2 CHEMISTRY HOLYDAY PACKAGE term3 (3).pdf",
        date: "2025-04-14"
      }
    ];

    function renderWorks(data) {
      const grid = document.getElementById('holidayWorksGrid');
      const noResults = document.getElementById('noResults');
      grid.innerHTML = '';

      if (data.length === 0) {
        noResults.classList.remove('d-none');
        return;
      }
      
      noResults.classList.add('d-none');

      data.forEach((work, index) => {
        const col = document.createElement('div');
        col.className = 'col-lg-4 col-md-6';
        col.setAttribute('data-aos', 'fade-up');
        col.setAttribute('data-aos-delay', (index % 3) * 100);

        col.innerHTML = `
          <div class="work-card">
            <h5>${work.title}</h5>
            <div class="description">${work.description}</div>
            <div class="tags">${work.tags.join(' ')}</div>
            <div class="small text-muted mb-3">
              <i class="bi bi-file-earmark-pdf me-1"></i>${work.file_name}
              <br><small><i class="bi bi-calendar-event me-1"></i>Uploaded: ${work.date}</small>
            </div>
            <button class="btn-download" onclick="handleDownload('${work.id}', '${work.file_name}')">
              <i class="bi bi-cloud-arrow-down-fill me-2"></i>Download PDF
            </button>
          </div>
        `;
        grid.appendChild(col);
      });
      
      if (typeof AOS !== 'undefined') AOS.init();
    }

    /**
     * Functional Download Handler
     * Links to the actual PHP backend to fetch BLOB data from holiday_work table.
     */
    function handleDownload(id, fileName) {
      const toast = document.getElementById('downloadToast');
      const msg = document.getElementById('toastMessage');
      
      msg.textContent = `Requesting: ${fileName}...`;
      toast.style.display = 'block';

      // Implementation:
      // This will redirect the browser to your download script.
      // Your download.php should accept 'id', fetch the BLOB and mime_type, 
      // then output the correct headers for a file download.
      setTimeout(() => {
        window.location.href = `download_work.php?id=${id}`;
        
        msg.innerHTML = `<i class="bi bi-check-lg text-success"></i> Download starting!`;
        
        setTimeout(() => {
          toast.style.display = 'none';
        }, 3000);
      }, 800);
    }

    // Search Logic
    document.getElementById('searchInput').addEventListener('input', function(e) {
      const term = e.target.value.toLowerCase();
      const filtered = holidayWorks.filter(w => 
        w.title.toLowerCase().includes(term) || 
        w.description.toLowerCase().includes(term) ||
        w.tags.some(t => t.toLowerCase().includes(term))
      );
      renderWorks(filtered);
    });

    // Initialize
    window.addEventListener('load', () => {
      AOS.init({
        duration: 800,
        easing: 'slide',
        once: true
      });
      renderWorks(holidayWorks);
    });
  </script>
</body>

</html>