<?php
session_start();
if (!isset($_SESSION["donor_name"])) {
    echo "Access denied. Please <a href='login.php'>login</a>.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donor Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<img src="../image/4bags.jpg" class="bags" alt="Blood Bags">
<div class="center-container">
    <h2 class="welcome">👋 Welcome, <?php echo $_SESSION["donor_name"]; ?>!</h2>

    <ul>
        <li><a href="../search.php">🔍 Search Donors</a></li>
        <li><a href="../recipient/request.php">🩸 Request Blood</a></li>
        <li><a href="donation-history.php">📜 Donation History</a></li> 
        <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
</div>
<footer class="footer">
    <p>&copy; 2025 Blood Bank System | Designed by Gopal Ramakant Soni</p>
</footer>
</body>
</html>
