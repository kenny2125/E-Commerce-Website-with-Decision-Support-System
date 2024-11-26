<link rel="stylesheet" href="assets/css/header.css">
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
            <img src="assets/images/rpc-logo-black.png" alt="" width="245" height="81" class="d-inline-block align-text-top">
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
    </div>
</nav>

<!-- Include the modal -->
<?php include 'pages/user/login.php'; ?>
<?php include 'pages/user/registration.php'; ?>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="assets/js/login.js"></script>