<?php

session_start();
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$userId = $_SESSION['user_ID'] ?? null;
// Database connection
include '../../config/db_config.php'; // Adjust path as necessary

// Ensure user is logged in
if (!isset($_SESSION['user_ID'])) {
    echo "User not logged in.";
    exit;
}

$userId = $_SESSION['user_ID']; // Get the user ID from session

// Fetch products in the user's cart
$query = "SELECT p.product_ID, p.product_name, p.store_price, p.img_data, c.quantity 
          FROM tbl_cart c
          INNER JOIN tbl_products p ON c.product_ID = p.product_ID
          WHERE c.user_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
        .cart-summary-box {
            margin-top: 20px;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Logo -->
        <img src="assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        
        <!-- Search Bar -->
        <form class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <!-- User-specific Content -->
        <?php if ($isLoggedIn === true): ?>
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                <a href="../user/user_profile.php" class="btn btn-outline-primary mx-2">Profile</a>
                <a href="../shop/carting_list.php" class="btn btn-outline-secondary mx-2">Cart</a>
                <a href="../user/logout.php" class="btn btn-danger ml-2">Log Out</a>
            </div>
        <?php else: ?>
            <!-- If not logged in, show login button -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
        <?php endif; ?>
    </div>
</nav>

<div class="container mt-5">
    <h3>Your Cart</h3>
    <form method="POST" action="checkout_carting.php">
        <div class="row">
            <?php
            $totalPrice = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_ID = $row['product_ID'];
                    $product_name = $row['product_name'];
                    $store_price = $row['store_price'];
                    $img_data = $row['img_data'];
                    $quantity = $row['quantity'];

                    // Convert img_data to a base64 string for displaying
                    $img_base64 = base64_encode($img_data);

                    // Calculate total price
                    $itemTotal = $store_price * $quantity;
                    $totalPrice += $itemTotal;
            ?>
                <div class="col-12">
                    <div class="product-card">
                        <img src="data:image/jpeg;base64,<?php echo $img_base64; ?>" alt="<?php echo $product_name; ?>">
                        <div class="product-info">
                            <h5><?php echo $product_name; ?></h5>
                            <p>Price: ₱<?php echo number_format($store_price, 2); ?></p>
                            <p>Quantity: <?php echo $quantity; ?></p>
                            <p>Subtotal: ₱<?php echo number_format($itemTotal, 2); ?></p>
                        </div>
                        <div>
                            <!-- Checkbox for selecting the product -->
                            <input type="checkbox" name="selected_products[]" value="<?php echo $product_ID; ?>" 
                                id="product-<?php echo $product_ID; ?>" class="product-checkbox">

                            <!-- Hidden fields to pass product details if checkbox is selected -->
                            <input type="hidden" name="product_names[<?php echo $product_ID; ?>]" value="<?php echo htmlspecialchars($product_name); ?>" class="product-name">
                            <input type="hidden" name="product_images[<?php echo $product_ID; ?>]" value="<?php echo $img_base64; ?>" class="product-image">
                            <input type="hidden" name="product_prices[<?php echo $product_ID; ?>]" value="<?php echo $store_price; ?>" class="product-price">
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </div>

        <!-- Cart Summary -->
        <div class="cart-summary-box">
            <div class="cart-summary">
                <div class="total">
                    <span class="total-label">Total:</span>
                    <span class="total-price">₱<?php echo number_format($totalPrice, 2); ?></span>
                </div>

                <!-- Action Buttons (Go Back & Checkout) -->
                <div class="cart-actions">
                    <button class="btn btn-secondary" type="button" onclick="window.history.back();">Go Back</button>
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
