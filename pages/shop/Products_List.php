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

$searchQuery = isset($_SESSION['search_query']) ? $_SESSION['search_query'] : '';

if ($searchQuery) {
    $sql = "SELECT * FROM tbl_products WHERE product_name LIKE '%$searchQuery%'";
}

$cacheExpirationTime = 60 * 30;

$searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

if (isset($_SESSION['products_cache']) && (time() - $_SESSION['products_cache_time'] < $cacheExpirationTime)) {
    $products = $_SESSION['products_cache'];
} else {

    $query = "SELECT * FROM tbl_products";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    $_SESSION['products_cache'] = $products;
    $_SESSION['products_cache_time'] = time();

    $stmt->close();
    $conn->close();
}

$startTime = microtime(true);

if (!empty($searchQuery)) {
    $products = array_filter($products, function ($product) use ($searchQuery) {
        return stripos($product['product_name'], $searchQuery) !== false;
    });
}

$endTime = microtime(true);

$searchTime = round($endTime - $startTime, 3);

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
<div class="row">
    <div class="col-12 mb-3" >
        <a href="?category=CPU" class="btn btn-primary w-100" style="padding: 7px;">CPU</a>
    </div>
    <div class="col-12 mb-3">
        <a href="?category=RAM" class="btn btn-primary w-100" style="padding: 7px;">RAM</a>
    </div>
    <div class="col-12 mb-3">
        <a href="?category=Motherboard" class="btn btn-primary w-100" style="padding: 7px;">Motherboard</a>
    </div>
    <div class="col-12 mb-3">
        <a href="?category=Video%20Card" class="btn btn-primary w-100" style="padding: 7px;">Video Card</a>
    </div>
    <div class="col-12 mb-3">
        <a href="?category=Computer%20Case" class="btn btn-primary w-100" style="padding: 7px;">Computer Case</a>
    </div>
    <div class="col-12 mb-3">
        <a href="?category=Solid%20State%20Drive" class="btn btn-primary w-100" style="padding: 7px;">Solid State Drive</a>
    </div>
    <div class="col-12 mb-3">
        <a href="?category=Hard%20Disk%20Drive" class="btn btn-primary w-100" style="padding: 7px;">Hard Disk Drive</a>
    </div>
    <div class="col-12 mb-3">
        <a href="?category=CPU%20Cooler" class="btn btn-primary w-100" style="padding: 7px;">CPU Cooler</a>
    </div>
    <div class="col-12 mb-3">
        <a href="?category=Power%20Supply" class="btn btn-primary w-100" style="padding: 7px;">Power Supply</a>
    </div>
    <div class="col-12 mb-3">
        <a href="?category=Monitor" class="btn btn-primary w-100" style="padding: 7px;">Monitor</a>
    </div>
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
