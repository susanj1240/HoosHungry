<?php 
    require("../html/sign-up.html");
    require("connect-db.php");
    
    /*********** FORM VALIDATION **********/

    // Make sure fields are not empty 
    if (!empty($_POST['signUpEmail']) && !empty($_POST['signUpPassword'] && !empty($_POST['confirmPassword']))) {
        // Validate email reference: https://www.w3schools.com/php/php_form_url_email.asp
        if (!filter_input(INPUT_POST, "signUpEmail", FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email";
        } 

        // Password length validation
        if(strlen($_POST['signUpPassword']) < 8) {
            echo "Password must be 8 characters or longer.";
        }

        // Password match validation
        if ($_POST['signUpPassword'] != $_POST['confirmPassword']) {
            echo "Passwords do not match.";
        }

        addNewUser();
    }

    /****** ADD NEW USER TO DATABASE *******/

    if (isset($_POST['signUpEmail']) && isset($_POST['signUpPassword']) && isset($_POST['confirmPassword'])) {
        try {
            addNewUser();
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            echo "<p>Error message: $error_message </p>";
        }
    }

    function addNewUser() {
        require("connect-db.php");
        global $mainpage;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pwd = htmlspecialchars($_POST['signUpPassword']); 
            $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT); 
            $email = htmlspecialchars($_POST['signUpEmail']);
        }

        $query = "INSERT INTO loginInfo (email, pwdHash) VALUES (:email, :pwdHash)";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email); 
        $statement->bindValue(':pwdHash', $hash_pwd);
        $statement->execute();
        $statement->closeCursor();

        header("Location: " . $mainpage);
    }

    $mainpage = "../html/home.html"; // UPDATE LATER

?> 
