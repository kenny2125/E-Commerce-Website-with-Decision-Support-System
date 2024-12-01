<?php
session_start(); // Start the session

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
// Debugging (optional, can be removed in production)
// echo "<h2>Session Data (Debugging)</h2>";
// if (!empty($_SESSION)) {
//     echo "<pre>";
//     print_r($_SESSION);
//     echo "</pre>";
// } else {
//     echo "<p>No session data available.</p>";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Products List</title>
    <link rel="stylesheet" href="/assets/css/products_List.css">
    <script>
        // Function to redirect to product detail page when button is clicked
        function viewDetails(productId) {
            // Redirect to product_detail.php with the product ID
            window.location.href = "product_detail.php?id=" + productId;
        }
    </script>
</head>
<body style="background-color: #EBEBEB;">
<!-- Navbar -->
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
                
                <a href="pages/user/logout.php" class="btn btn-danger ml-2">Log Out</a>
            </div>
        <?php else: ?>
            <!-- If not logged in, show login button -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
        <?php endif; ?>
    </div>
</nav>

<div class="container-fluid" style="padding: 50px">
    <div class="row">
        <!-- Sidebar: Filters -->
        <div class="col-3">
        <div class="bg-light p-3">
            <h4 class="mb-4">Category</h4>
            <div class="col-3">
        <div class="bg-light p-3">
    <h4 class="mb-4">Filters</h4>
    <form method="GET" action="">
        <!-- Category Filter -->
        <div class="mb-4">
            <h6 class="mb-2">Computer Parts</h6>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="category-graphics-card" name="category[]" value="graphics-card">
                <label class="form-check-label" for="category-graphics-card">Graphics Card</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="category-laptop" name="category[]" value="laptop">
                <label class="form-check-label" for="category-laptop">Laptop</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="category-gaming-laptop" name="category[]" value="gaming-laptop">
                <label class="form-check-label" for="category-gaming-laptop">Gaming Laptop</label>
            </div>
        </div>

        <!-- Brand Filter -->
        <div class="mb-4">
            <h6 class="mb-2">Brand</h6>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="brand-msi" name="brand[]" value="msi">
                <label class="form-check-label" for="brand-msi">MSI</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="brand-dell" name="brand[]" value="dell">
                <label class="form-check-label" for="brand-dell">Dell</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="brand-apple" name="brand[]" value="apple">
                <label class="form-check-label" for="brand-apple">Apple</label>
            </div>
        </div>

        <!-- Clear Button -->
        <div class="mb-4">
            <button type="button" class="btn btn-secondary">Clear</button>
        </div>

    </form>
</div>
</div>

    </div>
</div>

<?php
// Include the database connection
include '../../config/db_config.php'; // Adjust the path as needed

// Fetch products from the database
$query = "SELECT * FROM tbl_products"; // Modify to match your table structure
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    // Fetch the products
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    $products = []; // No products found
}

// Close the database connection (optional, as PHP will close it automatically at the end of script execution)
$conn->close();
?>



<!-- Main Content -->
<div class="col-9">
    <!-- Search Result Info Row -->
    <div class="d-flex justify-content-between align-items-center bg-light p-3 mb-3">
        <div>
            <span class="fw-bold">Search Result for:</span> "searched product", 
            <span class="fw-bold">30 results</span> found in <span class="fw-bold">0.02 seconds</span>
        </div>
        <div class="d-flex gap-3">
            <div>
                <label for="sort-by" class="form-label me-2">Sort by:</label>
                <select id="sort-by" name="sort-by" class="form-select">
                    <option value="best-seller">Best Seller</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Dynamic Product Cards -->
    <div class="row">
    <?php foreach ($products as $product): ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <?php
            // Check if there is image data
            if ($product['img_data']) {
                // Encode the image data in base64
                $imgData = base64_encode($product['img_data']);
                $imgSrc = 'data:image/jpeg;base64,' . $imgData; // Assuming JPEG image format, adjust if needed
            } else {
                $imgSrc = 'path/to/default-image.jpg'; // Default image if no img_data is present
            }
            ?>
            <!-- Display the product image -->
            <img src="<?php echo $imgSrc; ?>" class="card-img-top" alt="Product Image">
            
            <div class="card-body">
                <!-- Display product name and SRP -->
                <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                <p class="card-text">
                    <strong>Price:</strong> ₱<?php echo number_format($product['srp'], 2); ?><br>
                </p>

                <!-- View Details Button with dynamic product ID -->
                <button id="view-details-<?php echo $product['product_ID']; ?>" class="btn btn-primary" onclick="viewDetails(<?php echo $product['product_ID']; ?>)">View Details</button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
