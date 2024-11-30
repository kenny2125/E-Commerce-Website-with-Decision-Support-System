<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/css/admin_dashboard.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
</head>

<nav class="navbar">
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 100%;">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                        <span class="fs-4">Sidebar</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">
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
                            <a href="#" class="nav-link link-dark">
                                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                                Invetory Mananagement
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
                            <a href="#" class="d-flex align-items-center link-dark text-decoration-none">
                                
                            <strong>John Kenny Q. Reyes</strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 2nd Column: Total Sales, Ongoing Orders, Visitors, Top Category, and Chart -->
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total sale</h5>
                                <p class="card-text">₱114,995.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ongoing Orders</h5>
                                <p class="card-text">1 Orders</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No of Online Visitors per day</h5>
                                <p class="card-text">4 Visitors</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Top Product Categories</h5>
                                <p class="card-text">GPU</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="row">
                    <div class="col-12">
                        <div id="chart-container" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>

            <!-- 3rd Column: Top Products and Stock Alerts -->
            <div class="col-3">
                <div class="row">
                    <!-- Top Products Cards -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Top Products</h5>
                                <p class="card-text">Product 1</p>
                                <p class="card-text">Product 2</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Top Products</h5>
                                <p class="card-text">Product 3</p>
                                <p class="card-text">Product 4</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stock Alerts Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Stock Alerts</h5>
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
</body>
</html>
