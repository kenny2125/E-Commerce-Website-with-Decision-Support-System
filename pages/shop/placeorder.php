<?php
session_start(); // Start session

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$userId = $_SESSION['user_ID'] ?? null;
$selectedProductIds = $_POST['selected_products'] ?? null;
$paymentMethod = $_POST['payment_method'] ?? '';

// Database connection
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";
$port = "3306";

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If user is not logged in, handle error
if (!$isLoggedIn || !$userId) {
    echo "User not logged in.";
    exit;
}

// Check if selected product IDs are provided
if (!$selectedProductIds) {
    echo "No products selected for checkout.";
    exit;
}

// Convert the product IDs to an array (from comma-separated string)
$selectedProductIdsArray = explode(',', $selectedProductIds);

// Query to fetch product details
$sql = "SELECT product_ID, store_price FROM tbl_products WHERE product_ID IN (" . implode(",", $selectedProductIdsArray) . ")";
$result = $conn->query($sql);

if (!$result) {
    echo "Error fetching products: " . $conn->error;
    exit;
}

// Define shipping fee
$shippingFee = 50.00; // Example shipping fee

// Prepare the query to insert the order into tbl_orders
$orderDate = date('Y-m-d'); // Today's date
$stmt = $conn->prepare("INSERT INTO tbl_orders (user_ID, product_ID, payment_status, pickup_status, order_date, total) VALUES (?, ?, ?, ?, ?, ?)");

while ($row = $result->fetch_assoc()) {
    $productId = $row['product_ID'];
    $productPrice = $row['store_price'];
    
    $paymentStatus = 'PENDING';  // Set payment status to 'PENDING' for all orders
    $pickupStatus = 'PENDING';   // Set pickup status to 'PENDING' for all orders
    $totalAmount = $productPrice + $shippingFee; // Each product has its own price plus shipping fee

    // Bind parameters for each insert
    $stmt->bind_param("issssd", $userId, $productId, $paymentStatus, $pickupStatus, $orderDate, $totalAmount);

    // Execute the insert statement for each product
    if (!$stmt->execute()) {
        echo "Error inserting order for product ID $productId: " . $stmt->error;
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Output the success message and trigger the redirect with a delay
echo "Order placed successfully!";
?>
<script>
    // Wait for 5 seconds before redirecting to the user profile page
    setTimeout(function() {
        window.location.href = '../user/user_profile.php'; // Redirect after 5 seconds
    }, 3000);
</script>
