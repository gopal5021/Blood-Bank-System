<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['admin'])) {
    echo "Access denied. Please <a href='login.php'>login</a>.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<img src="../image/4bags.jpg" class="bags" alt="Background">

<div class="admin-links">
    <a href="inventory.php">🧪 Inventory</a> |
    <a href="logout.php">🚪 Logout</a> |
    <a href="../pending.php">🔴 Pending Requests</a>
</div>

<h2 class="welcome">Admin Dashboard</h2>

<?php
// Handle approve/reject
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == "approve" || $action == "reject") {
        $new_status = ucfirst($action);
        $stmt = $conn->prepare("UPDATE recipients SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $id);
        $stmt->execute();
        echo "<p class='status-message'>Status updated to <b>$new_status</b> for request ID $id.</p>";
    }
}

$result = $conn->query("SELECT * FROM recipients ORDER BY id DESC");

echo "<table class='admin-table'>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Blood Group</th>
    <th>Reason</th>
    <th>Contact</th>
    <th>Status</th>
    <th>Action</th>
</tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['blood_group']}</td>
                <td>{$row['reason']}</td>
                <td>{$row['contact']}</td>
                <td>{$row['status']}</td>
                <td>
                    <a href='dashboard.php?action=approve&id={$row['id']}'>Approve</a> |
                    <a href='dashboard.php?action=reject&id={$row['id']}'>Reject</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No blood requests found.</td></tr>";
}
echo "</table>";
?>

<footer class="footer">
    <p>&copy; 2025 Blood Bank System | Designed by Gopal Ramakant Soni</p>
</footer>
</body>
</html>
