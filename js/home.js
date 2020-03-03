
function validate(){
    var email = document.forms["loginForm"]["email"]; 
    var password = document.forms["loginForm"]["password"];

    if(email.value == ""){
        window.alert("Please enter your Email."); 
        return false;
    } 
    if(password.value == ""){
        window.alert("Please enter your password.")
        return false;
    }

}

function search(){
    window.alert("searched");
}