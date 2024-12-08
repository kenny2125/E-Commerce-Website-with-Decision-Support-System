<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product Detail Page</title>
    <link rel="stylesheet" href="/assets/css/product-detail.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
</head>
<body>

<?php
include '../../includes/header.php';
include '../../config/db_config.php';

// Product ID from URL or testing
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Session data
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$userId = $_SESSION['user_ID'] ?? null;

// Cache expiration time (in seconds)
$cacheExpirationTime = 60 * 5; // 5 minutes (adjust as needed)

// Cache check and logic for product details
if (isset($_SESSION['product_' . $productId . '_cache']) && (time() - $_SESSION['product_' . $productId . '_cache_time'] < $cacheExpirationTime)) {
    // Use the cached product details
    $product = $_SESSION['product_' . $productId . '_cache'];
    $specification = json_decode($product['specification'], true);
} else {
    // No cache or cache expired, fetch product details from the database
    if ($productId > 0) {
        $query = "SELECT * FROM tbl_products WHERE product_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        $product = $result->fetch_assoc();

        if (!$product) {
            echo "Product not found!";
            exit;
        }

        // Cache the product details and specification
        $_SESSION['product_' . $productId . '_cache'] = $product;
        $_SESSION['product_' . $productId . '_cache_time'] = time();

        $specification = json_decode($product['specification'], true);
    } else {
        echo "Invalid product ID!";
        exit;
    }
}
?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-3 text-center">
            <?php
            $imgSrc = $product['img_data']
                ? 'data:image/jpeg;base64,' . base64_encode($product['img_data'])
                : 'path/to/default-image.jpg';
            ?>
            <img src="<?php echo $imgSrc; ?>" class="img-fluid rounded" alt="Product Image">
        </div>
        <div class="col-md-4">
            <h2 class="fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <p><strong>Stock Available:</strong> <span class="text-success">In Stock</span></p>
            <p><strong>Price:</strong> ₱<?php echo number_format($product['srp'], 2); ?></p>
            <p class="text-justify"><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>

            <form id="addToCartForm" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['product_ID']; ?>">
                <div class="d-flex align-items-center my-3">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(-1)">-</button>
                    <input type="number" name="quantity" id="quantity" class="form-control mx-2" value="1" min="1" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(1)">+</button>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-left: 40px;">Add to Cart</button>
            </form>
            <div id="cartMessage" class="mt-3"></div>
        </div>
        <div class="col-md-4">
            <h4 class="fw-bold">Specification</h4>
            <ul>
                <?php
                if (is_array($specification)) {
                    foreach ($specification as $key => $value) {
                        echo "<li><strong>$key:</strong> $value</li>";
                    }
                } else {
                    echo htmlspecialchars($product['specification']);
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<!-- Footer -->
<?php
include '../../includes/footer.php';
?>

</body>
</html>


<script>
function changeQuantity(amount) {
    const quantityInput = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityInput.value) || 1;
    quantityInput.value = Math.max(1, currentQuantity + amount);
}

document.getElementById('addToCartForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('addtocart.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        const cartMessage = document.getElementById('cartMessage');
        cartMessage.innerHTML = `<span class="${data.status === 'success' ? 'text-success' : 'text-danger'}">${data.message}</span>`;
        setTimeout(() => cartMessage.innerHTML = '', 3000);
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('cartMessage').innerHTML = '<span class="text-danger">An unexpected error occurred.</span>';
    });
});
</script>

