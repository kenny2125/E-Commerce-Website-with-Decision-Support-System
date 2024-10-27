
// Initial state for edit mode
let isEditing = false;

// Load data from localStorage on page load
window.onload = function() {
    loadProfileData();
};

function toggleEdit() {
    const fields = document.querySelectorAll('.value');
    const editIcon = document.querySelector('.edit-icon');
    const birthdateDisplay = document.getElementById('birthdateDisplay');
    const birthdateInput = document.getElementById('birthdateInput');

    // Toggle editing mode
    isEditing = !isEditing;

    fields.forEach(field => {
        field.contentEditable = isEditing;
        field.style.backgroundColor = isEditing ? "#f9f9f9" : "#fff";
        field.style.border = isEditing ? "1px solid #666" : "1px solid #ccc";
    });

    if (isEditing) {
        // Show the date picker and hide the display
        birthdateInput.style.display = "block";
        birthdateDisplay.style.display = "none";
        birthdateInput.value = formatDateToInput(birthdateDisplay.textContent);
    } else {
        // Hide the date picker and show the display
        birthdateInput.style.display = "none";
        birthdateDisplay.style.display = "block";
        saveProfileData(); // Save data to localStorage
    }

    editIcon.textContent = isEditing ? '💾' : '✏️';
}

// Save profile data to localStorage
function saveProfileData() {
    const firstName = document.getElementById('firstName').textContent;
    const lastName = document.getElementById('lastName').textContent;
    const email = document.getElementById('email').textContent;
    const birthdate = document.getElementById('birthdateDisplay').textContent;
    const address = document.getElementById('address').textContent;
    const phoneNumber = document.getElementById('phoneNumber').textContent;

    const profileData = {
        firstName,
        lastName,
        email,
        birthdate,
        address,
        phoneNumber
    };

    localStorage.setItem('profileData', JSON.stringify(profileData));
}

// Load profile data from localStorage
function loadProfileData() {
    const savedData = localStorage.getItem('profileData');

    if (savedData) {
        const profileData = JSON.parse(savedData);

        document.getElementById('firstName').textContent = profileData.firstName;
        document.getElementById('lastName').textContent = profileData.lastName;
        document.getElementById('email').textContent = profileData.email;
        document.getElementById('birthdateDisplay').textContent = profileData.birthdate;
        document.getElementById('address').textContent = profileData.address;
        document.getElementById('phoneNumber').textContent = profileData.phoneNumber;
    }
}

// Format display date to "YYYY-MM-DD" for date input
function formatDateToInput(dateString) {
    const [day, month, year] = dateString.split('-');
    return `${year}-${month}-${day}`;
}

// Update birthdate display when a date is selected
function updateBirthdate() {
    const birthdateInput = document.getElementById('birthdateInput');
    const birthdateDisplay = document.getElementById('birthdateDisplay');

    const selectedDate = new Date(birthdateInput.value);
    const formattedDate = selectedDate.toLocaleDateString('en-GB');
    birthdateDisplay.textContent = formattedDate.replace(/\//g, '-');
}