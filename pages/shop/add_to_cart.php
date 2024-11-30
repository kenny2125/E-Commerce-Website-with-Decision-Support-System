<?php
// Database connection
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";
$port = "3306";

$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set user ID variable (change this value as needed)
$user_id = 2; // You can change this value to filter by different users

// Query to fetch products for the specific user
$sql = "SELECT p.product_ID, p.product_name, p.store_price, p.img_data 
        FROM tbl_products p
        JOIN tbl_cart c ON p.product_ID = c.product_ID
        WHERE c.user_ID = $user_id"; // Only fetch products added to the cart by the specified user

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            width: 100%;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .product-card img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            margin-right: 20px;
        }
        .product-info {
            flex: 1;
        }
        .product-info h5 {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h3>Products for User <?php echo $user_id; ?></h3>
    <form method="POST" action="checkout_page.php">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Output products
                while ($row = $result->fetch_assoc()) {
                    $product_ID = $row['product_ID'];
                    $product_name = $row['product_name'];
                    $store_price = $row['store_price'];
                    $img_data = $row['img_data'];

                    // Convert img_data to a base64 string for displaying
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
                                <!-- Checkbox for selecting the product -->
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

        <!-- Checkout Button -->
        <button type="submit" class="btn btn-primary mt-3">Proceed to Checkout</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>