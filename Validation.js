
document.querySelector('.logInForm').addEventListener('submit', function (event) {
    let username = document.getElementById('username').value.trim();
    let password = document.getElementById('password').value.trim();
    let errors = [];

    if (username === "") {
        errors.push("Username cannot be empty.");
    }
    if (password === "") {
        errors.push("Password cannot be empty.");
    }
    if (errors.length > 0) {
        event.preventDefault(); 
        alert(errors.join("\n"));
    } else {
        alert("Login successful!");
    }
});

document.querySelector('form[action="#"]').addEventListener('submit', function (event) {
    let fullname = document.getElementById('fullname').value.trim();
    let email = document.getElementById('email').value.trim();
    let username = document.getElementById('username').value.trim();
    let password = document.getElementById('password').value.trim();
    let confirmPassword = document.getElementById('confirm_password').value.trim();
    let errors = [];


    if (fullname === "" || fullname.length < 2) {
        errors.push("Fullname must be at least 2 characters.");
    }


    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errors.push("Invalid email format.");
    }

    if (username.length < 3) {
        errors.push("Username must be at least 3 characters.");
    }

    if (password.length < 8) {
        errors.push("Password must be at least 8 characters.");
    }
    if (password !== confirmPassword) {
        errors.push("Passwords do not match.");
    }

    if (errors.length > 0) {
        event.preventDefault(); 
        alert(errors.join("\n"));
    } else {
        alert("Registration successful!");
    }
});
