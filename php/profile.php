<?php
    //Author: Susan Jang
    //Profile page 

    session_start();

    //if not insession --> go to login page
    //reference: https://www.tutorialspoint.com/php/php_mysql_login.htm
    if(!isset($_SESSION['username'])){
        header("location:login.php");
        die();
    }


?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="author" content="Sooyun Jang (sj7yj)">
    <meta name="description" content="The profile page for HoosHungry">
    <title>Profile Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <!-- profile css  -->
    <link rel="stylesheet" type="text/css" href="../css/profile.css">

    <!-- icon -->
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</head>

<body>
    <script>
        function goBackHome(){
            window.location.href = "login.php";
        }
    </script>

    <button id="homeBtn"class="btn btn-primary" onclick="goBackHome();">Home</button>
    <div class="text-center ">
        <!-- profile image -->
        <div class="container" id="profile">
            <img src="../img/user.jpg" class="profileImg rounded-circle" alt="...">
            <!-- image reference: https://www.shutterstock.com/search/user+profile -->
            <!-- username -->

            <div class="container" style="text-align:center">
                <p id="username" style="display: inline-block;"><?php echo $_SESSION['username']?></p>
            </div>


        </div>
    </div>

    <!-- favorite -->
    <?php
        require("favorite.php");
    ?>

    <!-- reviews -->
    <?php
        require("profile_review.php");
    ?>

    <script src="../js/profile.js"></script>


</body>

</html>
