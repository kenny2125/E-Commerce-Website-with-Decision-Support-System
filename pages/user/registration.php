<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Create an Account</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-box">                   
                    <p>Already have an account? 
                            <a href="#" class="create-account" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Log In</a>
                        </p>
                        <form action="register.php" method="post">
                            <div class="row">
                                <div class="input-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" id="firstName" placeholder="eg. Danel" name="firstName" required>
                                </div>
                                <div class="input-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" id="lastName" placeholder="eg. Oandasan" name="lastName" required>
                                </div>
                                <div class="input-group">
                                    <label for="middleInitial">M.I</label>
                                    <input type="text" id="middleInitial" placeholder="eg. T." name="middleInitial">
                                </div>
                                <div class="input-group">
                                    <label for="gender">Gender</label>
                                    <input type="text" id="gender" placeholder="eg. Female" name="gender">
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" placeholder="eg. jeondanel" name="username" required>
                            </div>
                            <div class="input-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" placeholder="eg. BLK 5 LOT 6 SAMMAR 1 HOA Luzon Ave. Old Balara, Quezon City" name="address" required>
                            </div>
                            <div class="row">
                                <div class="input-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" placeholder="eg. danel@gmail.com" name="email" required>
                                </div>
                                <div class="input-group">
                                    <label for="contactNumber">Contact Number</label>
                                    <input type="text" id="contactNumber" placeholder="eg. 09123456789" name="contactNumber" required>
                                </div>
                            </div>
                            <div class="password-container input-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" placeholder="••••••••" name="password" required>
                                <img src="../assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon1" style="cursor: pointer;">
                                <div id="passwordFeedback" class="feedback"></div>
                            </div>
                            <div class="confirmpassword-container input-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" id="confirmPassword" placeholder="••••••••" name="confirmPassword" required>
                                <img src="../assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon2" style="cursor: pointer;">
                                <div id="confirmPasswordFeedback" class="feedback"></div>
                            </div>
                            <div class="terms">
                                <input type="checkbox" name="terms" required/>Agree on <a href="#">Terms and Conditions</a>
                            </div>
                            <button type="submit" name="signUp">SIGN UP</button>
                        </form>
                    </div>
                </div>
                    <script src="../../assets/js/registration.js"></script>
            </div>
        </div>
    </div>
</div>

<style>
    /* General Modal Styling */
.modal-content {
    border-radius: 8px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.modal-header {
    border-bottom: none;
    text-align: center;
}

.modal-header .modal-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    text-align: center;
}

/* Login Form Styling */
.form-box {
    text-align: center;
}

.form-box img {
    max-width: 100px;
    margin-bottom: 15px;
}

.input-group {
    margin-bottom: 15px;
    text-align: left;
}

.input-group label {
    font-size: 0.9rem;
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    text-transform: uppercase;
    color: #333;
}

.input-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 0.9rem;
}

.input-group input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 3px rgba(0, 123, 255, 0.5);
}

/* Button Styling */
button.button {
    width: 100%;
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button.button:hover {
    background-color: #0056b3;
}

/* Create Account Link */
.create-account {
    color: #007bff;
    text-decoration: none;
    font-size: 0.9rem;
}

.create-account:hover {
    text-decoration: underline;
}

/* Center the "Don't have an account?" text */
p {
    font-size: 0.9rem;
    margin: 15px 0;
    color: #333;
    text-align: center;
}

</style>