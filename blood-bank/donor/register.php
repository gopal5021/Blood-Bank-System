<!DOCTYPE html>
<html>
<head>
    <title>Donor Registration</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <img src="../image/4bags.jpg" class="bags">
    <div class="center-container">
        <h2 class="welcome">🩸 Donor Registration</h2>

        <?php
        include('../includes/config.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars(trim($_POST["name"]));
            $age = intval($_POST["age"]);
            $gender = htmlspecialchars(trim($_POST["gender"]));
            $blood_group = htmlspecialchars(trim($_POST["blood_group"]));
            $city = htmlspecialchars(trim($_POST["city"]));
            $phone = htmlspecialchars(trim($_POST["phone"]));
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = $_POST["password"];

            $check = $conn->prepare("SELECT * FROM donors WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $res = $check->get_result();

            if ($res->num_rows > 0) {
                echo "<p style='color:red; font-weight:bold;'>⚠️ Email already registered.</p>";
            } else {
                $stmt = $conn->prepare("INSERT INTO donors (name, age, gender, blood_group, city, phone, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sissssss", $name, $age, $gender, $blood_group, $city, $phone, $email, $password);

                if ($stmt->execute()) {
                    echo "<p style='color:green; font-weight:bold;'>✅ Donor registered successfully.</p>";
                } else {
                    echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
                }
            }
        }
        ?>

        <form method="post">
            Name: <input type="text" name="name" required><br><br>
            Age: <input type="number" name="age" required><br><br>
            Gender: 
            <input type="radio" name="gender" value="Male" required>Male 
            <input type="radio" name="gender" value="Female" required>Female<br><br>
            Blood Group: <input type="text" name="blood_group" required><br><br>
            City: <input type="text" name="city" required><br><br>
            Phone: <input type="text" name="phone" required><br><br>
            Email: <input type="email" name="email" required><br><br>
            Password: <input type="password" name="password" required><br><br>
            <input type="submit" value="Register">
        </form>

        <p><a href="login.php">🔐 Donor Login</a></p>
        <p><a href="../index.php">⬅️ Back to Home</a></p>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Blood Bank System | Designed by Gopal Ramakant Soni</p>
    </footer>
</body>
</html>
