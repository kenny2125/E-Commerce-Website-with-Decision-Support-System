<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand" href="#">
            <img src="assets/images/rpc-logo-black.png" alt="Logo" class="logo" style="width: 175px;">
        </a>
        <form class="d-flex ms-auto">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <?php if (!$isLoggedIn): ?>
            <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>
        <?php else: ?>
            <span class="navbar-text ms-3">Welcome, <?php echo htmlspecialchars($username); ?>!</span>
        <?php endif; ?>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 bg-light p-3">
                <div class="list-group">
                    <button class="list-group-item list-group-item-action active" id="myProfile">
                        <span class="material-icons">person</span> My Profile
                    </button>
                    <button class="list-group-item list-group-item-action" id="orderHistory">
                        <span class="material-icons">history</span> Order History
                    </button>
                    <button class="btn btn-danger mt-3 w-100" id="logoutButton">Log Out</button>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="col-md-9">
                <div class="p-4 bg-white shadow-sm rounded">
                    <h2>My Profile</h2>
                    <div class="mb-3">
                        <h5>Basic Information</h5>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" value="Mikylla T. Nova" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="mikiimeeow" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" value="********" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="text" class="form-control" id="birthdate" value="April 10, 2005" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="gender" value="Female" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" value="673 Quirino Hwy, Novaliches, Quezon City, Metro Manila" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contactNumber" value="091222222222" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="mikyllanova10@gmail.com" disabled>
                        </div>
                    </div>
                    <!-- <div class="mt-4">
                        <button class="btn btn-primary me-2" id="editProfile" data-editing="false">Edit Profile</button>
                        <button class="btn btn-secondary" id="changePassword">Change Password</button>
                    </div> -->
                </div>

                <!-- Order History Section -->
                <div id="orderHistoryContent" class="d-none mt-4">
                    <h2>Order History</h2>
                    <p>Your order history is empty.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
