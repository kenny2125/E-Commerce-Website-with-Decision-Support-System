<?php
include 'db_config.php';

class Payment {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Add
    public function addPayment($order_ID, $payment_date, $amount, $payment_method, $status) {
        $sql = "INSERT INTO tbl_payments (order_ID, payment_date, amount, payment_method, status) 
                VALUES (:order_ID, :payment_date, :amount, :payment_method, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_ID', $order_ID);
        $stmt->bindParam(':payment_date', $payment_date);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    // Update
    public function updatePayment($payment_ID, $order_ID, $payment_date, $amount, $payment_method, $status) {
        $sql = "UPDATE tbl_payments SET order_ID = :order_ID, payment_date = :payment_date, amount = :amount, 
                payment_method = :payment_method, status = :status WHERE payment_ID = :payment_ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':payment_ID', $payment_ID);
        $stmt->bindParam(':order_ID', $order_ID);
        $stmt->bindParam(':payment_date', $payment_date);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    // Delete
    public function deletePayment($payment_ID) {
        $sql = "DELETE FROM tbl_payments WHERE payment_ID = :payment_ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':payment_ID', $payment_ID);
        return $stmt->execute();
    }

    // view payment by ID
    public function getPaymentById($payment_ID) {
        $sql = "SELECT * FROM tbl_payments WHERE payment_ID = :payment_ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':payment_ID', $payment_ID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // view all payments
    public function getAllPayments() {
        $sql = "SELECT * FROM tbl_payments";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
