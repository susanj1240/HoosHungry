<?php
    // Author: Emily Lin (ezl9uu)
    require("connect-db.php");

    /**** COOKIE ******/
    $msg = '';
    if (count($_COOKIE) > 0) 
    {
        if(!empty($_COOKIE['msgsofar']))
        {
            $msg=$_COOKIE['msgsofar'];
        }
    }
    if (!empty($_POST['review-box']))
    {
        $msg = $_POST['review-box'];
        setcookie('msgsofar', $msg, time()+3600); // set $msg to cookie msgsofar, expires in 1 hour (3600 seconds)
        $_COOKIE['msgsofar'] = $msg;
    }

    if (isset($_COOKIE['msgsofar'])) {
        echo "<div style='margin: 5%'>You have already submitted a review for this restaurant. You said: " . $msg . "</div>";
    }
    
    // Which user is logged in?
    global $user_email;
    session_start();
    $user_email = '';

    /********* EMILY'S EDIT ***********/ 
    if (isset($_SESSION['username'])) {
        $user_email = $_SESSION['username'];
    } else {
        echo "<div class='alert alert-danger' style='text-align:center'>Warning: You must log in before writing a review.</div>";
    }
    /********* END OF EMILY'S EDIT ***********/ 

    // Favorite button setting upon load
    

    // HTML 
    require("../html/restaurant-page.html");

    // Which restaurant is this?
    global $restaurant_name;
    $restaurant_name = 'milan';

    //******************** */
    //Susan's Edit
    $test_rest = $_COOKIE['gfg'];

    //*********************** */

    // Add HTML (add reviews from the database)
    function addReviewHTML() {
        require('connect-db.php');
        $query = "SELECT * FROM reviewInfo";
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();  
        $statement->closeCursor();
    
        echo "<div class='container'>";
        foreach($results as $result)
        {
            echo " <div class='card'> 
                        <div class='card-body'> 
                            <p class='ratingReview'>" . formatStarsReview($result['numStars']) . "</p>
                            <p>" . $result['userText'] . "</p> 
                        </div> 
                   </div> 
                   <br> ";
            // echo "userText: " . $result['userText'] . "numStars: " . $result['numStars'] . "<br/>";
        }
        echo "</div>";
    }
    addReviewHTML();

    function formatStarsReview($numStars) {
        $ret = '<span class="checked">★</span>';
        for ($i = 1; $i < $numStars; $i++) {
            $ret .= '<span class="checked">★</span>';
        }
        for ($j = 0; $j < (5 - $numStars); $j++) {
            $ret .= '<span class="unchecked">★</span>';
        }
        return $ret;
    }

    

    // Restaurant average stars display
    function avgStars() {
        $avgRating = 0;
        
        require('connect-db.php');
        $query = "SELECT AVG(numStars) AS avg FROM reviewInfo";
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(); 
        $statement->closeCursor();
        
        foreach ($results as $result) {
            $avgRating = $result['avg'];
        }

        $percentRating = ($avgRating / 5.0) * 105.0 . "px";

        echo '<script>document.getElementById("avgResRating").style.width = "' . $percentRating . '";</script>';
    }

    avgStars();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['reviewSubmit'])) {
            if (isset($_POST['rating'])) {
                if (isset($_POST['review-box'])) {
                    // $_POST['confirm-msg'] = "Thanks! Your review was submitted.";
                    if ($user_email != '') {
                        addReviewInfo();
                        /*********** EMILY'S EDIT ***********/
                    } else {
                        echo "<div class='alert alert-danger' style='text-align:center'>Error: please log in before writing a review.</div>";
                    }
                    /********** END OF EMIlY'S EDIT ************/
                    
                } else {
                    echo "Please write a review.";
                }
            } else {
                echo "Please click on a star to give a rating.";
            }
        }
    }
    
    // addReviewInfo();

    function addReviewInfo() {
        global $user_email;
        global $restaurant_name;

        $userText = $_POST['review-box']; // user text input 

        // Radio buttons with PHP reference: https://stackoverflow.com/questions/8416099/php-testing-if-a-radio-button-is-selected-and-get-the-value/37721155
        $numStars = 0; // number of stars
        $rating = $_POST['rating'];
        if ($rating == "1") {
            $numStars = 1;
        } else if ($rating == "2") {
            $numStars = 2;
        } else if ($rating == "3") {
            $numStars = 3;
        } else if ($rating == "4") {
            $numStars = 4;
        } else if ($rating == "5") {
            $numStars = 5;
        } else {
            echo "<p> Error: invalid number of stars. </p>";
        }

        // Add info to database
        require('connect-db.php');

        $query = "INSERT INTO reviewInfo (userText, numStars, user, restaurant) VALUES (:userText, :numStars, :user, :restaurant)";
        $statement = $db->prepare($query);
        $statement->bindValue(':userText', $userText); 
        $statement->bindValue(':numStars', $numStars);
        $statement->bindValue(':user', $user_email);
        $statement->bindValue(':restaurant', $restaurant_name);
        $statement->execute();
        $statement->closeCursor();
        ?>
        <!-- page refresh. reference: https://stackoverflow.com/questions/27123470/redirect-in-php-without-use-of-header-method/27123606 -->
        
        <script type="text/javascript">
            window.location.href = 'restaurant.php';
        </script>
    
        <?php
    }

    // Favorite button
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Using PHP with checkbox ref: https://stackoverflow.com/questions/11929471/how-do-i-use-two-submit-buttons-and-differentiate-between-which-one-was-used-to
        if (isset($_POST['heart'])) {
                global $restaurant_name;
                global $user_email;

                require('connect-db.php');

                $query = "INSERT INTO favs (email, restaurant) VALUES (:email, :restaurant)";
                $statement = $db->prepare($query);
                $statement->bindValue(':email', $user_email); 
                $statement->bindValue(':restaurant', $restaurant_name);
                $statement->execute();
                $statement->closeCursor();

                setFav();

            } else {
                global $restaurant_name;
                global $user_email;

                require('connect-db.php');
                $query = "DELETE FROM favs WHERE favs.email=:email AND favs.restaurant=:restaurant";
                $statement = $db->prepare($query);
                $statement->bindValue(':email', $user_email); 
                $statement->bindValue(':restaurant', $restaurant_name);
                $statement->execute();
                $statement->closeCursor();

                setFav();
            }
        }

        function setFav() {
            global $restaurant_name;
            require('connect-db.php');
            $query = "SELECT restaurant FROM favs"; // CHANGE TO INCLUDE EMAIL
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(); 
            $statement->closeCursor();
                        
            foreach ($results as $result) {
                if ($result['restaurant'] == $restaurant_name) {
                    echo '<script>document.getElementById("heartLabel").className = "btn btn-danger"; </script>';
                    echo '<script>document.getElementById("heartCheck").checked = true;</script>'; 
                    // Keeping checkbox checked ref: https://stackoverflow.com/questions/12541419/php-keep-checkbox-checked-after-submitting-form
                }
            } 
        }
    
        setFav();
    
    function updateFav() {

        if (!empty($_GET['updateFav'])) {
            echo "inline";
            return "inline";
        } else {
            echo "none";
            return "none";
        }
    }
    
?>
