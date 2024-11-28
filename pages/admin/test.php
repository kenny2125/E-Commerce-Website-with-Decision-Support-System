<?php
// Database connection details
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";
$port = "3306";

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product data
$sql = "SELECT p.product_ID, p.product_name, p.srp, p.store_price, p.description, p.specification, 
               p.img_name, p.img_data, c.category_name, b.brand_name 
        FROM tbl_products p
        LEFT JOIN tbl_categories c ON p.category_ID = c.category_ID
        LEFT JOIN tbl_brands b ON p.brand_ID = b.brand_ID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the product details
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<h3>" . htmlspecialchars($row['product_name']) . "</h3>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category_name']) . "</p>";
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
