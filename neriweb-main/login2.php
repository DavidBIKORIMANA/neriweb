
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General page styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            transition: all 0.3s ease;
        }

        .login-container:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        /* Welcome Message */
        .welcome-message {
            text-align: center;
            font-size: 20px;
            color: #3498db;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #3498db;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            font-size: 16px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border-radius: 8px;
            border: 2px solid #ddd;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #3498db;
            outline: none;
        }

        .form-footer {
            text-align: center;
        }

        .btn {
            background-color: #3498db;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .error {
            color: #e74c3c;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .link-container {
            text-align: center;
            margin-top: 20px;
        }

        .admin-link,
        .student-link {
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin: 5px;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .admin-link:hover,
        .student-link:hover {
            text-decoration: none;
            background-color: #3498db;
            color: white;
            transform: translateY(-3px);
        }

        .admin-link:active,
        .student-link:active {
            transform: translateY(1px);
        }

    </style>
</head>
<body>

    <div class="login-container">
        <!-- Welcome Message -->
        <div class="welcome-message">Welcome to GS ST PHILPPE NERI GISAGARA </div>

        

        </form>

        <!-- Link to Admin Login and Student Login -->
        <div class="link-container">
            <a href="login.php" class="admin-link">Log in as Admin</a>
            <a href="teacher_login.php" class="student-link">Log in as teacher</a>
        </div>
    </div>

</body>
</html>
