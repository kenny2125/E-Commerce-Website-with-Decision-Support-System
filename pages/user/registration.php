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
                        <form action="/IS104-E-Commerce/pages/user/register.php" method="post">
                            <div class="row">
                                <div class="input-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" id="firstName" placeholder="eg. Danel" name="firstName" required>
                                </div>
                                <div class="input-group">
                                    <label for="middleInitial">M.I</label>
                                    <input type="text" id="middleInitial" placeholder="eg. T." name="middleInitial">
                                </div>
                                <div class="input-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" id="lastName" placeholder="eg. Oandasan" name="lastName" required>
                                </div>
                                <div class="input-group">
                                    <label for="gender">Gender</label>
                                    <input type="text" id="gender" placeholder="eg. Female" name="gender">
                                </div>
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
                                <div class="input-group">
                                    <label for="contactNumber">Age</label>
                                    <input type="text" id="age" placeholder="eg. 18" name="age" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" placeholder="eg. jeondanel" name="username" required>
                            </div>
                            <!-- Password Field -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control" placeholder="Enter password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                <div id="passwordFeedback" class="form-text text-danger"></div>
                            </div>
                            <!-- Confirm Password Field -->
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" name="confirmPassword" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                <div id="confirmPasswordFeedback" class="form-text text-danger"></div>
                            </div>
                            <!-- Terms and Conditions -->
                            <div class="terms">
                                <input type="checkbox" name="terms" required/> Agree to <a href="#">Terms and Conditions</a>
                            </div>
                            <button type="submit" name="signUp" class="btn btn-primary mt-3">SIGN UP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this script at the end of your HTML -->
<script>
    // Toggle password visibility
    document.querySelectorAll('button[id^="togglePassword"]').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    });
</script>
