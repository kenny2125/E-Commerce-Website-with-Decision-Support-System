<?php
// Database connection
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

// Get form data
$product_name = $_POST['product_name'];
$brand_ID = $_POST['brand_ID'];
$category_ID = $_POST['category_ID'];
$srp = $_POST['srp'];
$store_price = $_POST['store_price'];
$description = $_POST['description'];
$specification = $_POST['specification'];
$quantity = $_POST['quantity'];

// Default image if no image uploaded
$image_name = "defaultproduct.png";
$image_data = null;

// Handle file upload if an image is uploaded
if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
    $image_tmp_name = $_FILES['product_image']['tmp_name'];

    // Read the file into a binary string
    $image_data = file_get_contents($image_tmp_name);
    $image_name = $_FILES['product_image']['name']; // Set the original file name
}

// Prepare SQL query with BLOB data
$sql = "INSERT INTO tbl_products (product_name, brand_ID, category_ID, srp, store_price, description, specification, img_name, img_data) 
        VALUES ('$product_name', '$brand_ID', '$category_ID', '$srp', '$store_price', '$description', '$specification', '$image_name', ?)";

// Prepare statement to bind the binary data
$stmt = $conn->prepare($sql);
$stmt->bind_param("b", $image_data); // "b" means binding a blob data

// Execute the query
if ($stmt->execute()) {
    echo "New product added successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$conn->close();
?>
