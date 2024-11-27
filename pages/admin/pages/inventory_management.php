<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/inventorymanagement.css">
</head>
<body style="background-color: #EBEBEB;">

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
                        <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                            Payments List
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link active">
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

        <!-- 2nd Column: Payments List -->
        <div class="col-9">
            <div class="row">
                <div class="col-12 d-flex align-items-center mb-3">
                    <img src="../../../assets/vectors/inventory.svg" alt="Product Image" class="me-3" style="width: auto; height: 50px">
                    <h5 class="me-auto">Inventory Management</h5>
                    <!-- Refresh Button -->
                    <button class="btn btn-primary me-2" style="width: 150px; height: 35px">Refresh</button>
                    <!-- Add Product Button -->
                    <button class="btn btn-primary me-2" style="width: 150px; height: 35px" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
                    <!-- Search Bar -->
                    <!-- <input type="text" class="form-control" placeholder="Search..."> -->
                  </div>
              </div>

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

// Handle delete action
if (isset($_POST['delete'])) {
    $product_id = $_POST['product_ID'];
    $delete_sql = "DELETE FROM tbl_products WHERE product_ID = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        // echo "<script>alert('Product deleted successfully'); window.location.reload();</script>";
    } else {
        echo "<script>alert('Failed to delete product');</script>";
    }
}

// Handle edit action (save changes)
if (isset($_POST['edit'])) {
    $product_id = $_POST['product_ID'];
    $product_name = $_POST['product_name'];
    $brand_ID = $_POST['brand_ID'];
    $category = $_POST['category'];
    $srp = $_POST['srp'];
    $store_price = $_POST['store_price'];
    $description = $_POST['description'];
    $specification = $_POST['specification'];
    $quantity = $_POST['quantity']; // Quantity field

    $update_sql = "UPDATE tbl_products 
                    SET product_name = ?, 
                        brand_ID = ?, 
                        category = ?, 
                        srp = ?, 
                        store_price = ?, 
                        description = ?, 
                        specification = ?, 
                        quantity = ? 
                    WHERE product_ID = ?";

    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssdssii", $product_name, $brand_ID, $category, $srp, $store_price, $description, $specification, $quantity, $product_id);

    if ($stmt->execute()) {
        // echo "<script>alert('Product updated successfully'); window.location.reload();</script>";
    } else {
        echo "<script>alert('Failed to update product');</script>";
    }
}

// Fetch product data
$sql = "SELECT p.product_ID, p.category, b.brand_name, p.product_name, p.srp, p.store_price, p.description, p.specification, p.quantity 
        FROM tbl_products p
        LEFT JOIN tbl_brands b ON p.brand_ID = b.brand_ID";

$result = $conn->query($sql);
?>

<div class="row">
    <div class="col-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Product #</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Product Name</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Store Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

   

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['product_ID'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['brand_name'] . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>Available</td>"; // Static status placeholder
                        echo "<td>" . $row['quantity'] . "</td>"; // Quantity field
                        echo "<td>₱ " . number_format($row['store_price'], 2) . "</td>";
                        echo "<td>
                                <form method='post' style='display:inline;'>
                                    <input type='hidden' name='product_ID' value='" . $row['product_ID'] . "'>
                                    <button type='submit' name='delete' class='btn btn-danger btn-sm'>Delete</button>
                                </form>
                                <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editProductModal-" . $row['product_ID'] . "'>Edit</button>
                              </td>";
                        echo "</tr>";

                        // Edit Modal for the current product
                        $brands_query = "SELECT brand_ID, brand_name FROM tbl_brands";
                        $brands_result = $conn->query($brands_query);
                        
                        $categories = [
                            "CPU", "RAM", "Motherboard", "Video Card", "Computer Case",
                            "Solid State Drive", "Hard Disk Drive", "CPU Cooler", "Power Supply", "Monitor"
                        ];
                        
                        echo "<div class='modal fade' id='editProductModal-" . $row['product_ID'] . "' tabindex='-1' aria-labelledby='editProductModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Edit Product</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <form method='post'>
                                            <input type='hidden' name='product_ID' value='" . $row['product_ID'] . "'>
                                            
                                            <div class='mb-3'>
                                                <label for='product_name-" . $row['product_ID'] . "' class='form-label'>Product Name</label>
                                                <input type='text' class='form-control' name='product_name' id='product_name-" . $row['product_ID'] . "' value='" . $row['product_name'] . "'>
                                            </div>
                        
                                            <div class='mb-3'>
                                                <label for='brand_ID-" . $row['product_ID'] . "' class='form-label'>Brand</label>
                                                <select name='brand_ID' class='form-control' id='brand_ID-" . $row['product_ID'] . "'>";
                                                
                                                // Populate brands dropdown
                                                while($brand = $brands_result->fetch_assoc()) {
                                                    $selected = ($brand['brand_ID'] == $row['brand_ID']) ? "selected" : "";
                                                    echo "<option value='" . $brand['brand_ID'] . "' $selected>" . $brand['brand_name'] . "</option>";
                                                }
                        
                        echo "          </select>
                                            </div>
                        
                                            <div class='mb-3'>
                                                <label for='category-" . $row['product_ID'] . "' class='form-label'>Category</label>
                                                <select name='category' class='form-control' id='category-" . $row['product_ID'] . "'>";
                        
                                                // Populate category dropdown
                                                foreach ($categories as $category) {
                                                    $selected = ($category == $row['category']) ? "selected" : "";
                                                    echo "<option value='" . $category . "' $selected>" . $category . "</option>";
                                                }
                        
                        echo "          </select>
                                            </div>
                        
                                            <div class='mb-3'>
                                                <label for='srp-" . $row['product_ID'] . "' class='form-label'>Retail Price</label>
                                                <input type='text' class='form-control' name='srp' id='srp-" . $row['product_ID'] . "' value='" . $row['srp'] . "'>
                                            </div>
                        
                                            <div class='mb-3'>
                                                <label for='store_price-" . $row['product_ID'] . "' class='form-label'>Store Price</label>
                                                <input type='text' class='form-control' name='store_price' id='store_price-" . $row['product_ID'] . "' value='" . $row['store_price'] . "'>
                                            </div>
                        
                                            <div class='mb-3'>
                                                <label for='description-" . $row['product_ID'] . "' class='form-label'>Description</label>
                                                <textarea class='form-control' name='description' id='description-" . $row['product_ID'] . "'>" . $row['description'] . "</textarea>
                                            </div>
                        
                                            <div class='mb-3'>
                                                <label for='specification-" . $row['product_ID'] . "' class='form-label'>Specifications</label>
                                                <textarea class='form-control' name='specification' id='specification-" . $row['product_ID'] . "'>" . $row['specification'] . "</textarea>
                                            </div>
                        
                                            <div class='d-flex align-items-center'>
                                                <label for='quantity-" . $row['product_ID'] . "' class='me-2'>Quantity</label>
                                                <input type='number' class='form-control mx-2' name='quantity' id='quantity-" . $row['product_ID'] . "' value='" . $row['quantity'] . "' min='1' style='width: 60px;'>
                                            </div>
                                            
                                            <button type='submit' name='edit' class='btn btn-primary mt-3'>Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
?>




<!-- Modal for Adding Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 1141px; max-height: 635px;">
    <div class="modal-content" style="height: 635px;">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="addProductModalLabel">Product Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <form action="insert_product.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body" style="height: calc(100% - 50px); overflow-y: auto;">
          <div class="row" style="height: 100%;">
            <!-- First Column: Image Section -->
            <div class="col-md-4 d-flex justify-content-center align-items-center flex-column">
              <img id="productImage" src="../../../assets/images/defaultproduct.png" class="img-fluid rounded" alt="Product Image" style="max-width: 100%; max-height: 100%;">
              <div class="mt-2 text-center">
                  <button type="button" class="btn btn-primary btn-sm  d-block w-100 mt-2" onclick="document.getElementById('imageInput').click();">Replace Image</button>
                  

                  <!-- Hidden File Input for Image Upload -->
                  <input type="file" name="product_image" id="imageInput" class="d-none" accept="image/*" onchange="previewImage(event)">
              </div>
            </div>

            <!-- Second Column: Product Details Section -->
            <div class="col-md-4">
              <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="productName">
              </div>

              <?php

// Create connection
$conn = new mysqli($host, $username, $password, $db_name, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch brand names from the database
$brand_sql = "SELECT brand_ID, brand_name FROM tbl_brands";
$brand_result = $conn->query($brand_sql);

// Check if the query was successful
if (!$brand_result) {
    die("Query failed: " . $conn->error);
}

?>

<div class="mb-3">
    <label for="brandName" class="form-label">Brand</label>
    <select name="brand_ID" class="form-control" id="brandName">
        <?php
        // Check if there are any brands
        if ($brand_result->num_rows > 0) {
            // Loop through and display each brand as an option
            while ($brand_row = $brand_result->fetch_assoc()) {
                echo "<option value='" . $brand_row['brand_ID'] . "'>" . $brand_row['brand_name'] . "</option>";
            }
        } else {
            echo "<option value=''>No Brands Available</option>";
        }
        ?>
    </select>
</div>

<?php
// Close the connection
$conn->close();
?>

                <div class="mb-3">
                <label for="categoryName" class="form-label">Category</label>
                <select name="category" class="form-control" id="categoryName">
                    <option value="CPU">CPU</option>
                    <option value="RAM">RAM</option>
                    <option value="Motherboard">Motherboard</option>
                    <option value="Video Card">Video Card</option>
                    <option value="Computer Case">Computer Case</option>
                    <option value="Solid State Drive">Solid State Drive</option>
                    <option value="Hard Disk Drive">Hard Disk Drive</option>
                    <option value="CPU Cooler">CPU Cooler</option>
                    <option value="Power Supply">Power Supply</option>
                    <option value="Monitor">Monitor</option>
                </select>
                </div>


              <div class="mb-3">
                <label for="retailPrice" class="form-label">Retail Price</label>
                <input type="text" name="srp" class="form-control" id="retailPrice">
              </div>

              <div class="mb-3">
                <label for="storePrice" class="form-label">Store Price</label>
                <input type="text" name="store_price" class="form-control" id="storePrice">
              </div>
            </div>

            <!-- Third Column: Description and Specifications -->
            <div class="col-md-4">
              <div class="mb-3">
                <label for="productDescription" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="productDescription" rows="5" placeholder="Enter a detailed product description."></textarea>
              </div>

              <div class="mb-3">
                <label for="productSpecs" class="form-label">Specifications</label>
                <textarea name="specification" class="form-control" id="productSpecs" rows="5" placeholder="Enter detailed product specifications."></textarea>
              </div>

              <div class="d-flex align-items-center">
                <label for="quantity" class="me-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control mx-2" value="1" min="1" style="width: 60px;">
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Apply</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- JavaScript to Preview Image -->
<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
      const output = document.getElementById('productImage');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if ($openModal): ?>
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        <?php endif; ?>
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    <?php if ($openModal): ?>
    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
    loginModal.show();
    <?php endif; ?>
});
</script>

</body>
</html>