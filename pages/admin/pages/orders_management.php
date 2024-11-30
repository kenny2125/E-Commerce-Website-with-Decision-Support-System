<?php
// Database Connection
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";
$port = "3306";

$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Orders from tbl_orders
$sql = "SELECT order_ID, payment_status, user_ID, total, order_date FROM tbl_orders";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Orders Management</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <img src="/assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        <form class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-3">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 100%;">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item"><a href="#" class="nav-link active">Dashboard</a></li>
                    <li><a href="#" class="nav-link link-dark">Admin Profile</a></li>
                    <li><a href="#" class="nav-link link-dark">Payments List</a></li>
                    <li><a href="#" class="nav-link link-dark">Inventory Management</a></li>
                    <li><a href="#" class="nav-link link-dark">Orders Management</a></li>
                </ul>
            </div>
        </div>

        <!-- Orders Management -->
        <div class="col-9">
            <div class="row">
                <div class="col-12 d-flex align-items-center mb-3">
                    <h5 class="me-auto">Orders Management</h5>
                    <button class="btn btn-primary me-2">Refresh</button>
                    <button class="btn btn-success me-2">Add Order</button>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Payment Status</th>
                                <th>Customer ID</th>
                                <th>Total</th>
                                <th>Ordering Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['order_ID']}</td>
                                            <td>{$row['payment_status']}</td>
                                            <td>{$row['user_ID']}</td>
                                            <td>₱" . number_format($row['total'], 2) . "</td>
                                            <td>{$row['order_date']}</td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No orders found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
