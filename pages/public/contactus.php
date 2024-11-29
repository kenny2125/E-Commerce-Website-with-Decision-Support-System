<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    
    <link rel="stylesheet" href="" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400&display=swap" />

    <style>


        body {
            background: rgba(239, 239, 239, 1);
            font-family: 'Lato', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes full height */
            padding-top: 90px;
        }

        .content {
            flex: 1; /* Allow content to expand */
            padding-top: 20px; /* Space for header */
            margin: 0 170px; /* Center the content */
        }

        .footer-contact-us {
            width: 100%;
            text-align: center;
            font-size: 18px;
        }

        .contact-header {
            width: 100%; /* Make it full width */
            height: auto;
            margin-bottom: 20px;
        }

        .call-icon {
            height: 25px;
        }

        .contact-us {
            font-size: 24px;
            font-family: 'Work Sans';
            font-weight: 600;
            text-align: left;
        }

        .email {
            text-decoration: none;
            color: inherit;
        }

        .storefb {
            text-decoration: none;
            color: inherit;
        }

        .hours-title {
            font-family: 'Lato', sans-serif;
            font-size: 16px;
            font-weight: 600;
            line-height: 19.2px;
            text-align: left;
            margin-bottom: 8px;
        }

        .hours-content {
            font-family: 'Lato', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 19.2px;
            text-align: left;
        }

        .flex-container {
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Space out the sections */
        }

        .rectangle-parent {
            width: 437px; /* Width of contact section */
            padding-bottom: 20px; /* Extra spacing if needed */
        }

        .map-section {
            width: 59%; /* Adjust width as needed */

        }

        .map-title {
            font-size: 24px;
            font-weight: 600;
            font-family: 'Work Sans', sans-serif;
            margin-bottom: 10px;
        }

        .mapcontainer {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 10px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            background-color: #f4f6ff;
            padding: 10px;
            border-radius: 8px;
        }

        .contact-item img {
            width: 30px;
            margin-right: 15px;
        }

        .back {
            position: fixed;
            top: 110px;
            right: 20px;
            font-size: 16px;
            color: #8b8b8b;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="content">
        <img src="assets/images/footerimages/contactus.png" alt="Contact Us Header" class="contact-header"> <!-- Header Image -->

        <div class="flex-container">
            <div class="rectangle-parent">
                <div class="contact-section">
                    <h2 class="contact-us"><img class="call-icon" src="assets/images/footerimages/call icon.png" alt="Phone Icon">Contact Us</h2>

                    <div class="contact-item">
                        <img src="assets/images/footerimages/mailicon.png" alt="Email Icon">
                        <a href="mailto:homelabsol@gmail.com" class="email">rpctechcomputers@gmail.com</a>
                    </div>

                    <div class="contact-item">
                        <img src="assets/images/footerimages/telephoneicon.png" alt="Telephone Icon">
                        0912345678910
                    </div>

                    <div class="contact-item">
                        <img src="assets/images/footerimages/fbicon.png" alt="Facebook Icon">
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

    <?php include 'includes/footer.php'; ?>
</body>
</html>