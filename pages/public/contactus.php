<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400&display=swap" />
    <link rel="stylesheet" href="../../assets/css/contactus.css" />
    <link rel="stylesheet" href="../../assets/css/footer.css">

</head>
<body>
    <div class="content">
        <img src="../../assets/images/footerimages/contactus.png" alt="Contact Us Header" class="contact-header"> <!-- Header Image -->

        <div class="flex-container">
            <div class="rectangle-parent">
                <div class="contact-section">
                    <h2 class="contact-us"><img class="call-icon" src="../../assets/images/footerimages/call icon.png" alt="Phone Icon">Contact Us</h2>

                    <div class="contact-item">
                        <img src="../../assets/images/footerimages/mailicon.png" alt="Email Icon">
                        <a href="mailto:homelabsol@gmail.com" class="email">rpctechcomputers@gmail.com</a>
                    </div>

                    <div class="contact-item">
                        <img src="../../assets/images/footerimages/telephoneicon.png" alt="Telephone Icon">
                        0912345678910
                    </div>

                    <div class="contact-item">
                        <img src="../../assets/images/footerimages/fbicon.png" alt="Facebook Icon">
                        <a href="https://www.facebook.com/RPCTechComputerStore" target="_blank" class="storefb">RPC Tech Computer Store</a>
                    </div>
                    <div class="contact-item">
                        <div class="hours-title">Hours Of Operation</div>
                        <p class="hours-content">
                            We're available to assist you during the following hours:<br>
                            <strong>Monday to Saturday:</strong> 9:00 AM – 6:00 PM<br>
                            <strong>Sunday:</strong> Closed
                        </p>
                    </div>
                </div>        
            </div>

            <div class="map-section">
                <div class="map-title">Google Maps</div>
                <iframe
                    class="mapcontainer"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.019584833245!2d120.64694731531743!3d15.04241867907745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd1c64e9b8d8b9%3A0x8d1c9c7e7c4e1c2!2sKM%2078%20MC%20ARTHUR%20HI-WAY%20BRGY.SAGUIN%2C%20San%20Fernando%2C%20Philippines%2C%202000!5e0!3m2!1sen!2sus!4v1635268928945!5m2!1sen!2sus"
                    allowfullscreen
                    loading="lazy">
                </iframe>
            </div>
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