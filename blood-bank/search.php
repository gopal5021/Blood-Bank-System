<?php
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $group = $_POST['blood_group'];
    $city = $_POST['city'];

    $stmt = $conn->prepare("SELECT name, city, phone, email FROM donors WHERE blood_group = ? AND city = ?");
    $stmt->bind_param("ss", $group, $city);
    $stmt->execute();
    $res = $stmt->get_result();

    $result_html = "<h3>Matching Donors</h3>";
    if ($res->num_rows > 0) {
        $result_html .= "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>";
        while ($row = $res->fetch_assoc()) {
            $result_html .= "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['city']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                  </tr>";
        }
        $result_html .= "</table>";
    } else {
        $result_html .= "No matching donors found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Donors</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<img src="image/4bags.jpg" class="bags">
<div class="center-container">
    <h2 class="welcome">🔍 Search Donors</h2>
    <form method="post">
        Blood Group: <input type="text" name="blood_group" required><br><br>
        City: <input type="text" name="city" required><br><br>
        <input type="submit" value="Search">
    </form>

    <?php if (isset($result_html)) echo $result_html; ?>

    <p><a href="index.php">⬅️ Back to Home</a></p>
</div>
<footer class="footer">
    <p>&copy; 2025 Blood Bank System | Designed by Gopal Ramakant Soni</p>
</footer>
</body>
</html>
