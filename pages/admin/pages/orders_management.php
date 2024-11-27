<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php include '../../../includes/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <!-- 1st Column: Sidebar -->
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
                            Inventory Management
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

        <!-- 2nd Column: Payments List -->
        <div class="col-9">
            <div class="row">
                <!-- First row: Picture, Title, Buttons (Refresh, Add Order), Search Bar -->
                <div class="col-12 d-flex align-items-center mb-3">
                    <img src="https://via.placeholder.com/50" alt="Product Image" class="me-3">
                    <h5 class="me-auto">Orders Management</h5>
                    <!-- Refresh Button -->
                    <button class="btn btn-primary me-2">Refresh</button>
                    <!-- Add Order Button -->
                    <button class="btn btn-success me-2">Add Order</button>
                    <!-- Search Bar -->
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
            </div>

            <!-- Second row: Payment List Table -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Payment Status</th>
                                <th>Customer Name</th>
                                <th>Purchased Product/s</th>
                                <th>Total</th>
                                <th>Ordering Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>PAID</td>
                                <td>Mikayla T. Nova</td>
                                <td>GEFORCE RTX 4090 MSI GAMING TRIO 24GB GDDR6X TRIPLE FAN RGB</td>
                                <td>₱114,995.00</td>
                                <td>October 29, 2024</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>UNPAID</td>
                                <td>John D. Smith</td>
                                <td>DELL ALIENWARE AURORA R13</td>
                                <td>₱85,000.00</td>
                                <td>November 2, 2024</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>PAID</td>
                                <td>Sarah J. Taylor</td>
                                <td>APPLE MACBOOK PRO 16” M2</td>
                                <td>₱120,000.00</td>
                                <td>November 5, 2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    
    
</body>
</html>