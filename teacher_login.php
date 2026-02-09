<?php
// FILE: teacher_login.php
session_start();

// Database connection parameters
$host = 'localhost';
$dbname = 'philippeneri';
$username_db = 'root'; // Renamed to avoid conflict with loginUsername
$password_db = '';     // Renamed to avoid conflict with loginPassword

// Initialize error message
$error = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and collect form data
    $loginUsername = trim($_POST['username'] ?? ''); // Use null coalescing and trim whitespace
    $loginPassword = $_POST['password'] ?? '';       // Password will be verified, no trim for leading/trailing space in password

    // Basic validation: Check if fields are not empty after trimming username
    if (empty($loginUsername) || empty($loginPassword)) {
        $error = "Please enter both username and password.";
    } else {
        // Connect to the database using PDO for modern, secure database interactions
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username_db, $password_db);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception for better error handling
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Fetch rows as associative arrays by default
        } catch (PDOException $e) {
            // Log the error for debugging, but show a generic message to the user
            error_log("Database connection failed: " . $e->getMessage());
            die("An unexpected database error occurred. Please try again later."); // Generic message
        }

        // Prepare SQL statement to prevent SQL injection
        // Select all user columns for the given username and teacher role
        $stmt = $pdo->prepare("SELECT id, username, password, role FROM user WHERE username = :username AND role = 'teacher'");
        $stmt->bindParam(':username', $loginUsername, PDO::PARAM_STR); // Bind parameter as string
        $stmt->execute();
        $teacher = $stmt->fetch(); // Fetch the user record

        // Verify password if a teacher user is found
        if ($teacher && password_verify($loginPassword, $teacher['password'])) {
            // Login successful: Set session variables
            $_SESSION['id'] = $teacher['id'];
            $_SESSION['username'] = $teacher['username'];
            $_SESSION['role'] = $teacher['role'];

            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true); 

            // Redirect to the teacher dashboard
            header("Location: teacher_dashboard.php");
            exit(); // Terminate script execution after redirect
        } else {
            // Invalid credentials: Use a generic message for security (don't reveal if username or password was wrong)
            $error = "Invalid username or password. Please try again.";
        }
    }
}

// If already logged in, redirect to dashboard (optional, but good UX)
if (isset($_SESSION['id']) && $_SESSION['role'] === 'teacher') {
    header("Location: teacher_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login - GS ST Philippe Neri</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #c5cae9); /* Soft gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); /* More pronounced shadow */
            width: 100%;
            max-width: 400px; /* Max width for a clean look */
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        .login-container h2 {
            color: #283593; /* A deeper blue for headings */
            margin-bottom: 25px;
            font-size: 2.2em;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .form-floating label {
            color: #6c757d; /* Lighter color for placeholder effect */
        }
        
        .form-control:focus {
            border-color: #4CAF50; /* A nice green on focus */
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }

        .btn-primary {
            background-color: #283593; /* Primary button color */
            border-color: #283593;
            padding: 12px 0;
            font-size: 1.1em;
            font-weight: 600;
            margin-top: 15px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1a237e; /* Darker on hover */
            border-color: #1a237e;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            margin-bottom: 20px;
            font-size: 0.95em;
            padding: 10px 15px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2><i class="fas fa-user-tie me-2"></i> Teacher Login</h2>
        <form method="POST" action="teacher_login.php">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                <label for="username">Username</label>
            </div>
            
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>