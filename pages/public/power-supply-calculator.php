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
        <div style="padding-top: 90px; padding-bottom: 300px; font-family: 'Work Sans', sans-serif; background-color: rgba(239, 239, 239, 1);">
    <div style="width: 100%; position: relative; background-color: #efefef; padding: 60px; text-align: center; font-size: 48px; color: #000; border-radius: 10px; max-width: 1000px; margin: 50px auto;">
        <div style="font-size: 40px; font-weight: bold; margin-bottom: 30px;">Power Supply Calculator</div>
        <div style="margin-bottom: 40px; font-weight: bold; font-size: 32px;">Select your CPU and GPU to calculate:</div>
        
        <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 40px;">
            <div style="margin-bottom: 20px;">
                <label for="cpu-select" style="margin-right: 15px; font-weight: 700; font-size: 24px;">CPU:</label>
                <select id="cpu-select" style="padding: 20px; font-size: 22px; border: 2px solid #1a54c0; border-radius: 5px; background-color: #fff; color: #000; transition: border-color 0.3s; width: 350px;">
                    <option value="0">Select CPU </option>
                    <option value="65">Ryzen 3 (65W)</option>
                    <option value="95">Ryzen 5 (95W)</option>
                    <option value="105">Ryzen 7 (105W)</option>
                </select>
            </div>
            
            <div>
                <label for="gpu-select" style="margin-right: 15px; font-weight: 700; font-size: 24px;">GPU:</label>
                <select id="gpu-select" style="padding: 20px; font-size: 22px; border: 2px solid #1a54c0; border-radius: 5px; background-color: #fff; color: #000; transition: border-color 0.3s; width: 350px;">
                    <option value="0">Select GPU</option>
                    <option value="170">NVIDIA RTX 3060 (170W)</option>
                    <option value="220">NVIDIA RTX 3070 (220W)</option>
                </select>
            </div>
        </div>
        
        <div style="margin-top: 40px; font-size: 36px; font-weight: 700;">Total TDP: <span id="total-tdp">0</span> watts</div>
        <div style="margin-top: 40px; font-size: 36px; font-weight: 700;">You should buy PSU with a minimum of: <span id="minimum-psu">0</span> watts</div>
        
        <div style="margin-top: 40px;">
            <button onclick="calculatePSU()" style="padding: 20px 40px; font-size: 24px; background-color: #1a54c0; color: #f0f1f4; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">Calculate PSU</button>
        </div>
    </div>
</div>
<?php
include '../../includes/footer.php';
?>

</body>
</html>

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

    function calculatePSU() {
        const cpuPower = parseInt(document.getElementById('cpu-select').value);
        const gpuPower = parseInt(document.getElementById('gpu-select').value);
        
        if (cpuPower > 0 && gpuPower > 0) {
            const totalPower = cpuPower + gpuPower + 150; // Adding headroom
            document.getElementById('total-tdp').innerText = totalPower;
            document.getElementById('minimum-psu').innerText = totalPower;
        } else {
            alert("Please select both CPU and GPU.");
        }
    }
</script>