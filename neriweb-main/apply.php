<?php
/**
 * Database Configuration
 * Based on your phpMyAdmin screenshot:
 * Host: 127.0.0.1
 * Database: philippeneri
 * Table: learners
 */

$host = '127.0.0.1';
$db   = 'philippeneri';
$user = 'root'; // Default XAMPP/WAMP user
$pass = '';     // Default XAMPP/WAMP password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$message = "";
$status = "";

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Handle File Upload for school_report
        $reportPath = "";
        if (isset($_FILES['school_report']) && $_FILES['school_report']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/reports/';
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileExtension = pathinfo($_FILES['school_report']['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('report_', true) . '.' . $fileExtension;
            $targetPath = $uploadDir . $newFileName;

            if (move_uploaded_file($_FILES['school_report']['tmp_name'], $targetPath)) {
                $reportPath = $targetPath;
            }
        }

        $sql = "INSERT INTO learners (
                    first_name, last_name, gender, birthday, email, phone, 
                    province, district, sector, prev_school, school_background, 
                    sports, school_report, question1, question2, question3, 
                    applied_class, created_at, submitted_at
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()
                )";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['gender'],
            $_POST['birthday'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['province'],
            $_POST['district'],
            $_POST['sector'],
            $_POST['prev_school'],
            $_POST['school_background'],
            $_POST['sports'],
            $reportPath, // Saving the file path to database
            $_POST['question1'],
            $_POST['question2'],
            $_POST['question3'],
            $_POST['applied_class']
        ]);

        $status = "success";
        $message = "Application submitted successfully for " . htmlspecialchars($_POST['first_name']) . "!";
    } catch (Exception $e) {
        $status = "error";
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learner Registration - GS ST Philippe Neri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-input {
            transition: all 0.2s ease-in-out;
            border: 1.5px solid #e2e8f0;
        }
        .form-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: none;
        }
        .section-header {
            position: relative;
            padding-bottom: 0.5rem;
        }
        .section-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: #2563eb;
            border-radius: 2px;
        }
        .upload-area {
            border: 2px dashed #cbd5e1;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            border-color: #2563eb;
            background: #f8fafc;
        }
    </style>
</head>
<body class="py-12 px-4">

    <div class="max-w-4xl mx-auto glass-card rounded-2xl shadow-2xl overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-700 to-indigo-800 p-8 text-white relative">
            <div class="absolute top-0 right-0 p-8 opacity-10">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3L1 9L12 15L21 10.09V17H23V9M5 13.18V17.18L12 21L19 17.18V13.18L12 17L5 13.18Z"/></svg>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight mb-2">GS ST Philippe Neri</h1>
            <p class="text-blue-100 font-medium opacity-90">Official Learner Application Portal</p>
        </div>

        <?php if ($message): ?>
            <div class="m-8 p-4 rounded-xl flex items-center gap-3 <?php echo $status === 'success' ? 'bg-green-50 text-green-800 border border-green-200' : 'bg-red-50 text-red-800 border border-red-200'; ?>">
                <?php if($status === 'success'): ?>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php else: ?>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php endif; ?>
                <span class="font-semibold"><?php echo $message; ?></span>
            </div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="p-8 lg:p-12 space-y-10">
            
            <!-- Section 1: Personal -->
            <section class="space-y-6">
                <div class="section-header">
                    <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider text-sm">Personal Identity</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter">First Name</label>
                        <input type="text" name="first_name" required class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm focus:bg-white transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter">Last Name</label>
                        <input type="text" name="last_name" required class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm focus:bg-white transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter">Gender Identity</label>
                        <select name="gender" class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm focus:bg-white transition-all">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter">Date of Birth</label>
                        <input type="date" name="birthday" required class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm focus:bg-white transition-all">
                    </div>
                </div>
            </section>

            <!-- Section 2: Contact -->
            <section class="space-y-6">
                <div class="section-header">
                    <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider text-sm">Contact Details</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter">Email Address</label>
                        <input type="email" name="email" required placeholder="example@mail.com" class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm focus:bg-white transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter">Phone Number</label>
                        <input type="tel" name="phone" required placeholder="+250 7XX XXX XXX" class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm focus:bg-white transition-all">
                    </div>
                    <div class="md:col-span-2 grid grid-cols-3 gap-4">
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase">Province</label>
                            <input type="text" name="province" required class="form-input block w-full rounded-lg bg-gray-50 px-4 py-2 text-gray-900 shadow-sm focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase">District</label>
                            <input type="text" name="district" required class="form-input block w-full rounded-lg bg-gray-50 px-4 py-2 text-gray-900 shadow-sm focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase">Sector</label>
                            <input type="text" name="sector" required class="form-input block w-full rounded-lg bg-gray-50 px-4 py-2 text-gray-900 shadow-sm focus:bg-white transition-all">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section 3: Academic -->
            <section class="space-y-6 bg-blue-50/50 p-6 rounded-2xl border border-blue-100">
                <div class="section-header">
                    <h2 class="text-xl font-bold text-blue-900 uppercase tracking-wider text-sm">Academic History</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-blue-700 uppercase tracking-tighter">Previous School</label>
                        <input type="text" name="prev_school" required class="form-input block w-full rounded-lg bg-white px-4 py-3 text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-blue-700 uppercase tracking-tighter">Target Class</label>
                        <input type="text" name="applied_class" placeholder="e.g. Senior 4 MCB" required class="form-input block w-full rounded-lg bg-white px-4 py-3 text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-bold text-blue-700 uppercase tracking-tighter">Report Card Upload</label>
                        <div class="upload-area relative rounded-xl p-4 text-center cursor-pointer bg-white">
                            <input type="file" name="school_report" accept=".pdf,.jpg,.jpeg,.png" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="text-sm text-gray-600"><span class="font-bold text-blue-600">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-400 mt-1">PDF, JPG or PNG (Max 5MB)</p>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2 space-y-1">
                        <label class="block text-xs font-bold text-blue-700 uppercase tracking-tighter">School Background Summary</label>
                        <textarea name="school_background" rows="3" class="form-input block w-full rounded-lg bg-white px-4 py-3 text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Tell us briefly about your academic journey..."></textarea>
                    </div>
                </div>
            </section>

            <!-- Section 4: Extra -->
            <section class="space-y-6">
                <div class="section-header">
                    <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider text-sm">Talents & Motivations</h2>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-tighter">Sports & Extra-Curricular Talents</label>
                        <input type="text" name="sports" class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm transition-all">
                    </div>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700 italic">"Why is GS ST Philippe Neri your school of choice?"</label>
                            <input type="text" name="question1" class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700 italic">"What are your future career aspirations?"</label>
                            <input type="text" name="question2" class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm transition-all">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700 italic">"Any specific health considerations we should know?"</label>
                            <input type="text" name="question3" class="form-input block w-full rounded-lg bg-gray-50 px-4 py-3 text-gray-900 shadow-sm transition-all">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Submit Button -->
            <div class="pt-10">
                <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-lg font-bold rounded-xl text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-xl hover:shadow-2xl">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-blue-400 group-hover:text-blue-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                    </span>
                    Submit Final Application
                </button>
                <p class="text-center text-xs text-gray-400 mt-4 uppercase tracking-widest font-semibold">Privacy Guaranteed &bullet; SECURE TRANSMISSION</p>
            </div>
        </form>
    </div>

</body>
</html>