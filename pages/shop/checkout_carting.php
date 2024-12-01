<?php
// Start the session
session_start();

// Database connection
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

// Initialize variables for subtotal and shipping fee
$subtotal = 0;
$shipping_fee = 50.00;  // Example shipping fee

// Ensure cart items are in the session
if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
    // Loop through the selected products
    $product_names = $_POST['product_names'];
    $product_images = $_POST['product_images'];
    $product_prices = $_POST['product_prices'];

    // Calculate subtotal for selected products
    foreach ($product_prices as $product_ID => $price) {
        $subtotal += $price;
    }
} else {
    echo "No products selected.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/checkout.css">
</head>
<body style="background-color: #EBEBEB;">
    <div class="container my-5">
        <div class="mb-4">
            <a href="cart.php" class="text-decoration-none text-primary fw-bold back-link">&larr; Back to Cart</a>
            <h2 class="fw-bold mt-3 title-header">Checkout</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-8">
                <?php
                // Display the selected products
                foreach ($product_names as $product_ID => $product_name) {
                    $product_image = $product_images[$product_ID];
                    $product_price = $product_prices[$product_ID];
                ?>
                <div class="card shadow border-0 mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="data:image/jpeg;base64,<?php echo $product_image; ?>" class="img-fluid rounded-start" alt="<?php echo $product_name; ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold product-title"><?php echo $product_name; ?></h5>
                                <p class="card-text text-danger fw-bold product-price">₱<?php echo number_format($product_price, 2); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="col-lg-4">
                <form method="POST" action="checkout_url.php" target="_blank">
                    <div class="card shadow border-0 mb-3">
                        <div class="card-body">
                            <h5 class="fw-bold section-title">Purchase Information</h5>
                            <!-- Customer Information (can be fetched from a session or a database if available) -->
                            <div class="mt-3">
                                <p class="mb-1"><strong>Name:</strong> <span id="customer-name">[Customer Name]</span></p>
                                <p class="mb-1"><strong>Contact:</strong> <span id="customer-contact">[Customer Contact]</span></p>
                                <p class="mb-3"><strong>Address:</strong> <span id="customer-address">[Customer Address]</span></p>
                            </div>
                            <div class="mb-3">
                                <label for="payment-method" class="form-label fw-bold">Payment Method</label>
                                <select id="payment-method" class="form-select">
                                    <option value="paymongo">Paymongo Link</option>
                                    <option value="gcash">GCash</option>
                                    <option value="paymaya">PayMaya</option>
                                    <option value="cash_on_delivery">Cash on Delivery</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pickup-method" class="form-label fw-bold">Pickup Method</label>
                                <select id="pickup-method" class="form-select">
                                    <option value="store">Store Pickup</option>
                                    <option value="delivery">Delivery</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <h5 class="fw-bold section-title">Order Review</h5>
                            <div class="mt-3">
                                <p class="mb-1">Subtotal: ₱<?php echo number_format($subtotal, 2); ?></p>
                                <p class="mb-1">Shipping Fee: ₱<?php echo number_format($shipping_fee, 2); ?></p>
                                <p class="mb-3"><strong>Total: ₱<?php echo number_format($subtotal + $shipping_fee, 2); ?></strong></p>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Proceed to Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
