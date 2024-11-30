<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="initial-scale=1, width=device-width">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" />
    <link rel="stylesheet" href="../../assets/css/motherboard-chipset.css" />
    <link rel="stylesheet" href="../../assets/css/footer.css">


</head>
<body>

<div class="motherboard-chipset-page">
    <img src="../../assets/images/footerimages/motherboard.png" alt="Motherboard Chipset Header" class="chipset-header">

  	<b class="how-to-check">How to check Motherboard Chipset Version?</b>
	<p class="blank-line">&nbsp;</p>
	<div class="step-1">Step 1:</div>
    <div class="step1-content">On Windows search bar, search and open “dxdiag”.</div>
	<p class="blank-line">&nbsp;</p>
	<div class="step-2">Step 2:</div>
    <div class="step2-content">Find the system model as per picture.</div>
    <img class="chipset-step-icon" alt="" src="../../assets/images/footerimages/chipsetstep.png">
    <div class="in-this-example">In this example, the Motherboard Chipset is B450M</div>
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