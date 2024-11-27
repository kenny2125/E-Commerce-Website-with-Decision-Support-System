<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" />

    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #000;
            background: rgba(239, 239, 239, 1); /* Set the background color for the entire page */
            font-family: 'Lato', sans-serif;
            padding-bottom: 300px;
            padding-top: 90px;
        }

        /* Main Content Container */
        .footer-privacy-policy {
            width: 100%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background: rgba(239, 239, 239, 1); /* Set the background color */
            font-family: 'Lato', sans-serif;
            text-align: justify;
            font-size: 18px;
        }
        
        /* Image styling */
        .privacy-header {
      width: 100%; /* Adjust width as needed */
      height: 215px;
      margin-bottom: 20px;
    }

        /* Title Styling */
        .privacy-policy {
            font-size: 48px;
            text-align: left;
            margin-bottom: 20px;
        }

        /* Section Titles */
        .who-are-we {
            font-size: 32px;
            margin: 20px 0 10px 0;
        }

        /* Paragraph Styling */
        .we-are-a {
            margin-bottom: 20px;
            font-size: 18px;
            line-height: 1.6;
        }

        /* Back Button Styling */
        .back {
      position: fixed;
      top: 60px;
      right: 20px;
      font-size: 16px;
      color: #8b8b8b;
      cursor: pointer;
      padding-top: 80px;
    }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .footer-privacy-policy {
                padding: 15px;
                font-size: 18px;
            }

            .privacy-policy {
                font-size: 36px;
                text-align: center;
            }

            .who-are-we {
                font-size: 28px;
                text-align: center;
            }

            .back {
                font-size: 14px;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .footer-privacy-policy {
                padding: 10px;
                font-size: 16px;
            }

            .privacy-policy {
                font-size: 28px;
            }

            .who-are-we {
                font-size: 24px;
            }

            .back {
                font-size: 12px;
                text-align: center;
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="footer-privacy-policy">

            <!-- Insert image as header -->
    <img src="assets/images/footerimages/privacy.png" alt="Privacy Policy Header" class="privacy-header">

        <div class="privacy-policy"><img src="assets/images/footerimages/lock.svg" alt="Lock Icon">Privacy Policy</div>
        
        <!-- Sections -->
        <p class="who-are-we"><b>WHO ARE WE?</b></p>
        <p class="we-are-a">We are a team dedicated to providing exceptional products and services, with a commitment to transparency, privacy, and security for our users. Our goal is to create a seamless experience while ensuring your personal data is protected. This Privacy Policy outlines how we collect, use, and secure your information.</p>

        <p class="who-are-we"><b>PERSONAL INFORMATION WE COLLECT</b></p>
        <p class="we-are-a"><b>Device Information</b></p>
        <p class="we-are-a">We collect information about the device you use to access our website, including your IP address, browser type, operating system, and device identifiers. This helps us optimize your experience, troubleshoot issues, and secure our platform.</p>

        <p class="we-are-a"><b>Cookies</b></p>
        <p class="we-are-a">Our website uses cookies to enhance your experience. Cookies are small data files stored on your device that remember your preferences and improve site functionality. You can manage cookie preferences in your browser settings.</p>

        <p class="we-are-a"><b>Log Files</b></p>
        <p class="we-are-a">We use log files to record actions on our site, including your IP address, browser type, and interaction with our pages. This data helps us improve site performance and troubleshoot issues.</p>

        <p class="we-are-a"><b>Web Beacons, Tags, and Pixels</b></p>
        <p class="we-are-a">We may use web beacons, tags, and pixels to track user behavior, understand website traffic, and measure the effectiveness of our marketing efforts. This information is used solely for analytics and improving user experience.</p>

        <p class="who-are-we"><b>HOW DO WE USE YOUR PERSONAL INFORMATION?</b></p>
        <p class="we-are-a">We use your personal information to process orders, provide customer support, and improve our services. This may include personalizing your experience, sending updates or promotional materials, and analyzing user behavior to enhance our offerings. We prioritize your privacy and ensure that all uses of your data align with this Privacy Policy.</p>

        <p class="we-are-a"><b>DATA RETENTION</b></p>
        <p class="we-are-a">We retain your personal information only for as long as necessary to fulfill the purposes outlined in this policy, including providing services, maintaining your account, and complying with legal obligations. Once your information is no longer needed, we securely delete or anonymize it.</p>

        <p class="we-are-a"><b>DATA PRIVACY CHANGES</b></p>
        <p class="we-are-a">We may occasionally update this Privacy Policy to reflect changes in our practices or legal requirements. Any updates will be posted on this page, and we encourage you to review it periodically. Your continued use of our services after policy changes signifies your acceptance of the revised terms.</p>

        <p class="we-are-a"><b>SECURITY OF YOUR INFORMATION</b></p>
        <p class="we-are-a">We take your privacy seriously and implement multiple security measures to protect your personal information. These measures include encryption, firewalls, and secure server environments. While we strive to safeguard your data, please note that no method of transmission over the internet or electronic storage is completely secure. However, we are committed to keeping your data as secure as possible.</p>

        <p class="we-are-a"><b>POLICY FOR CHILDREN</b></p>
        <p class="we-are-a">At RPC Tech Computer Store, we value the privacy and protection of children who use our services. This Children’s Privacy Policy outlines how we collect, use, and safeguard personal information from children under the age of 13 in accordance with applicable privacy laws.</p>

        <p class="we-are-a"><b>YOUR RIGHTS</b></p>
        <p class="we-are-a">Depending on your location, you may have certain rights regarding your personal information, such as the right to access, correct, or delete your data. If you would like to exercise these rights, please contact us at homelabsol@gmail.com.</p>

        <!-- Back Button -->
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

<?php include 'includes/footer.php'; ?>

</body>
</html>