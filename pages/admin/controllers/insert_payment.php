<?php
// Database connection
include '../../../config/db_config.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $status = $_POST['status'];            // Payment status (e.g., PAID, REFUNDED)
    $cust_name = $_POST['cust_name'];      // Customer's name
    $amount = $_POST['amount'];            // Payment amount
    $source_type = $_POST['source_type'];  // Payment method (GCASH, MAYA, CASH)
    // $ = $_POST['']; // Optional external reference
    // $ = $_POST[''];          // Payment date/time (optional)

    // Prepare SQL query for inserting payment data
    $insert_sql = "INSERT INTO tbl_payments (status, cust_name, amount, source_type, created_at)
                   VALUES (?, ?, ?, ?, NOW())";

    // Prepare the statement
    $stmt = $conn->prepare($insert_sql);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters (s = string, d = double, i = integer, s = string for datetime)
    $stmt->bind_param('ssds', 
        $status, $cust_name, $amount, $source_type
    );

    // Execute the query
    if ($stmt->execute()) {
        // echo "Payment record inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
