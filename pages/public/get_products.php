<?php
include('db_config.php');

// Get the selected category and brand from the URL parameters
$selected_category = $_GET['category']; // e.g., 'CPU'
$selected_brand = $_GET['brand'] ?? ''; // e.g., 'AMD', empty string if no brand filter

// Query to get products based on selected category and brand (no price filtering)
$sql = "
    SELECT p.product_name, p.srp, p.store_price
    FROM tbl_products p
    JOIN tbl_brands b ON p.brand_ID = b.brand_ID
    WHERE p.category = '$selected_category'
";

// If a brand is selected, add the brand condition to the query
if (!empty($selected_brand)) {
    $sql .= " AND b.brand_name = '$selected_brand'";
}

// Execute the query
$result = $conn->query($sql);

// Prepare the response (products list)
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Send the products back as a response in JSON format
echo json_encode($products);
?>
