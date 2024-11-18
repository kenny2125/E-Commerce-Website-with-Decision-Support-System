<?php
include 'db_config.php';
include 'Product.php';

$productManager = new Product($conn);

// Testing ng Add product
if ($productManager->addProduct("Sample Product", 1, 1999.99, 1799.99, 2, true, "Sample description", "Sample specification", "img.jpg", 1)) {
    echo "Product added successfully!<br>";
} else {
    echo "Failed to add product.<br>";
}

// Testing ng Update
if ($productManager->updateProduct()) {
    echo "Product updated successfully!<br>";
} else {
    echo "Failed to update product.<br>";
}

// Test Get a product by ID
$product = $productManager->getProductById();
echo "<pre>";
print_r($product);
echo "</pre>";

// Test Get all products
$allProducts = $productManager->getAllProducts();
echo "<pre>";
print_r($allProducts);
echo "</pre>";

// Testing nang pag Delete ng product
if ($productManager->deleteProduct()) {
    echo "Product deleted successfully!<br>";
} else {
    echo "Failed to delete product.<br>";
}
?>