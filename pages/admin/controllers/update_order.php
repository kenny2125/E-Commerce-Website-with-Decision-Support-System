<?php
// Database Connection
include '../../../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $order_ID = $conn->real_escape_string($_POST['order_ID']);
    $payment_status = $conn->real_escape_string($_POST['payment_status']);
    $pickup_status = $conn->real_escape_string($_POST['pickup_status']);
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $total = $conn->real_escape_string($_POST['total']);

    // For walk-in customers, handle walk_name
    if (empty($_POST['user_ID'])) {
        $user_ID = 0;  // Walk-in customer (ID = 0)
        $walk_name = $conn->real_escape_string($_POST['walk_name']);
    } else {
        $user_ID = $conn->real_escape_string($_POST['user_ID']);
        $walk_name = null;  // Registered user (no walk_name)
    }

    // Update order in tbl_orders (no change to walk_name)
    $sql = "UPDATE tbl_orders SET 
            payment_status = '$payment_status', 
            pickup_status = '$pickup_status', 
            total = '$total'
            WHERE order_ID = '$order_ID'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to orders management page with success message
        header("Location: ../orders_management.php?success=Order updated successfully.");
    } else {
        // Error handling
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
