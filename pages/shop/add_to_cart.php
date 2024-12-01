<?php

session_start();
// Database connection
include '../../config/db_config.php'; // Adjust path as necessary

// Ensure user is logged in
if (!isset($_SESSION['user_ID'])) {
    echo "User not logged in.";
    exit;
}

$userId = $_SESSION['user_ID']; // Get the user ID from session

// Get product ID and quantity from POST request
$productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

// Validate inputs
if ($productId <= 0 || $quantity <= 0) {
    echo "Invalid product or quantity.";
    exit;
}

// Check if product exists and is available in stock
$query = "SELECT * FROM tbl_products WHERE product_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Product not found.";
    exit;
}

$product = $result->fetch_assoc();

// Insert product into cart
$insertQuery = "INSERT INTO tbl_cart (user_ID, product_ID, quantity, date_added)
                VALUES (?, ?, ?, NOW())
                ON DUPLICATE KEY UPDATE quantity = quantity + ?";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param('iiii', $userId, $productId, $quantity, $quantity);

if ($stmt->execute()) {
    // Redirect back with success message
    header("Location: product_detail.php?id=$productId&status=success");
} else {
    echo "Error adding product to cart: " . $conn->error;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .product-card {
            width: 100%;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .product-card img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            margin-right: 20px;
        }
        .product-info {
            flex: 1;
        }
        .product-info h5 {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h3>Products for User <?php echo $user_id; ?></h3>
    <form method="POST" action="checkout_page.php">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                $totalPrice = 0;
                // Output products
                while ($row = $result->fetch_assoc()) {
                    $product_ID = $row['product_ID'];
                    $product_name = $row['product_name'];
                    $store_price = $row['store_price'];
                    $img_data = $row['img_data'];

                    // Convert img_data to a base64 string for displaying
                    $img_base64 = base64_encode($img_data);

                    // Calculate the total price dynamically
                    $totalPrice += $store_price;
            ?>
                    <div class="col-12">
                        <div class="product-card">
                            <img src="data:image/jpeg;base64,<?php echo $img_base64; ?>" alt="<?php echo $product_name; ?>">
                            <div class="product-info">
                                <h5><?php echo $product_name; ?></h5>
                                <p>Price: ₱<?php echo number_format($store_price, 2); ?></p>
                            </div>
                            <div>
                                <!-- Checkbox for selecting the product -->
                                <input type="checkbox" name="selected_products[]" value="<?php echo $product_ID; ?>">
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No products found for this user.";
            }
            ?>
        </div>

        <!-- Cart Summary -->
        <div class="cart-summary-box">
            <div class="cart-summary">
                <div class="total">
                    <span class="total-label">Total</span>
                    <span class="total-price">₱<?php echo number_format($totalPrice, 2); ?></span>
                </div>

                <!-- Action Buttons (Go Back & Checkout) -->
                <div class="cart-actions">
                    <button class="go-back-btn" type="button" onclick="window.history.back();">Go Back</button>
                    <button type="submit" class="btn btn-primary mt-3">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
