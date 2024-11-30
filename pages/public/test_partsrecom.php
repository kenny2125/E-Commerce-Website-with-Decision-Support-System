<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Recommendation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn.selected {
            background-color: #28a745 !important;
            color: white !important;
        }
    </style>
</head>
<body class="p-4">
        <?php
        // Database credentials
        $host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $username = "vg2eweo4yg8eydii";
        $password = "rccstjx3or46kpl9";
        $db_name = "s0gp0gvxcx3fc7ib";

        // Establish a database connection
        $conn = new mysqli($host, $username, $password, $db_name);

        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        ?>


    <div class="container">
        <h1 class="mb-4">Parts Recommendation System</h1>
        
        <!-- Category Buttons -->
        <h3>Choose a Category</h3>
        <div class="mb-3">
            <?php
            $categories = [
                "CPU", "RAM", "Motherboard", "Video Card", "Computer Case",
                "Solid State Drive", "Hard Disk Drive", "CPU Cooler", "Power Supply", "Monitor"
            ];

            foreach ($categories as $index => $category) {
                echo "<button type='button' class='btn btn-primary me-2 mb-2' 
                        onclick='selectCategory(this, \"$category\")'>{$category}</button>";
            }
            ?>
            <input type="hidden" name="selected_category" id="selected_category">
        </div>

        <!-- Brand Buttons -->
        <h3>Choose a Brand</h3>
        <div class="mb-3">
            <?php
            $brandsResult = $conn->query("SELECT brand_ID, brand_name FROM tbl_brands");
            while ($row = $brandsResult->fetch_assoc()) {
                echo "<button type='button' class='btn btn-secondary me-2 mb-2' 
                        onclick='selectBrand(this, {$row['brand_ID']})'>{$row['brand_name']}</button>";
            }
            ?>
            <input type="hidden" name="selected_brand" id="selected_brand">
        </div>

        <!-- Budget Slider -->
        <h3>Set Your Budget</h3>
        <div class="mb-3">
            <label for="budget_slider" class="form-label">Budget: <span id="budget_display">0</span> PHP</label>
            <input type="range" class="form-range" id="budget_slider" min="0" max="50000" step="500" 
                   oninput="updateBudgetDisplay(this.value)">
            <input type="hidden" name="selected_budget" id="selected_budget" value="0">
        </div>

        <!-- Search Button -->
        <button class="btn btn-success" onclick="submitForm()">Search</button>

        <!-- Output Results -->
        <div id="results" class="mt-4">
            <?php
            if (isset($_GET['category']) && isset($_GET['brand']) && isset($_GET['budget'])) {
                $selectedCategory = $_GET['category'];
                $selectedBrand = intval($_GET['brand']);
                $selectedBudget = floatval($_GET['budget']);

                // Query products by selected category, brand, and budget
                $query = "
                    SELECT p.product_name, p.description, p.store_price, b.brand_name 
                    FROM tbl_products p
                    JOIN tbl_brands b ON p.brand_ID = b.brand_ID
                    WHERE p.category = '$selectedCategory' 
                        AND p.brand_ID = $selectedBrand 
                        AND p.store_price <= $selectedBudget";
                $result = $conn->query($query);

                echo "<h3>Results:</h3>";
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<p><strong>" . htmlspecialchars($row['product_name']) . "</strong> - "
                            . htmlspecialchars($row['description']) . " - "
                            . number_format($row['store_price'], 2) . " PHP - "
                            . htmlspecialchars($row['brand_name']) . "</p>";
                    }
                } else {
                    echo "<p>No products found.</p>";
                }
            }
            ?>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        let selectedCategory = null;
        let selectedBrand = null;
        let selectedBudget = 0;

        function selectCategory(button, categoryName) {
            document.querySelectorAll(".btn.btn-primary").forEach(btn => btn.classList.remove("selected"));
            button.classList.add("selected");
            selectedCategory = categoryName;
            document.getElementById("selected_category").value = categoryName;
        }

        function selectBrand(button, brandId) {
            document.querySelectorAll(".btn.btn-secondary").forEach(btn => btn.classList.remove("selected"));
            button.classList.add("selected");
            selectedBrand = brandId;
            document.getElementById("selected_brand").value = brandId;
        }

        function updateBudgetDisplay(value) {
            document.getElementById("budget_display").innerText = value;
            selectedBudget = value;
            document.getElementById("selected_budget").value = value;
        }

        function submitForm() {
            if (selectedCategory && selectedBrand && selectedBudget) {
                window.location.href = `?category=${encodeURIComponent(selectedCategory)}&brand=${selectedBrand}&budget=${selectedBudget}`;
            } else {
                alert("Please select a category, a brand, and set your budget.");
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
