document.addEventListener('DOMContentLoaded', function() {
    const orderHistoryBtn = document.getElementById('order-history-btn');
    const profileBtn = document.getElementById('my-profile-btn');
    const orderHistorySection = document.getElementById('order-history-section');
    const profileSection = document.getElementById('profile-section');

    // Show Order History by default
    orderHistorySection.classList.add('active');

    orderHistoryBtn.addEventListener('click', function() {
        orderHistorySection.classList.add('active');
        profileSection.classList.remove('active');
    });

    profileBtn.addEventListener('click', function() {
        profileSection.classList.add('active');
        orderHistorySection.classList.remove('active');
    });
});