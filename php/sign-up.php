<?php 
    // Author: Emily Lin 
    session_start();
    // header('Access-Control-Allow-Origin: http://localhost:4200');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

    // retrieve data from the request
    $postdata = file_get_contents("php://input");

    // Process data

    // Extract json format to PHP array
    $request = json_decode($postdata);

    global $data;
    $data = [];
    $response = [];
    foreach ($request as $k => $v)
    {
        array_push($data, $v); // Reference: https://www.php.net/manual/en/function.array-push.php
        $response[0]['post_'.$k] = $v;
    }
    $_SESSION['username'] = $data[0];
    echo json_encode(['content'=>$response]);

    // require("../html/sign-up.html");
    require("connect-db.php");

    function addNewUser() {
        global $data; 
        require("connect-db.php");

        $email = $data[0];

        $pwd = $data[1];

        $password = hash('sha256', $pwd);

        $query = "INSERT INTO loginInfo (email, pwd) VALUES (:email, :pwd)";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email); 
        $statement->bindValue(':pwd', $password);
        $statement->execute();
        $statement->closeCursor();

        // header("Location: ../php/loggedIn.php");
        // echo '<script>window.location.href = "../php/loggedIn.php"</script>';
        exit();
    }

    if ($data[1] == $data[2]) { // If passwords match 
        addNewUser();
    }

?> 
