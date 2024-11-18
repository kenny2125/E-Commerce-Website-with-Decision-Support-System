<?php
include 'db_config.php';
include 'Payment.php';

$paymentManager = new Payment($conn);

// Testing Add Payment
if ($paymentManager->addPayment(1, '2024-11-12', 150.00, 'Credit Card', 'Completed')) {
    echo "Payment added successfully!<br>";
} else {
    echo "Failed to add payment.<br>";
}

// Testing Update Payment
if ($paymentManager->updatePayment(1, 1, '2024-11-12', 200.00, 'PayPal', 'Pending')) {
    echo "Payment updated successfully!<br>";
} else {
    echo "Failed to update payment.<br>";
}

// Testing view payment by ID
$payment = $paymentManager->getPaymentById(1);
echo "<pre>";
print_r($payment);
echo "</pre>";

// Testing view all payments
$allPayments = $paymentManager->getAllPayments();
echo "<pre>";
print_r($allPayments);
echo "</pre>";

// Testing Delete Payment
if ($paymentManager->deletePayment(1)) {
    echo "Payment deleted successfully!<br>";
} else {
    echo "Failed to delete payment.<br>";
}
?>
