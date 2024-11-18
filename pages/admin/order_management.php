<?php
include 'db_config.php';
include 'Order.php';

$orderManager = new Order($conn);

// Testing Add Order
if ($orderManager->addOrder(1, 2, 3, 299.99, '2024-11-12', 'Pending')) {
    echo "Order added successfully!<br>";
} else {
    echo "Failed to add order.<br>";
}

// Testing Update Order
if ($orderManager->updateOrder(1, 1, 2, 5, 499.99, '2024-11-12', 'Shipped')) {
    echo "Order updated successfully!<br>";
} else {
    echo "Failed to update order.<br>";
}

// Testing view order by ID
$order = $orderManager->getOrderById(1);
echo "<pre>";
print_r($order);
echo "</pre>";

// Testing view all orders
$allOrders = $orderManager->getAllOrders();
echo "<pre>";
print_r($allOrders);
echo "</pre>";

// Testing Delete Order
if ($orderManager->deleteOrder(1)) {
    echo "Order deleted successfully!<br>";
} else {
    echo "Failed to delete order.<br>";
}
?>
