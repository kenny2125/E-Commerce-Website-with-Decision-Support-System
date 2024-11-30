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
    $status = $_POST['status'];            // Payment status (e.g., PAID, REFUNDED)
    $cust_name = $_POST['cust_name'];      // Customer's name
    $amount = $_POST['amount'];            // Payment amount
    $source_type = $_POST['source_type'];  // Payment method (GCASH, MAYA, CASH)
    // $ = $_POST['']; // Optional external reference
    // $ = $_POST[''];          // Payment date/time (optional)

    // Prepare SQL query for inserting payment data
    $insert_sql = "INSERT INTO tbl_payments (status, cust_name, amount, source_type )
                   VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($insert_sql);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters (s = string, d = double, i = integer,  s = string for datetime)
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