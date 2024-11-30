<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@600&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400&display=swap" />
    <link rel="stylesheet" href="../../assets/css/powersupplycalcu.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">

</head>
<body>

<div class="brand-power-supply">
    <div class="heading">Power Supply Calculator</div> <!-- Added heading -->
    <div class="select-your-cpu">Select your CPU and GPU to calculate:</div>
    
    <div class="selection-container">
        <div>
            <label for="cpu-select">CPU:</label>
            <select id="cpu-select">
                <option value="0">Select CPU </option>
                <option value="65">Ryzen 3 (65W)</option>
                <option value="95">Ryzen 5 (95W)</option>
                <option value="105">Ryzen 7 (105W)</option>
            </select>
        </div>
        
        <div>
            <label for="gpu-select">GPU:</label>
            <select id="gpu-select">
                <option value="0">Select GPU</option>
                <option value="170">NVIDIA RTX 3060 (170W)</option>
                <option value="220">NVIDIA RTX 3070 (220W)</option>
            </select>
        </div>
    </div>
    
    <div class="total-tdp">Total TDP: <span id="total-tdp">0</span> watts</div>
    <div class="you-should-buy">You should buy PSU with a minimum of: <span id="minimum-psu">0</span> watts</div>
    
    <div class="state-layer" id="calculate-psu">
        <button onclick="calculatePSU()">Calculate PSU</button>
    </div>
</div>

<!-- Back button -->
<div class="back" id="backButton">Back</div>

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

<?php 
include '../../config/db_config.php';
include '../../includes/footer.php'; ?>
</body>
</html>