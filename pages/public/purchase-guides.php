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
            <img src="/assets/images/BANNERS (3).png" alt="Logo" class="logo" style="width: 95%;">>
        
    <h1 class="purchasing-guide" style="margin-top: 20px; margin-left: 65px;"><img src="/assets/images/Group 344.png" alt="Cart Icon" style="margin-right:10px;">Purchasing Guide</h1>

    <div class="welcome-to-our" style="text-align: justify; margin-bottom: 40px; margin-left: 190px; margin-right: 170px; font-size: 20px;">
      Welcome to our Purchasing Guide! This page is designed to make your shopping experience as easy and enjoyable as possible. Whether you're a new customer or a returning one looking for a quick refresher, we’re here to guide you through every step of the buying process. In this guide, you'll find helpful information on how to navigate our website, select products, and complete your purchase with confidence. Our goal is to ensure a smooth, straightforward shopping journey from start to finish. Let’s get started!
    </div>

    <!-- Step Sections -->
    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 1: Determine Your Needs
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">When buying a new computer or tech equipment, start by assessing your specific needs. Are you purchasing for basic home use like browsing the internet and light document editing, or do you need a more powerful system for gaming, video editing, or programming? Different uses require different hardware capabilities.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">If you're a gamer, for instance, you'll need a system with a powerful GPU and fast refresh rates, whereas a graphic designer might prioritize color accuracy and screen quality. If you're working in an office environment, portability and battery life might take precedence. Keep in mind that determining your needs early will help you narrow down your options and avoid overspending on features you don’t really need.</p>
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 2: Set a Budget
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Setting a budget is crucial. This will help you focus on products within your range and might influence the specifications you can realistically afford. Remember to consider long-term costs, such as potential upgrades, additional peripherals, and extended warranties that could extend the lifespan of your device.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Additionally, consider the overall cost of ownership. Some products may seem affordable upfront, but they might require costly upgrades or additional peripherals down the line. It's wise to think ahead and anticipate future needs, such as buying additional storage, software, or even warranties that could extend the lifespan of your device.</p>
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 3: Choose the Right Specifications
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Selecting appropriate specifications ensures your device meets your performance expectations. Here are the main components to consider the Processor (CPU), Memory (RAM), and the Storage. You may be able to upgrade RAM and storage later, so don’t feel pressured to max out these specs from the beginning.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Storage is another key factor to consider. An SSD (Solid State Drive) is faster and more reliable than a traditional HDD (Hard Disk Drive), but it tends to be more expensive. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. SSDs are ideal if speed and performance are important to you, whereas HDDs are better suited for bulk storage at a lower price. When choosing your specifications, remember that it’s often easier to upgrade certain components later, such as RAM or storage, so it's not always necessary to max out your configuration from the start.</p>   
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 4: Compare Products
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">After narrowing your choices, compare the specifications and features of each product. Key factors to look for includes Performance look at specifications such as processor speed, graphics card performance, and RAM to understand how each device handles tasks, Display the resolution (e.g., Full HD, 4K), color accuracy, and brightness are important, particularly if you’ll be doing visual work like photo or video editing., Battery Life and Portability.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">By evaluating each of these factors, you can weigh the pros and cons of each model to find the best fit for your needs and budget. Customer and expert reviews are helpful resources to understand how well a product performs in real-world settings. Consider both positive and negative feedback for a balanced view.</p>  
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 5: Place Your Order
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Once you’re ready to purchase, add the item to your cart and proceed to checkout. In terms of shipping method choose between standard or express, depending on your urgency and in payment options it might include Paymongo, and Cash On Delivery. Before proceeding to checkout, verify that the correct item, model, and any additional options (such as specific configurations or accessories) are in your cart.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">After completing payment, you should receive an order confirmation email with details about your purchase, including tracking information. By following these steps, you’ll minimize errors during the purchasing process and ensure your order is accurate, secure, and on track for timely delivery.</p>
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 6: Monitor Shipping & Delivery
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Use the tracking details provided to keep an eye on your order’s progress. If any issues arise, like delays or incorrect information, contact customer service for assistance. You may also be able to arrange for pickup if you won’t be home at the time of delivery.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Be sure to monitor your tracking details, so you know when to expect your delivery. If any issues arise with your delivery, such as delays or incorrect information, our customer service team is always ready to assist you. We also offer the option to choose different delivery preferences, such as having the package held at a delivery center for pickup if you won’t be home at the time of delivery.</p>
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 7: Review Return Policy
      </div>
      <p style="text-align: justify; margin-bottom: 80px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Lastly, review the return policy in case you encounter any issues with your purchase. Most stores have specific conditions for returns and exchanges, often with a limited window for returning items. Understanding this policy upfront will help ensure you’re prepared if you need to make a return.</p>
    </div>
  </div>

  <?php
include '../../includes/footer.php';
?>
</body>
</html>