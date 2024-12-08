<?php
include '../../includes/header.php';
include '../../config/db_config.php';
?>

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
 

<div class="container">
        <!-- Back button -->
        <div class="back" id="backButton" style="margin-top: 30px; right: 20px; margin-bottom: 30px; font-size: 23px; color: #A9A9A9; margin-left: 1790px;">
            <a href="/index.php" style="text-decoration: none; color: inherit;">Back</a>
        </div>
            <img src="/assets/images/BANNERS (2).png" alt="Logo" class="logo" style="width: 95%;">

    <h1 class="contact-us" style="margin-top: 20px; margin-left: 65px;"><img src="/assets/images/call icon.png" alt="Call Icon" style="margin-right:10px;">Contact Us</h1>

    <!-- Flex container to display contact-us and maps side by side -->
<div class="flex-container" style="display: flex; justify-content: space-between; text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 80px; font-size: 23px;">
    
    <!-- Contact Us Section -->
    <div class="contact-section" style="width: 45%; font-size: 15px; margin-right: 20px;">
        <div class="contact-item" style="margin: 20px 0; margin-left: 65px; margin-top: -10px; font-size: 23px">
            <img src="/assets/images/mailicon.png" alt="Mail Icon">
            <a href="mailto:homelabsol@gmail.com" class="email">rpctechcomputers@gmail.com</a>
        </div>

        <div class="contact-item" style="margin: 20px 0; margin-top: 20px; margin-left: 65px; margin-top: -10px; font-size: 23px">
            <img src="/assets/images/call icon.png" alt="Call Icon">
            0912345678910 / 09945657044
        </div>

        <div class="contact-item" style="margin: 20px 0 80px; margin-top: 20px; margin-left: 65px; margin-top: -10px; font-size: 23px">
            <img src="/assets/images/image 14.png" alt="Facebook Icon">
            <a href="https://www.facebook.com/profile.php?id=61567195257950" target="_blank" class="storefb">RPC Tech Computer Store</a>
        </div>

        <div class="hours-of-operation">
            <div class="hours-title" style="font-size: 22px; font-weight: bold; text-align: left; margin-top: 20px; margin-left: 65px;">Hours Of Operation</div>
            <p class="hours-content" style="font-size: 20px; text-align: left; margin-left: 65px">
                We're available to assist you during the following hours:<br>
                <br>
                <strong>Monday to Saturday:</strong> 9:00 AM – 6:00 PM<br>
                <strong>Sunday:</strong> Closed
            </p>
        </div>
    </div>
<!-- Google Maps Section -->
<div class="map-section" style="width: 45%; text-align: center; position: relative;">
    <!-- Title for Google Maps -->
    <div class="map-title" style="display: flex; font-size: 35px; font-weight: bold; margin-top: -70px; margin-bottom: 40px; margin-left: 220px">
        Google Maps
    </div>
    
    <!-- Google Maps Iframe -->
    <iframe
        class="mapcontainer"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4739.866456776542!2d120.62206320000001!3d15.098811700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f1d7698ed943%3A0x8086f35e9ed733de!2sRPC%20Tech%20Computer!5e1!3m2!1sen!2sph!4v1733128732330!5m2!1sen!2sph"
        style="width: 100%; height: 500px; border: none; margin-left: -30px; margin-top: -20px"
        allowfullscreen
        loading="lazy">
    </iframe>
    
    <!-- Main Branch Text at the bottom-left of the map -->
    <p class="branch" style="font-size: 15px; text-align: left; margin-left: 38px; margin-bottom: 3px; position: absolute; bottom: 10px; left: 10px; z-index: 10; background-color: rgba(255, 255, 255, 0.7); padding: 5px;">
        <strong>Main Branch</strong><br>
        KM 78 MC ARTHUR HI-WAY BRGY.SAGUIN, San Fernando, Philippines, 2000
    </p>
</div>


</body>

</html>