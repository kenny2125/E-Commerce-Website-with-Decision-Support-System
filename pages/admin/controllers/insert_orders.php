<?php
// Database Connection
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";

$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $payment_status = $conn->real_escape_string($_POST['payment_status']);
    $pickup_status = $conn->real_escape_string($_POST['pickup_status']);
    $product_ID = intval($_POST['product_ID']); // Get product ID as integer
    $total = floatval($_POST['total']); // Convert total to float
    $order_date = $conn->real_escape_string($_POST['order_date']);
    $walk_name = $conn->real_escape_string($_POST['walk_name']);

    // Set user_ID to 0 for walk-in buyers
    $user_ID = 1;

    // Insert order into tbl_orders
    $sql = "INSERT INTO tbl_orders (payment_status, user_ID, walk_name, pickup_status, product_ID, total, order_date) 
            VALUES ('$payment_status', '$user_ID', '$walk_name', '$pickup_status', '$product_ID', '$total', '$order_date')";

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
