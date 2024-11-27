<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Products List</title>
    <!-- Correct CSS Path -->
    <link rel="stylesheet" href="/assets/css/products_List.css">
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Logo -->
        <img src="/assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        <!-- Search Bar -->
        <form class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar: Filters -->
        <div class="col-3">
            <div class="bg-light p-3">
                <h4 class="mb-4">Filters</h4>
                <form method="GET" action="">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category" class="form-select">
                            <option value="">All Categories</option>
                            <option value="graphics-card">Graphics Card</option>
                            <option value="laptop">Laptop</option>
                            <option value="gaming-laptop">Gaming Laptop</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <select id="brand" name="brand" class="form-select">
                            <option value="">All Brands</option>
                            <option value="msi">MSI</option>
                            <option value="dell">Dell</option>
                            <option value="apple">Apple</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price-range" class="form-label">Price Range</label>
                        <input type="text" id="price-range" name="price-range" class="form-control" placeholder="e.g., 10000-50000">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </form>
            </div>
        </div>

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
                <!-- Example Card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path-to-image.jpg" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">Product Name</h5>
                            <p class="card-text">
                                <strong>Brand:</strong> Brand Name<br>
                                <strong>Price:</strong> ₱Price<br>
                                <strong>Stock:</strong> Quantity Available
                            </p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
                <!-- More cards to be dynamically added here -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>