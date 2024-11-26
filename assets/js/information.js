// JavaScript functionality

// Helper function to save data to localStorage
function saveToLocalStorage() {
    const profileData = {
        firstName: document.getElementById('firstName').value,
        middleInitial: document.getElementById('middleInitial').value,
        lastName: document.getElementById('lastName').value,
        username: document.getElementById('username').value
    };

    localStorage.setItem('profileData', JSON.stringify(profileData));
}

// Load profile data from localStorage if available
function loadFromLocalStorage() {
    const savedProfileData = localStorage.getItem('profileData');
    if (savedProfileData) {
        const profileData = JSON.parse(savedProfileData);
        document.getElementById('firstName').value = profileData.firstName;
        document.getElementById('middleInitial').value = profileData.middleInitial;
        document.getElementById('lastName').value = profileData.lastName;
        document.getElementById('username').value = profileData.username;
    }
}

// Edit/Save button functionality
document.getElementById('editProfile').addEventListener('click', function() {
    const isEditing = this.getAttribute('data-editing') === 'true';
    const profileFields = ['firstName', 'middleInitial', 'lastName', 'username'];
    
    if (!isEditing) {
        // Enter editing mode
        profileFields.forEach(fieldId => {
            document.getElementById(fieldId).disabled = false; // Enable input fields
        });
        this.textContent = 'Save'; // Change button text to 'Save'
        this.setAttribute('data-editing', 'true'); // Set editing mode
    } else {
        // Save changes and exit editing mode
        profileFields.forEach(fieldId => {
            document.getElementById(fieldId).disabled = true; // Disable input fields
        });

        // Save the data to localStorage
        saveToLocalStorage();
        
        this.textContent = 'Edit Profile'; // Change button text back to 'Edit Profile'
        this.setAttribute('data-editing', 'false'); // Exit editing mode
        alert('Changes saved successfully!');
    }
});

// Change password functionality (not implemented here)
document.getElementById('changePassword').addEventListener('click', function() {
    alert('Change Password functionality is not yet implemented.');
});

// Logout functionality
document.getElementById('logoutButton').addEventListener('click', function() {
    if (confirm('Are you sure you want to log out?')) {
        alert('Logged out successfully!');
        window.location.href = 'login.html';
    }
});

// Sidebar toggle functionality
const sidebarItems = document.querySelectorAll('.sidebar-item');
const orderHistoryContent = document.getElementById('orderHistoryContent');
const profileContent = document.getElementById('profileContent');

// Hide order history by default
orderHistoryContent.style.display = 'none'; // Make sure it's hidden initially

sidebarItems.forEach(item => {
    item.addEventListener('click', function() {
        sidebarItems.forEach(i => i.classList.remove('active'));
        this.classList.add('active');
        
        // Toggle content display based on sidebar selection
        if (this.id === 'orderHistory') {
            profileContent.style.display = 'none';
            orderHistoryContent.style.display = 'block';
        } else if (this.id === 'myProfile') {
            orderHistoryContent.style.display = 'none';
            profileContent.style.display = 'block';
        }
    });
});

// Load data and button state on page load
window.addEventListener('load', function() {
    loadFromLocalStorage(); // Load profile data
    const editButton = document.getElementById('editProfile');
    const isEditing = editButton.getAttribute('data-editing') === 'true';

    if (isEditing) {
        const profileFields = ['firstName', 'middleInitial', 'lastName', 'username'];
        profileFields.forEach(fieldId => {
            document.getElementById(fieldId).disabled = false; // Enable input fields if in editing mode
        });
        editButton.textContent = 'Save'; // Change button text to 'Save'
    }
});