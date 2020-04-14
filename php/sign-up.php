<?php 
    // Author: Emily Lin (ezl9uu)
    require("../html/sign-up.html");
    require("connect-db.php");
    
    /*********** FORM VALIDATION **********/

    // Make sure fields are not empty 
    if (!empty($_POST['signUpEmail']) && !empty($_POST['signUpPassword'] && !empty($_POST['confirmPassword']))) {
        // Validate email reference: https://www.w3schools.com/php/php_form_url_email.asp
        if (!filter_input(INPUT_POST, "signUpEmail", FILTER_VALIDATE_EMAIL)) {
            echo "<div align='center' class='container' style='color: red;'><br><h3>ERROR: Invalid email</h3></div>";
        } 

        // Password length validation
        // Reference: https://stackoverflow.com/questions/12896766/check-form-input-length-via-php-with-maxlength-tag
        else if(strlen($_POST['signUpPassword']) < 8) {
            echo "<div align='center' class='container' style='color: red;'><br><h3>ERROR: Password must be 8 characters or longer.</h3></div>";
        }

        // Password match validation
        else if ($_POST['signUpPassword'] != $_POST['confirmPassword']) {
            echo "<div align='center' class='container' style='color: red;'><br><h3>ERROR: Passwords do not match.</h3></div>";
        }

        /****** ADD NEW USER TO DATABASE *******/

        else {
            try {
                addNewUser();
            } catch (Exception $e) {
                $error_message = $e->getMessage();
                echo "<p>Error message: $error_message </p>";
            }
        }  
    }

    function addNewUser() {
        require("connect-db.php");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pwd = htmlspecialchars($_POST['signUpPassword']); 
            $email = htmlspecialchars($_POST['signUpEmail']);
        }

        $query = "INSERT INTO loginInfo (email, pwdHash) VALUES (:email, :pwdHash)";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email); 
        $statement->bindValue(':pwdHash', $pwd);
        $statement->execute();
        $statement->closeCursor();

        header("Location: ../php/loggedIn.php");
        exit();
    }

    /**** COOKIE ******/
    $emailcookie = '';
    if (count($_COOKIE) > 0) 
    {
        if(!empty($_COOKIE['emailcookie']))
        {
            $emailcookie=$_COOKIE['emailcookie'];
        }
    }
    if (!empty($_POST['signUpEmail']))
    {
        $emailcookie = $_POST['signUpEmail'];
        setcookie('emailcookie', $emailcookie, time()+3600); 
        $_COOKIE['emailcookie'] = $emailcookie;
        // echo $_COOKIE['emailcookie'];
    }
    

    // reference: https://stackoverflow.com/questions/230592/xpath-query-with-php
    // reference: https://stackoverflow.com/questions/16127142/modify-html-attribute-with-php/16139844
    $html = '../html/sign-up.html';
    $dom = new DOMDocument;
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query("//html/body/div[@class='sign-up-box']/form[@id='sign-up-fm']/div[@class='form group']/input[@id='signUpEmail']");
    foreach($nodes as $node) {
        $node->setAttribute('value', $emailcookie);
    }
    
    // echo $dom->saveHTML();

    // setcookie('msgsofar', 'something', time()-3600); // remove cookie 

?> 