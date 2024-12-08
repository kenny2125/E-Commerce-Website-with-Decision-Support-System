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
            <img src="/assets/images/BANNERS (3).png" alt="Logo" class="logo" style="width: 95%;">>
        
    <h1 class="terms-and-condition" style="margin-top: 20px; margin-left: 65px;"><img src="/assets/images/Group 349.png" alt="Call Icon" style="margin-right:10px;">Privacy Policy</h1>

        <!-- Sections -->
        <p class="who-are-we" style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;"><b>WHO ARE WE?</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 40px; margin-left: 190px; margin-right: 170px; font-size: 20px;">We are a team dedicated to providing exceptional products and services, with a commitment to transparency, privacy, and security for our users. Our goal is to create a seamless experience while ensuring your personal data is protected. This Privacy Policy outlines how we collect, use, and secure your information.</p>

        <p class="who-are-we" style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;"><b>PERSONAL INFORMATION WE COLLECT</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 10px; margin-left: 190px; margin-right: 170px; font-size: 20px;"><b>Device Information</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 30px; margin-left: 190px; margin-right: 170px; font-size: 20px;">We collect information about the device you use to access our website, including your IP address, browser type, operating system, and device identifiers. This helps us optimize your experience, troubleshoot issues, and secure our platform.</p>

        <p class="we-are-a" style="text-align: justify; margin-bottom: 10px; margin-left: 190px; margin-right: 170px; font-size: 20px;"><b>Cookies</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 30px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Our website uses cookies to enhance your experience. Cookies are small data files stored on your device that remember your preferences and improve site functionality. You can manage cookie preferences in your browser settings.</p>

        <p class="we-are-a" style="text-align: justify; margin-bottom: 10px; margin-left: 190px; margin-right: 170px; font-size: 20px;"><b>Log Files</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 30px; margin-left: 190px; margin-right: 170px; font-size: 20px;">We use log files to record actions on our site, including your IP address, browser type, and interaction with our pages. This data helps us improve site performance and troubleshoot issues.</p>


        <p class="who-are-we" style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;"><b>HOW DO WE USE YOUR PERSONAL INFORMATION?</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 30px; margin-left: 190px; margin-right: 170px; font-size: 20px;">We use your personal information to process orders, provide customer support, and improve our services. This may include personalizing your experience, sending updates or promotional materials, and analyzing user behavior to enhance our offerings. We prioritize your privacy and ensure that all uses of your data align with this Privacy Policy.</p>

        <p class="we-are-a" style="text-align: justify; margin-bottom: 10px; margin-left: 190px; margin-right: 170px; font-size: 20px;"><b>DATA RETENTION</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 30px; margin-left: 190px; margin-right: 170px; font-size: 20px;">We retain your personal information only for as long as necessary to fulfill the purposes outlined in this policy, including providing services, maintaining your account, and complying with legal obligations. Once your information is no longer needed, we securely delete or anonymize it.</p>

        <p class="we-are-a" style="text-align: justify; margin-bottom: 10px; margin-left: 190px; margin-right: 170px; font-size: 20px;"><b>DATA PRIVACY CHANGES</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 30px; margin-left: 190px; margin-right: 170px; font-size: 20px;">We may occasionally update this Privacy Policy to reflect changes in our practices or legal requirements. Any updates will be posted on this page, and we encourage you to review it periodically. Your continued use of our services after policy changes signifies your acceptance of the revised terms.</p>

        <p class="we-are-a" style="text-align: justify; margin-bottom: 10px; margin-left: 190px; margin-right: 170px; font-size: 20px;"><b>SECURITY OF YOUR INFORMATION</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 30px; margin-left: 190px; margin-right: 170px; font-size: 20px;">We take your privacy seriously and implement multiple security measures to protect your personal information. These measures include encryption, firewalls, and secure server environments. While we strive to safeguard your data, please note that no method of transmission over the internet or electronic storage is completely secure. However, we are committed to keeping your data as secure as possible.</p>

        <p class="we-are-a" style="text-align: justify; margin-bottom: 10px; margin-left: 190px; margin-right: 170px; font-size: 20px;"><b>POLICY FOR CHILDREN</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 30px; margin-left: 190px; margin-right: 170px; font-size: 20px;">At RPC Tech Computer Store, we value the privacy and protection of children who use our services. This Children’s Privacy Policy outlines how we collect, use, and safeguard personal information from children under the age of 13 in accordance with applicable privacy laws.</p>

        <p class="we-are-a" style="text-align: justify; margin-bottom: 10px; margin-left: 190px; margin-right: 170px; font-size: 20px;"><b>YOUR RIGHTS</b></p>
        <p class="we-are-a" style="text-align: justify; margin-bottom: 80px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Depending on your location, you may have certain rights regarding your personal information, such as the right to access, correct, or delete your data. If you would like to exercise these rights, please contact us at homelabsol@gmail.com.</p>
    </div>

    
<?php
include '../../includes/footer.php';
?>
</body>
</html>