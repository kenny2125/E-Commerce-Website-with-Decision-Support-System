<?php
session_start();
include '../../config/db_config.php';

$userId = $_SESSION['user_ID'] ?? null;

if (!$userId) {
    echo json_encode(['status' => 'error', 'message' => 'Please log in to add items to your cart.']);
    exit;
}

$productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

if ($productId <= 0 || $quantity <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid product or quantity.']);
    exit;
}

$checkQuery = "SELECT * FROM tbl_cart WHERE user_ID = ? AND product_ID = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param('ii', $userId, $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $updateQuery = "UPDATE tbl_cart SET quantity = quantity + ?, date_added = NOW() WHERE user_ID = ? AND product_ID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('iii', $quantity, $userId, $productId);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Cart updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating cart: ' . $stmt->error]);
    }
} else {
    $insertQuery = "INSERT INTO tbl_cart (user_ID, product_ID, quantity, date_added) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('iii', $userId, $productId, $quantity);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Product added to cart.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding product to cart: ' . $stmt->error]);
    }
}
?>
