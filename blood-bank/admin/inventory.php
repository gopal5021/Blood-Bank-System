<?php
include('../includes/config.php');
session_start();

if (!isset($_SESSION['admin'])) {
    echo "Access denied. <a href='login.php'>Login</a>";
    exit;
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group = $_POST['blood_group'];
    $action = $_POST['action'];
    $units = intval($_POST['units']);

    $check = $conn->prepare("SELECT units FROM blood_inventory WHERE blood_group = ?");
    $check->bind_param("s", $group);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $current_units = $row['units'];

        if ($action === 'add') {
            $new_units = $current_units + $units;
        } elseif ($action === 'remove') {
            $new_units = max(0, $current_units - $units);
        }

        $update = $conn->prepare("UPDATE blood_inventory SET units = ? WHERE blood_group = ?");
        $update->bind_param("is", $new_units, $group);
        $update->execute();

        $msg = "<p style='color:green; font-weight:bold;'> Inventory updated for <b>$group</b> New units: <b>$new_units</b></p>";
    } else {
        $msg = "<p style='color:red; font-weight:bold;'> Blood group $group not found in inventory.</p>";
    }
}

// Display inventory
$result = $conn->query("SELECT * FROM blood_inventory ORDER BY blood_group ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Inventory</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<img src="../image/4bags.jpg" class="bags">
<div class="center-container">
    <h2 class="welcome">🧪 Blood Inventory</h2>

    <?php if (isset($msg)) echo $msg; ?>

    <table border="1" cellpadding="10" class="inventory-table">
        <tr>
            <th>Blood Group</th>
            <th>Units</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['blood_group']; ?></td>
                <td><?php echo $row['units']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <h3 style="margin-top: 30px;">Update Inventory</h3>
    <form method="post" class="form-box">
        <label>Blood Group:</label>
        <select name="blood_group" required>
            <option value="">-- Select Blood Group --</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select><br><br>

        <label>Units:</label>
        <select name="units" required>
            <option value="">-- Select Units --</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select><br><br>

        <label>Action:</label>
        <select name="action" required>
            <option value="">-- Add / Remove --</option>
            <option value="add">Add</option>
            <option value="remove">Remove</option>
        </select><br><br>

        <input type="submit" value="Update Inventory">
    </form>

    <p style="margin-top: 20px;"><a href="dashboard.php">⬅️ Back to Admin Dashboard</a></p>
</div>
</body>
</html>
