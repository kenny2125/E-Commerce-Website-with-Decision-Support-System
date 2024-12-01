<?php
session_start(); // Start the session

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

$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";

// Establish a database connection
$conn = new mysqli($host, $username, $password, $db_name);


$searchQuery = $_GET['search_query'] ?? '';

// Prepare the SQL query to fetch products
$query = "SELECT * FROM tbl_products";
if (!empty($searchQuery)) {
    $query .= " WHERE product_name LIKE ?"; // Add a WHERE clause to filter by product name
}

// Prepare and execute the query
$stmt = $conn->prepare($query);
if (!empty($searchQuery)) {
    $searchTerm = '%' . $searchQuery . '%'; // Add wildcard characters for partial matching
    $stmt->bind_param('s', $searchTerm);
}
$stmt->execute();
$result = $stmt->get_result();

// Fetch the products
$products = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Close the database connection
$stmt->close();
$conn->close();
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
        // Function to redirect to product detail page when button is clicked
        function viewDetails(productId) {
            // Redirect to product_detail.php with the product ID
            window.location.href = "Product_Detail.php?id=" + productId;
        }
    </script>
</head>
<body style="background-color: #EBEBEB;">

<link rel="stylesheet" href="../../assets/css/index.css">
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Clickable Logo -->
        <a href="index.php">
            <img src="../../assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        </a>
        
        <!-- Search Bar -->
        <form action="pages/shop/Products_List.php" method="get" class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button href="pages/shop/Products_List.php" class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <!-- User-specific Content -->
        <?php if ($isLoggedIn === true): ?>
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                <div class="icon-container">
                    <!-- Cart and Profile Links -->
                    <a href="pages/shop/carting_list.php">
                        <img src="/assets/images/Group 204.png" alt="Cart Icon">
                    </a>
                    <a href="pages/user/user_profile.php">
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

<div class="container d-flex" style="padding: 30px">
    <div class="row">
        <!-- Sidebar: Filters -->
        <div class="col-3">
            <div class="container-main p-3">
                <h4 class="category mb-4">Category</h4>
                <div class="col-3">
                <div class="p-3">
    <h4 class="mb-4">Filters</h4>
    <form method="GET" action="">
        <!-- Category Filter -->
        <div class="mb-4">
            <h6 class="mb-3">Computer Parts</h6>
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
            <h6 class="mb-3">Brand</h6>
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

<!-- Product Listings -->
<div class="col-9">
            <!-- Search Result Info Row -->
            <div class="container-search d-flex justify-content-between align-items-center bg-light p-3 mb-3">
                <div>
                    <?php if (!empty($searchQuery)): ?>
                        <span class="fw-bold">Search Result for:</span> "<?php echo htmlspecialchars($searchQuery); ?>", 
                    <?php endif; ?>
                    <span class="fw-bold"><?php echo count($products); ?> results</span> found.
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
                        <div class="image-wrapper">
                        <!-- Display the product image -->
                        <img src="<?php echo $imgSrc; ?>" class="card-img-top" alt="Product Image" style="width: 100%; height: auto; object-fit: cover; display: block; margin: auto;"></div>
                        
                        <div class="card-body">
                            <!-- Display product name and SRP -->
                            <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                            <p class="card-text">
                                <strong>Price:</strong> ₱<?php echo number_format($product['srp'], 2); ?><br>
                            </p>
                        </div>
                        <div class="card-footer">
                            <!-- View Details Button with dynamic product ID -->
                            <button id="view-details-<?php echo $product['product_ID']; ?>" class="btn btn-primary-footer" onclick="viewDetails(<?php echo $product['product_ID']; ?>)">View Details</button>
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
