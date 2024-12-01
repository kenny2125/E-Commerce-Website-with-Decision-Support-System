    // Function to change the form's target based on the selected payment method
    document.getElementById('payment-method').addEventListener('change', function() {
        var form = document.getElementById('checkout-form');
        var paymentMethod = this.value;
        var agreeLabel = document.getElementById('agree-label');
        
        if (paymentMethod === 'gcash' || paymentMethod === 'paymaya') {
            // If payment method is GCash or PayMaya, open the form in a new tab
            form.target = '_blank';
            agreeLabel.textContent = 'I agree to redirect to Paymongo Payment Gateway'; // Default text for Paymongo
        } else if (paymentMethod === 'cash_on_delivery') {
            // If payment method is Cash on Delivery, submit in the same tab
            form.target = '_self';  // Submit in the same window
            agreeLabel.textContent = 'I agree that my information is true and valid'; // Text for Cash on Delivery
        } else {
            // For other payment methods, default to submitting in the same tab
            form.target = '_self';
            agreeLabel.textContent = 'I agree to redirect to Paymongo Payment Gateway'; // Default text for Paymongo
        }
    });

    // Trigger change event on page load to ensure correct behavior
    document.getElementById('payment-method').dispatchEvent(new Event('change'));
