<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Products List</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/assets/css/products_List.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
    <script>
        function viewDetails(productId) {
            window.location.href = "Product_Detail.php?id=" + productId;
        }
    </script>
</head>
<body style="background-color: #EBEBEB;">

<?php

include '../../includes/header.php';
include '../../config/db_config.php';

// Get the search query from session if available
$searchQuery = isset($_SESSION['search_query']) ? $_SESSION['search_query'] : '';

// Get the category filter if present
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Cache expiration time (in seconds)
$cacheExpirationTime = 60 * 30; // 5 minutes (adjust as needed)

// Initialize $searchQuery as an empty string by default
$searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Cache check and logic for product list
if (isset($_SESSION['products_cache']) && (time() - $_SESSION['products_cache_time'] < $cacheExpirationTime)) {
    // Use the cached products data
    $products = $_SESSION['products_cache'];
} else {

    // Prepare the SQL query to fetch products
    $query = "SELECT * FROM tbl_products";
    
    // Add category filter if set
    if (!empty($categoryFilter)) {
        $query .= " WHERE category = '$categoryFilter'";
    }
    
    // Prepare for search filter
    if (!empty($searchQuery)) {
        $query .= !empty($categoryFilter) ? " AND product_name LIKE '%$searchQuery%'" : " WHERE product_name LIKE '%$searchQuery%'";
    }

    // Execute the query
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

// Fetch categories from the database
$categoriesQuery = "SELECT DISTINCT category FROM tbl_products";
$categoriesResult = $conn->query($categoriesQuery);
?>

<div class="container d-flex" style="padding: 30px">
    <div class="row">
        <div class="col-3"> 
            <div class="container-main p-3">
                <h4 class="category mb-4">Category</h4>
                <div class="p-3">
                    <h4 class="mb-4">Filters</h4>
                    <form method="GET" action="">
                        <!-- Category Filter Cards -->
                        <div class="row">
                            <?php
                            if ($categoriesResult && $categoriesResult->num_rows > 0) {
                                while ($categoryRow = $categoriesResult->fetch_assoc()) {
                                    $categoryName = $categoryRow['category'];
                                    // Add "active" class if the category is selected
                                    $activeClass = ($categoryName == $categoryFilter) ? 'active' : '';
                                    echo "<div class='col-12 mb-3'>
                                            <a href='?category=$categoryName' class='btn btn-primary w-100 $activeClass' style='text-align: center; padding: 7px; border-radius: 20px;'>$categoryName</a>
                                        </div>";
                                }
                            }
                            ?>
                        </div>
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
                                <strong>Price:</strong> ₱<?php echo number_format($product['store_price'], 2); ?><br>
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

<?php
include '../../includes/footer.php';
?>
</body>
</html>
