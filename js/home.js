

/*Login Validation
    - if the entered email or password is empty --> alerts the user
*/
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

/* success function
    - redirects the user to dummyHome.html when successfully login
    - dummy email: ab@virginia.edu
    - dummy password: 12345
 */
function success(){
    var email = document.forms["loginForm"]["email"]; 
    var password = document.forms["loginForm"]["password"];

    if(email.value == "ab@virginia.edu" && password.value == "12345"){
        console.log("?");
        window.location.href = "dummyHome.html";
    } else{
        window.alert("Username or password is incorrect");
    }
}


/* Search Function
    - if the user types in keyword and press enter --> shows the filtered result
 */

//hard coded the restaurant list for now
var restaurants = ["mod pizza", "milan", "roots","doma"];

function search(e){
    if (e.keyCode == 13) {
        var userInput = document.getElementById("userInput").value;
        userInput = userInput.toString().toLowerCase();

        console.log(userInput);

        for (var i = 0; i < restaurants.length; i++) {
            if(restaurants[i] == userInput){
                var show = document.getElementById(restaurants[i]);
                show.style.display = "block";

                $(show).insertAfter("first elem");

            } else{
                var hide = document.getElementById(restaurants[i]);
                hide.style.display = "none";
            }
        }       
        return true;
    }
}