<?php
// add_to_cart.php

// Start the session (if needed for user management)
session_start();

// Database connection
include '../../config/db_config.php';

// Static user ID for now (can be replaced with dynamic user management later)
$userId = 1; // Static user ID

// Get the product ID from the AJAX request
$productId = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

if ($productId && $quantity > 0) {
    // Prepare SQL query to insert into tbl_cart
    $query = "INSERT INTO tbl_cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add product to cart']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid product or quantity']);
}
?>
