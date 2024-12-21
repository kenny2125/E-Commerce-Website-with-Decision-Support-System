<?php
session_start();

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$userId = $_SESSION['user_ID'] ?? null;
$selectedProductIds = $_POST['selected_products'] ?? null;
$paymentMethod = $_POST['payment_method'] ?? '';

include '../../../config/db_config.php';

if (!$isLoggedIn || !$userId) {
    echo "User not logged in.";
    exit;
}

if (!$selectedProductIds) {
    echo "No products selected for checkout.";
    exit;
}

$selectedProductIdsArray = explode(',', $selectedProductIds);

$sql = "SELECT product_ID, store_price FROM tbl_products WHERE product_ID IN (" . implode(",", $selectedProductIdsArray) . ")";
$result = $conn->query($sql);

if (!$result) {
    echo "Error fetching products: " . $conn->error;
    exit;
}

$shippingFee = 50.00;
$orderDate = date('Y-m-d');

$stmt = $conn->prepare("INSERT INTO tbl_orders (user_ID, product_ID, payment_status, pickup_status, order_date, total, payment_method) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");

while ($row = $result->fetch_assoc()) {
    $productId = $row['product_ID'];
    $productPrice = $row['store_price'];
    
    $paymentStatus = 'PENDING';
    $pickupStatus = 'PENDING';
    $totalAmount = $productPrice + $shippingFee;

    $stmt->bind_param("issssds", $userId, $productId, $paymentStatus, $pickupStatus, $orderDate, $totalAmount, $paymentMethod);

    if (!$stmt->execute()) {
        echo "Error inserting order for product ID $productId: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

echo "Order placed successfully!";
?>
<script>
    setTimeout(function() {
        window.location.href = '../../user/user_profile.php';
    }, 3000);
</script>
