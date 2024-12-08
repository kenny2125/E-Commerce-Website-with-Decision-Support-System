

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Admin Dashboard</title>
    <!-- <link rel="stylesheet" href="/assets/css/admin_dashboard.css"> -->
    <link rel="icon" href="/assets/images/rpc-favicon.png">
</head>
<?php
// Database connection
    include '../../config/db_config.php';

// Query to calculate total sales, ongoing orders count, and total registered users
$sql = "
    SELECT 
        (SELECT SUM(total) FROM tbl_orders WHERE payment_status = 'PAID' AND pickup_status = 'CLAIMED') AS total_sales,
        (SELECT COUNT(*) FROM tbl_orders WHERE payment_status = 'PAID' AND pickup_status = 'PENDING') AS ongoing_orders_count,
        (SELECT COUNT(*) FROM tbl_user) AS total_users
";

// Execute query
$result = $conn->query($sql);

// Initialize variables
$total_sales = 0;
$ongoing_orders_count = 0;
$total_users = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_sales = $row['total_sales'] ?? 0; // Default to 0 if NULL
    $ongoing_orders_count = $row['ongoing_orders_count'] ?? 0; // Default to 0 if NULL
    $total_users = $row['total_users'] ?? 0; // Default to 0 if NULL
}

// Close the connection
$conn->close();
?>

<?php
// Connect to the database
$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch sales data for PAID and CLAIMED orders
$sql = "SELECT SUM(total) AS total_sales, MONTH(order_date) AS month
        FROM tbl_orders
        WHERE payment_status = 'PAID' AND pickup_status = 'CLAIMED'
        GROUP BY MONTH(order_date)
        ORDER BY MONTH(order_date)";
$result = $conn->query($sql);

// Prepare data for the chart
$data = [];
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

// Initialize the data array with zeros
for ($i = 0; $i < 12; $i++) {
    $data[$i] = 0;
}

// Fetch the result and populate the data array
while ($row = $result->fetch_assoc()) {
    $month = $row['month'] - 1; // Adjust to 0-based index
    $data[$month] = (float) $row['total_sales'];
}

$conn->close();
?>
<body style="background-color: #EFEFEF;">

    <!-- Navbar -->
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
                            <a href="#" class="nav-link link-light active" aria-current="page">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="inventory_management.php" class="nav-link link-light">
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
                                <a href="../user/logout.php" class="btn" style="background-color: #1A54C0; color: #fff; margin-left: 35px; margin-top: 10px; padding-right: 20px; padding-left: 20px;">Log Out</a>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Main Dashboard Section -->
            <div class="col-md-6 admin-dashboard-main">
                <div class="row">
                    <div class="col-6" style="margin-bottom: 30px; max-width: 220px;">
                        <div class="card admin-card" style="background-color: #fff; border-radius: 30px; height: 200px; text-align: center; box-shadow: 0 4px 10px #888383;">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <img src="/assets/images/Philippine Peso (PHP).png" alt="Philippine Peso" class="php" style="margin-top: 12px;">
                            <p class="card-text">₱<?php echo number_format($total_sales, 2); ?></p>
                        </div>

                        </div>
                    </div>
                    <div class="col-6" style="margin-bottom: 30px; max-width: 220px;">
                        <div class="card admin-card" style="background-color: #fff; border-radius: 30px; height: 200px; text-align: center; box-shadow: 0 4px 10px #888383;">
                            <div class="card-body">
                                <h5 class="card-title">Ongoing Orders</h5>
                                <img src="/assets/images/bx-receipt.png" alt="Receipt" class="receipt" style="margin-top: 12px;">
                                <p class="card-text">
                                    <?php echo $ongoing_orders_count; ?> Order<?php echo $ongoing_orders_count > 1 ? 's' : ''; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" style="margin-bottom: 30px; max-width: 220px;">
                        <div class="card admin-card" style="background-color: #fff; border-radius: 30px; height: 200px; text-align: center; box-shadow: 0 4px 10px #888383;">
                            <div class="card-body">
                                <h5 class="card-title">No of Registered Users</h5>
                                <img src="/assets/images/bxs-user.png" alt="User" class="user">
                                <p class="card-text"><?php echo $total_users; ?> User<?php echo $total_users > 1 ? 's' : ''; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" style="margin-bottom: 30px; max-width: 220px;">
                        <div class="card admin-card" style="background-color: #fff; border-radius: 30px; height: 200px; text-align: center; box-shadow: 0 4px 10px #888383;">
                        <?php
                        // Database connection
                        $conn = new mysqli($host, $username, $password, $db_name);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT p.category, COUNT(o.order_ID) AS total_sales
                                FROM tbl_orders o
                                JOIN tbl_products p ON o.product_ID = p.product_ID
                                WHERE o.payment_status = 'PAID' AND o.pickup_status = 'CLAIMED'
                                GROUP BY p.category
                                ORDER BY total_sales DESC
                                LIMIT 3";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<div class="card-body" style="max-width: 200px; max-height: 200px; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;">';
                            echo '<h5 class="card-title" style="font-size: 16px; margin-bottom: 10px;">Top Product Categories</h5>';
                            
                            while ($row = $result->fetch_assoc()) {
                                echo '<p class="card-text" style="font-size: 14px; font-weight: bold; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">' . $row['category'] . '</p>';
                            }
                            echo '</div>';
                        } else {
                            echo '<div class="card-body" style="max-width: 200px; max-height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center;">';
                            echo '<p>No data available.</p>';
                            echo '</div>';
                        }
                        

                        
                        ?>

                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="row" style="background-color: #fff; border-radius: 30px; box-shadow: 0 2px 5px #888383; max-width: 878px;">
                    <div class="col-12 text-center">
                        <h3 style="margin-top: 20px; font-size: 24px;">Monthly Sales</h3>
                    </div>
                    <div class="col-12">
                        <div id="chart-container" class="admin-chart-container" style="height: 300px;"></div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar Section: Top Products & Stock Alerts -->
            <div class="col-md-3 admin-sidebar-right" style="margin-left: -10px;">
                <div class="row">
                    <div class="col-12">
                        <div class="card admin-card" style="background-color: #fff; border-radius: 30px; height: 280px; text-align: center; box-shadow: 0 4px 10px #888383; margin-bottom: 50px;">
                        <?php
                            // Query to get the top 5 most sold products from tbl_orders
                            $sql = "SELECT p.product_name, COUNT(o.product_ID) AS product_count 
                                    FROM tbl_orders o
                                    INNER JOIN tbl_products p ON o.product_ID = p.product_ID
                                    WHERE o.payment_status = 'PAID' AND o.pickup_status = 'CLAIMED' 
                                    GROUP BY o.product_ID
                                    ORDER BY product_count DESC
                                    LIMIT 5";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title" style="margin-bottom: 25px;">Top Products</h5>';
                                
                                // Output the top 5 products
                                $rank = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo '<p class="card-text" style="font-size: 14px; font-weight: bold; margin: 0;">' . $rank . '. ' . $row['product_name'] . '</p>';
                                    $rank++;
                                }
                                echo '</div>';
                            } else {
                                echo '<div class="card-body"><p>No top products available.</p></div>';
                            }


                        ?>

                        </div>
                    </div>
                </div>
                <!-- Stock Alerts Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="card admin-card" style="background-color: #fff; border-radius: 30px; height: 280px; text-align: center; box-shadow: 0 4px 10px #888383;">
                        <?php
                            // Query to get products with low or out of stock
                            $sql = "SELECT product_name, quantity FROM tbl_products 
                                    WHERE quantity <= 5 
                                    ORDER BY quantity ASC
                                    LIMIT 5";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title" style="margin-bottom: 25px;">Stock Alerts</h5>';
                                
                                // Output the stock alerts
                                while ($row = $result->fetch_assoc()) {
                                    // If the quantity is 0, it's out of stock
                                    if ($row['quantity'] == 0) {
                                        echo '<p class="card-text" style="font-size: 14px; color: red;">' . $row['product_name'] . ': Out of stock</p>';
                                    } else {
                                        echo '<p class="card-text" style="font-size: 14px; color: orange;">' . $row['product_name'] . ': Low stock</p>';
                                    }
                                }
                                echo '</div>';
                            } else {
                                echo '<div class="card-body"><p>No stock alerts at the moment.</p></div>';
                            }
                            $conn->close();
                        ?>

                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
        <?php
        include '../../includes/footer.php';
        ?>
</body>
</html>


<script>
    // Pass PHP data to JavaScript
    const data = <?php echo json_encode(array_map(function($month, $sales) {
        return ['name' => $month, 'value' => $sales];
    }, $months, $data)); ?>;

    const options = {
        chart: {
            type: 'bar',
            height: 400,
            toolbar: {
                show: false,
            },
        },
        series: [
            {
                name: 'Sales',
                data: data.map(item => item.value),
            },
        ],
        xaxis: {
            categories: data.map(item => item.name),
        },
        yaxis: {
            labels: {
                formatter: val => `₱${val.toLocaleString()}`,
            },
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5,
            },
        },
        theme: {
            palette: 'palette1',
        },
    };

    const chart = new ApexCharts(document.getElementById('chart-container'), options);
    chart.render();
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