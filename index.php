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

    <!-- Carousel -->
    <div id="carouselWithInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
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

    <!-- Brand Logos -->
    <div class="brand-logo-container overflow-hidden my-5">
        <div class="brand-logo-wrapper d-flex">
            <?php 
            $brands = ["amd", "asus", "biostar", "coolermaster", "corsair", "cougar", "darkflash", "dell", "fanatec", "gigabyte", "gskill", "hp", "inplay", "intel", "kingston", "msi", "nvidia", "nvision", "nzxt", "samsung"];

            foreach (array_merge($brands, $brands) as $brand): ?>
                <img src="assets/images/brands/<?= $brand ?>.png" alt="<?= ucfirst($brand) ?>" class="brand-logo mx-3">
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="featured-products-wrapper">
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
    </div>

<!-- DSS Section -->
<div style="width: 100%; height: 450px; position: relative; background-image: url('assets/images/banner-dss.png'); background-size: cover; background-position: center;">
  <!-- Content Layer (Text and Button) -->
  <div style="width: 100%; height: 300px%; position: absolute; left: 0; top: 0; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; color: black;">
    <div style="font-size: 64px; font-family: Work Sans; font-weight: 600; word-wrap: break-word;">Don’t know what to buy?</div>
    <div style="font-size: 16px; font-family: Lato; font-weight: 400; word-wrap: break-word; margin-top: 10px;">
      Check our “Parts Recommendation System” helps you figure out your needs!
    </div>
    <div style="width: 162.35px; height: 59.87px; margin-top: 20px; position: relative;">
      <div style="width: 100%; height: 90%; background: #1A54C0; border-radius: 74px;"></div>
      <div style="position: absolute; top: 25%; left: 0; width: 100%; height: 100%; text-align: center; color: white; font-size: 16px; font-family: Lato; font-weight: 700; word-wrap: break-word;">
        Get Started
      </div>
    </div>
  </div>
</div>

<br>
<br>
<br>
<br>
<br><br><br><br><br><br><br>

    <?php include 'includes/footer.php'; ?>
</body>
</html>