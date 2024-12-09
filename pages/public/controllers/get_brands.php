<?php
include '../../../config/db_config.php';

// Get the selected category from the URL parameter
$selected_category = $_GET['category']; // e.g., 'CPU'

// Query to get brands for the selected category
$sql = "
    SELECT DISTINCT b.brand_name
    FROM tbl_products p
    JOIN tbl_brands b ON p.brand_ID = b.brand_ID
    WHERE p.category = '$selected_category'
";

// Execute the query
$result = $conn->query($sql);

// Prepare the response (brands as buttons)
$brands = [];
while ($row = $result->fetch_assoc()) {
    $brands[] = $row['brand_name'];
}

// Send the brands back as a response in JSON format
echo json_encode($brands);
?>
