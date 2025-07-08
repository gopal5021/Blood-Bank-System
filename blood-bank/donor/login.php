<?php
include('../includes/config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM donors WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();

        // Compare plain text password
        if ($user["password"] === $password) {
            $_SESSION["donor_name"] = $user["name"];
            header("Location: donor-dashboard.php");
            exit;
        } else {
            $error = "❌ Invalid password.";
        }
    } else {
        $error = "❌ Email not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Donor Login</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <img src="../image/4bags.jpg" class="bags" alt="Blood Bags">
    <div class="center-container">
        <h2 class="welcome">🔐 Donor Login</h2>

        <?php if (isset($error)) {
            echo "<p style='color:red; font-weight:bold;'>$error</p>";
        } ?>

        <form method="post">
            Email: <input type="email" name="email" required><br><br>
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
