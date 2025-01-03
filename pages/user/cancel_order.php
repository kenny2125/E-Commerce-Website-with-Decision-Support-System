<?php
session_start();
if (!isset($_SESSION['user_ID'])) {
    die("You must be logged in to cancel an order.");
}
$userID = $_SESSION['user_ID'];
$orderID = $_POST['order_ID'];
include '../../config/db_config.php';
$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("UPDATE tbl_orders SET payment_status = 'CANCELLED', pickup_status = 'CANCELLED' WHERE order_ID = ? AND user_ID = ?");
$stmt->bind_param("ii", $orderID, $userID);
if ($stmt->execute() && $stmt->affected_rows > 0) {
    header("Location: user_profile.php?message=Order cancelled successfully");
} else {
    header("Location: user_profile.php?error=Failed to cancel order");
}
$stmt->close();
$conn->close();
?>
