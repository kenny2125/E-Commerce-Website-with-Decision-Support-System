<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webhook Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Order Confirmation</h1>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Successfully paid. Please wait for the confirmation of your order.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Check webhook status every 5 seconds
        setInterval(function() {
            $.ajax({
                url: 'check_status.php', // Endpoint to check status
                method: 'GET',
                success: function(response) {
                    if (response.trim() === 'paid') {
                        // Show the modal
                        let modal = new bootstrap.Modal(document.getElementById('paymentModal'));
                        modal.show();

                        // Optionally reset the status
                        $.ajax({ url: 'reset_status.php', method: 'POST' });
                    }
                }
            });
        }, 200);
    </script>
</body>
</html>
