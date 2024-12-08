<?php
session_start(); // Start the session

// Check if the user is logged in
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false; // Safe check for isLoggedIn

// Initialize the check for admin role
$isAdmin = ($_SESSION['role'] ?? '') === 'admin'; // Check if role is 'admin'
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
$sql = "SELECT o.order_ID, 
               o.payment_status, 
               o.pickup_status, 
               o.user_ID, 
               CASE 
                   WHEN o.user_ID = 1 THEN o.walk_name 
                   ELSE CONCAT(u.first_name, ' ', u.last_name) 
               END AS customer_name, 
               o.total, 
               o.order_date, 
               p.product_name
        FROM tbl_orders o
        LEFT JOIN tbl_user u ON o.user_ID = u.user_ID
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
    <link rel="stylesheet" href="/assets/css/orders_management.css">
    <title>Orders Management</title>
</head>
<body style="background-color: #EBEBEB;">
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Clickable Logo -->
        <a href="/index.php">
            <img src="/assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        </a>
        
        <!-- Search Bar -->
        <form action="pages/shop/Products_List.php" method="get" class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button href="pages/shop/Products_List.php" class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <!-- User-specific Content -->
        <?php if ($isLoggedIn === true): ?>
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                <div class="icon-container">
                    <!-- Cart and Profile Links -->
                    <a href="pages/shop/carting_list.php">
                        <img src="/assets/images/Group 204.png" alt="Cart Icon">
                    </a>
                    <a href="pages/user/user_profile.php">
                        <img src="/assets/images/Group 48.png" alt="Profile Icon">
                    </a>

                    <!-- Admin Link (only visible to admins) -->
                    <?php if ($isAdmin): ?>
                        <a href="pages/admin/pages/admin_dashboard.php" class="btn btn-outline-danger ms-3">
                            Admin Dashboard
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- If not logged in, show login button -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
        <?php endif; ?>
    </div>
</nav>

<div class="container-fluid" style="padding: 50px;">
        <div class="row">
            <!-- Sidebar Section -->
            <div class="col-md-2 admin-sidebar" style="background-color: #1A54C0; border-radius: 20px; margin-right: 35px; margin-left: 68px; box-shadow: 0 4px 10px #888383;">
                <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 100%; margin-top: 30px;">
                    <ul class="nav nav-pills flex-column mb-auto">
           
                        <li>
                            <a href="admin_dashboard.php" class="nav-link link-light">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="inventory_management.php" class="nav-link link-light">
                                Inventory Management
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-light active" aria-current="page">
                                Orders Management
                            </a>
                        </li>
                        <li>
                            <a href="payment_list.php" class="nav-link link-light">
                                Payments List
                            </a>
                        </li>
                    </ul>
                    <div class="container-fluid admin-dropdown">
                <div class="d-flex justify-content-end">
        <div class="dropdown" style="background-color: #fff; margin-top: 355px; margin-bottom: 20px; border-radius: 20px; padding-right: 10px; padding-left: 30px; padding-top: 20px; padding-bottom: 10px;">
        <img src="/assets/images/Vector.png" alt="Vector" class="vector" style="margin-left: -15px; margin-right: 9px; margin-top: 3px;"><strong style="margin-right: 9.3px; text-align: center;">John Kenny Q. Reyes</strong>
                <a href="../../user/logout.php" class="btn" style="background-color: #1A54C0; color: #fff; margin-left: 35px; margin-top: 10px; padding-right: 20px; padding-left: 20px;">Log Out</a>
            </a>
        </div>
    </div>
</div>
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
                                    <td class='customer-name'>{$row['customer_name']}</td>
                                    <td class='product-name'>{$row['product_name']}</td>
                                    <td class='order-total'>₱" . number_format($row['total'], 2) . "</td>
                                    <td class='order-date'>{$row['order_date']}</td>
                                    <td>
                                        <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editOrderModal' onclick='editOrder({$row['order_ID']})'>Edit</button>
                                      
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
            
            <!-- Order Number -->
            <div class="mb-3">
              <label for="orderNumber" class="form-label">Order Number</label>
              <p id="orderNumber"></p> <!-- Display the order number here -->
            </div>
            
            <div class="mb-3">
              <label for="paymentStatus" class="form-label">Payment Status</label>
              <select name="payment_status" class="form-control" id="paymentStatus" required>
                <option value="PAID">PAID</option>
                <option value="PENDING">PENDING</option>
                <option value="CANCELLED">CANCELLED</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="pickupStatus" class="form-label">Pickup Status</label>
              <select name="pickup_status" class="form-control" id="pickupStatus" required>
                <option value="CLAIMED">CLAIMED</option>
                <option value="SHIPPED">SHIPPED</option>
                <option value="PENDING">PENDING</option>
              </select>
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
      <form action="../pages/insert_orders.php" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label for="paymentStatus" class="form-label">Payment Status</label>
            <select name="payment_status" class="form-control" id="paymentStatus" required>
              <option value="PAID">PAID</option>
              <option value="PENDING">PENDING</option>
              <option value="CANCELLED">CANCELLED</option>
            </select>
          </div>
          <!-- Walk-In Name for customers without an account -->
          <div class="mb-3">
            <label for="walkName" class="form-label">Walk-In Name</label>
            <input type="text" name="walk_name" class="form-control" id="walkName" placeholder="Enter name for walk-in buyer" required>
          </div>
            <div class="mb-3">
              <label for="pickupStatus" class="form-label">Pickup Status</label>
              <select name="pickup_status" class="form-control" id="pickupStatus" required>
                <option value="CLAIMED">CLAIMED</option>
                <option value="SHIPPED">SHIPPED</option>
                <option value="PENDING">PENDING</option>
              </select>
            </div>
          <div class="mb-3">
            <label for="productID" class="form-label">Select Product</label>
            <select name="product_ID" class="form-control" id="productID" required onchange="updateTotal(this)">
              <option value="" disabled selected>Select a product</option>
              <?php
              // Fetch products from the database
              $conn = new mysqli($host, $username, $password, $db_name);
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }
              $sql = "SELECT product_ID, product_name, store_price FROM tbl_products ORDER BY product_ID DESC";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<option value='{$row['product_ID']}' data-price='{$row['store_price']}'>
                              {$row['product_name']} - ₱{$row['store_price']}
                            </option>";
                  }
              } else {
                  echo "<option value=''>No products available</option>";
              }
              $conn->close();
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="orderTotal" class="form-label">Total</label>
            <input type="text" name="total" class="form-control" id="orderTotal" readonly>
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
  function updateTotal(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const price = selectedOption.getAttribute("data-price") || 0;
    document.getElementById("orderTotal").value = price;
  }
</script>





<script>
// Function to edit the order data in the modal
function editOrder(orderID) {
    // Get the row corresponding to the clicked order
    var row = document.querySelector(`#order-row-${orderID}`);
    
    // Set the modal fields with data from the selected row
    document.getElementById('editOrderID').value = orderID;
    document.getElementById('paymentStatus').value = row.getAttribute('data-payment-status');
    document.getElementById('pickupStatus').value = row.getAttribute('data-pickup-status');
    document.getElementById('editUserID').value = row.getAttribute('data-user-id');
    document.getElementById('editProductName').value = row.getAttribute('data-product-name');
    document.getElementById('editOrderTotal').value = row.getAttribute('data-total');
    document.getElementById('editOrderDate').value = row.getAttribute('data-order-date');
    
    // Update the order number on top of the modal
    document.getElementById('orderNumber').innerText = 'Order #: ' + orderID;
}
</script>


</body>
</html>

