<?php
// Database Connection
include '../../../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $payment_status = $conn->real_escape_string($_POST['payment_status']);
    $pickup_status = $conn->real_escape_string($_POST['pickup_status']);
    $product_ID = intval($_POST['product_ID']); // Get product ID as integer
    $total = floatval($_POST['total']); // Convert total to float
    $order_date = $conn->real_escape_string($_POST['order_date']);
    $walk_name = $conn->real_escape_string($_POST['walk_name']);
    $payment_method = $conn->real_escape_string($_POST['payment_method']); // Get payment method

    // Set user_ID to 0 for walk-in buyers
    $user_ID = 1;

    // Insert order into tbl_orders, including payment_method
    $sql = "INSERT INTO tbl_orders (payment_status, user_ID, walk_name, pickup_status, product_ID, total, order_date, payment_method) 
            VALUES ('$payment_status', '$user_ID', '$walk_name', '$pickup_status', '$product_ID', '$total', '$order_date', '$payment_method')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to orders management page with success message
        header("Location: ../orders_management.php?success=Order added successfully.");
        exit;
    } else {
        // Error handling
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
