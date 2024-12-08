
<?php
    // Database connection
    include '../../config/db_config.php';

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
    $sql = "
    SELECT p.product_ID, p.category, b.brand_name, p.product_name, p.srp, p.store_price, p.description, p.specification, p.quantity 
    FROM tbl_products p
    LEFT JOIN tbl_brands b ON p.brand_ID = b.brand_ID
    ORDER BY p.product_ID DESC";

$result = $conn->query($sql);
?>

<?php



// Fetch brand names from the database
$brand_sql = "SELECT brand_ID, brand_name FROM tbl_brands";
$brand_result = $conn->query($brand_sql);

// Check if the query was successful
if (!$brand_result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    
</head>
<body style="background-color: #EBEBEB;">


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
                            <a href="#" class="nav-link link-light active" aria-current="page">
                                Inventory Management
                            </a>
                        </li>
                        <li>
                            <a href="orders_management.php" class="nav-link link-light">
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


        <!-- 2nd Column: Inventory -->
        <div class="col-9">
                <!-- Table Header -->
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
                <!-- Table of Records -->
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
      <form action="controllers/insert_product.php" method="POST" enctype="multipart/form-data">
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


<?php
include '../../includes/footer.php';
?>
</body>
</html>


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