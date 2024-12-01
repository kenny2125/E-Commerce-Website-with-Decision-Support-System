
<?php
session_start(); // Start the session

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$userId = $_SESSION['user_ID'] ?? null;
// Database connection
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";
$port = "3306";

$conn = new mysqli($host, $username, $password, $db_name);
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false; // Safe check for isLoggedIn

// Initialize the check for admin role
$isAdmin = ($_SESSION['role'] ?? '') === 'admin'; // Check if role is 'admin'
// Debugging (optional, can be removed in production)
// echo "<h2>Session Data (Debugging)</h2>";
// if (!empty($_SESSION)) {
//     echo "<pre>";
//     print_r($_SESSION);
//     echo "</pre>";
// } else {
//     echo "<p>No session data available.</p>";
// }
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data from the tbl_user table based on the logged-in user
if ($isLoggedIn && $userId) {
    // Fetch user details from the tbl_user table
    $sql = "SELECT first_name, middle_initial, last_name, contact_number, address FROM tbl_user WHERE user_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($first_name, $middle_initial, $last_name, $contact_number, $address);
    $stmt->fetch();
    $stmt->close();
    
    // Concatenate the full name (first, middle, last)
    $full_name = $first_name . " " . $middle_initial . ". " . $last_name;
} else {
    // Handle the case if the user is not logged in
    echo "User not logged in.";
    exit;
}

// Check if selected products are passed from the form
if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
    $selected_product_ids = $_POST['selected_products'];  // Array of selected product IDs
    $ids = implode(",", $selected_product_ids);  // Convert the array to a comma-separated string for the SQL query

    // echo "<pre> Selected Product IDs: " . print_r($selected_product_ids, true) . "</pre>";
    
    // Query to fetch product details for the selected products
    $sql = "SELECT product_ID, product_name, store_price, img_data FROM tbl_products WHERE product_ID IN ($ids)";
    $result = $conn->query($sql);

    // Initialize variables for subtotal calculation
    $subtotal = 0;
    $shipping_fee = 50.00;  // Example shipping fee
} else {
    // If no products were selected
    echo "No products selected for checkout.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/checkout.css">
</head>
<body style="background-color: #EBEBEB;">

<!-- <link rel="stylesheet" href="../../assets/css/index.css"> -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Clickable Logo -->
        <a href="/index.php">
            <img src="../../assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        </a>
        
        <!-- Search Bar -->
        <form action="/pages/shop/Products_List.php" method="get" class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button href="/pages/shop/Products_List.php" class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <!-- User-specific Content -->
        <?php if ($isLoggedIn === true): ?>
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                <div class="icon-container">
                    <!-- Cart and Profile Links -->
                    <a href="/pages/shop/carting_list.php">
                        <img src="/assets/images/Group 204.png" alt="Cart Icon">
                    </a>
                    <a href="/pages/user/user_login.php">
                        <img src="/assets/images/Group 48.png" alt="Profile Icon">
                    </a>

                    <!-- Admin Link (only visible to admins) -->
                    <?php if ($isAdmin): ?>
                        <a href="pages/admin/pages/admin_dashboard.php" class="btn btn-outline-danger ms-3">
                            Admin Dashboard
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- If not logged in, show login button -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
        <?php endif; ?>
    </div>
</nav>


<div class="container my-5">
    <div class="mb-4">
        <a href="test_carting.php" class="text-decoration-none text-primary fw-bold back-link">&larr; Back</a>
        <h2 class="fw-bold mt-3 title-header">Checkout</h2>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <?php
            if ($result->num_rows > 0) {
                // Output each product selected for checkout
                while ($row = $result->fetch_assoc()) {
                    $product_ID = $row['product_ID'];
                    $product_name = $row['product_name'];
                    $store_price = $row['store_price'];
                    $img_data = $row['img_data'];

                    // Convert img_data to a base64 string for displaying
                    $img_base64 = base64_encode($img_data);

                    // Calculate subtotal
                    $subtotal += $store_price;
            ?>
            <div class="card shadow border-0 mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="data:image/jpeg;base64,<?php echo $img_base64; ?>" class="img-fluid rounded-start" alt="<?php echo $product_name; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold product-title"><?php echo $product_name; ?></h5>
                            <p class="card-text text-danger fw-bold product-price">₱<?php echo number_format($store_price, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "No products found.";
            }
            ?>
        </div>
        <div class="col-lg-4">
        <form method="POST" id="checkout-form">
    <div class="card shadow border-0 mb-3">
        <div class="card-body">
            <h5 class="fw-bold section-title">Purchase Information</h5>
            <!-- Customer Information -->
            <div class="mt-3">
                <p class="mb-1"><strong>Name:</strong> <span id="customer-name"><?php echo $full_name; ?></span></p>
                <p class="mb-1"><strong>Contact:</strong> <span id="customer-contact"><?php echo $contact_number; ?></span></p>
                <p class="mb-3"><strong>Address:</strong> <span id="customer-address"><?php echo $address; ?></span></p>
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
            <div class="mb-3" id="agree-container">
                <!-- Agreement message based on payment method -->
            </div>
        </div>
    </div>
    <div class="card shadow border-0">
        <div class="card-body">
            <h5 class="fw-bold section-title">Order Review</h5>
            <div class="mt-3">
                <p class="mb-1">Product subtotal: <span class="float-end" id="product-subtotal">₱<?php echo number_format($subtotal, 2); ?></span></p>
                <p class="mb-1">COD shipping: <span class="float-end" id="shipping-fee">₱<?php echo number_format($shipping_fee, 2); ?></span></p>
                <hr>
                <p><strong>Total payment: <span class="float-end text-danger" id="total-payment">₱<?php echo number_format($subtotal + $shipping_fee, 2); ?></span></strong></p>
            </div>
            <input type="hidden" name="amount" value="<?php echo ($subtotal + $shipping_fee) * 100; ?>"> <!-- Dummy amount in cents -->
            <input type="hidden" id="selected_products" name="selected_products" value=""> <!-- Hidden field for selected product IDs -->
            <input type="hidden" name="user_ID" value="<?php echo $userId; ?>"> <!-- User ID -->

            <div class="form-check mt-3">
                <input type="checkbox" class="form-check-input" id="agree" required>
                <label for="agree" class="form-check-label small" id="agree-label">
                    I agree that my information is correct and valid.
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold">Place Order</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('payment-method').addEventListener('change', function() {
    var paymentMethod = this.value;
    var form = document.getElementById('checkout-form');
    var agreeLabel = document.getElementById('agree-label');
    var agreeContainer = document.getElementById('agree-container');

    // Set form action based on payment method
    if (paymentMethod === 'paymongo' || paymentMethod === 'gcash' || paymentMethod === 'paymaya') {
        form.action = 'checkout_url.php';  // Paymongo, GCash, PayMaya
        agreeLabel.textContent = 'I agree to make payment via ' + paymentMethod.charAt(0).toUpperCase() + paymentMethod.slice(1);
        agreeContainer.style.display = 'block';  // Show agree checkbox for these payment methods
    } else if (paymentMethod === 'cash_on_delivery') {
        form.action = 'placeorder.php';  // COD
        agreeLabel.textContent = 'I agree that my information is correct and valid.';
        agreeContainer.style.display = 'block';  // Show agree checkbox for COD
    }
});

// Automatically update the hidden field with selected product IDs
document.getElementById('checkout-form').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent default form submission
    
    // Check if agreement checkbox is checked
    if (document.getElementById('agree').checked) {
        // Assuming you have a JavaScript array `selected_product_ids` containing the product IDs
        var selectedProductIds = <?php echo json_encode($selected_product_ids); ?>; // Pass selected product IDs from PHP

        if (selectedProductIds.length === 0) {
            alert("No products selected for checkout.");
            return false;
        }

        // Set the hidden field value with the selected product IDs
        document.getElementById('selected_products').value = selectedProductIds.join(',');

        // Now submit the form
        this.submit();  // Submit the form to the correct action
    } else {
        alert('Please agree to the terms and conditions before placing the order.');
    }
});
</script>

</body>
</html>

<?php
$conn->close();
?>
