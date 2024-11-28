<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/payment_list.css">
</head>
<body style="background-color: #EBEBEB";>
<?php
    // Database connection
    $host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $username = "vg2eweo4yg8eydii";
    $password = "rccstjx3or46kpl9";
    $db_name = "s0gp0gvxcx3fc7ib";
    $port = "3306";

    // Create connection
    $conn = new mysqli($host, $username, $password, $db_name);

    // Fetch payment data
    $sql = "
    SELECT 
        payment_ID, 
        status, 
        cust_name, 
        amount, 
        phone, 
        source_type, 
        external_reference_number, 
        paid_at 
    FROM tbl_payments;
    ";

    $result = $conn->query($sql);

    // Handle edit action (save changes)
    if (isset($_POST['edit'])) {
        $payment_ID = $_POST['payment_ID'];
        $status = $_POST['status'];
        $cust_name = $_POST['cust_name'];
        $amount = $_POST['amount'];
        $source_type = $_POST['source_type'];

        $update_sql = "UPDATE tbl_payments 
                        SET status = ?, 
                            cust_name = ?, 
                            amount = ?, 
                            source_type = ? 
                        WHERE payment_ID = ?";

        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssdsi", $status, $cust_name, $amount, $source_type, $payment_ID);

        if ($stmt->execute()) {
            // echo "<script>alert('Payment updated successfully'); window.location.reload();</script>";
        } else {
            echo "<script>alert('Failed to update payment');</script>";
        }
    }
?>



<!-- Navigation -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Logo -->
        <img src="/assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        
        <!-- Search Bar -->
        <form class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid" style="padding: 50px">
    <div class="row">
        <!-- 1st Column: Sidebar -->
        <div class="col-3">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 100%;">
         
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link link-dark" aria-current="page">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Admin Profile
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link active">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                            Payments List
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                            Inventory Management
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                            Orders Management
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <strong>John Kenny Q. Reyes</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 2nd Column: Inventory -->
        <div class="col-9">
                <!-- Table Header -->
            <div class="row">
                <div class="col-12 d-flex align-items-center mb-3">
                    <img src="../../../assets/vectors/cash.svg" alt="Product Image" class="me-3" style="width: auto; height: 50px">
                    <h5 class="me-auto">Payments List</h5>
                    <!-- Refresh Button -->
                    <button class="btn btn-primary me-2" style="width: 150px; height: 35px" onclick="location.reload();">Refresh</button>

                    
                    <button class='btn btn-success me-2' style="width: 150px; height: 35px" data-bs-toggle='modal' data-bs-target='#addPaymentModal'>Add Payment</button>
                    <!-- Search Bar -->
                    <!-- <input type="text" class="form-control" placeholder="Search..."> -->
                </div>
            </div>

        <?php
// Database connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch payments data
$payments_query = "SELECT payment_ID, status, cust_name, amount, source_type, paid_at FROM tbl_payments";
$result = $conn->query($payments_query);
?>

<!-- Payments Table -->
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            <th>Payment ID</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Customer Name</th>
            <th>Payment Method</th>
            <th>Paid At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['payment_ID'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>₱ " . number_format($row['amount'], 2) . "</td>";
                echo "<td>" . $row['cust_name'] . "</td>";
                echo "<td>" . $row['source_type'] . "</td>";
                echo "<td>" . ($row['paid_at'] ? date("Y-m-d H:i:s", strtotime($row['paid_at'])) : 'N/A') . "</td>";
                echo "<td>
                        <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editPaymentModal-" . $row['payment_ID'] . "'>Edit</button>
                      </td>";
                echo "</tr>";

                // Edit Modal for the current payment
                echo "<div class='modal fade' id='editPaymentModal-" . $row['payment_ID'] . "' tabindex='-1' aria-labelledby='editPaymentModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title'>Edit Payment #" . $row['payment_ID'] . "</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form method='post'>
                                    <input type='hidden' name='payment_ID' value='" . $row['payment_ID'] . "'>
                                    
                                    <div class='mb-3'>
                                        <label for='status-" . $row['payment_ID'] . "' class='form-label'>Status</label>
                                        <select class='form-control' name='status' id='status-" . $row['payment_ID'] . "'>
                                            <option value='PAID' " . ($row['status'] === 'PAID' ? 'selected' : '') . ">PAID</option>
                                            <option value='REFUNDED' " . ($row['status'] === 'REFUNDED' ? 'selected' : '') . ">REFUNDED</option>
                                        </select>
                                    </div>
                                    
                                    <div class='mb-3'>
                                        <label for='amount-" . $row['payment_ID'] . "' class='form-label'>Amount</label>
                                        <input type='text' class='form-control' name='amount' id='amount-" . $row['payment_ID'] . "' value='" . $row['amount'] . "'>
                                    </div>
                                    
                                    <div class='mb-3'>
                                        <label for='cust_name-" . $row['payment_ID'] . "' class='form-label'>Customer Name</label>
                                        <input type='text' class='form-control' name='cust_name' id='cust_name-" . $row['payment_ID'] . "' value='" . $row['cust_name'] . "'>
                                    </div>
                                    
                                    <div class='mb-3'>
                                        <label for='source_type-" . $row['payment_ID'] . "' class='form-label'>Payment Method</label>
                                        <select class='form-control' name='source_type' id='source_type-" . $row['payment_ID'] . "'>
                                            <option value='GCASH' " . ($row['source_type'] === 'GCASH' ? 'selected' : '') . ">GCASH</option>
                                            <option value='MAYA' " . ($row['source_type'] === 'MAYA' ? 'selected' : '') . ">MAYA</option>
                                            <option value='CASH' " . ($row['source_type'] === 'CASH' ? 'selected' : '') . ">CASH</option>
                                        </select>
                                    </div>

                                    <button type='submit' name='edit' class='btn btn-primary'>Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>No payments found</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- Add Payment Modal -->
<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">Add New Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form that calls insert_payment.php -->
                <form id="addPaymentForm" method="POST">
    <div class="mb-3">
        <label for="new-status" class="form-label">Status</label>
        <select class="form-control" name="status" id="new-status" required>
            <option value="PAID">PAID</option>
            <option value="REFUNDED">REFUNDED</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="new-amount" class="form-label">Amount</label>
        <input type="text" class="form-control" name="amount" id="new-amount" required>
    </div>

    <div class="mb-3">
        <label for="new-cust_name" class="form-label">Customer Name</label>
        <input type="text" class="form-control" name="cust_name" id="new-cust_name" required>
    </div>

    <div class="mb-3">
        <label for="new-source_type" class="form-label">Payment Method</label>
        <select class="form-control" name="source_type" id="new-source_type" required>
            <option value="GCASH">GCASH</option>
            <option value="MAYA">MAYA</option>
            <option value="CASH">CASH</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Add Payment</button>
</form>

<script>
    // Prevent the default form submission
    document.getElementById('addPaymentForm').addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent the form from submitting normally

        // Prepare form data
        var formData = new FormData(this);

        // Send data via AJAX (fetch API)
        fetch('insert_payment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert("Payment added successfully!");
            console.log(data);  // You can log the response for debugging purposes
            // Optionally, close the modal or reset the form
            $('#addPaymentModal').modal('hide');
            document.getElementById('addPaymentForm').reset(); // Reset the form
        })
        // .catch(error => {
        //     console.error('Error:', error);
        //     alert("There was an error adding the payment.");
        // });
    });
</script>

            </div>
        </div>
    </div>
</div>


        </tbody>
    </table>
</div>


        </div>

    </div>

</div>

</body>
</html>