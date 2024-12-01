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

// Correct SQL query to join the tables properly based on foreign keys
$sql = "SELECT o.order_ID, o.payment_status, o.pickup_status, o.user_ID, u.first_name, u.last_name, o.total, o.order_date, p.product_name
        FROM tbl_orders o
        JOIN tbl_user u ON o.user_ID = u.user_ID
        JOIN tbl_products p ON o.product_ID = p.product_ID";  

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
                    <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addOrderModal">Add Order</button>
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
                            <th>Pickup Status</th>
                            <th>Customer Name</th>
                            <th>Product Name</th>
                            <th>Total</th>
                            <th>Ordering Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                              $customer_name = $row['first_name'] . " " . $row['last_name'];
                              echo "<tr id='order-row-{$row['order_ID']}'
                                       data-payment-status='{$row['payment_status']}'
                                       data-pickup-status='{$row['pickup_status']}'
                                       data-user-id='{$row['user_ID']}'
                                       data-product-name='{$row['product_name']}'
                                       data-total='{$row['total']}'
                                       data-order-date='{$row['order_date']}'>
                                      <td>{$row['order_ID']}</td>
                                      <td class='payment-status'>{$row['payment_status']}</td>
                                      <td class='pickup-status'>{$row['pickup_status']}</td>
                                      <td class='customer-name'>{$customer_name}</td>
                                      <td class='product-name'>{$row['product_name']}</td>
                                      <td class='order-total'>₱" . number_format($row['total'], 2) . "</td>
                                      <td class='order-date'>{$row['order_date']}</td>
                                      <td>
                                          <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editOrderModal' onclick='editOrder({$row['order_ID']})'>Edit</button>
                                          <button class='btn btn-danger btn-sm' onclick='deleteOrder({$row['order_ID']})'>Delete</button>
                                      </td>
                                    </tr>";
                          }
                      } else {
                          echo "<tr><td colspan='8' class='text-center'>No orders found</td></tr>";
                      }
                      ?>
                  </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Order -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="update_order.php" method="POST">
        <div class="modal-body">
            <input type="hidden" name="order_ID" id="editOrderID"> <!-- Hidden input for order ID -->
            
            <div class="mb-3">
                <label for="editPaymentStatus" class="form-label">Payment Status</label>
                <input type="text" name="payment_status" class="form-control" id="editPaymentStatus" required>
            </div>
            <div class="mb-3">
                <label for="editPickupStatus" class="form-label">Pickup Status</label>
                <input type="text" name="pickup_status" class="form-control" id="editPickupStatus" required>
            </div>
            <div class="mb-3">
                <label for="editUserID" class="form-label">Customer ID</label>
                <input type="text" name="user_ID" class="form-control" id="editUserID" required>
            </div>
            <div class="mb-3">
                <label for="editProductName" class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="editProductName" required>
            </div>
            <div class="mb-3">
                <label for="editOrderTotal" class="form-label">Total</label>
                <input type="number" name="total" class="form-control" id="editOrderTotal" required>
            </div>
            <div class="mb-3">
                <label for="editOrderDate" class="form-label">Ordering Date</label>
                <input type="date" name="order_date" class="form-control" id="editOrderDate" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Order</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal for Adding Order -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addOrderModalLabel">Add Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../pages/insert" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label for="paymentStatus" class="form-label">Payment Status</label>
            <input type="text" name="payment_status" class="form-control" id="paymentStatus" required>
          </div>
          <!-- Walk-In Name for customers without an account -->
          <div class="mb-3">
            <label for="walkName" class="form-label">Walk-In Name</label>
            <input type="text" name="walk_name" class="form-control" id="walkName" placeholder="Enter name for walk-in buyer" required>
          </div>
          <div class="mb-3">
            <label for="pickupStatus" class="form-label">Pickup Status</label>
            <input type="text" name="pickup_status" class="form-control" id="pickupStatus" required>
          </div>
          <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" name="product_name" class="form-control" id="productName" required>
          </div>
          <div class="mb-3">
            <label for="orderTotal" class="form-label">Total</label>
            <input type="number" name="total" class="form-control" id="orderTotal" required>
          </div>
          <div class="mb-3">
            <label for="orderDate" class="form-label">Ordering Date</label>
            <input type="date" name="order_date" class="form-control" id="orderDate" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Order</button>
        </div>
      </form>
    </div>
  </div>
</div>




<script>
// Function to edit the order data in the modal
function editOrder(orderID) {
    // Get the row corresponding to the clicked order
    var row = document.querySelector(`#order-row-${orderID}`);
    
    // Set the modal fields with data from the selected row
    document.getElementById('editOrderID').value = orderID;
    document.getElementById('editPaymentStatus').value = row.getAttribute('data-payment-status');
    document.getElementById('editPickupStatus').value = row.getAttribute('data-pickup-status');
    document.getElementById('editUserID').value = row.getAttribute('data-user-id');
    document.getElementById('editProductName').value = row.getAttribute('data-product-name');
    document.getElementById('editOrderTotal').value = row.getAttribute('data-total');
    document.getElementById('editOrderDate').value = row.getAttribute('data-order-date');
}
</script>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
