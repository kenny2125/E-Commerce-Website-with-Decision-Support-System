<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Recommendation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<html>
<body>

<?php include '../includes/header.php'; ?>
<!-- Welcome to Parts Recommendation System -->
<div style="padding-top: 100px; padding-bottom: 350px; width: 100%; position: relative; background-image: url('assets/images/banner-dss.png'); background-size: cover; background-position: center;">
  <!-- Content Layer (Text and Button) -->
  <div style="width: 100%; height: 300px; position: absolute; left: 0; top: 0; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; color: black;">
    <div style="font-size: 64px; font-family: Work Sans; font-weight: 400; word-wrap: break-word;">Welcome to</div>
    <div style="font-size: 64px; font-family: Lato; font-weight: 600; word-wrap: break-word; margin-top: 10px;">
      Parts Recommendation system
    </div>
    <div style="width: 162.35px; height: 59.87px; margin-top: 20px; position: relative;">
      <div style="width: 100%; height: 90%; background: #1A54C0; border-radius: 74px;"></div>
      <div style="position: absolute; top: 25%; left: 0; width: 100%; height: 100%; text-align: center; color: white; font-size: 16px; font-family: Lato; font-weight: 700; word-wrap: break-word;">
        Start Answering
      </div>
    </div>
  </div>
</div>

<!-- Select a Product Cards -->
<div class="container mt-5">
  <div class="row row-cols-6 g-4 justify-content-center">
    <!-- Card 1: CPU -->
    <div class="col">
      <div class="card text-center" style="width: 251px; height: 300px; margin: auto;" onclick="showSection('cpu')">
        <img src="../assets/images/rtx-4090.jpg" alt="CPU" class="img-fluid" style="max-height: 150px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">CPU</h5>
          <p class="card-text">To boost FPS in games and better multitasking.</p>
        </div>
      </div>
    </div>
    <!-- Card 2: Motherboard -->
    <div class="col">
      <div class="card text-center" style="width: 251px; height: 300px; margin: auto;" onclick="showSection('motherboard')">
        <img src="../assets/images/rtx-4090.jpg" alt="Motherboard" class="img-fluid" style="max-height: 150px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">Motherboard</h5>
          <p class="card-text">To update features.</p>
        </div>
      </div>
    </div>
    <!-- Card 3: RAM -->
    <div class="col">
      <div class="card text-center" style="width: 251px; height: 300px; margin: auto;" onclick="showSection('ram')">
        <img src="../assets/images/rtx-4090.jpg" alt="RAM" class="img-fluid" style="max-height: 150px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">RAM</h5>
          <p class="card-text">For better multitasking.</p>
        </div>
      </div>
    </div>
    <!-- Add other product cards here... -->
  </div>
</div>

<!-- If CPU is clicked -->
<div id="cpu-section" class="product-section" style="display:none;">
  <div class="container mt-5 text-center">
    <h4 class="mb-4"><strong>Select the brand of your CPU</strong></h4>
    <div class="row justify-content-center g-4">
      <!-- AMD Card -->
      <div class="col">
        <div class="card text-center" style="width: 251px; height: 300px; margin: auto;" onclick="showBudgetSlider()">
          <img src="../assets/images/brands/amd.png" alt="AMD" class="img-fluid" style="max-height: 150px; object-fit: contain; margin-top: 20px;">
          <div class="card-body">
            <h5 class="card-title">AMD</h5>
          </div>
        </div>
      </div>
      <!-- Intel Card -->
      <div class="col">
        <div class="card text-center" style="width: 251px; height: 300px; margin: auto;">
          <img src="../assets/images/brands/intel.png" alt="Intel" class="img-fluid" style="max-height: 150px; object-fit: contain; margin-top: 20px;">
          <div class="card-body">
            <h5 class="card-title">Intel</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Budget Slider Section -->
<div id="budget-slider-section" class="product-section" style="display:none;">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="mb-3">Specify your budget.</h2>
        <div class="budget-slider">
          <input type="range" min="0" max="100000" value="10000" class="form-range" id="budgetSlider" onchange="updateBudgetAmount()">
          <label for="budgetSlider">PHP <span id="budgetAmount">10,000</span></label>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript to toggle sections -->
<script>
  // Store selected CPU brand and budget value
  let selectedCPU = '';
  let selectedBudget = 10000; // Default budget

  // Function to show the relevant section
  function showSection(section) {
    // Hide all sections
    const sections = document.querySelectorAll('.product-section');
    sections.forEach(section => {
      section.style.display = 'none';
    });

    // Show selected section
    const selectedSection = document.getElementById(section + '-section');
    if (selectedSection) {
      selectedSection.style.display = 'block';
    }

    // Store the selected CPU section
    if (section === 'cpu') {
      selectedCPU = document.querySelector('input[name="cpu"]:checked').value;
    }
  }

  // Function to show the budget slider
  function showBudgetSlider() {
    // Hide the CPU selection section
    document.getElementById("cpu-section").style.display = 'none';

    // Show the budget slider section
    document.getElementById("budget-slider-section").style.display = 'block';
  }

  // Update the displayed budget amount when the slider value changes
  function updateBudgetAmount() {
    const slider = document.getElementById("budgetSlider");
    const budgetAmount = document.getElementById("budgetAmount");
    selectedBudget = slider.value;  // Update the selected budget
    budgetAmount.textContent = selectedBudget.toLocaleString();
  }

  // Initialize the budget slider with the correct value
  document.getElementById("budgetSlider").addEventListener("input", updateBudgetAmount);

  // Function to submit the selected data to PHP
  function submitSelection() {
    // Ensure that CPU brand and budget are selected before submitting
    if (!selectedCPU || selectedBudget === undefined) {
      alert("Please complete the selection process.");
      return;
    }

    // Prepare the data to be sent
    const formData = new FormData();
    formData.append("cpu", selectedCPU);
    formData.append("budget", selectedBudget);

    // Send the data to the PHP file using AJAX (fetch API)
    fetch("process_selection.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      // Handle the response from the PHP file (e.g., display the product info)
      if (data.success) {
        // Example: display the recommended product
        document.getElementById("product-recommendation").innerHTML = `
          <div class="container my-2">
            <h2 class="text-center">Based on your answers, here’s what we recommend!</h2>
            <div class="row">
              <div class="col-md-4 text-center">
                <img src="../assets/images/${data.product.img_name}" class="img-fluid rounded" alt="Product Image" style="max-width: 100%;">
              </div>
              <div class="col-md-4">
                <h2 class="fw-bold">${data.product.product_name}</h2>
                <p><strong>Stock Available:</strong> <span class="text-success">${data.product.stock_status}</span></p>
                <p><strong>Price:</strong> <span class="text-danger fs-4">₱${data.product.store_price.toLocaleString()}</span></p>
                <p><strong>Description:</strong> ${data.product.description}</p>
                <h5>Payment & Pickup Methods</h5>
                <ul>
                  <li>Cash on Delivery</li>
                  <li>Credit/Debit Card</li>
                  <li>Bank Transfer</li>
                  <li>In-store Pickup</li>
                </ul>
                <div class="d-flex align-items-center my-3">
                  <button class="btn btn-outline-secondary" id="quantity-minus">-</button>
                  <input type="number" id="quantity" class="form-control mx-2" value="1" min="1" style="width: 80px;">
                  <button class="btn btn-outline-secondary" id="quantity-plus">+</button>
                </div>
                <div>
                  <button class="btn btn-primary me-2">Add to Cart</button>
                  <button class="btn btn-success">Checkout</button>
                </div>
              </div>
              <div class="col-md-3">
                <h4 class="fw-bold">Specifications</h4>
                <ul>
                  ${data.product.specifications.map(spec => `<li>${spec}</li>`).join('')}
                </ul>
              </div>
            </div>
          </div>
        `;
      } else {
        alert("No products found for your selection.");
      }
    })
    .catch(error => {
      console.error("Error submitting selection:", error);
      alert("There was an error processing your selection.");
    });
  }
</script>








<?php
// Include the database connection file
include '../config/db_config.php';

// Get the selected CPU brand and budget value from the GET or POST request
$selected_cpu = isset($_GET['cpu']) ? $_GET['cpu'] : 'amd';  // Default to 'amd' if not set
$budget = isset($_GET['budget']) ? $_GET['budget'] : 10000; // Default to 10000 PHP if not set

// Query to get products based on the selected CPU brand and budget
$query = "
    SELECT p.product_ID, p.product_name, p.srp, p.store_price, p.description, p.img_name, p.specification
    FROM products p
    JOIN product_brands pb ON p.brand_ID = pb.brand_ID
    WHERE pb.brand_name = :brand
    AND (p.store_price <= :budget OR p.srp <= :budget)
    ORDER BY p.store_price ASC
    LIMIT 1"; // Adjust the LIMIT to get the best match or a range of products

// Prepare the query
$stmt = $pdo->prepare($query);

// Bind the parameters
$stmt->bindParam(':brand', $selected_cpu, PDO::PARAM_STR);
$stmt->bindParam(':budget', $budget, PDO::PARAM_INT);

// Execute the query
$stmt->execute();

// Fetch the product data
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if product exists
if ($product) {
    // Get product details
    $product_name = htmlspecialchars($product['product_name']);
    $product_price = $product['store_price'] ? '₱' . number_format($product['store_price'], 2) : '₱' . number_format($product['srp'], 2);
    $product_desc = htmlspecialchars($product['description']);
    $product_img = $product['img_name'] ? '../assets/images/' . $product['img_name'] : '../assets/images/default_product.jpg';
    $product_spec = htmlspecialchars($product['specification']);
    $product_stock = 10; // Example stock value; this should be fetched from the database if available

    // Output the product details
    echo "
        <div class='container my-2'>
            <h2 class='text-center'>Based on your answers, here’s what we recommend!</h2>
            <div class='row'>
                <!-- Product Image -->
                <div class='col-md-4 text-center'>
                    <img src='$product_img' class='img-fluid rounded' alt='Product Image' style='max-width: 100%;'>
                </div>

                <!-- Product Details -->
                <div class='col-md-4'>
                    <h2 class='fw-bold'>$product_name</h2>
                    <p><strong>Stock Available:</strong> <span class='text-success'>" . ($product_stock > 0 ? 'In Stock' : 'Out of Stock') . "</span></p>
                    <p><strong>Price:</strong> <span class='text-danger fs-4'>$product_price</span></p>
                    <p><strong>Description:</strong> $product_desc</p>

                    <h5>Payment & Pickup Methods</h5>
                    <ul>
                        <li>Cash on Delivery</li>
                        <li>Credit/Debit Card</li>
                        <li>Bank Transfer</li>
                        <li>In-store Pickup</li>
                    </ul>

                    <!-- Quantity Control -->
                    <div class='d-flex align-items-center my-3'>
                        <button class='btn btn-outline-secondary' id='quantity-minus'>-</button>
                        <input type='number' id='quantity' class='form-control mx-2' value='1' min='1' style='width: 80px;'>
                        <button class='btn btn-outline-secondary' id='quantity-plus'>+</button>
                    </div>

                    <!-- Buttons -->
                    <div>
                        <button class='btn btn-primary me-2'>Add to Cart</button>
                        <button class='btn btn-success'>Checkout</button>
                    </div>
                </div>

                <!-- Product Specifications -->
                <div class='col-md-3'>
                    <h4 class='fw-bold'>Specifications</h4>
                    <ul>";
    
    // Assuming the specification is stored as a list, output it
    $specs = explode("\n", $product_spec);  // If specifications are saved as line breaks
    foreach ($specs as $spec) {
        echo "<li>" . htmlspecialchars($spec) . "</li>";
    }
    
    echo "    </ul>
                </div>
            </div>
        </div>";
} else {
    // If no product found
    echo "<p>No products found based on your selections.</p>";
}
?>



  <?php include '../includes/footer.php'; ?>
    
</body>
</html>