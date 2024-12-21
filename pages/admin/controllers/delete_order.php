<?php
// Database Connection
include '../../../config/db_config.php';

if (isset($_GET['order_ID'])) {
    // Get order ID from URL
    $order_ID = $conn->real_escape_string($_GET['order_ID']);

    // Delete order from tbl_orders
    $sql = "DELETE FROM tbl_orders WHERE order_ID = '$order_ID'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to orders management page with success message
        header("Location: orders_management.php?success=Order deleted successfully.");
    } else {
        // Error handling
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
