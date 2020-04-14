
<?php
//Author: Susan Jang
//Home page with login form

    require("connect-db.php");
    // require("../html/home.html");

    //initialize session
    session_start();

    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        //
    }

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
                header("location: ../php/loggedIn.php");
                
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

     <!-- home javascript -->
     <script src="../js/home.js"></script>
</head>

<body>


    <div class="part1">
        <div class="d-flex flex-row">

            <!-- Logo -->
            <div class="p-2">
                <h1 class="Logo">Hoos Hungry</h1>
            </div>


            <div class="ml-auto p-2" id="login">
                <!-- login form -->
                <div class="wrapper">
                    <form class="form-signin" name="loginForm" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" style="padding:15px;">
                        <h4 class="form-signin-heading">Login</h4>

                        <!-- email input -->
                        <input style="margin-bottom:2px;" id="email" type="text" class="form-control" name="email" placeholder="Email" />
                        <span style="color:red;font-size:12px;" ><?php echo $username_err; ?></span>

                        <!-- password input -->
                        <input style="margin-bottom:2px;" id="password" type="password" class="form-control" name="password" placeholder="Password" />
                        <span style="color:red;font-size:12px;"><?php echo $password_err; ?></span>

                        <div class="text-center" style="margin-top:10px">
                            <input type="submit" id="loginBtn" name="submit" class="btn btn-primary" value="submit">
                        </div>

                        <p style ="font-size:15px;" class="d-flex justify-content-center"><a href="../php/sign-up.php">Sign Up</a></p>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- login form -->
    <!-- <div class="wrapper2">
        <form class="form-signin" name="loginForm" method="post" action = "../php/login.php" >
         <form class="form-signin" name="loginForm" action = "../php/login.php" onSubmit="return validate()"> 
  
            <h4 class="form-signin-heading">Login</h4>

             email input
            <input id="email" type="text" class="form-control" name="username" placeholder="Email" />

            password input 
            <input id="password" type="password" class="form-control" name="password" placeholder="Password" />

            <div class="text-center">
                <input type="button" id="loginBtn" class="btn btn-primary" value="submit">
            </div>

            <p class="d-flex justify-content-center"><a href="sign-up.html">Sign Up</a></p>
        </form>
    </div> -->

    <div class="part2 container">
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input id="userInput" name="userInput" type="text" class="form-control" placeholder="Type in your restaurant">

        </div>

    </div>

    <div class="part3 container">
        <ul class="row restaurants" id="result"></ul>
    </div>

<script>
    //reference: https://www.webslesson.info/2016/03/ajax-live-data-search-using-jquery-php-mysql.html
    $(document).ready(function(){

    load_data();

    function load_data(query)
    {
    $.ajax({
    url:"../php/fetch.php",
    method:"POST",
    data:{query:query},
    success:function(data)
    {
    $('#result').html(data);
    }
    });
    }
    $('#userInput').keyup(function(){
        console.log("typiing...");
    var search = $(this).val();
    if(search != '')
    {
    load_data(search);
    }
    else
    {
    load_data();
    }
    });
    });
    
</script>

</body>

</html>
