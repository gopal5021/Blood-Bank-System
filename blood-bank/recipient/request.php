<?php
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $blood_group = htmlspecialchars(trim($_POST["blood_group"]));
    $reason = htmlspecialchars(trim($_POST["reason"]));
    $contact = htmlspecialchars(trim($_POST["contact"]));

    if (empty($name) || empty($blood_group) || empty($reason) || empty($contact)) {
        echo "All fields are required.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO recipients (name, blood_group, reason, contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $blood_group, $reason, $contact);
    
    if ($stmt->execute()) {
        echo "Blood request submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Blood</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<img src="../image/4bags.jpg" class="bags">

<div class="center-container">
    <h2 class="welcome">🤕 Request Blood</h2>
    <form method="post">
        Name: <input type="text" name="name" required><br><br>
        Blood Group: <input type="text" name="blood_group" required><br><br>
        Reason: <textarea name="reason" required></textarea><br><br>
        Contact: <input type="text" name="contact" required><br><br>
        <input type="submit" value="Submit Request">
    </form>

    <p><a href="../index.php">⬅️ Back to Home</a></p>
</div>
<footer class="footer">
    <p>&copy; 2025 Blood Bank System | Designed by Gopal Ramakant Soni</p>
</footer>
</body>
</html>
