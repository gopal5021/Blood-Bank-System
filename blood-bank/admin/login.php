<?php
include('../includes/config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Direct match with plain text password
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php"); // ✅ redirect to admin dashboard
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<img src="../image/4bags.jpg" class="bags">

<div class="center-container">
    <h2 class="welcome">👨‍⚕️ Admin Login</h2>
    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>

    <p><a href="../index.php">⬅️ Back to Home</a></p>
</div>
<footer class="footer">
    <p>&copy; 2025 Blood Bank System | Designed by Gopal Ramakant Soni</p>
</footer>
</body>
</html>
