document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('welcomeModal'), {
        backdrop: 'true',  // Prevent closing by clicking outside
        keyboard: true       // Allow ESC key to close modal
    });

    // Display the modal
    myModal.show();

    // Add event listener to close button in case manual JavaScript is required
    var closeButton = document.querySelector('.btn-close');
    if (closeButton) {
        closeButton.addEventListener('click', function () {
            myModal.hide(); // Manually hide the modal
        });
    }

    // Ensure footer close button also triggers modal close
    var footerCloseButton = document.querySelector('.modal-footer .btn-secondary');
    if (footerCloseButton) {
        footerCloseButton.addEventListener('click', function () {
            myModal.hide(); // Manually hide the modal
        });
    }
});
