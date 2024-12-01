<?php
session_start(); // Start the session

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$userId = $_SESSION['user_ID'] ?? null;

// Get the product ID from the URL
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Include the database connection
include '../../config/db_config.php'; // Adjust the path as needed

// Handle form submission for adding to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($userId && $quantity > 0) {
        // Check if the product exists
        $checkQuery = "SELECT * FROM tbl_products WHERE product_ID = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Insert or update the product in the cart
            $cartQuery = "INSERT INTO tbl_cart (user_ID, product_ID, quantity, date_added)
                          VALUES (?, ?, ?, NOW())
                          ON DUPLICATE KEY UPDATE quantity = quantity + ?";
            $stmt = $conn->prepare($cartQuery);
            $stmt->bind_param('iiii', $userId, $productId, $quantity, $quantity);

            if ($stmt->execute()) {
                $successMessage = "Product successfully added to your cart!";
            } else {
                $errorMessage = "Error adding product to the cart: " . $stmt->error;
            }
        } else {
            $errorMessage = "Product not found!";
        }
    } else {
        $errorMessage = "Please log in or enter a valid quantity.";
    }
}

// Check if product ID is valid
if ($productId > 0) {
    // Fetch product details from the database
    $query = "SELECT * FROM tbl_products WHERE product_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the product details
    $product = $result->fetch_assoc();

    // Check if the product exists
    if (!$product) {
        echo "Product not found!";
        exit;
    }

    // Decode the JSON specification if stored as JSON
    $specification = json_decode($product['specification'], true);
} else {
    echo "Invalid product ID!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
            <div class="navbar-text d-flex align-items-center">
                <a href="pages/user/logout.php" class="btn btn-danger ml-2">Log Out</a>
            </div>
        <?php else: ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
        <?php endif; ?>
    </div>
</nav>

<div class="container my-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-4 text-center">
            <?php
            if ($product['img_data']) {
                $imgData = base64_encode($product['img_data']);
                $imgSrc = 'data:image/jpeg;base64,' . $imgData;
            } else {
                $imgSrc = 'path/to/default-image.jpg';
            }
            ?>
            <img src="<?php echo $imgSrc; ?>" class="img-fluid rounded" alt="Product Image" style="max-width: 100%;">
        </div>

        <!-- Product Details -->
        <div class="col-md-4">
            <h2 class="fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <p><strong>Stock Available:</strong> <span class="text-success">In Stock</span></p>
            <p><strong>Price:</strong> <span class="text-danger fs-4">₱<?php echo number_format($product['srp'], 2); ?></span></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>

            <!-- Add to Cart Form -->
            <?php if (isset($successMessage)) { echo "<div class='alert alert-success'>$successMessage</div>"; } ?>
            <?php if (isset($errorMessage)) { echo "<div class='alert alert-danger'>$errorMessage</div>"; } ?>
            
            <form action="" method="POST">
                <div class="d-flex align-items-center my-3">
                    <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(-1)">-</button>
                    <input type="number" name="quantity" id="quantity" class="form-control mx-2" value="1" min="1" style="width: 80px;">
                    <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(1)">+</button>
                </div>
                <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
            </form>

            <form action="checkout_page.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['product_ID']; ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>">
                <input type="hidden" name="store_price" value="<?php echo $product['srp']; ?>">
                <button type="submit" class="btn btn-success w-100">Proceed to Checkout</button>
            
    
            </form>
        </div>

        <!-- Product Specification -->
        <div class="col-md-4">
            <h4 class="fw-bold">Specification</h4>
            <ul>
                <?php if (is_array($specification)) {
                    foreach ($specification as $key => $value) {
                        echo "<li><strong>$key:</strong> $value</li>";
                    }
                } else {
                    echo htmlspecialchars($product['specification']);
                } ?>
            </ul>
        </div>
    </div>
</div>

<script>
    // Increment and Decrement quantity
    document.getElementById('quantity-plus').addEventListener('click', () => {
        let quantity = document.getElementById('quantity');
        quantity.value = parseInt(quantity.value) + 1;
    });
    document.getElementById('quantity-minus').addEventListener('click', () => {
        let quantity = document.getElementById('quantity');
        if (quantity.value > 1) quantity.value = parseInt(quantity.value) - 1;
    });
</script>

<script>
function changeQuantity(amount) {
    const quantityInput = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityInput.value) || 1;
    currentQuantity = Math.max(1, currentQuantity + amount);
    quantityInput.value = currentQuantity;
}
</script>
</body>
</html>
