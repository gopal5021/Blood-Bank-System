<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<img src="../image/4bags.jpg" class="bags" alt="Blood Bags">

<div class="center-container">
    <h2 class="welcome">✅ You have been logged out successfully.</h2>
    <p><a href="../index.php">🏠 Return to Home</a></p>
</div>
<footer class="footer">
    <p>&copy; 2025 Blood Bank System | Designed by Gopal Ramakant Soni</p>
</footer>
</body>
</html>
