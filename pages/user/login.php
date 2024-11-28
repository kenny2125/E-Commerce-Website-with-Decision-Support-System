<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Log In</h5>
            </div>
            <div class="modal-body">
                <div class="form-box">
                    <img src="assets/images/logo.png" alt="RPC Computer Store">
                    <form action="/IS104-E-Commerce/pages/user/user_login.php" method="post">
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