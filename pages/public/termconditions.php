<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@400&display=swap" />
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;500;700&display=swap" />
      <link rel="stylesheet" href="../../assets/css/termconditions.css" />
      <link rel="stylesheet" href="../../assets/css/footer.css">


</head>
<body>
  	<div class="footer-terms-conditions">

        <!-- Insert image as header -->
        <img src="../../assets/images/footerimages/termsconditions.png" alt="TERMS Header" class="terms-header">
        <!-- Terms and Conditions -->
        <b class="terms-conditions"><img src="../../assets/images/footerimages/list.svg" alt="List Icon">Terms & Conditions</b>
        <div class="these-terms-and">
            These Terms and Conditions govern your access to and use of our website, services, and products. By using our website, you agree to comply with and be bound by these terms. If you do not agree to these Terms and Conditions, you should not use our services. We reserve the right to modify these terms at any time, and any changes will be posted on this page. Your continued use of the site after any modifications indicates your acceptance of the updated Terms and Conditions.
        </div>

        <!-- Information We Collect Section -->
        <div class="information-we-collect-container">
            <p class="information-we-collect-we-col">
                <b class="information-we-collect">Information We Collect: </b>
                <span>We collect information that you provide directly to us, such as when you create an account, make a purchase, or communicate with us. This information may include your name, email address, phone number, payment information, and any other details you choose to provide.</span>
            </p>
            <p class="information-we-collect-we-col">
                <b class="information-we-collect">How We Use Your Information:</b>
                <span>We use the information we collect to process transactions, personalize your experience, improve our website, provide customer support, and communicate with you about products, services, and promotions. We may also use your information for analytics to enhance the functionality and performance of our services.</span>
            </p>
            <p class="information-we-collect-we-col">
                <b class="information-we-collect">How We Disclose Your Information: </b>
                <span>We may share your information with trusted third-party service providers who assist us in operating our business, such as payment processors and shipping companies. We ensure these partners handle your data securely and only for purposes aligned with our privacy practices. We may also share information as required by law or to protect our legal rights.</span>
            </p>
            <p class="information-we-collect-we-col">
                <b class="information-we-collect">Security:</b>
                <span>We are committed to protecting your information and have implemented industry-standard security measures to prevent unauthorized access, disclosure, alteration, or destruction of your data. While we strive to safeguard your information, please note that no method of electronic storage is 100% secure.</span>
            </p>
            <p class="information-we-collect-we-col">
                <b class="information-we-collect">Third-Party Websites:</b>
                <span>Our website may contain links to third-party websites for your convenience. These sites have their own privacy policies, and we encourage you to review them. We are not responsible for the privacy practices or content of third-party sites.</span>
            </p>
            <p class="information-we-collect-we-col">
                <b class="information-we-collect">Children’s Privacy:</b>
                <span>Our services are not directed at children under 13, and we do not knowingly collect personal information from children. If we become aware of data collected from children without parental consent, we will take steps to delete it promptly.</span>
            </p>
        </div>

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

<?php 
include '../../config/db_config.php';
include '../../includes/footer.php'; ?>

</body>
</html>