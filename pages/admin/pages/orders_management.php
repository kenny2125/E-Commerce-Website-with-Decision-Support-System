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
                    <!-- Button to trigger the modal -->
                    <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
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

<!-- Modal for Adding Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="addProductModalLabel">Product Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <form action="insert_product.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <!-- First Column: Image Section -->
            <div class="col-md-4 d-flex justify-content-center align-items-center flex-column">
              <img id="productImage" src="../../../assets/images/defaultproduct.png" class="img-fluid rounded" alt="Product Image">
              <div class="mt-2 text-center">
                  <button type="button" class="btn btn-primary btn-sm d-block w-100 mt-2" onclick="document.getElementById('imageInput').click();">Replace Image</button>
                  <!-- Hidden File Input for Image Upload -->
                  <input type="file" name="product_image" id="imageInput" class="d-none" accept="image/*" onchange="previewImage(event)">
              </div>
            </div>

            <!-- Second Column: Product Details Section -->
            <div class="col-md-8">
              <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="productName">
              </div>
              <div class="mb-3">
                <label for="productDescription" class="form-label">Product Description</label>
                <textarea name="product_description" class="form-control" id="productDescription" rows="3"></textarea>
              </div>
              <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" name="product_price" class="form-control" id="productPrice">
              </div>
            </div>
          </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Product</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function () {
        const productImage = document.getElementById('productImage');
        productImage.src = reader.result;
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>