

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <title>RPC Tech Computer Store</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
  
<?php
include '../../includes/header.php';
include '../../config/db_config.php';
?>
<div class="container">
        <!-- Back button -->
        <div class="back" id="backButton" style="margin-top: 30px; right: 20px; margin-bottom: 30px; font-size: 23px; color: #A9A9A9; margin-left: 1790px;">
            <a href="/index.php" style="text-decoration: none; color: inherit;">Back</a>
        </div>
            <img src="/assets/images/BANNERS (5).png" alt="Logo" class="logo" style="width: 95%;">>
        
    <h1 class="purchasing-guide" style="margin-top: 20px; margin-left: 65px;">How to check Motherboard Chipset Version?</h1>
	<p class="blank-line">&nbsp;</p>
	<div class="step-1" style="text-align: justify; margin-bottom: 10px; margin-left: 140px; margin-right: 170px; font-size: 20px; font-weight: bold;">Step 1:</div>
    <div class="step1-content" style="text-align: justify; margin-bottom: 20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">On Windows search bar, search and open “dxdiag”.</div>
	<p class="blank-line">&nbsp;</p>
	<div class="step-2" style="text-align: justify; margin-bottom: 10px; margin-left: 140px; margin-right: 170px; font-size: 20px; font-weight: bold;">Step 2:</div>
    <div class="step2-content" style="text-align: justify; margin-bottom: 5px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Find the system model as per picture.</div>
    <img class="chipset-step-icon" alt="" src="/assets/images/image 37.png" style="width: 50%; height: auto; margin-left: 190px;">
    <div class="in-this-example" style="text-align: justify; margin-bottom: 80px; margin-left: 190px; margin-right: 170px; font-size: 20px;">In this example, the Motherboard Chipset is B450M</div>
</div>

<?php
include '../../includes/footer.php';
?>
</body>
</html>