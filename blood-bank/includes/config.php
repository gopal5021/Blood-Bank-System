<?php
// 🔐 Hide errors in production
error_reporting(0);
ini_set('display_errors', 0);

$conn = new mysqli("localhost", "root", "", "blood_bank");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
