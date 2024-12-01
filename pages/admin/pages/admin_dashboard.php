<?php
// Database connection
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

<body style="background-color: #EFEFEF;">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap" style="display: flex; align-items: center; height: auto; background-color: #FFFFFF; box-shadow: 0 7px 3px -2px lightgrey; padding: 10px 20px; position: relative;">
            <!-- Logo -->
            <img src="/assets/images/rpc-logo-black.png" alt="Logo" class="logo" style="width: 240px; height: auto; max-width: 100%; margin-left: 20px; position: relative; left: 20px;">
            
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
                        <li class="nav-item">
                            <a href="admin_profile.php" class="nav-link link-light">
                                Admin Profile
                            </a>
                        </li>
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
                            <a href="orders_management" class="nav-link link-light">
                                Orders Management
                            </a>
                        </li>
                        <li>
                            <a href="payment_list" class="nav-link link-light">
                                Payments List
                            </a>
                        </li>
                    </ul>
                    <div class="container-fluid admin-dropdown">
                <div class="d-flex justify-content-end">
        <div class="dropdown" style="background-color: #fff; margin-top: 260px; margin-bottom: 20px; border-radius: 20px; padding-right: 10px; padding-left: 30px; padding-top: 20px; padding-bottom: 10px;">
        <img src="/assets/images/Vector.png" alt="Vector" class="vector" style="margin-left: -15px; margin-right: 9px; margin-top: 3px;"><strong style="margin-right: 9.3px; text-align: center;">John Kenny Q. Reyes</strong>
                <a href="/index.php" class="btn" style="background-color: #1A54C0; color: #fff; margin-left: 35px; margin-top: 10px; padding-right: 20px; padding-left: 20px;">Log Out</a>
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
                            <div class="card-body">
                                <h5 class="card-title">Top Product Categories</h5>
                                <img src="/assets/images/GPU.png" alt="GPU" class="gpu" style="margin-top: 12px;">
                                <p class="card-text" style="margin-top: 3px; margin-bottom: 0px;">Motherboard</p>
                                <p class="card-text">CPU</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="row" style="background-color: #fff; border-radius: 30px; box-shadow: 0 2px 5px #888383; max-width: 878px;">
                    <div class="col-12 text-center">
                        <h3 style="margin-top: 20px; font-size: 24px;">Overall Sales in 2024</h3>
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
                            <div class="card-body">
                                <h5 class="card-title" style="margin-bottom: 25px;">Top Products</h5>
                                <p class="card-text">Product 1</p>
                                <p class="card-text">Product 2</p>
                                <p class="card-text">Product 3</p>
                                <p class="card-text">Product 4</p>
                                <p class="card-text">Product 5</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Stock Alerts Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="card admin-card" style="background-color: #fff; border-radius: 30px; height: 280px; text-align: center; box-shadow: 0 4px 10px #888383;">
                            <div class="card-body">
                                <h5 class="card-title" style="margin-bottom: 25px;">Stock Alerts</h5>
                                <p class="card-text">Product A: Low stock</p>
                                <p class="card-text">Product B: Out of stock</p>
                                <p class="card-text">Product C: Low stock</p>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

<div class="content"></div>
<footer class="footer" style="width: 100%; background-color: #122448; color: #fff; font-family: 'Lato', sans-serif; padding: 10px 0; position: relative; bottom: 0;">
  <div class="footer-container" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; max-width: 1200px; margin: 0 auto; padding: 10px;">
    <div class="footer-section" style="flex: 1 1 200px; text-align: left;">
      <img class="footer-logo" src="/assets/images/rpc-logo-white.png" alt="RPC Tech Computer Store Logo" style="width: 250px; margin-bottom: 10px; margin-left: 10px;">
      <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Follow Us</p>
      <a href="https://www.facebook.com/profile.php?id=61567195257950" target="_blank">
        <img class="footer-social-links" src="/assets/images/fb icon.png" alt="Social Links" style="width: 20px; margin-left: 32px;">
      </a>
    </div>
    
    <div class="footer-section contact" style="flex: 1 1 200px; text-align: left; margin-top: 90px; margin-left: -50px;">
      <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Contact Us</p>
      <p class="footer-contact-item" style="display: flex; align-items: center; margin: 5px 0; font-size: 13px; color: #fff; text-decoration: none;">
        <img class="icon" src="/assets/images/call-icon.png" alt="Phone Icon" style="width: 15px; margin-right: 10px;"> 09616952829 / 09945657044
      </p>
      <p class="footer-contact-item" style="display: flex; align-items: center; margin: 5px 0; font-size: 13px; color: #fff; text-decoration: none;">
        <a href="mailto:rpctechcomputers@gmail.com"><img class="icon" src="/assets/images/gmail icon.png" alt="Email Icon" style="width: 15px; margin-right: 10px;">rpctechcomputers@gmail.com</a>
      </p>
    </div>
    
    <div class="footer-section branch" style="flex: 1 1 200px; text-align: left; margin-top: 15px; margin-left: 40px;">
      <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Branches</p>
      <p class="footer-branch-item" style="display: flex; align-items: left; margin: 5px 0; color: #fff;">
        <img class="icon" src="/assets/images/bx-location-plus.png" alt="Branch Icon" style="width: 20px; height: 18px; margin-right: 6px;">Main Branch
      </p>
      <p class="footer-branch-address" style="margin: 5px 18px; font-size: 13px; width: 220px; text-align: left; color: #fff;">
        <a href="https://www.google.com/maps/place/RPC+Tech+Computer/@15.0988169,120.6194883,1059m/data=!3m2!1e3!4b1!4m6!3m5!1s0x3396f1d7698ed943:0x8086f35e9ed733de!8m2!3d15.0988117!4d120.6220632!16s%2Fg%2F11lmmzgj3y?hl=en&entry=ttu&g_ep=EgoyMDI0MTEyNC4xIKXMDSoASAFQAw%3D%3D" target="_blank">KM 78 MC ARTHUR HI-WAY BRGY.SAGUIN, San Fernando, Philippines, 2000</a>
      </p>
    </div>
    
    <div class="footer-links" style="display: flex; padding-top: 15px; margin-right: 5px; justify-content: flex-start;">
      <div class="footer-link-column" style="flex: none; margin: 0 13px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Who are we?</p>
        <div class="footer-link-list" style="display: flex; flex-direction: column; gap: 8px; font-weight: 300; text-align: left;">
          <p style="margin: 0; text-align: left;"><a href="pages/public/aboutus.php" style="text-decoration: none; color: #fff; font-size: 14px;">About Us</a></p>
          <p style="margin: 0; text-align: left;"><a href="pages/public/faq.php" style="text-decoration: none; color: #fff; font-size: 14px;">FAQ</a></p>
          <p style="margin: 0; text-align: left;"><a href="pages/public/contactus.php" style="text-decoration: none; color: #fff; font-size: 14px;">Contact Us</a></p>
        </div>
      </div>
      
      <div class="footer-link-column" style="flex: none; margin: 0 13px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Legal Terms</p>
        <div class="footer-link-list" style="display: flex; flex-direction: column; gap: 8px; font-weight: 300; text-align: left;">
          <p style="margin: 0; text-align: left;"><a href="pages/public/termconditions.php" style="text-decoration: none; color: #fff; font-size: 14px;">Terms & Conditions</a></p>
          <p style="margin: 0; text-align: left;"><a href="pages/public/privacy-policy.php" style="text-decoration: none; color: #fff; font-size: 14px;">Privacy Policy</a></p>
        </div>
      </div>
      
      <div class="footer-link-column" style="flex: none; margin: 0 13px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Guides</p>
        <div class="footer-link-list" style="display: flex; flex-direction: column; gap: 8px; font-weight: 300; text-align: left;">
          <p style="margin: 0; text-align: left;"><a href="pages/public/purchase-guides.php" style="text-decoration: none; color: #fff; font-size: 14px;">Purchasing Guides</a></p>
          <p style="margin: 0; text-align: left;"><a href="pages/public/motherboard-chipset.php" style="text-decoration: none; color: #fff; font-size: 14px;">Motherboard Chipset</a></p>
          <p style="margin: 0; text-align: left;"><a href="pages/public/power-supply-calculator.php" style="text-decoration: none; color: #fff; font-size: 14px;">Power Supply Calculator</a></p>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom" style="text-align: center; font-size: 12px; margin-top: 20px;">
    <p style="margin: 5px 0; color: #fff;">&copy; 2022 RPC Tech Computer Store.</p>
    <p style="margin: 5px 0; color: #fff;">All rights reserved.</p>
  </div>
</footer>

    <script>
        const data = [
            { name: 'January', value: 12000 },
            { name: 'February', value: 16000 },
            { name: 'March', value: 18000 },
            { name: 'April', value: 20000 },
            { name: 'May', value: 21000 },
            { name: 'June', value: 22000 },
            { name: 'July', value: 23000 },
            { name: 'August', value: 27000 },
            { name: 'September', value: 29000 },
            { name: 'October', value: 31000 },
            { name: 'November', value: 33000 },
            { name: 'December', value: 37100 },
        ];

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

        // Format time
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        // Format date
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const dateString = now.toLocaleDateString(undefined, options);

        // Update the clock and date
        document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
        document.getElementById('date').textContent = dateString;
    }

    // Update the clock every second
    setInterval(updateClock, 1000);
    updateClock(); // Initialize immediately
</script>
</body>
</html>