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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $payment_status = $conn->real_escape_string($_POST['payment_status']);
    $pickup_status = $conn->real_escape_string($_POST['pickup_status']);
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $total = $conn->real_escape_string($_POST['total']);
    $order_date = $conn->real_escape_string($_POST['order_date']);
    
    // Set user_ID to 0 for walk-in buyers and get walk_name if it's a walk-in order
    $user_ID = 0;
    $walk_name = $conn->real_escape_string($_POST['walk_name']);  // Walk-in buyer name

    // Insert order into tbl_orders
    $sql = "INSERT INTO tbl_orders (payment_status, user_ID, walk_name, pickup_status, product_name, total, order_date) 
            VALUES ('$payment_status', '$user_ID', '$walk_name', '$pickup_status', '$product_name', '$total', '$order_date')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to orders management page with success message
        header("Location: orders_management.php?success=Order added successfully.");
    } else {
        // Error handling
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
