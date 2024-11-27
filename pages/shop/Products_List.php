<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Products List</title>
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
        <div class="col-3">
    <div class="bg-light p-3">
        <h4 class="mb-4">Filters</h4>
        <form method="GET" action="">
            <!-- Category Filter -->
            <div class="mb-4">
                <h6 class="mb-2">Category</h6>
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
