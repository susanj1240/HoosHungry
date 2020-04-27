<?php 
    //Author: Susan Jang, Emily Lin
    //Connects with Xampp database

    $hostname = 'localhost';
    $dbname = ''; // CHANGE THIS
    $username = ''; // CHANGE THIS
    $password = ''; // CHANGE THIS

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
