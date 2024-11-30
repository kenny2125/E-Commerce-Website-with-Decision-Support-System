<?php
// Database Connection
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories for dropdown
$categories = [];
$categoryQuery = "SELECT category_ID, category_name FROM tbl_categories";
$categoryResult = $conn->query($categoryQuery);

if ($categoryResult && $categoryResult->num_rows > 0) {
    while ($row = $categoryResult->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch brands for dropdown
$brands = [];
$brandQuery = "SELECT brand_ID, brand_name FROM tbl_brands";
$brandResult = $conn->query($brandQuery);

if ($brandResult && $brandResult->num_rows > 0) {
    while ($row = $brandResult->fetch_assoc()) {
        $brands[] = $row;
    }
}

// Handle form submission
$products = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetching form inputs
    $category = $_POST['category'];
    $budget = $_POST['budget'];
    $brand = $_POST['brand'];

    // SQL query with filters
    $sql = "SELECT * FROM tbl_products WHERE category = ? AND store_price <= ?";

    // If brand is selected
    if (!empty($brand)) {
        $sql .= " AND brand_ID = ?";
    }

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    if (!empty($brand)) {
        $stmt->bind_param("sdi", $category, $budget, $brand);
    } else {
        $stmt->bind_param("sd", $category, $budget);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Recommendation</title>
</head>
<body>
    <h1>Parts Recommendation</h1>
    <!-- Decision Support Form -->
    <form method="POST">
        <label for="category">Select Category:</label>
        <select name="category" id="category" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category['category_name']); ?>">
                    <?php echo htmlspecialchars($category['category_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="budget">Enter Budget:</label>
        <input type="number" name="budget" id="budget" required>
        <br><br>

        <label for="brand">Select Brand (Optional):</label>
        <select name="brand" id="brand">
            <option value="">Any</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?php echo htmlspecialchars($brand['brand_ID']); ?>">
                    <?php echo htmlspecialchars($brand['brand_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <button type="submit">Get Recommendations</button>
    </form>

    <!-- Recommendations Output -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h2>Recommended Products:</h2>
        <?php if (empty($products)): ?>
            <p>No products match your criteria.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($products as $product): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($product['product_name']); ?></strong> - 
                        <?php echo htmlspecialchars($product['category']); ?> - 
                        <?php echo htmlspecialchars($product['store_price']); ?> PHP
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
