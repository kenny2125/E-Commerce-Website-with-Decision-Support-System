

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
<?php
include '../../includes/header.php';
include '../../config/db_config.php';
?>

<div class="container">
        <!-- Back button -->
        <div class="back" id="backButton" style="margin-top: 30px; right: 20px; margin-bottom: 30px; font-size: 23px; color: #A9A9A9; margin-left: 1790px;">
            <a href="/index.php" style="text-decoration: none; color: inherit;">Back</a>
        </div>
          <img src="/assets/images/BANNERS (1).png" alt="Logo" class="logo" style="width: 95%;">
                      
    <h1 class="frequently-asked-questions" style="margin-top: 20px; margin-left: 65px;"><img src="/assets/images/Group 345.png" alt="Question Icon" style="margin-right:10px;">Frequently Asked Questions (FAQ)</h1>
    <div class="our-frequently-asked" style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 80px; font-size: 23px;">Our Frequently Asked Questions (FAQ) section provides quick answers to common inquiries about our services, policies, and support. From understanding our offerings to details on shipping, payment options, and return policies, this section is designed to help you find the information you need easily and efficiently.</div>
    
    <!-- General Questions Section -->
    <div class="general-questions-q-container"> 
      <p class="general-questions" style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;"> General Questions</p>
      
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: What is your company's mission?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Our mission is to provide high-quality products and excellent customer service to help meet your technology needs. We’re committed to innovation, value, and reliability.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;" >Q: How can I contact customer support? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: You can reach customer support via email at rpctechcomputers@gmail.com or by calling our number, 0912345678910.</p>

      <!-- Repeat structure for each FAQ section below -->
      
      <p class="general-questions" style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;" >Product Specifications</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;"> Q: How much RAM is recommended for general use? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;"> A: For most general users, 8GB of RAM is sufficient for browsing, document editing, and media consumption. For gaming or professional tasks, we recommend 16GB or more for optimal performance.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: SSD vs. HDD – What’s the difference?  </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: SSDs (Solid State Drives) offer faster data access, quicker boot times, and better performance, making them ideal for most users. HDDs (Hard Disk Drives) are more affordable and provide larger storage capacity, making them suitable for extensive data storage on a budget.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Which processor is best for gaming or professional tasks?  </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: For gaming, an Intel Core i7 or AMD Ryzen 7 processor is typically ideal. For professional tasks like video editing or 3D rendering, a more powerful processor, such as Intel Core i9 or AMD Ryzen 9, is recommended.</p>

      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Ordering & Payments</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: What payment methods do you accept? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: We accept Paymongo, Cash on Delivery, and In-store payment.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Can I cancel or modify my order after it’s placed?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Yes, you can cancel or modify your order within 24 hours of placing it. Please contact our customer service team at rpctechcomputers@gmail.com for assistance.</p>
      
      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Shipping & Delivery</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: How long does standard shipping take? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Standard shipping usually takes 3-5 business days, while express shipping options are available and typically take 1-2 business days.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Will I be able to track my order?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Yes, once your order ships, you’ll receive an email with a tracking number. You can use this number to check the status of your shipment.</p>

      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Returns & Refunds</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: What is your return policy? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: We offer a 30-day return policy on all products. Items must be in their original condition and packaging. For more details, please contact support.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: How long does it take to process a refund?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Refunds are typically processed within 7-10 business days after we receive the returned item.</p>

      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Technical Support</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: How can I contact technical support for help with my device? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: For technical support, email us at rpctechcomputers@gmail.com or call 0912345678910. Our support team is available Monday through Friday, 9 AM to 6 PM (EST).</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Are desktops easier to upgrade than laptops?  </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Yes, desktops generally offer more flexibility for upgrades, allowing you to easily replace components like the processor, graphics card, and memory. Laptop upgrades are usually limited to RAM and storage.</p>

      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Warranty & Support</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Do your products come with a warranty? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Yes, all computers come with a standard 1-year manufacturer’s warranty. Extended warranty options are also available at checkout for added coverage.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: How can I reach the technical support team?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; margin-bottom: 80px; font-size: 20px;">A: You can reach our technical support team via email at rpctechcomputers@gmail.com or by calling 0912345678910. We’re available Monday through Friday, from 9 AM to 6 PM (EST).</p>
    </div>
</div>

<?php
include '../../includes/footer.php';
?>
</body>
</html>