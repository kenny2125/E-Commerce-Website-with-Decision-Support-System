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
            padding-top: 90px;
            padding-bottom: 300px;
            font-family: 'Work Sans', sans-serif;
            background-color: rgba(239, 239, 239, 1); /* Updated background color */
        }

        .brand-power-supply {
            width: 100%;
            position: relative;
            background-color: #efefef;
            padding: 60px; /* Increased padding for more space */
            text-align: center;
            font-size: 48px; /* Increased font size for more prominence */
            color: #000;
            border-radius: 10px; /* Optional: Add rounded corners */
            max-width: 1000px; /* Increased max-width for a wider appearance */
            margin: 50px auto; /* Center the container */
        }

        .heading {
            font-size: 40px; /* Font size for the heading */
            font-weight: bold; /* Bold font for the heading */
            margin-bottom: 30px; /* Space below the heading */
        }

        .select-your-cpu {
            margin-bottom: 40px; /* Increased margin for better spacing */
            font-weight: bold;
            font-size: 32px; /* Increased font size for better visibility */
        }

        .selection-container {
            display: flex;
            flex-direction: column; /* Stack items vertically */
            align-items: center; /* Center items horizontally */
            margin-bottom: 40px; /* Increased space below the dropdowns */
        }

        label {
            margin-right: 15px;
            font-weight: 700;
            font-size: 24px; /* Increased font size for labels */
        }

        select {
            padding: 20px; /* Increased padding for better touch targets */
            font-size: 22px; /* Increased font size for dropdowns */
            border: 2px solid #1a54c0;
            border-radius: 5px;
            background-color: #fff;
            color: #000;
            transition: border-color 0.3s;
            width: 350px; /* Increased width for dropdowns */
        }

        select:hover {
            border-color: #0056b3; /* Darker blue on hover */
        }

        select:focus {
            outline: none;
            border-color: #0056b3; /* Darker blue on focus */
            box-shadow: 0 0 5px rgba(0, 86, 179, 0.5); /* Shadow effect */
        }

        .total-tdp, .you-should-buy {
            margin-top: 40px; /* Increased margin for better spacing */
            font-size: 36px; /* Increased font size for results */
            font-weight: 700;
        }

        .state-layer {
            margin-top: 40px;
        }

        button {
            padding: 20px 40px; /* Increased padding for buttons */
            font-size: 24px; /* Increased font size for buttons */
            background-color: #1a54c0;
            color: #f0f1f4;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Fixed position for the Back button */
        .back {
            position: fixed;
            top: 60px;
            right: 20px;
            font-size: 16px;
            color: #8b8b8b;
            cursor: pointer;
            padding-top: 90px;
        }
    </style>
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

<?php include 'includes/footer.php'; ?>
</body>
</html>