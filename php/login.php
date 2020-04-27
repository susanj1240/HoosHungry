
<?php
//Author: Susan Jang
//Home page with login form

    require("connect-db.php");
    // require("../html/home.html");

    //initialize session
    session_start();

    //if logged in--> go to loggedIn page
    // if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    //     header("location:loggedIn.php");
    //     die();
    // }

    global $db;

    //initialize variables
    $username = "";
    $password = "";
    $username_err ="";
    $password_err="";


    //login codes referece": https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
    //https://www.tutorialspoint.com/php/php_mysql_login.htm
    function loginValidate(){
        
    }
    if(isset($_POST["submit"])){
    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //username 
        if(empty(trim($_POST["email"]))){
            $username_err = "Please enter username.";  
        }else{
            $username = trim($_POST["email"]);
        }

        //password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

        //if username & password not empty check in database
        //reference: https://makitweb.com/create-simple-login-page-with-php-and-mysql/
        if(!empty(trim($_POST["email"])) && !empty(trim($_POST["password"]))){

            // $hash_pwd = password_hash($password, PASSWORD_BCRYPT); 
            $query = "select email from loginInfo where email='".$username."' and pwdHash='".$password."'";
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();  
            $statement->closeCursor();
            
            
            //if the username and password is correct
            if(count($results) == 1){

                $_SESSION['username'] = $username;
                $_SESSION["loggedin"] = true;
                // header("location: ../php/loggedIn.php");
                
            }else{//if the username or password is incorrect
                $username_err = "Username or Password is incorrect";  
            }

        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Sooyun Jang (sj7yj)">
    <meta name="description" content="The home page for HoosHungry">
    <title>Home Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <!-- css  -->
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <!-- google icon  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</head>

<body>
    <!-- Redriectiong the page for profile button -->
    <script>
        function goToProfile(){
            window.location.href = "../php/profile.php";
        }

        //reference: https://www.geeksforgeeks.org/how-to-pass-javascript-variables-to-php/
        // Creating a cookie after the document is ready 
        $(document).ready(function () { 
            createCookie("gfg", "GeeksforGeeks", "10"); 
        }); 
        
        window.onclick = e => {
            console.log(e.target.id);
            
            createCookie("gfg", e.target.id, "10"); 
            // var clicked = e.target.id;
        }

        // Function to create the cookie 
        function createCookie(name, value, days) { 
            var expires; 
            
            if (days) { 
                var date = new Date(); 
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); 
                expires = "; expires=" + date.toGMTString(); 
            } 
            else { 
                expires = ""; 
            } 
            
            document.cookie = escape(name) + "=" +  
                escape(value) + expires + "; path=/"; 
        } 


    </script>

    <div class="part1" >
        <div class="d-flex flex-row">

            <!-- Logo -->
            <div class="p-2">
                <img class= "Logo" src="../img/Logo.png">
            </div>

            <!-- login form -->
            <?php 
            if (count($_COOKIE) > 0) {
                if (!empty($_COOKIE['username'])) {
                    $_SESSION['username'] = $_COOKIE['username'];
                    $_SESSION["loggedin"] = true;
                }
            }
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                echo'<div class="profile ml-auto p-2">
                <p id="greeting">Hello, ';
                echo $_SESSION["username"];
                echo'<button id="profileBtn" class="btn btn-primary" onclick="goToProfile()";">Profile</button> </p></div>';
            }else {
                require("loginForm.php");
            }
            ?>

        </div>
    </div>

    <!-- Ajax for Extra credit -->
    <script src="../js/search.js"></script>

    <div class="part2 container">
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input onkeyup="search(this.value)" id="userInput" name="userInput" type="text" class="form-control" placeholder="Type in your restaurant">

        </div>

    </div>

    <div class="part3 container">
        <div class="restaurants" id="result"></div>
    </div>


</body>

</html>
