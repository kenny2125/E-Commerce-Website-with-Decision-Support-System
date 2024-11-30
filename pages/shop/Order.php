<?php
include 'db_config.php';

class Order {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Add
    public function addOrder($customer_ID, $product_ID, $quantity, $total_price, $order_date, $status) {
        $sql = "INSERT INTO tbl_orders (customer_ID, product_ID, quantity, total_price, order_date, status) 
                VALUES (:customer_ID, :product_ID, :quantity, :total_price, :order_date, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':customer_ID', $customer_ID);
        $stmt->bindParam(':product_ID', $product_ID);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    // Update
    public function updateOrder($order_ID, $customer_ID, $product_ID, $quantity, $total_price, $order_date, $status) {
        $sql = "UPDATE tbl_orders SET customer_ID = :customer_ID, product_ID = :product_ID, quantity = :quantity, 
                total_price = :total_price, order_date = :order_date, status = :status WHERE order_ID = :order_ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_ID', $order_ID);
        $stmt->bindParam(':customer_ID', $customer_ID);
        $stmt->bindParam(':product_ID', $product_ID);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    // Delete
    public function deleteOrder($order_ID) {
        $sql = "DELETE FROM tbl_orders WHERE order_ID = :order_ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_ID', $order_ID);
        return $stmt->execute();
    }

    // View order by ID
    public function getOrderById($order_ID) {
        $sql = "SELECT * FROM tbl_orders WHERE order_ID = :order_ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_ID', $order_ID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // view all orders
    public function getAllOrders() {
        $sql = "SELECT * FROM tbl_orders";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>