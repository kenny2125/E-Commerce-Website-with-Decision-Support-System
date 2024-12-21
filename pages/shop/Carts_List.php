<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../assets/css/Carts_List.css">
    <title>My Cart</title>
    <link rel="icon" href="../../assets/images/rpc-favicon.png">
    <?php
    include '../../includes/header.php';
    include '../../config/db_config.php';

    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
    $isAdmin = ($_SESSION['role'] ?? '') === 'admin';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT p.product_ID, p.product_name, p.store_price, p.img_data 
            FROM tbl_products p
            JOIN tbl_cart c ON p.product_ID = c.product_ID
            WHERE c.user_ID = $user_ID";

    $result = $conn->query($sql);
    ?>
</head>
<body>
<div class="container mt-5">
    <h3>Cart List</h3>
    <form method="POST" action="Checkout.php">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_ID = $row['product_ID'];
                    $product_name = $row['product_name'];
                    $store_price = $row['store_price'];
                    $img_data = $row['img_data'];
                    $img_base64 = base64_encode($img_data);
            ?>
                    <div class="col-12">
                        <div class="product-card">
                            <img src="data:image/jpeg;base64,<?php echo $img_base64; ?>" alt="<?php echo $product_name; ?>">
                            <div class="product-info">
                                <h5><?php echo $product_name; ?></h5>
                                <p>Price: ₱<?php echo number_format($store_price, 2); ?></p>
                            </div>
                            <div>
                                <input type="checkbox" name="selected_products[]" value="<?php echo $product_ID; ?>">
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No products found for this user.";
            }
            ?>
        </div>
        <div style="text-align: right; margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
        </div>
    </form>
</div>
</body>
</html>
<?php
$conn->close();
?>
