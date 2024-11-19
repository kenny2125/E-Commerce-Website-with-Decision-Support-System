<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <link rel="stylesheet" href="../../assets/css/userinformation.css">
</head>
<body>
    <div class="profile-card">
        <h2>my profile <span class="edit-icon" onclick="toggleEdit()">✏️</span></h2>
        
        <div class="flex-container">
            <div class="field">
                <label>First Name</label>
                <div class="value" contenteditable="false" id="firstName"></div>
            </div>
            <div class="field">
                <label>Last Name</label>
                <div class="value" contenteditable="false" id="lastName"></div>
            </div>
        </div>
        
        <div class="field">
            <label>Email Address</label>
            <div class="value" contenteditable="false" id="email"></div>
        </div>
        
        <div class="flex-container">
            <div class="field">
                <label>Birthdate</label>
                <div class="value" contenteditable="false" id="birthdateDisplay"></div>
                <input type="date" id="birthdateInput" style="display: none;" onchange="updateBirthdate()">
            </div>
            <div class="field">
                <label>Shipping Address</label>
                <div class="value" contenteditable="false" id="address"></div>
            </div>
        </div>
        
        <div class="field">
            <label>Phone Number</label>
            <div class="value" contenteditable="false" id="phoneNumber"></div>
        </div>
    </div>
    <script src="userInformation.js"></script>
</body>
</html>