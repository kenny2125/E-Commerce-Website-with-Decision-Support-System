<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Recommendation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="/assets/css/partsrecommendationsystem.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
    
</head>
<body style="background-color: #EFEFEF;">

<?php 
    include '../../includes/header.php';
    include '../../config/db_config.php';
?>

    <div class="container mt-4">
    <h1 style="text-align: center;">Parts Recommendation System</h1>
    <p style="text-align: center;">Select a category to view recommended products.</p>


        <!-- Categories Card Container -->
        <div class="container">
            <div class="category-cards-wrapper">
                <div class="row" id="category-cards">
                <div class="row" id="category-cards">
    <?php
    // Categories and their specific titles/descriptions
    $categories = [
        "CPU" => [
            "title" => "To Boost FPS",
            "description" => "Upgrade your CPU to boost FPS and gaming performance.",
            "image" => "../../assets/images/categories/CPU.png" // Manually specify the image
        ],
        "RAM" => [
            "title" => "For Better Multitasking",
            "description" => "Upgrade your RAM for smoother multitasking and faster performance.",
            "image" => "../../assets/images/categories/RAM.png" // Manually specify the image
        ],
        "Motherboard" => [
            "title" => "For Better Connectivity",
            "description" => "Upgrade your motherboard for better connectivity and system performance.",
            "image" => "../../assets/images/categories/Motherboard.png" // Manually specify the image
        ],
        "Video Card" => [
            "title" => "To Enhance Graphics",
            "description" => "Upgrade your Video Card for enhanced graphics performance and rendering.",
            "image" => "../../assets/images/categories/VideoCard.png" // Manually specify the image
        ],
        "Computer Case" => [
            "title" => "For Improved Cooling",
            "description" => "Upgrade your computer case for better airflow and cooling.",
            "image" => "../../assets/images/categories/ComputerCase.png" // Manually specify the image
        ],
        "Solid State Drive" => [
            "title" => "For Faster Storage",
            "description" => "Upgrade your SSD for faster data transfer speeds and improved system performance.",
            "image" => "../../assets/images/categories/SolidStateDrive.png" // Manually specify the image
        ],
        "Hard Disk Drive" => [
            "title" => "For More Storage",
            "description" => "Upgrade your HDD for additional storage capacity.",
            "image" => "../../assets/images/categories/HardDiskDrive.png" // Manually specify the image
        ],
        "CPU Cooler" => [
            "title" => "For Better Cooling",
            "description" => "Upgrade your CPU cooler to ensure your CPU stays cool during intensive tasks.",
            "image" => "../../assets/images/categories/CPUCooler.png" // Manually specify the image
        ],
        "Power Supply" => [
            "title" => "For Stable Power",
            "description" => "Upgrade your power supply for more stable and efficient power delivery.",
            "image" => "../../assets/images/categories/PowerSupply.png" // Manually specify the image
        ],
        "Monitor" => [
            "title" => "For Better Display",
            "description" => "Upgrade your monitor for better resolution and a smoother viewing experience.",
            "image" => "../../assets/images/categories/Monitor.png" // Manually specify the image
        ]
    ];

    // Loop through categories and create a card for each
    foreach ($categories as $category => $details) {
        // Use the manually defined image source
        $imageSrc = file_exists($details['image']) ? $details['image'] : "https://via.placeholder.com/200";

        echo "
        <div class='col-lg-3'>
            <div class='card' id='card-$category'>
                <img src='$imageSrc' class='card-img-top' alt='Category Image'>
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

            </div>
        </div>


<!-- Brand Selection Container (Initially hidden) -->
<div id="brand-selection" class="d-flex flex-column justify-content-center align-items-center vh-10" style="display: none; margin:150px">
    <h3 id="select-brand-title" style="display: none;">Select a Brand</h3> <!-- Initially hidden title -->
    <div id="brand-buttons"></div>
</div>


<!-- Price Range Slider (Initially hidden) -->
<div id="price-slider-container" style="display: none; text-align: center;">
    <label for="price-slider" style="font-size: 2rem; font-weight: bold; display: block; margin-bottom: 1rem;">
        Max Price: ₱<span id="price-value">10000</span>
    </label>
    <div id="reset-button-container" style="display: none;">
        <button onclick="window.location.reload();" class="btn btn-danger mt-3">Reset</button>
    </div>
    <input type="range" id="price-slider" class="form-range" min="0" max="99999" step="1" value="10000" 
           style="width: 80%; margin: 0 auto;">

</div>



<!-- Reset Button (Initially hidden) -->
<div id="reset-button-container" style="display: none;">
    <button onclick="window.location.reload();" class="btn btn-danger mt-3">Reset</button>
</div>

<!-- Product List -->
<div id="product-list" class="mt-3"></div>


</body>
</html>


<script>
let allProducts = [];  // Array to store all products after fetching
let filteredProducts = [];  // Array for filtered products based on slider value

// Fetch brands when category is selected
function fetchBrands(category) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'controllers/get_brands.php?category=' + category, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var brands = JSON.parse(xhr.responseText);
            var brandCardsHtml = ''; // Initialize empty string for brand cards

            // Create a card for each brand with a button and image inside it
            brands.forEach(function(brand) {
                // Construct image path based on the brand name (assuming lowercase brand names)
                var brandImagePath = `/assets/images/brands/${brand.toLowerCase()}.png`;

                // Create a card for each brand
                brandCardsHtml += `
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4" style="display: inline-block; padding: 10px; width: 100%;">
                        <div class="card" style="border: 1px solid #ddd; height: 250px; text-align: center; display: flex; flex-direction: column; justify-content: space-between;">
                            <div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                <img src="${brandImagePath}" alt="${brand} logo" style="max-height: 50px; max-width: 100%; object-fit: contain;">
                                
                                <button class="btn btn-secondary mt-2" onclick="fetchProducts('${category}', '${brand}')">Select ${brand}</button>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Display the brand cards and show the brand selection container
            document.getElementById('brand-buttons').innerHTML = brandCardsHtml;
            document.getElementById('brand-selection').style.display = 'block';  // Show brand selection container
            document.getElementById('reset-button-container').style.display = 'block'; // Show reset button
            document.getElementById('select-brand-title').style.display = 'block'; // Show the "Select a Brand" title
        }
    };
    xhr.send();
}
// Fetch products once the brand is selected
function fetchProducts(category, brand) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'controllers/get_products.php?category=' + category + '&brand=' + brand, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            allProducts = JSON.parse(xhr.responseText);  // Store all products fetched
            filteredProducts = allProducts;  // Initially, display all products
            displayProducts(filteredProducts);  // Display products
            filterProducts();  // Apply initial filter based on slider value
            document.getElementById('price-slider-container').style.display = 'block'; // Show price slider
        }
    };
    xhr.send();
}

// Display products in Bootstrap card format
function displayProducts(products) {
    let productHtml = '';
    products.forEach(function(product) {
        productHtml += `
            <div class="col-sm-6 col-md-4 col-lg-2 mb-4">
                <div class="card" style="border: 1px solid #ddd;">
                    <div class="image-wrapper">
                        ${product.img_data ? 
                            `<img src="data:image/jpeg;base64,${product.img_data}" class="card-img-top img-fluid" alt="${product.product_name}">` 
                            : 
                            `<img src="images/${product.img_name}" class="card-img-top img-fluid" alt="${product.product_name}">`
                        }
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${product.product_name}</h5>
                        <p class="card-text">
                            <strong>Price:</strong> ₱${parseFloat(product.store_price).toFixed(2)}<br>
                            <strong>Description:</strong> ${product.description}
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="/pages/shop/Product_Detail.php?id=${product.product_ID}" class="btn btn-primary-footer">View Details</a>
                    </div>
                </div>
            </div>
        `;
    });
    document.getElementById('product-list').innerHTML = `<div class="row g-3">${productHtml}</div>`;
}





// Filter products based on the selected price range
function filterProducts() {
    const maxPrice = parseInt(document.getElementById('price-slider').value, 10); // Get the slider value as an integer
    // Filter products based on max price (convert product store_price to an integer for comparison)
    filteredProducts = allProducts.filter(product => parseInt(product.store_price, 10) <= maxPrice);
    displayProducts(filteredProducts);  // Update the displayed products
}

// Event listener for slider change to dynamically filter products
document.getElementById('price-slider').addEventListener('input', function () {
    const value = parseInt(this.value, 10); // Get the slider value as an integer
    document.getElementById('price-value').textContent = value; // Update displayed value
    filterProducts();  // Apply the filter with the new slider value
});


</script>
