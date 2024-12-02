<?php
session_start(); // Start the session

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false; // Safe check for isLoggedIn
$isAdmin = ($_SESSION['role'] ?? '') === 'admin'; // Check if role is 'admin'


// Get the search query from session if available
$searchQuery = isset($_SESSION['search_query']) ? $_SESSION['search_query'] : '';

// You can now use $searchQuery in your SQL query to filter results based on the search
if ($searchQuery) {
    $sql = "SELECT * FROM tbl_products WHERE product_name LIKE '%$searchQuery%'";
    // Continue with your database query
}

// Cache expiration time (in seconds)
$cacheExpirationTime = 60 * 30; // 5 minutes (adjust as needed)

// Initialize $searchQuery as an empty string by default
$searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Cache check and logic for product list
if (isset($_SESSION['products_cache']) && (time() - $_SESSION['products_cache_time'] < $cacheExpirationTime)) {
    // Use the cached products data
    $products = $_SESSION['products_cache'];
} else {
    // No cache or cache expired, fetch products from the database
    $host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $username = "vg2eweo4yg8eydii";
    $password = "rccstjx3or46kpl9";
    $db_name = "s0gp0gvxcx3fc7ib";

    $conn = new mysqli($host, $username, $password, $db_name);

    // Prepare the SQL query to fetch products
    $query = "SELECT * FROM tbl_products";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the products
    $products = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    // Store the products and cache time in the session
    $_SESSION['products_cache'] = $products;
    $_SESSION['products_cache_time'] = time();

    // Close the database connection
    $stmt->close();
    $conn->close();
}

// Start measuring the time taken for search operation
$startTime = microtime(true);

// Filter products by search query if present
if (!empty($searchQuery)) {
    // Filter through cached products (case-insensitive search)
    $products = array_filter($products, function ($product) use ($searchQuery) {
        return stripos($product['product_name'], $searchQuery) !== false; // Case-insensitive search
    });
}

// End measuring the time
$endTime = microtime(true);

// Calculate the time taken to filter the products
$searchTime = round($endTime - $startTime, 3); // Round to 3 decimal places

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Products List</title>
    <link rel="stylesheet" href="/assets/css/products_List.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
    <script>
        function viewDetails(productId) {
            window.location.href = "Product_Detail.php?id=" + productId;
        }
    </script>
</head>
<body style="background-color: #EBEBEB;">

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <a href="../../index.php">
            <img src="../../assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        </a>

        <!-- Search Form -->
        <form action="Products_List.php" method="get" class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" name="search_query" value="<?php echo htmlspecialchars($searchQuery); ?>" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <?php if ($isLoggedIn === true): ?>
            <div class="navbar-text d-flex align-items-center">
                <a href="../../pages/shop/carting_list.php">
                    <img src="/assets/images/Group 204.png" alt="Cart Icon">
                </a>
                <a href="../../pages/user/user_profile.php">
                    <img src="/assets/images/Group 48.png" alt="Profile Icon">
                </a>
                <?php if ($isAdmin): ?>
                    <a href="../../pages/admin/pages/admin_dashboard.php" class="btn btn-outline-danger ms-3">
                        Admin Dashboard
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
        <?php endif; ?>
    </div>
</nav>

<div class="container d-flex" style="padding: 30px">
    <div class="row">
        <div class="col-3">
            <div class="container-main p-3">
                <h4 class="category mb-4">Category</h4>
                <div class="p-3">
                    <h4 class="mb-4">Filters</h4>
                    <form method="GET" action="">
                        <!-- Filters can be added here -->
                    </form>
                </div>
            </div>
        </div>

        <div class="col-9">
            <div class="container-search d-flex justify-content-between align-items-center bg-light p-3 mb-3">
                <div>
                    <?php if (!empty($searchQuery)): ?>
                        <span class="fw-bold">Search Result for:</span> "<?php echo htmlspecialchars($searchQuery); ?>", 
                    <?php endif; ?>
                    <span class="fw-bold"><?php echo count($products); ?> result(s) found in <?php echo $searchTime; ?> secs</span>
                </div>
            </div>

            <!-- Dynamic Product Cards -->
            <div class="row">
                <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php
                        $imgSrc = isset($product['img_data']) && $product['img_data'] ? 'data:image/jpeg;base64,' . base64_encode($product['img_data']) : 'path/to/default-image.jpg';
                        ?>
                        <div class="image-wrapper">
                            <img src="<?php echo $imgSrc; ?>" class="card-img-top" alt="Product Image" style="width: 100%; height: auto; object-fit: cover; display: block; margin: auto;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                            <p class="card-text">
                                <strong>Price:</strong> ₱<?php echo number_format($product['srp'], 2); ?><br>
                            </p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary-footer" onclick="viewDetails(<?php echo $product['product_ID']; ?>)">View Details</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
