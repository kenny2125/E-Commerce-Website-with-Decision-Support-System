// Load data from localStorage on page load
window.onload = function() {
    loadProfileData();
};

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
    alert('Profile data saved!');
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