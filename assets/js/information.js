document.addEventListener('DOMContentLoaded', function() {
    const profileContent = document.getElementById('profileContent');
    const orderHistoryContent = document.getElementById('orderHistoryContent');
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    
    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            if (item.id === 'myProfile') {
                profileContent.style.display = 'block';
                orderHistoryContent.style.display = 'none';
            } else if (item.id === 'orderHistory') {
                profileContent.style.display = 'none';
                orderHistoryContent.style.display = 'block';
            }
            
            sidebarItems.forEach(sideItem => {
                sideItem.classList.remove('active');
            });
            item.classList.add('active');
        });
    });
    
    // Initially show My Profile by default
    profileContent.style.display = 'block';
    orderHistoryContent.style.display = 'none';
});