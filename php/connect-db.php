<?php 
    $hostname = 'localhost:3306';
    $dbname = 'webPLproject'; // ALTER THIS AS NEEDED
    $username = 'aaa';
    $password = 'keylimepie24';

    $dsn = "mysql:host=$hostname;dbname=$dbname";

    try 
        {
            $db = new PDO($dsn, $username, $password);
            // echo "<p> You connected. </p>";
        }
    catch (PDOException $e) 
        {
            $error_message = $e -> getMessage(); 
            echo "<p> An error occurred while connecting to the database: $error_message </p>";
        }
    catch (Exception $e) 
        {
            $error_message = $e -> getMessage(); 
            echo "<p> Error message: $error_message </p>";
        }
?> 