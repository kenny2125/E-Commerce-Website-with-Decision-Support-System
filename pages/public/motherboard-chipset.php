<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="initial-scale=1, width=device-width">
  	
  	<link rel="stylesheet" href="" />
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" />
  	
  	<style>
    /* Reset default margin and padding */
    body {
        padding-top: 90px;
        padding-bottom: 300px;
        background: rgba(239, 239, 239, 1);
        font-family: 'Lato', sans-serif;
    }

    /* Main container for the motherboard chipset page */
    .motherboard-chipset-page {
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px;
        background: rgba(239, 239, 239, 1);
        color: #000;
        font-size: 18px;
    }

    .chipset-header {
        width: 100%; 
        height: auto;
        margin-bottom: 20px;
    }

    .how-to-check {
        width: 444px;
        font-size: 22px;
        line-height: 30px;
        display: inline-block;
        color: #000;
        white-space: pre-wrap;
        text-align: justify;
    }

    .step-1, .step-2 {
        font-size: 20px;
        line-height: 30px;
        font-weight: 600;
        color: #000;
        display: inline-block;
    }

    .step1-content, .step2-content, .in-this-example {
        font-size: 18px;
        line-height: 30px;
        color: #000;
        text-align: justify;
    }

    .chipset-step-icon {
        width: auto;
        max-width: 100%;
        overflow: hidden;
        height: 79px;
        object-fit: cover;
    }

    /* Fixed position for the Back button */
    .back {
        position: fixed;
        top: 60px;
        right: 20px;
        font-size: 16px;
        color: #8b8b8b;
        cursor: pointer;
        padding-top: 80px;
    }
	</style>
</head>
<body>

<div class="motherboard-chipset-page">
    <img src="assets/images/footerimages/motherboard.png" alt="Motherboard Chipset Header" class="chipset-header">

  	<b class="how-to-check">How to check Motherboard Chipset Version?</b>
	<p class="blank-line">&nbsp;</p>
	<div class="step-1">Step 1:</div>
    <div class="step1-content">On Windows search bar, search and open “dxdiag”.</div>
	<p class="blank-line">&nbsp;</p>
	<div class="step-2">Step 2:</div>
    <div class="step2-content">Find the system model as per picture.</div>
    <img class="chipset-step-icon" alt="" src="assets/images/footerimages/chipsetstep.png">
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

    <?php include 'includes/footer.php'; ?>
</body>
</html>