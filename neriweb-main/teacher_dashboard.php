<?php
session_start();

// Check if teacher is logged in
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: teacher_login.php");
    exit();
}

// DB connection
$host = 'localhost';
$dbname = 'philippeneri';
$username = 'root'; // Make sure this is correct for your setup
$password = ''; // Make sure this is correct for your setup

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Recommended for security
} catch (PDOException $e) {
    die("<h1>Database connection failed:</h1><p>Please check your database configuration. Error: " . $e->getMessage() . "</p>");
}

// Get teacher info
$teacher_id = $_SESSION['id'];
// IMPORTANT: Reverted this line based on your previous error, assuming 'user' table exists
$stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?"); // Use 'user' table if 'teachers' table doesn't exist
$stmt->execute([$teacher_id]);
$teacher = $stmt->fetch(PDO::FETCH_ASSOC);

// If teacher not found, log out
if (!$teacher) {
    header("Location: teacher_login.php");
    exit();
}

// No longer fetching counts or displaying stat cards.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - GS ST Philippe Neri</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        :root {
            --primary-color: #1abc9c; /* Green - Teacher theme color */
            --secondary-color: #2c3e50; /* Dark Blue - Shared accent */
            --accent-color: #e67e22; /* Orange - For alerts/highlights */
            --text-color: #333;
            --light-bg: #ecf0f1; /* Light grey background */
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
            width: 250px;
            background-color: var(--secondary-color);
            color: white;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color); /* Teacher primary color */
            text-transform: uppercase;
            white-space: nowrap;
            overflow: hidden;
        }
        .sidebar.collapsed .logo {
            font-size: 1.2rem;
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
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-size: 0.95rem;
        }

        .sidebar nav a i {
            margin-right: 15px;
            font-size: 1.1rem;
            min-width: 20px;
            text-align: center;
        }

        .sidebar nav a span {
            display: inline-block;
            transition: opacity 0.3s ease, width 0.3s ease;
            overflow: hidden;
            white-space: nowrap;
        }

        .sidebar.collapsed nav a span {
            opacity: 0;
            width: 0;
        }

        .sidebar nav a:hover {
            background-color: #34495e; /* Darker secondary on hover */
            transform: translateX(5px);
        }

        .sidebar .logout-link {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            text-align: center;
        }

        .sidebar .logout-link a {
            background-color: var(--accent-color); /* Orange for logout */
            justify-content: center;
        }
        .sidebar .logout-link a:hover {
            background-color: #d35400; /* Darker orange */
            transform: scale(1.02);
        }

        /* --- Main Content Styles --- */
        .main-content {
            flex-grow: 1;
            padding: 20px 30px;
            overflow-x: hidden;
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
            color: var(--primary-color); /* Teacher primary color */
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

        /* --- No Stat Cards - grid styles removed for this section --- */
        /* --- Recent Activity / Quick Links Section --- */
        .recent-activity, .quick-links {
            background-color: var(--card-bg);
            padding: 25px;
            border-radius: 10px;
            box-shadow: var(--shadow-light);
            margin-top: 25px; /* Adjust margin if no stat cards above */
        }

        .section-header {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-color); /* Teacher primary color */
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
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .activity-list li:last-child {
            border-bottom: none;
        }

        .activity-list li .activity-icon {
            color: var(--primary-color); /* Teacher primary color */
            margin-right: 10px;
            font-size: 1.1rem;
            min-width: 20px;
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
            background-color: var(--primary-color); /* Teacher primary color */
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: var(--shadow-light);
            min-height: 100px;
            text-align: center;
        }

        .quick-link-btn:hover {
            background-color: #16a085; /* Darker primary on hover */
            transform: translateY(-5px);
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
            margin-top: auto;
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
            .section-header {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                padding: 15px;
            }
            .sidebar .logo {
                margin-bottom: 15px;
            }
            .sidebar nav {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin-top: 15px;
            }
            .sidebar nav ul {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                width: 100%;
            }
            .sidebar nav ul li {
                margin: 5px 8px;
            }
            .sidebar nav a {
                padding: 8px 12px;
                font-size: 0.9rem;
                flex-direction: column;
                min-width: 80px;
            }
            .sidebar nav a i {
                margin-right: 0;
                margin-bottom: 5px;
            }
            .sidebar.collapsed {
                width: 100%;
            }
            .sidebar .logout-link {
                padding-top: 10px;
                margin-top: 10px;
                border-top: 1px solid rgba(255,255,255,0.1);
            }

            .main-content {
                padding: 15px;
                margin-left: 0;
            }
            header {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px;
            }
            .toggle-btn {
                display: none;
            }
            .welcome-message {
                margin-bottom: 10px;
            }
            .quick-links-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
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
            .quick-links-grid {
                grid-template-columns: 1fr;
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
                    localStorage.setItem('sidebarCollapsedTeacher', sidebar.classList.contains('collapsed'));
                });

                // Check local storage for collapse preference on load
                if (localStorage.getItem('sidebarCollapsedTeacher') === 'true') {
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
                <li><a href="teacher_dashboard.php"><i class="fas fa-home"></i> <span>Home</span></a></li>
               
                <li><a href="classreport.php"><i class="fas fa-chart-line"></i> <span>Class Reports</span></a></li>
                <li><a href="upload_holiday.php"><i class="fas fa-cloud-upload-alt"></i> <span>Add Holiday Post</span></a></li>
                <li><a href="teacher_settings.php"><i class="fas fa-cogs"></i> <span>Settings</span></a></li>
            </ul>
        </nav>
        <div class="logout-link">
            <a href="logout4.php"><i class="fas fa-sign-out-alt"></i> <span>Log Out</span></a>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="welcome-message">Welcome, <span><?php echo htmlspecialchars($teacher['username']); ?></span>!</div>
            <button class="toggle-btn" title="Toggle Sidebar">
                <i class="fas fa-bars"></i>
            </button>
        </header>

        <section class="quick-links" style="margin-top: 0;">
            <h2 class="section-header">Quick Actions</h2>
            <div class="quick-links-grid">
                <a href="classreport.php" class="quick-link-btn">
                    <i class="fas fa-chart-bar"></i>
                    View Reports
                </a>
            </div>
        </section>

        <section class="recent-activity">
            <h2 class="section-header">Recent Activity</h2>
            <div class="activity-list">
                <ul>
                    <li><i class="activity-icon fas fa-check-circle"></i> Logged in to dashboard. <small>(Just now)</small></li>
                    <li><i class="activity-icon fas fa-calendar-plus"></i> Holiday post for 'Mid-Term Break' uploaded. <small>(Yesterday)</small></li>
                </ul>
            </div>
        </section>

    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> GS St. Philippe Neri. All Rights Reserved.
    </div>

</body>
</html>