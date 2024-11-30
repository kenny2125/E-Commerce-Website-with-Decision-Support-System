<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/aboutus.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">

  
</head>
<body>
    <div class="container">

            <h1>About Us</h1>

        <div class="content">
            <p><strong>RPC Tech Computer Store</strong>, founded by Ryn Maglonzo in August 2024, is a business that sells desktop computer accessories and hardware. The store is known for its smooth transactions and affordable prices, attracting customers such as students, work-from-home workers, and others looking for high-quality computer parts at reasonable costs.</p>
            <p>At present, RPC Tech Computer Store operates from a single location. To meet the growing demand for its products and reach more customers, the store plans to move from its traditional sales approach—which depends on face-to-face interactions and social media—to an online selling platform. This change is expected to make the store more accessible to customers and improve how it operates.</p>
        </div>

    </div>

            <!-- Back button -->
            <div class="back" id="backButton">Back</div>
        </div>
    
        <script>
            document.getElementById("backButton").addEventListener("click", function () {
                if (document.referrer) {
                    // Go back if there's a previous page
                    window.history.back();
                } else {
                    // Redirect to the main page if there's no history
                    window.location.href = "index.php"; // Change to your main page URL
                }
            });
        </script>

<?php 
include '../../config/db_config.php';
include '../../includes/footer.php'; ?>

</body>
</html>