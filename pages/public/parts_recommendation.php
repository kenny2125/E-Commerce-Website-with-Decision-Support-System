<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Recommendation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <link rel="stylesheet" href="/assets/css/partsrecommendationsystem.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
    <style>
        /* Ensure carousel has 400x400 size */
        .carousel, .carousel-inner {
            width: 400px;
            height: 400px;
        }

        /* Keep the cards 200x200 */
        .card {
            width: 200px;
            height: 200px;
            margin: 10px;
            text-align: center;
            display: inline-block;
            vertical-align: top;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        /* Center the carousel items */
        .carousel-inner {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<?php 
    include '../../includes/header.php';
    include '../../config/db_config.php';
?>

<body>
    <div class="container my-5">
        <div id="computerPartsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Item 1 -->
                <div class="carousel-item active">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=CPU" alt="CPU">
                        <div class="card-body">
                            <h5 class="card-title">CPU</h5>
                        </div>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="carousel-item">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=Motherboard" alt="Motherboard">
                        <div class="card-body">
                            <h5 class="card-title">Motherboard</h5>
                        </div>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="carousel-item">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=RAM" alt="RAM">
                        <div class="card-body">
                            <h5 class="card-title">RAM</h5>
                        </div>
                    </div>
                </div>
                <!-- Item 4 -->
                <div class="carousel-item">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=GPU" alt="GPU">
                        <div class="card-body">
                            <h5 class="card-title">GPU</h5>
                        </div>
                    </div>
                </div>
                <!-- Item 5 -->
                <div class="carousel-item">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=SSD" alt="SSD">
                        <div class="card-body">
                            <h5 class="card-title">SSD</h5>
                        </div>
                    </div>
                </div>
                <!-- Item 6 -->
                <div class="carousel-item">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=HDD" alt="HDD">
                        <div class="card-body">
                            <h5 class="card-title">HDD</h5>
                        </div>
                    </div>
                </div>
                <!-- Item 7 -->
                <div class="carousel-item">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=Power+Supply" alt="Power Supply">
                        <div class="card-body">
                            <h5 class="card-title">Power Supply</h5>
                        </div>
                    </div>
                </div>
                <!-- Item 8 -->
                <div class="carousel-item">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=Case" alt="Case">
                        <div class="card-body">
                            <h5 class="card-title">Case</h5>
                        </div>
                    </div>
                </div>
                <!-- Item 9 -->
                <div class="carousel-item">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=Cooler" alt="Cooler">
                        <div class="card-body">
                            <h5 class="card-title">Cooler</h5>
                        </div>
                    </div>
                </div>
                <!-- Item 10 -->
                <div class="carousel-item">
                    <div class="card">
                        <img src="https://via.placeholder.com/200x200?text=Keyboard" alt="Keyboard">
                        <div class="card-body">
                            <h5 class="card-title">Keyboard</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#computerPartsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#computerPartsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</body>
</html>
