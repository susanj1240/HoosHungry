

/*Login Validation
    - if the entered email or password is empty --> alerts the user
*/
function validate() {
    var email = document.forms["loginForm"]["email"];
    var password = document.forms["loginForm"]["password"];

    if (email.value == "") {
        window.alert("Please enter your Email.");
        return false;
    }
    if (password.value == "") {
        window.alert("Please enter your password.")
        return false;
    }


}

/* success function
    - redirects the user to dummyHome.html when successfully login
    - dummy email: ab@virginia.edu
    - dummy password: 12345678
 */
function success() {
    var email = document.forms["loginForm"]["email"];
    var password = document.forms["loginForm"]["password"];

    if (email.value == "ab@virginia.edu" && password.value == "12345678") {
        console.log("?");
        window.location.href = "dummyHome.html";
    } else {
        window.alert("Username or password is incorrect");
    }
}


/* Search Function
    - if the user types in keyword and press enter --> shows the filtered result
 */

//hard coded the restaurant list for now
var restaurants = ["mod pizza", "milan", "roots", "doma"];


function search() {


    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById('userInput').value;
    filter = input.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName('li');

if(input != ""){
     // Loop through all list items, and hide those who don't match the search query
     for (i = 0; i < li.length; i++) {
        console.log(input);
        // console.log(li[i].getAttribute('id'));
        if (input == li[i].getAttribute('id')) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
    return true;
} else{
    for (i = 0; i < li.length; i++) {
        // console.log(input);
        // console.log(li[i].getAttribute('id'));
       
        li[i].style.display = "";
    }
    return true;

}
   


}