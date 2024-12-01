<?php
// Database Connection
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
