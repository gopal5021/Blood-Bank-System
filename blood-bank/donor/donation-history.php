<?php
session_start();
if (!isset($_SESSION["donor_name"])) {
    echo "Access denied. <a href='login.php'>Login</a>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Donation History</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<img src="../image/4bags.jpg" class="bags" alt="Blood Bags">

<div class="center-container">
    <h2 class="welcome">📜 Donation History</h2>
    <p class="contact-box">Hello <strong><?php echo $_SESSION["donor_name"]; ?></strong>,</p>
    <p class="contact-box">This feature is currently under development. Stay tuned!</p>
    <p><a href="donor-dashboard.php">⬅️ Back to Dashboard</a></p>
</div>
<footer class="footer">
    <p>&copy; 2025 Blood Bank System | Designed by Gopal Ramakant Soni</p>
</footer>
</body>
</html>
