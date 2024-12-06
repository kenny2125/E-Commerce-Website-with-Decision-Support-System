<?php
    include 'includes/welcomemodal.php';
    include 'includes/header.php';
    include 'config/db_config.php';
    
    // Cache expiry time (1 hour in seconds)
    $cacheTime = 3600; 

    // Check if the product data is already in the session and if it's still valid
    if (isset($_SESSION['products_cache_time']) && (time() - $_SESSION['products_cache_time'] < $cacheTime)) {
        // Load data from the session cache
        $products = $_SESSION['products_cache'];
    } else {
        // Fetch data from the database
        $sql = "SELECT product_ID, product_name, srp, img_data FROM tbl_products LIMIT 6";
        $result = $conn->query($sql);

        $products = [];
        if ($result->num_rows > 0) {
            // Store products in an array
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }

            // Save the fetched data into the session as cache
            $_SESSION['products_cache'] = $products;
            $_SESSION['products_cache_time'] = time(); // Store the cache time
        }

        // Close the database connection
        $conn->close();
    }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <script src="assets/js/index.js"></script>
    <title>RPC Tech Computer Store</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="icon" href="assets/images/rpc-favicon.png">
</head>
<body>



<!-- Carousel -->
<div id="carouselWithInterval" class="carousel slide mx-2" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php for ($i = 1; $i <= 16; $i++): ?>
            <div class="carousel-item <?= $i === 1 ? 'active' : '' ?>" data-bs-interval="7000">
                <img src="assets/images/bs-images/WHITE BANNER VERSION (<?= $i ?>).png" class="d-block w-100 img-fluid" alt="Slide <?= $i ?>">
            </div>
        <?php endfor; ?>
    </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselWithInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselWithInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Brand Logos -->
    <div class="brand-logo-container overflow-hidden my-5" style="height: 100px;">
        <div class="brand-logo-wrapper d-flex animate-loop">
            <?php 
            $brands = ["amd", "asus", "biostar", "coolermaster", "corsair", "cougar", "darkflash", "dell", "fanatec", "gigabyte", "gskill", "hp", "inplay", "intel", "kingston", "msi", "nvidia", "nvision", "nzxt", "samsung"];
            foreach (array_merge($brands, $brands) as $brand): ?>
            <img src="assets/images/brands/<?= $brand ?>.png" alt="<?= ucfirst($brand) ?>" class="brand-logo mx-4" style="height: 50px;">
            <?php endforeach; ?>
        </div>
    </div>
</div>



<!-- Featured Products -->
<div class="featured-products-wrapper" style="margin-bottom: 100px;">
    <div class="container my-4">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row g-3">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                        <div class="card" style="width: 309.328px; height: 437.188px; display: flex; flex-direction: column; align-items: center; border: 1px solid #ddd;">
                    <?php
                    // Check if there is image data
                    if (!empty($product['img_data'])) {
                        $imgData = base64_encode($product['img_data']);
                        $imgSrc = 'data:image/jpeg;base64,' . $imgData;
                    } else {
                        $imgSrc = 'path/to/default-image.jpg';
                    }
                    ?>
                            <div class="image-wrapper">
                                <!-- Display the product image inside the image-wrapper -->
                                <img src="<?php echo $imgSrc; ?>" class="card-img-top img-fluid" alt="Product Image">
                            </div>
                            <!-- Card Body (Title and Text Centered) -->
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                <p class="card-text">
                                    <strong>Price:</strong> ₱<?php echo number_format($product['srp'], 2); ?><br>
                                </p>
                            </div>
                            <!-- Card Footer (Button stays at the bottom) -->
                            <div class="card-footer">
                                <a href="/pages/shop/Product_Detail.php?id=<?php echo $product['product_ID']; ?>" class="btn btn-primary-footer">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">No featured products available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- DSS Section -->
<div class="banner-section">
    <div class="banner-content">
        <div class="banner-title">Don’t know what to buy?</div>
        <div class="banner-subtitle">Check our “Parts Recommendation System” helps you figure out your needs!</div>
        <a href="pages/public/partsrecommendationsystem.php" class="banner-button">Get Started</a>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
</body>
</html>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if ($openModal): ?>
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        <?php endif; ?>
    });
</script>

