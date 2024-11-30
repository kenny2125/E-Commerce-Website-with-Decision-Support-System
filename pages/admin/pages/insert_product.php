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
    // Get form data for other product details
    $product_name = $_POST['product_name'];
    $brand_ID = $_POST['brand_ID'];
    $category = $_POST['category'];
    $srp = $_POST['srp'];
    $store_price = $_POST['store_price'];
    $description = $_POST['description'];
    $specification = $_POST['specification'];
    $quantity = $_POST['quantity'];

    // Handle image upload
    $image_name = "defaultproduct.png"; // Default image name
    $image_data = null;

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $image_name = $_FILES['product_image']['name'];
        $image_data = file_get_contents($_FILES['product_image']['tmp_name']);
        $image_data = $conn->real_escape_string($image_data);  // Escape binary data
    }

    // Insert the product details first
    $sql_product = "INSERT INTO tbl_products (product_name, brand_ID, category, srp, store_price, description, specification, quantity) 
                    VALUES ('$product_name', '$brand_ID', '$category', '$srp', '$store_price', '$description', '$specification', '$quantity')";
    
    if ($conn->query($sql_product) === TRUE) {
        // Get the last inserted product ID
        $product_id = $conn->insert_id;  // Retrieve the last inserted product ID

        // Now insert the image associated with the product ID
        if ($image_data !== null) {
            $sql_image = "UPDATE tbl_products SET img_name = '$image_name', img_data = '$image_data' WHERE product_ID = $product_id";
            if ($conn->query($sql_image) === TRUE) {
                echo "Image uploaded successfully and associated with product!";
            } else {
                echo "Error uploading image: " . $conn->error;
            }
        } else {
            echo "No image uploaded, using default.";
        }
    } else {
        echo "Error adding product: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
