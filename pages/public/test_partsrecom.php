<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Recommendation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-selected {
            background-color: #28a745;
            color: white;
        }
        .product {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .description-card {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 20px;
        }
        .card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .card {
            width: 300px;
        }
        .category-btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Product Recommendation System</h1>

        <!-- Categories Card Container -->
<div class="card-container mb-3">
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
        <div class='card'>
            <div class='card-body'>
                <h5 class='card-title'>{$details['title']}</h5>
                <p class='card-text'>{$details['description']}</p>
                <button class='btn btn-primary category-btn' onclick='fetchBrands(\"$category\")'>Select $category</button>
                <div id='brand-buttons-$category' class='mt-3'></div>
            </div>
        </div>";
    }
    ?>
</div>


        <!-- Placeholder Description (doesn't change dynamically) -->
        <div class="description-card">
            <h3>Category Description:</h3>
            <p>Choose a category above to filter products.</p>
        </div>

        <!-- Product List will be displayed here -->
        <div id="product-list" class="mt-3"></div>
    </div>

    <script>
        function fetchBrands(category) {
            // Send AJAX request to get brands based on the selected category
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

                    // Update the brand buttons section inside the corresponding category card
                    document.getElementById('brand-buttons-' + category).innerHTML = brandButtonsHtml;
                }
            };
            xhr.send();
        }

        function fetchProducts(category, brand) {
            // Send AJAX request to get products based on selected category and brand
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_products.php?category=' + category + '&brand=' + brand, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var products = JSON.parse(xhr.responseText);
                    var productHtml = '';

                    // Display products
                    products.forEach(function(product) {
                        productHtml += `
                            <div class="product">
                                <h5>${product.product_name}</h5>
                                <p>Price: $${product.store_price}</p>
                                <p>${product.description}</p>
                            </div>
                        `;
                    });

                    // Update the product list section
                    document.getElementById('product-list').innerHTML = productHtml;
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
