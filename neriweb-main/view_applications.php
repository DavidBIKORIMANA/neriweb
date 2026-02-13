<?php
// Include DB connection
require 'db.php';

// Handle CSV Export - This MUST stay at the very top before any HTML or spaces
if (isset($_GET['export']) && isset($_GET['status_type'])) {
    if (ob_get_level()) ob_end_clean();
    
    $status_type = mysqli_real_escape_string($conn, $_GET['status_type']);
    $filename = "GS_PhilippeNeri_Learners_" . ($status_type ?: 'All') . "_" . date('Y-m-d') . ".csv";
    
    $export_sql = "SELECT id, first_name, last_name, gender, email, phone, province, district, sector, applied_class, prev_school, question1, question2, question3, status, submitted_at FROM learners";
    if ($status_type !== 'all') {
        $export_sql .= " WHERE status = '$status_type'";
    }
    $export_sql .= " ORDER BY submitted_at DESC";
    
    $export_res = mysqli_query($conn, $export_sql);
    
    if ($export_res) {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');
        
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        fputcsv($output, array(
            'ID', 'First Name', 'Last Name', 'Gender', 'Email', 'Phone', 'Province', 'District', 'Sector',
            'Applied Class', 'Previous School', 'Why Us', 'Strengths', 'Goals', 
            'Status', 'Submission Date'
        ));
        
        while ($row = mysqli_fetch_assoc($export_res)) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit();
    }
}

// Handle Status Updates
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $action = $_GET['action'];
    $status = ($action === 'approve') ? 'Approved' : (($action === 'reject') ? 'Rejected' : 'Pending');
    
    $update_sql = "UPDATE learners SET status = '$status' WHERE id = '$id'";
    mysqli_query($conn, $update_sql);
    
    header("Location: dashboard.html");
    exit();
}

// Fetch all learner applications
$sql = "SELECT * FROM learners ORDER BY submitted_at DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Stats
$districts_sql = "SELECT COUNT(DISTINCT district) as d_count FROM learners";
$d_result = mysqli_query($conn, $districts_sql);
$d_row = mysqli_fetch_assoc($d_result);
$unique_districts = $d_row['d_count'] ?? 0;
$total_applications = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - GS ST Philippe Neri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        
        /* Restoring Status Badge Styles */
        .status-Approved { background: #dcfce7; color: #166534; }
        .status-Rejected { background: #fee2e2; color: #991b1b; }
        .status-Pending { background: #fef9c3; color: #854d0e; }
        
        /* Restoring Answer Card Styles */
        .answer-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px; }
        
        /* Restoring Score Colors */
        .score-high { color: #16a34a; }
        .score-mid { color: #ea580c; }
        .score-low { color: #dc2626; }

        .app-card { transition: transform 0.2s ease; }
        .app-card:hover { transform: translateY(-2px); }
    </style>
</head>
<body class="p-4 md:p-8">

    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-800 text-slate-900 tracking-tight">Applications Dashboard</h1>
                <p class="text-slate-500 font-medium">GS ST Philippe Neri Admissions Portal</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative">
                    <input type="text" id="searchInput" onkeyup="filterApplications()" 
                        class="pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl bg-white text-sm focus:ring-2 focus:ring-indigo-500 outline-none w-64" 
                        placeholder="Search students...">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="fas fa-search text-xs"></i></span>
                </div>

                <div class="relative group inline-block">
                    <button class="bg-white border border-slate-200 px-5 py-2.5 rounded-xl font-semibold text-slate-700 hover:bg-slate-50 transition flex items-center gap-2">
                        <i class="fas fa-download text-indigo-500"></i> Export CSV
                    </button>
                    <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white border border-slate-100 rounded-xl shadow-xl z-50 overflow-hidden">
                        <a href="?export=true&status_type=all" class="block px-4 py-3 text-xs font-bold hover:bg-slate-50">Export All</a>
                        <a href="?export=true&status_type=Approved" class="block px-4 py-3 text-xs font-bold text-green-700 hover:bg-green-50">Export Approved</a>
                        <a href="?export=true&status_type=Rejected" class="block px-4 py-3 text-xs font-bold text-red-700 hover:bg-red-50">Export Rejected</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Total Apps</p>
                <h3 class="text-2xl font-800 text-slate-900"><?php echo $total_applications; ?></h3>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Districts</p>
                <h3 class="text-2xl font-800 text-slate-900"><?php echo $unique_districts; ?></h3>
            </div>
        </div>

        <!-- Application List -->
        <div id="cardView" class="space-y-6">
            <?php 
            if (mysqli_num_rows($result) > 0):
                mysqli_data_seek($result, 0); 
                while($row = mysqli_fetch_assoc($result)): 
                    $current_status = $row['status'] ?? 'Pending';
                    
                    // IMPROVED AUTO-MARKING LOGIC
                    $score = 0;
                    $q1 = trim($row['question1']);
                    $q2 = trim($row['question2']);
                    $q3 = trim($row['question3']);
                    $all_text = strtolower($q1 . " " . $q2 . " " . $q3);
                    
                    $has_letters = preg_match('/[a-zA-Z]{3,}/', $all_text);
                    
                    if ($has_letters) {
                        $clean_text_len = strlen(preg_replace('/[^a-zA-Z]/', '', $all_text));
                        if($clean_text_len > 150) $score += 4;
                        elseif($clean_text_len > 40) $score += 2;
                        
                        $high_value = ['doctor', 'reputation', 'discipline', 'scientist', 'engineer', 'future'];
                        foreach($high_value as $word) {
                            if(strpos($all_text, $word) !== false) $score += 2;
                        }

                        $std_value = ['study', 'learn', 'work', 'time', 'good', 'smart', 'school'];
                        foreach($std_value as $word) {
                            if(strpos($all_text, $word) !== false) $score += 1;
                        }
                    }

                    $final_score = min($score, 10);
                    $score_class = ($final_score >= 7) ? 'score-high' : (($final_score >= 4) ? 'score-mid' : 'score-low');
                    $searchable = htmlspecialchars(strtolower($row['first_name'] . ' ' . $row['last_name'] . ' ' . $row['district'] . ' ' . $row['applied_class']));
            ?>
            <div class="app-card bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm" data-searchable="<?php echo $searchable; ?>">
                <!-- Top Info -->
                <div class="flex flex-wrap justify-between items-start gap-4 mb-6 border-b border-slate-50 pb-6">
                    <div class="flex gap-5">
                        <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white text-xl font-bold">
                            <?php echo strtoupper(substr($row['first_name'], 0, 1)); ?>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 rounded status-<?php echo $current_status; ?>">
                                    <?php echo $current_status; ?>
                                </span>
                                <span class="text-xs font-bold <?php echo $score_class; ?>">
                                    <i class="fas fa-star mr-1"></i> Auto-Mark: <?php echo $final_score; ?>/10
                                </span>
                            </div>
                            <h2 class="text-xl font-bold text-slate-900"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h2>
                            <p class="text-sm text-slate-500"><?php echo htmlspecialchars($row['email']); ?> | <?php echo htmlspecialchars($row['phone']); ?></p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <?php if(!empty($row['school_report'])): ?>
                        <a href="<?php echo htmlspecialchars($row['school_report']); ?>" target="_blank" class="bg-indigo-50 text-indigo-600 px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-100 transition">
                            VIEW REPORT
                        </a>
                        <?php endif; ?>
                        <a href="?action=approve&id=<?php echo $row['id']; ?>" class="bg-green-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-green-700 transition shadow-sm">APPROVE</a>
                        <a href="?action=reject&id=<?php echo $row['id']; ?>" class="bg-red-50 text-red-600 px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-100 transition">REJECT</a>
                    </div>
                </div>

                <!-- Bio Data -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Target Class</p>
                        <p class="font-bold text-slate-800"><?php echo htmlspecialchars($row['applied_class']); ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Location</p>
                        <p class="font-bold text-slate-800"><?php echo htmlspecialchars($row['district']); ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Prev School</p>
                        <p class="font-bold text-slate-800 truncate"><?php echo htmlspecialchars($row['prev_school']); ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Submitted</p>
                        <p class="font-bold text-slate-800"><?php echo date('M d, Y', strtotime($row['submitted_at'])); ?></p>
                    </div>
                </div>

                <!-- Answer Viewer -->
                <div class="space-y-4">
                    <h3 class="text-xs font-800 text-slate-400 uppercase tracking-widest">Application Answers</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="answer-card">
                            <p class="text-[9px] font-bold text-indigo-500 uppercase mb-2">1. Why GS St Philippe Neri?</p>
                            <p class="text-xs text-slate-600 leading-relaxed"><?php echo nl2br(htmlspecialchars($row['question1'] ?: 'N/A')); ?></p>
                        </div>
                        <div class="answer-card">
                            <p class="text-[9px] font-bold text-indigo-500 uppercase mb-2">2. Academic Background</p>
                            <p class="text-xs text-slate-600 leading-relaxed"><?php echo nl2br(htmlspecialchars($row['question2'] ?: 'N/A')); ?></p>
                        </div>
                        <div class="answer-card">
                            <p class="text-[9px] font-bold text-indigo-500 uppercase mb-2">3. Future Aspirations</p>
                            <p class="text-xs text-slate-600 leading-relaxed"><?php echo nl2br(htmlspecialchars($row['question3'] ?: 'N/A')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; else: ?>
            <div class="text-center py-20 bg-white rounded-3xl border border-slate-200">
                <p class="text-slate-400 font-medium">No applications found.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function filterApplications() {
            const filter = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.app-card');
            cards.forEach(card => {
                const text = card.getAttribute('data-searchable') || '';
                card.style.display = text.includes(filter) ? "" : "none";
            });
        }
    </script>

</body>
</html>
<?php mysqli_close($conn); ?>