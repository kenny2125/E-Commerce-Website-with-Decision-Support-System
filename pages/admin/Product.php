<?php
// Product.php
include 'db_config.php';

class Product {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Add a new product
    public function addProduct($product_name, $brand_ID, $srp, $store_price, $category_ID, $rgb_lights, $description, $specification, $img_url, $discount_ID) {
        $sql = "INSERT INTO tbl_products (product_name, brand_ID, srp, store_price, category_ID, rgb_lights, description, specification, img_url, discount_ID)
                VALUES (:product_name, :brand_ID, :srp, :store_price, :category_ID, :rgb_lights, :description, :specification, :img_url, :discount_ID)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':brand_ID', $brand_ID);
        $stmt->bindParam(':srp', $srp);
        $stmt->bindParam(':store_price', $store_price);
        $stmt->bindParam(':category_ID', $category_ID);
        $stmt->bindParam(':rgb_lights', $rgb_lights, PDO::PARAM_BOOL);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':specification', $specification);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->bindParam(':discount_ID', $discount_ID);
        return $stmt->execute();
    }

    // Update an existing product
    public function updateProduct($product_ID, $product_name, $brand_ID, $srp, $store_price, $category_ID, $rgb_lights, $description, $specification, $img_url, $discount_ID) {
        $sql = "UPDATE tbl_products SET product_name = :product_name, brand_ID = :brand_ID, srp = :srp, store_price = :store_price, 
                category_ID = :category_ID, rgb_lights = :rgb_lights, description = :description, specification = :specification, 
                img_url = :img_url, discount_ID = :discount_ID WHERE product_ID = :product_ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_ID', $product_ID);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':brand_ID', $brand_ID);
        $stmt->bindParam(':srp', $srp);
        $stmt->bindParam(':store_price', $store_price);
        $stmt->bindParam(':category_ID', $category_ID);
        $stmt->bindParam(':rgb_lights', $rgb_lights, PDO::PARAM_BOOL);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':specification', $specification);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->bindParam(':discount_ID', $discount_ID);
        return $stmt->execute();
    }

    // Delete a product by ID
    public function deleteProduct($product_ID) {
        $sql = "DELETE FROM tbl_products WHERE product_ID = :product_ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_ID', $product_ID);
        return $stmt->execute();
    }

    // Get a single product by ID
    public function getProductById($product_ID) {
        $sql = "SELECT * FROM tbl_products WHERE product_ID = :product_ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_ID', $product_ID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all products
    public function getAllProducts() {
        $sql = "SELECT * FROM tbl_products";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>