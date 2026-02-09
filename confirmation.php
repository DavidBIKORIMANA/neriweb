<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';

if ($status == 'success') {
    echo "<h2>Payment Successful!</h2>";
    echo "<p>Your payment has been recorded. Thank you.</p>";
} else {
    echo "<h2>Payment Failed!</h2>";
    echo "<p>There was an issue processing your request.</p>";
}
?>
