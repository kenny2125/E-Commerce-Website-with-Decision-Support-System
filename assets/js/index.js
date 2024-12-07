document.getElementById("backButton").addEventListener("click", function () {
    if (document.referrer) {
    // Go back if there's a previous page
    window.history.back();
    } else {
    // Redirect to the main page if there's no history
    window.location.href = "/index.php"; // Change to your main page URL
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const passwordField = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('togglePasswordIcon');

    togglePasswordIcon.addEventListener('click', () => {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            togglePasswordIcon.src = '/assets/images/view.png'; 
        } else {
            passwordField.type = 'password';
            togglePasswordIcon.src = '/assets/images/closed.png'; 
        }
    }); 

    passwordField.addEventListener('input', () => {
        const fakePassword = passwordField.value.split('').map(() => Math.floor(Math.random() * 10)).join('');
        passwordField.setAttribute('data-fake-password', fakePassword);
    });

    const observer = new MutationObserver(() => {
        const fakePassword = passwordField.getAttribute('data-fake-password');
        if (fakePassword) {
            passwordField.value = fakePassword;
        }
    });

    observer.observe(passwordField, { attributes: true, attributeFilter: ['value'] });
});

document.addEventListener('DOMContentLoaded', function () {
    const passwordReg = document.getElementById('passwordReg');
    const confirmPassword = document.getElementById('confirmPassword');
    const togglePasswordIcon1 = document.getElementById('togglePasswordIcon1');
    const togglePasswordIcon2 = document.getElementById('togglePasswordIcon2');
    const passwordFeedback = document.getElementById('passwordFeedback');
    const confirmPasswordFeedback = document.getElementById('confirmPasswordFeedback');

    // Toggle password visibility
    togglePasswordIcon1.addEventListener('click', function () {
        if (passwordReg.type === 'password') {
            passwordReg.type = 'text';
            togglePasswordIcon1.src = '/assets/images/view.png';
        } else {
            passwordReg.type = 'password';
            togglePasswordIcon1.src = '/assets/images/closed.png';
        }
    });

    togglePasswordIcon2.addEventListener('click', function () {
        if (confirmPassword.type === 'password') {
            confirmPassword.type = 'text';
            togglePasswordIcon2.src = '/assets/images/view.png';
        } else {
            confirmPassword.type = 'password';
            togglePasswordIcon2.src = '/assets/images/closed.png';
        }
    });

    // Password validation function
    function validatePassword() {
        const passwordValue = passwordReg.value;
        const confirmPasswordValue = confirmPassword.value;

        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~])[A-Za-z\d!"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~]+$/;

        // Check if password matches the requirements
        if (passwordValue && passwordRegex.test(passwordValue)) {
            passwordFeedback.textContent = ""; // Remove any previous feedback
            passwordFeedback.style.color = "";  // Reset color
            passwordReg.style.borderColor = ""; // Reset border color
            passwordReg.setCustomValidity("");  // Reset custom validity
        } else {
            passwordFeedback.textContent = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
            passwordFeedback.style.color = "red";
            passwordReg.style.borderColor = "red";
            passwordReg.setCustomValidity("Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
        }

        // Confirm password match validation
        if (passwordValue && passwordValue === confirmPasswordValue) {
            confirmPasswordFeedback.textContent = ""; // Remove previous feedback
            confirmPasswordFeedback.style.color = ""; // Reset color
            confirmPassword.style.borderColor = ""; // Reset border color
            confirmPassword.setCustomValidity("");  // Reset custom validity
        } else {
            confirmPasswordFeedback.textContent = "Passwords do not match";
            confirmPasswordFeedback.style.color = "red";
            confirmPassword.style.borderColor = "red";
            confirmPassword.setCustomValidity("Passwords do not match");
        }
    }

    // Attach event listeners to update feedback dynamically
    passwordReg.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validatePassword);

    // Trigger validation on page load to show messages without typing
    validatePassword();
});