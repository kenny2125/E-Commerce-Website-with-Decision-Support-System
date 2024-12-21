<?php
// Database connection details
include '../../config/db_config.php';

// Fetch product data
$sql = "SELECT p.product_ID, p.product_name, p.srp, p.store_price, p.description, p.specification, 
               p.img_name, p.img_data, p.category, b.brand_name 
        FROM tbl_products p
        LEFT JOIN tbl_brands b ON p.brand_ID = b.brand_ID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the product details
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<h3>" . htmlspecialchars($row['product_name']) . "</h3>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
        echo "<p><strong>Brand:</strong> " . htmlspecialchars($row['brand_name']) . "</p>";
        echo "<p><strong>Retail Price:</strong> ₱" . number_format($row['srp'], 2) . "</p>";
        echo "<p><strong>Store Price:</strong> ₱" . number_format($row['store_price'], 2) . "</p>";
        echo "<p><strong>Description:</strong> " . nl2br(htmlspecialchars($row['description'])) . "</p>";
        echo "<p><strong>Specifications:</strong> " . nl2br(htmlspecialchars($row['specification'])) . "</p>";

        // Display product image (img_data as BLOB)
        if ($row['img_data']) {
            echo "<p><strong>Image:</strong><br>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($row['img_data']) . "' alt='" . htmlspecialchars($row['img_name']) . "' width='200'></p>";
        } else {
            echo "<p><strong>Image:</strong> No image available</p>";
        }

        echo "</div><hr>";
    }
} else {
    echo "<p>No products found.</p>";
}

// Close the database connection
$conn->close();
?>
