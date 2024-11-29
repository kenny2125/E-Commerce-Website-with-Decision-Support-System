<?php
// Get the product ID from the URL
$productId = isset($_GET['id']) ? $_GET['id'] : 0;

// Include the database connection
include '../../config/db_config.php'; // Adjust the path as needed

// Fetch product details from the database using product_ID
$query = "SELECT * FROM tbl_products WHERE product_ID = :product_ID"; // Using product_ID here
$stmt = $conn->prepare($query);
$stmt->bindParam(':product_ID', $productId, PDO::PARAM_INT);
$stmt->execute();

// Fetch the product details
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found!";
    exit;
}

// Decode the JSON specification if stored as JSON
$specification = json_decode($product['specification'], true);
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


<div class="container my-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-4 text-center">
            <?php
            // Check if there is image data for the product
            if ($product['img_data']) {
                $imgData = base64_encode($product['img_data']);
                $imgSrc = 'data:image/jpeg;base64,' . $imgData;
            } else {
                $imgSrc = 'path/to/default-image.jpg'; // Default image if no img_data is present
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

            <h5>Payment & Pickup Methods</h5>
            <ul>
                <li>Cash on Delivery</li>
                <li>Credit/Debit Card</li>
                <li>Bank Transfer</li>
                <li>In-store Pickup</li>
            </ul>

            <!-- Quantity Control -->
            <div class="d-flex align-items-center my-3">
                <button class="btn btn-outline-secondary" id="quantity-minus">-</button>
                <input type="number" id="quantity" class="form-control mx-2" value="1" min="1" style="width: 80px;">
                <button class="btn btn-outline-secondary" id="quantity-plus">+</button>
            </div>

            <!-- Buttons -->
            <div>
            <button class="btn btn-primary me-2 add-to-cart">Add to Cart</button>
                <button class="btn btn-success">Checkout</button>
            </div>
        </div>

        <!-- Product specification -->
        <div class="col-md-4">
            <h4 class="fw-bold">specification</h4>
            <ul>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($product['specification']); ?></p>
            </ul>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get the 'Add to Cart' button and quantity input
    const addToCartBtn = document.querySelector('.btn.add-to-cart');
    const quantityInput = document.querySelector('#quantity');

    // Add event listener for 'Add to Cart' button
    addToCartBtn.addEventListener('click', function() {
        const productId = <?php echo $product['product_ID']; ?>; // Fetch the product ID from PHP
        const quantity = parseInt(quantityInput.value);

        // Send an AJAX request to add the product to the cart
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        // Prepare data to be sent
        const data = 'product_id=' + productId + '&quantity=' + quantity;

        // Handle response from the server
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert(response.message); // Show success message
                    // Optionally, update the cart icon or page to reflect the added product
                } else {
                    alert(response.message); // Show error message
                }
            }
        };

        // Send the request
        xhr.send(data);
    });
});

</script>
