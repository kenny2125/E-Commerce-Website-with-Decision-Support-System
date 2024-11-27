<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Log In</h5>
            </div>
            <div class="modal-body">
                <div class="form-box">
                    <img src="assets/images/logo.png" alt="RPC Computer Store">
                    <form action="register.php" method="post">
                        <div class="input-group">
                            <label for="username">USERNAME</label>
                            <input type="text" id="username" placeholder="eg.jeondanel" name="username">
                        </div>
                        <div class="input-group">
                            <label for="password">PASSWORD</label>
                            <input type="password" placeholder="••••••••" id="password" name="password">
                        </div>
                        <p>Don't have an account? 
                            <a href="#" class="create-account" data-toggle="modal" data-target="#registrationModal" data-dismiss="modal">Create Account</a>
                        </p>
                        <button class="button" name="logIn">LOG IN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>