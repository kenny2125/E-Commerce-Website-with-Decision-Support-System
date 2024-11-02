document.addEventListener('DOMContentLoaded', () => {
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirmPassword');
    const passwordFeedback = document.getElementById('passwordFeedback');
    const confirmPasswordFeedback = document.getElementById('confirmPasswordFeedback');
    const togglePasswordIcon1 = document.getElementById('togglePasswordIcon1');
    const togglePasswordIcon2 = document.getElementById('togglePasswordIcon2');

    let requirements = [];

    togglePasswordIcon1.addEventListener('click', () => {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            togglePasswordIcon1.src = '/assets/images/view.png'; 
        } else {
            passwordField.type = 'password';
            togglePasswordIcon1.src = '/assets/images/closed.png'; 
        }
    });

    togglePasswordIcon2.addEventListener('click', () => {
        if (confirmPasswordField.type === 'password') {
            confirmPasswordField.type = 'text';
            togglePasswordIcon2.src = '/assets/images/view.png'; 
        } else {
            confirmPasswordField.type = 'password';
            togglePasswordIcon2.src = '/assets/images/closed.png'; 
        }
    }); 

    passwordField.addEventListener('input', () => {
        const password = passwordField.value;
        requirements = [
            /[A-Z]/.test(password), 
            /[a-z]/.test(password), 
            /[0-9]/.test(password), 
            /[`~!@#$%^&*()\-_=+{};:'",<.>|\\[\]\/?]/.test(password)
        ];
        
        passwordFeedback.textContent = requirements.filter(Boolean).length === 4 
            ? 'Password meets all requirements!' 
            : 'Password must include uppercase, lowercase, number, and special character.';
        passwordFeedback.style.color = requirements.filter(Boolean).length === 4 ? 'green' : 'red';
    });
    
    document.querySelector('form').addEventListener('submit', (e) => {
        e.preventDefault();
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;

        if (password !== confirmPassword) {
            confirmPasswordFeedback.textContent = 'Password do not match!';
            confirmPasswordFeedback.style.color = 'red';
            return;
        } else {
            confirmPasswordFeedback.textContent = 'Password match!';
            confirmPasswordFeedback.style.color = 'green';
        }

        if (requirements.filter(Boolean).length !== 4) {
            alert('Password does not meet the requirements!');
            return;
        }

        alert('Registration successful!');
    });

    passwordField.addEventListener('input', () => {
        const fakePassword = passwordField.value.split('').map(() => Math.floor(Math.random() * 10)).join('');
        passwordField.setAttribute('data-fake-password', fakePassword);
    });
});