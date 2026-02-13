<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Database connection details
$host = 'localhost';
$dbname = 'philippeneri';
$username = 'root';
$password = ''; // <-- FIXED
$pdo = null; // Initialize PDO object

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Recommended for security

} catch (PDOException $e) {
    $error_message = "Database connection failed: " . $e->getMessage();
}

$stats = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GS ST Philippe Neri</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        :root {
            --primary-color: #3498db; /* Blue */
            --secondary-color: #2c3e50; /* Dark Blue */
            --accent-color: #e74c3c; /* Red for errors/highlights */
            --text-color: #333;
            --light-bg: #f4f7f9; /* Light grey background for main content */
            --card-bg: #ffffff;
            --border-color: #ddd;
            --shadow-light: 0 2px 8px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
            color: var(--text-color);
            line-height: 1.6;
            display: flex; /* Use flexbox for main layout */
            min-height: 100vh; /* Ensure body takes full viewport height */
        }

        /* --- Sidebar Styles --- */
        .sidebar {
            width: 250px; /* Wider sidebar for better readability */
            background-color: var(--secondary-color);
            color: white;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column; /* Stack logo, nav, logout vertically */
            position: sticky; /* Keep sidebar fixed while main content scrolls */
            top: 0;
            height: 100vh; /* Full viewport height */
            overflow-y: auto; /* Scrollable if content overflows */
            transition: width 0.3s ease; /* Smooth transition for collapse */
        }

        .sidebar.collapsed {
            width: 80px; /* Collapsed width, showing only icons */
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color); /* School branding color */
            text-transform: uppercase;
            white-space: nowrap; /* Prevent wrapping on collapse */
            overflow: hidden;
        }
        .sidebar.collapsed .logo {
            font-size: 1.2rem; /* Smaller logo when collapsed */
        }


        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar nav ul li {
            margin-bottom: 10px;
        }

        .sidebar nav a {
            color: white;
            text-decoration: none;
            display: flex; /* Flex for icon and text alignment */
            align-items: center;
            padding: 12px 15px;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-size: 0.95rem;
        }

        .sidebar nav a i {
            margin-right: 15px; /* Spacing between icon and text */
            font-size: 1.1rem;
            min-width: 20px; /* Ensure icons align vertically */
            text-align: center;
        }

        .sidebar nav a span {
            /* Text part of the navigation link */
            display: inline-block;
            transition: opacity 0.3s ease, width 0.3s ease; /* Smooth fade/slide for text */
            overflow: hidden; /* Hide overflow when collapsed */
            white-space: nowrap; /* Prevent text wrapping */
        }

        .sidebar.collapsed nav a span {
            opacity: 0; /* Hide text on collapse */
            width: 0; /* Collapse text width */
        }

        .sidebar nav a:hover {
            background-color: #3f5d7a; /* Lighter shade of dark blue on hover */
            transform: translateX(5px); /* Subtle slide effect */
        }

        .sidebar .logout-link {
            margin-top: auto; /* Pushes logout link to the bottom of the sidebar */
            border-top: 1px solid rgba(255,255,255,0.1); /* Separator line */
            padding-top: 20px;
            text-align: center;
        }

        .sidebar .logout-link a {
            background-color: var(--accent-color); /* Red for logout button */
            justify-content: center; /* Center icon and text */
        }
        .sidebar .logout-link a:hover {
            background-color: #c0392b; /* Darker red on hover */
            transform: scale(1.02); /* Slight scale effect */
        }

        /* --- Main Content Styles --- */
        .main-content {
            flex-grow: 1; /* Allows main content to take remaining horizontal space */
            padding: 20px 30px;
            overflow-x: hidden; /* Prevent horizontal scroll due to padding */
        }

        header {
            background-color: var(--card-bg);
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: var(--shadow-light);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--secondary-color);
        }

        .welcome-message {
            font-size: 1.8rem;
            font-weight: 700;
        }
        .welcome-message span {
            color: var(--primary-color); /* Highlight 'Admin' in blue */
        }

        .toggle-btn {
            background: none;
            border: none;
            color: var(--secondary-color);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .toggle-btn:hover {
            background-color: var(--light-bg);
        }

        /* --- Dashboard Statistics Grid --- */
        .dashboard-grid {
            display: grid;
            /* Responsive grid: columns will wrap as needed, min 280px wide */
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px; /* Spacing between cards */
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: var(--card-bg);
            padding: 25px;
            border-radius: 10px;
            box-shadow: var(--shadow-light);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 150px; /* Ensure consistent height for cards */
        }

        .stat-card:hover {
            transform: translateY(-8px); /* Lift effect on hover */
            box-shadow: var(--shadow-hover);
        }

        .stat-card .icon {
            font-size: 3.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            opacity: 0.7; /* Slightly faded icon */
        }

        .stat-card h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .stat-card .count {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--primary-color);
            letter-spacing: -1px; /* Tighter spacing for numbers */
            display: inline-block; /* Allows padding/margin for clickable area */
            transition: color 0.3s ease;
        }

        /* Styling for the clickable count/N/A */
        .stat-card .count a {
            color: inherit; /* Inherit color from parent (.count) */
            text-decoration: none; /* No underline */
            border-bottom: 2px dotted transparent; /* Dotted underline on hover */
            transition: border-color 0.3s ease, color 0.3s ease;
            cursor: pointer;
        }

        .stat-card .count a:hover {
            border-color: var(--primary-color); /* Blue dotted underline on hover */
            color: var(--primary-color); /* Keep primary color */
        }

        .stat-card.error .count, .stat-card.error .count a {
            color: var(--accent-color); /* Red for error counts/links */
        }

        .stat-card.error .count a:hover {
            border-color: var(--accent-color); /* Red dotted underline on hover for error */
        }

        .stat-card.error h3::after {
            content: " (Error)"; /* Add error text to title */
            color: var(--accent-color);
            font-size: 0.8em;
            margin-left: 5px;
        }

        /* --- Recent Activity / Quick Links Section --- */
        .recent-activity, .quick-links {
            background-color: var(--card-bg);
            padding: 25px;
            border-radius: 10px;
            box-shadow: var(--shadow-light);
            margin-top: 25px; /* Space from elements above */
        }

        .section-header {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-color); /* Blue underline */
            padding-bottom: 10px;
            font-weight: 700;
        }

        .activity-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .activity-list li {
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color); /* Separator for list items */
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .activity-list li:last-child {
            border-bottom: none; /* No border for the last item */
        }

        .activity-list li .activity-icon {
            color: var(--primary-color);
            margin-right: 10px;
            font-size: 1.1rem;
            min-width: 20px; /* Align icons */
            text-align: center;
        }

        .quick-links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
        }

        .quick-link-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: var(--shadow-light);
            min-height: 100px;
            text-align: center; /* Center text if it wraps */
        }

        .quick-link-btn:hover {
            background-color: #2980b9; /* Darker primary on hover */
            transform: translateY(-5px); /* Lift effect */
            box-shadow: var(--shadow-hover);
        }

        .quick-link-btn i {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        /* --- Footer Styles --- */
        .footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: auto; /* Pushes footer to the bottom if main content is short */
            font-size: 0.85rem;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
        }

        /* --- Responsive Design --- */
        @media (max-width: 992px) {
            .sidebar {
                width: 200px;
                padding: 15px;
            }
            .sidebar.collapsed {
                width: 70px;
            }
            .sidebar nav a i {
                margin-right: 10px;
            }
            .main-content {
                padding: 15px 20px;
            }
            header {
                font-size: 1.5rem;
                padding: 15px 20px;
            }
            .welcome-message {
                font-size: 1.4rem;
            }
            .stat-card .icon {
                font-size: 3rem;
            }
            .stat-card .count {
                font-size: 2.2rem;
            }
            .section-header {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column; /* Stack sidebar and main content vertically */
            }
            .sidebar {
                width: 100%;
                height: auto; /* Allow sidebar height to adjust */
                position: static; /* No longer fixed */
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                padding: 15px;
            }
            .sidebar .logo {
                margin-bottom: 15px;
            }
            .sidebar nav {
                display: flex;
                flex-wrap: wrap; /* Allow navigation items to wrap */
                justify-content: center;
                margin-top: 15px;
            }
            .sidebar nav ul {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                width: 100%; /* Take full width for wrapping */
            }
            .sidebar nav ul li {
                margin: 5px 8px; /* Horizontal spacing for menu items */
            }
            .sidebar nav a {
                padding: 8px 12px;
                font-size: 0.9rem;
                flex-direction: column; /* Stack icon and text vertically */
                min-width: 80px; /* Ensure a minimum button width */
            }
            .sidebar nav a i {
                margin-right: 0; /* Remove horizontal margin */
                margin-bottom: 5px; /* Add vertical margin */
            }
            .sidebar.collapsed {
                width: 100%; /* Collapsed state effectively becomes the mobile layout */
            }
            .sidebar .logout-link {
                padding-top: 10px;
                margin-top: 10px;
                border-top: 1px solid rgba(255,255,255,0.1);
            }

            .main-content {
                padding: 15px;
                margin-left: 0; /* Remove left margin from sidebar */
            }
            header {
                flex-direction: column; /* Stack header elements */
                align-items: flex-start;
                padding: 15px;
            }
            .toggle-btn {
                display: none; /* Hide toggle button on small screens as sidebar is static */
            }
            .welcome-message {
                margin-bottom: 10px;
            }
            .dashboard-grid {
                grid-template-columns: 1fr; /* Single column for all cards */
            }
            .quick-links-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Adjust quick links grid */
            }
        }

        @media (max-width: 480px) {
            .sidebar nav a {
                padding: 6px 8px;
                font-size: 0.8rem;
                min-width: 70px;
            }
            .sidebar nav a i {
                font-size: 1rem;
            }
            .stat-card .icon {
                font-size: 2.5rem;
            }
            .stat-card .count {
                font-size: 2rem;
            }
            .quick-links-grid {
                grid-template-columns: 1fr; /* Single column for quick links too */
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.querySelector('.toggle-btn');
            const sidebar = document.querySelector('.sidebar');

            // Toggle sidebar visibility on desktop
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    // Store preference in local storage (optional)
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                });

                // Check local storage for collapse preference on load
                if (localStorage.getItem('sidebarCollapsed') === 'true') {
                    sidebar.classList.add('collapsed');
                }
            }
        });
    </script>
</head>
<body>

    <div class="sidebar">
        <div class="logo">GS ST Philippe Neri</div>
        <nav>
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                <li><a href="view_applications.php"><i class="fas fa-file-invoice"></i> <span>All Applications</span></a></li>
                <li><a href="manage_news.php"><i class="fas fa-newspaper"></i> <span>Manage News</span></a></li>
                
               
                <li><a href="manage_academics.php"><i class="fas fa-book-open"></i> <span>Manage Academics</span></a></li>
                <li><a href="manage_announcement.php"><i class="fas fa-bullhorn"></i> <span>Manage Announcements</span></a></li>
                <li><a href="manage_holiday.php"><i class="fas fa-calendar-alt"></i> <span>Manage Holidays</span></a></li>
               
                 <li><a href="admin_overview.php"><i class="school_background"></i> <span>update school background</span></a></li>
                <li><a href="admin_settings.php"><i class="fas fa-cogs"></i> <span>Settings</span></a></li>
            </ul>
        </nav>
        <div class="logout-link">
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Log Out</span></a>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="welcome-message">Welcome, <span>Admin</span></div>
            <button class="toggle-btn" title="Toggle Sidebar">
                <i class="fas fa-bars"></i>
            </button>
        </header>

        <?php if (isset($error_message)): ?>
            <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin-top: 20px;">
                <p><strong>Error:</strong> <?php echo htmlspecialchars($error_message); ?></p>
            </div>
        <?php endif; ?>

        <section class="quick-links">
            <h2 class="section-header">Quick Actions</h2>
            <div class="quick-links-grid">
                <a href="register_teacher.php" class="quick-link-btn">
                    <i class="fas fa-user-plus"></i>
                    Add Teacher
                </a>
                <a href="manage_news.php" class="quick-link-btn">
                    <i class="fas fa-plus-square"></i>
                    New News Post
                </a>
                <a href="manage_announcement.php" class="quick-link-btn">
                    <i class="fas fa-plus-circle"></i>
                    New Announcement
                </a>
                    <a href="view_applications.php" class="quick-link-btn">
                    <i class="fas fa-eye"></i>
                    View Applications
                </a>
                    <a href="admin_settings.php" class="quick-link-btn">
                    <i class="fas fa-sliders-h"></i>
                    Site Settings
                </a>
            </div>
        </section>

        <section class="recent-activity">
            <h2 class="section-header">Recent Activity</h2>
            <div class="activity-list">
                <ul>
                    <li><i class="activity-icon fas fa-check-circle"></i> Admin 'John Doe' logged in successfully. <small>(Just now)</small></li>
                    <li><i class="activity-icon fas fa-plus"></i> New News Post: "Inter-School Sports Day Announced" added. <small>(15 minutes ago)</small></li>
                    <li><i class="activity-icon fas fa-edit"></i> Teacher 'Mukamisha Jane' profile updated. <small>(1 hour ago)</small></li>
                    <li><i class="activity-icon fas fa-file-alt"></i> New application submitted by 'Kwizera David'. <small>(3 hours ago)</small></li>
                    <li><i class="activity-icon fas fa-bell"></i> New Academic Post: "Term 2 Exam Schedule" published. <small>(Yesterday)</small></li>
                </ul>
            </div>
        </section>
    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> GS ST Philippe Neri - Admin Dashboard. All Rights Reserved.
    </div>

</body>
</html>