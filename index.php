<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>RPC Tech Computer Store</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="icon" href="assets/images/rpc-favicon.png">
</head>
<body>
<?php include 'includes/welcomemodal.php'; ?> 
<?php include 'includes/header.php'; ?>

<div id="carouselWithInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- Carousel Items -->
        <?php for ($i = 1; $i <= 16; $i++): ?>
        <div class="carousel-item <?= $i === 1 ? 'active' : '' ?>" data-bs-interval="2000">
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

<div class="brand-logo-container overflow-hidden my-5">
    <div class="brand-logo-wrapper d-flex">
        <?php 
        $brands = ["amd", "asus", "biostar", "coolermaster", "corsair", "cougar"];
        foreach (array_merge($brands, $brands) as $brand): ?>
        <img src="assets/images/brands/<?= $brand ?>.png" alt="<?= ucfirst($brand) ?>" class="brand-logo mx-3">
        <?php endforeach; ?>
    </div>
</div>

<div class="container my-4">
    <h2 class="text-center mb-4">Featured Products</h2>
    <div class="row g-3">
        <?php for ($i = 1; $i <= 5; $i++): ?>
        <div class="col-sm-6 col-md-4 col-lg-2">
            <div class="card">
                <img src="assets/images/defaultproduct.png" class="card-img-top img-fluid" alt="Product <?= $i ?>">
                <div class="card-body">
                    <h5 class="card-title">Product <?= $i ?></h5>
                    <p class="card-text">Price <?= $i ?></p>
                    <a href="#" class="btn btn-primary w-100">Add to Cart</a>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</div>

<div class="dss-section container-fluid py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 mb-4">
            <h1 class="display-4 fw-bold">Don’t know what to buy?</h1>
            <p class="lead">Check our “Parts Recommendation System” to help you figure out your needs!</p>
        </div>
        <div class="col-12">
            <a href="#" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
