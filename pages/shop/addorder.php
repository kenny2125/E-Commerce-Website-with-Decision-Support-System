<?php
session_start();

// Make sure the user is logged in
if (!isset($_SESSION['user_ID'])) {
    die("You must be logged in to place an order.");
}

// Get the user ID from the session
$userID = $_SESSION['user_ID'];

// Get the total amount from the hidden field (submitted from the form)
$totalAmount = isset($_POST['amount']) ? $_POST['amount'] / 100 : 0; // Convert from cents to PHP currency

// Get pickup method (store or delivery) from the form
$pickupMethod = isset($_POST['pickup-method']) ? $_POST['pickup-method'] : 'store';

// Set payment status for COD to "PENDING"
$paymentStatus = "PENDING";

// Get the current date
$orderDate = date('Y-m-d');

// Database connection (adjust as needed)
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";
$port = "3306";

$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert the order into the tbl_orders table (direct query)
$sql = "INSERT INTO tbl_orders (user_ID, payment_status, pickup_status, order_date, total) 
        VALUES ($userID, '$paymentStatus', '$pickupMethod', '$orderDate', $totalAmount)";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
    // Optionally redirect to a confirmation page or order details page
    header("Location: ../user/user_profile.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

// Close connection
$conn->close();
?>
