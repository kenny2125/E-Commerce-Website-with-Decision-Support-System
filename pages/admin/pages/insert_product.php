<?php
// Database connection
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

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $product_name = $_POST['product_name'];
    $brand_ID = $_POST['brand_ID'];  // Ensure this is the brand_ID from the dropdown
    $category = $_POST['category'];
    $srp = $_POST['srp'];
    $store_price = $_POST['store_price'];
    $description = $_POST['description'];
    $specification = $_POST['specification'];
    $quantity = $_POST['quantity'];

    // Handle image upload  
    $image_name = "defaultproduct.png"; // Default image
    $image_data = null;

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $image_name = $_FILES['product_image']['name'];
        $image_data = file_get_contents($_FILES['product_image']['tmp_name']);
        $image_data = $conn->real_escape_string($image_data); // Escape binary data
    }

    // Prepare SQL query for inserting product with image
    $insert_sql = "INSERT INTO tbl_products (product_name, brand_ID, category, srp, store_price, description, specification, img_name, img_data, quantity) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($insert_sql);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters (s = string, d = double, b = blob)
    $stmt->bind_param('sssssssbsi', 
        $product_name, $brand_ID, $category, $srp, $store_price, $description, $specification, $image_name, $image_data, $quantity
    );

    // Execute the query
    if ($stmt->execute()) {
       
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
