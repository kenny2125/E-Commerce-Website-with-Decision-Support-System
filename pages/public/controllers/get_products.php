<?php
include '../../../config/db_config.php';

// Get the selected category and brand from the URL parameters
$selected_category = $_GET['category']; // e.g., 'CPU'
$selected_brand = $_GET['brand'] ?? ''; // e.g., 'AMD', empty string if no brand filter

// Query to get products based on selected category and brand (including img_data for the image)
$sql = "
    SELECT p.product_name, p.srp, p.store_price, p.description, p.img_name, p.img_data, p.product_ID
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
    // If img_data is available, encode it in base64 and send it as part of the response
    if (!empty($row['img_data'])) {
        $row['img_data'] = base64_encode($row['img_data']);
    }
    $products[] = $row;
}

// Send the products back as a response in JSON format
echo json_encode($products);
?>
