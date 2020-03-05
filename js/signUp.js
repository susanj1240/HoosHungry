/* Author: Emily Lin */

// Disable the submit button when the form is empty 
var btn = document.getElementById("btn-submit");
btn.disabled = true;

// Validate Email
function validateEmail() {
    var msg = document.getElementById("email-msg");

    // Regular expression source: https://stackoverflow.com/questions/46155/how-to-validate-an-email-address-in-javascript
    var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;;
    var emailInput = document.getElementById("signUpEmail").value;
    if (regex.test(emailInput)) {
        msg.textContent = "";
    } else {
        msg.textContent = "Please enter a valid email (for example, mst3k@virginia.edu).";
    }
}
// Add validate email event listener 
var theEmail = document.getElementById("signUpEmail");
theEmail.addEventListener('blur', validateEmail, false);

// Check password length
function passwordLength() {
    var msg = document.getElementById("length-msg");
    var pwd = document.getElementById("signUpPassword").value;
    if (pwd.length >= 8) {
        msg.textContent = "";
    } else {
        msg.textContent = "Password must be 8 characters or longer.";
    }
}
// Add check password length listener
var pwdToCheck = document.getElementById("signUpPassword");
pwdToCheck.addEventListener('input', passwordLength, false);

// Check Password Match
function checkPassword() {
    var pwd1 = document.getElementById("signUpPassword").value;
    var pwd2 = document.getElementById("confirmPassword").value;
    var msg = document.getElementById("pwd-msg");
    if (pwd1 == pwd2) {
        msg.textContent = "";
        // enable the button when the passwords match 
        btn.disabled = false;
    } else {
        msg.textContent = "Passwords do not match.";
        // disable the button when the passwords do not match 
        btn.disabled = true;
    }
}
// Add check password match event listener
var thePwd = document.getElementById("confirmPassword");
thePwd.addEventListener('input', checkPassword, false);
// 'input' event: https://www.w3schools.com/jsref/dom_obj_event.asp

// Validate entire form (when the user presses the submit button)
function submitForm() {
    var field1 = document.getElementById("signUpEmail").value;
    var field2 = document.getElementById("signUpPassword").value;
    var field3 = document.getElementById("confirmPassword").value;
    if (field1 != "" && field2 != "" && field3 != "") {
        return true;
    } else {
        return false;
    }
}
