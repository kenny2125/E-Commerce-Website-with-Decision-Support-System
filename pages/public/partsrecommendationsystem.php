<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Recommendation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/partsrecommendationsystem.css">
</head>
<body>

<?php 
    include '../../includes/header.php';
    include '../../config/db_config.php';
?>





    <div class="container mt-4">
        <h1 style="text-align: center;">Product Recommendation System</h1>

        <!-- Categories Card Container -->
        <div class="container">
        <div class="row" id="category-cards">
            <?php
            // Categories and their specific titles/descriptions
            $categories = [
                "CPU" => [
                    "title" => "To Boost FPS",
                    "description" => "Upgrade your CPU to boost FPS and gaming performance."
                ],
                "RAM" => [
                    "title" => "For Better Multitasking",
                    "description" => "Upgrade your RAM for smoother multitasking and faster performance."
                ],
                "Motherboard" => [
                    "title" => "For Better Connectivity",
                    "description" => "Upgrade your motherboard for better connectivity and system performance."
                ],
                "Video Card" => [
                    "title" => "To Enhance Graphics",
                    "description" => "Upgrade your Video Card for enhanced graphics performance and rendering."
                ],
                "Computer Case" => [
                    "title" => "For Improved Cooling",
                    "description" => "Upgrade your computer case for better airflow and cooling."
                ],
                "Solid State Drive" => [
                    "title" => "For Faster Storage",
                    "description" => "Upgrade your SSD for faster data transfer speeds and improved system performance."
                ],
                "Hard Disk Drive" => [
                    "title" => "For More Storage",
                    "description" => "Upgrade your HDD for additional storage capacity."
                ],
                "CPU Cooler" => [
                    "title" => "For Better Cooling",
                    "description" => "Upgrade your CPU cooler to ensure your CPU stays cool during intensive tasks."
                ],
                "Power Supply" => [
                    "title" => "For Stable Power",
                    "description" => "Upgrade your power supply for more stable and efficient power delivery."
                ],
                "Monitor" => [
                    "title" => "For Better Display",
                    "description" => "Upgrade your monitor for better resolution and a smoother viewing experience."
                ]
            ];

            // Loop through categories and create a card for each
            foreach ($categories as $category => $details) {
                echo "
                <div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
                    <div class='card' id='card-$category'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$details['title']}</h5>
                            <p class='card-text'>{$details['description']}</p>
                            <button class='btn btn-primary category-btn' onclick='fetchBrands(\"$category\")'>$category</button>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>



        <!-- Brand Selection Container (Initially hidden) -->
        <div id="brand-selection" class="d-flex flex-column justify-content-center align-items-center vh-10">
            <h3>Select a Brand</h3>
            <div id="brand-buttons"></div>
        </div>

<!-- Price Range Slider -->

<label for="price-slider">Max Price: ₱<span id="price-value">150000.00</span></label>
<input type="range" id="price-slider" class="form-range" min="0" max="150000" step="0.01" value="150000">

<!-- Container for Brand Selection Buttons -->
<div id="brand-selection" style="display: none;">
    <div id="brand-buttons"></div>
</div>
        <!-- Placeholder Description (doesn't change dynamically) -->
        <div class="description-card">
            <h3>Category Description:</h3>
            <p>Choose a category above to filter products.</p>
            <button onclick="window.location.reload();" class="btn btn-danger mt-3">Reset</button>
        </div>
<!-- Product List -->
<div id="product-list" class="mt-3"></div>







<script>
let allProducts = [];  // Array to store all products after fetching
let filteredProducts = [];  // Array for filtered products based on slider value

// Fetch brands when category is selected
function fetchBrands(category) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_brands.php?category=' + category, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var brands = JSON.parse(xhr.responseText);
            var brandButtonsHtml = '';

            // Create buttons for each brand
            brands.forEach(function(brand) {
                brandButtonsHtml += `<button class="btn btn-secondary mt-2" onclick="fetchProducts('${category}', '${brand}')">${brand}</button>`;
            });

            // Display the brand buttons and show the brand selection container
            document.getElementById('brand-buttons').innerHTML = brandButtonsHtml;
            document.getElementById('brand-selection').style.display = 'block';  // Show brand selection container
        }
    };
    xhr.send();
}

// Fetch products once the brand is selected
function fetchProducts(category, brand) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_products.php?category=' + category + '&brand=' + brand, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            allProducts = JSON.parse(xhr.responseText);  // Store all products fetched
            filteredProducts = allProducts;  // Initially, display all products
            displayProducts(filteredProducts);  // Display products
            filterProducts();  // Apply initial filter based on slider value
        }
    };
    xhr.send();
}

// Display the filtered products
function displayProducts(products) {
    let productHtml = '';
    products.forEach(function(product) {
        productHtml += `
            <div class="product">
                <h5>${product.product_name}</h5>
                <p>Price: ₱${product.store_price}</p>
                <p>${product.description}</p>
            </div>
        `;
    });
    document.getElementById('product-list').innerHTML = productHtml;
}

// Filter products based on the selected price range
function filterProducts() {
    const maxPrice = parseFloat(document.getElementById('price-slider').value).toFixed(2);  // Get the slider value and fix to 2 decimal places
    // Filter products based on max price (client-side filtering)
    filteredProducts = allProducts.filter(product => product.store_price <= maxPrice);
    displayProducts(filteredProducts);  // Update the displayed products
}

// Event listener for slider change to dynamically filter products
document.getElementById('price-slider').addEventListener('input', function() {
    var value = parseFloat(this.value).toFixed(2);  // Get the slider value
    document.getElementById('price-value').textContent = '₱' + value; // Update displayed value
    filterProducts();  // Apply the filter with the new slider value
});


</script>

</body>
</html>
