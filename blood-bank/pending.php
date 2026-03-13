<?php
include('includes/config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pending Requests</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<img src="image/4bags.jpg" class="bags">

<div class="center-container">
    <h2 class="welcome">🔴 Pending Blood Requests</h2>

    <?php
    $result = $conn->query("SELECT name, blood_group, reason, contact FROM recipients WHERE status = 'Pending' ORDER BY id DESC");

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>
                <tr>
                    <th>Name</th>
                    <th>Blood Group</th>
                    <th>Reason</th>
                    <th>Contact</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['blood_group']}</td>
                    <td>{$row['reason']}</td>
                    <td>{$row['contact']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No pending requests found.</p>";
    }
    ?>
    
    <p><a href="index.php">⬅️ Back to Home</a></p>
</div>
<footer class="footer">
    <p>&copy; 2025 Blood Bank System | Designed by Gopal Ramakant Soni</p>
</footer>
</body>
</html>
