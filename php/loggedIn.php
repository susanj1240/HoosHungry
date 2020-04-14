<?php
    //Author: Susan Jang
    //Logged in home page


    require("connect-db.php");
    require("fetch.php");

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
    <meta name="description" content="The dummy home page for HoosHungry">
    <title>Dummy Home Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <!-- css  -->
    <link rel="stylesheet" type="text/css" href="../css/dummyHome.css">
    
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
    <script src="../js/dummyHome.js"></script>
</head>

<body>


    <div class="part1">
        <div class="d-flex flex-row">

            <!-- Logo -->
            <div class="p-2">
                <h1 class="Logo">Hoos Hungry</h1>
            </div>


            <div class="profile ml-auto p-2">
                <p>Hello <?php echo $_SESSION['username']?></p>
                <button id="profileBtn" class="btn btn-primary" onclick="profile()">Profile</button>

            </div>

        </div>
    </div>


    <!-- Search -->
     <div class="part2 container">
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input id="userInput" name="userInput" type="text" class="form-control" placeholder="Type in your restaurant">

        </div>

    </div>

    <!-- shows result of search -> this is live search -->
    <div class="part3 container">
        <ul class="row restaurants" id="result"></ul>
    </div>

    <script>
        //Ajax Live Search
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
