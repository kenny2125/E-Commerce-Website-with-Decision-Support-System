<?php
    include '../../config/db_config.php';

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
        JOIN tbl_products p ON o.product_ID = p.product_ID
        ORDER BY o.order_ID DESC";



$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="/assets/css/orders_management.css"> -->
    <title>Orders Management</title>
</head>
<body style="background-color: #EBEBEB;">
<!-- Header  -->
<nav class="navbar">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap" style="display: flex; align-items: center; height: auto; background-color: #FFFFFF; box-shadow: 0 7px 3px -2px lightgrey; padding: 10px 20px; position: relative;">
        <!-- Logo -->
        <a href="/index.php">
            <img src="/assets/images/rpc-logo-black.png" alt="Logo" class="logo" style="width: 240px; height: auto; max-width: 100%; margin-left: 20px; position: relative; left: 20px;">
        </a>
    
    <!-- Real-Time Clock -->       
    <div class="real-time-clock" style="text-align: center; font-family: Arial, sans-serif; color: #000; margin-right: 50px;">
    <div id="clock" style="font-size: 30px; font-weight: bold;"></div>
    <div id="date" style="font-size: 18px; margin-top: 10px;"></div>
    </div>
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
      <form action="controllers/insert_orders.php" method="POST">
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


</body>
</html>

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
<script>
function updateClock() {
    const now = new Date();

    // Format time (12-hour format with AM/PM)
    let hours = now.getHours();
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';  // Determine AM or PM
    hours = hours % 12; // Convert to 12-hour format
    hours = hours ? hours : 12; // Handle 0 hour as 12
    const formattedHours = hours.toString().padStart(2, '0');

    // Format date
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = now.toLocaleDateString(undefined, options);

    // Update the clock and date
    document.getElementById('clock').textContent = `${formattedHours}:${minutes}:${seconds} ${ampm}`;
    document.getElementById('date').textContent = dateString;
}

// Update the clock every second
setInterval(updateClock, 1000);
updateClock(); // Initialize immediately
</script>