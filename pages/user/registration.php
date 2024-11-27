<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Create an Account</h5>
            </div>
            <div class="modal-body">
                <div class="form-box">
                    <img src="assets/images/logo.png" alt="RPC Computer Store Logo">
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
                        </div>
                        <div class="input-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" placeholder="eg. jeondanel" name="username" required>
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" placeholder="••••••••" name="password" required>
                        </div>
                        <div class="terms">
                            <input type="checkbox" name="terms" required/> Agree on <a href="#">Terms and Conditions</a>
                        </div>
                        <button type="submit" name="signUp">SIGN UP</button>
                        <p>Already have an account?
                        <a href="#" class="login" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>