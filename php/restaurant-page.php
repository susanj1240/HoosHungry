<?php
    // Author: Emily Lin (ezl9uu)
    require("connect-db.php");
    
    // Which user is logged in?
    global $user_email;
    session_start();
    if (isset($_SESSION['username'])) {
        $user_email = $_SESSION['username'];
    }

    // HTML 
    // require("../html/restaurant-page.html");

    // Which restaurant is this?
    global $restaurant_name;
    // $restaurant_name = 'milan';
    if (isset($_GET['name'])) {
        $_COOKIE['gfg'] = $_GET['name'];
    }
    $_SESSION['res_name'] = 'a';
    if (isset($_GET['name'])) {
        $_SESSION['res_name'] = $_GET['name'];
    }
    if ($_COOKIE['gfg'] != 'profileBtn') {
        $_SESSION['res_name'] = $_COOKIE['gfg'];
    }
    $restaurant_name = $_COOKIE['gfg'];


    //******************** */
    //Susan's Edit
    $test_rest = $_COOKIE['gfg'];

    //*********************** */

    //Susan's Add
    // Loads the restaurant picture from 'restaurants' datavase
    function getPicture(){
        global $restaurant_name;
        require('connect-db.php');
        $query = "SELECT * FROM restaurants where name = '$restaurant_name' ";
        
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();  
        $statement->closeCursor();

        foreach($results as $result){
            $imgaeSrc = $result['image'];
            return $imgaeSrc;
        }
    }


    // Add HTML (add reviews from the database)
    function addReviewHTML() {
        global $restaurant_name;

        require('connect-db.php');
        $query = "SELECT * FROM reviewInfo where restaurant = '$restaurant_name' ";
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
    // addReviewHTML();

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
        global $restaurant_name;
        $avgRating = 0;
        
        require('connect-db.php');
        $query = "SELECT AVG(numStars) AS avg FROM reviewInfo WHERE restaurant=:restaurant";
        $statement = $db->prepare($query);
        $statement->bindValue(':restaurant', $restaurant_name);
        $statement->execute();
        $results = $statement->fetchAll(); 
        $statement->closeCursor();
        
        foreach ($results as $result) {
            $avgRating = $result['avg'];
        }

        $percentRating = ($avgRating / 5.0) * 105.0 . 'px';
        echo '<script>document.getElementById("avgResRating").style.width = "' . $percentRating . '";</script>';
    }

    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['reviewSubmit'])) {
            if (isset($_POST['rating'])) {
                if (isset($_POST['review-box'])) {
                    // $_POST['confirm-msg'] = "Thanks! Your review was submitted.";
                    if (isset($_SESSION['username'])) {
                        addReviewInfo();
                    } else {
                        echo "<div class='alert alert-danger'>Error: login before writing a review.</div>";
                    }
                    
                } else {
                    echo "Please write a review.";
                }
            } else {
                echo "Please click on a star to give a rating.";
            }
        }
    }

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
            window.location.href = 'restaurant-page.php?name=' . $_SESSION['res_name'];
        </script>
    
        <?php
    }

        // Favorite button
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        // Using PHP with checkbox ref: https://stackoverflow.com/questions/11929471/how-do-i-use-two-submit-buttons-and-differentiate-between-which-one-was-used-to
        if (isset($_POST['heart'])) {
            if (isset($_SESSION['username'])) {
                global $restaurant_name;
                global $user_email;

                require('connect-db.php');

                $query = "INSERT INTO favsRestaurant (email, restaurant, name, image, link) VALUES (:email, :restaurant, :name, :image, :link)";
                $statement = $db->prepare($query);
                $statement->bindValue(':email', $user_email); 
                $statement->bindValue(':restaurant', $restaurant_name);
                $statement->bindValue(':name', $restaurant_name);
                $statement->bindValue(':image', '../img/' . $restaurant_name . '.jpg');
                $statement->bindValue(':link', '../php/restaurant-page.php');
                $statement->execute();
                $statement->closeCursor();

                setFav();
            } else {
                echo "<div class='alert alert-danger'>Error: login before adding to favorites.</div>";
            }

        } else {
            if (isset($_SESSION['username'])) {
                global $restaurant_name;
                global $user_email;

                require('connect-db.php');
                $query = "DELETE FROM favsRestaurant WHERE favsRestaurant.email=:email AND favsRestaurant.restaurant=:restaurant";
                $statement = $db->prepare($query);
                $statement->bindValue(':email', $user_email); 
                $statement->bindValue(':restaurant', $restaurant_name);
                $statement->execute();
                $statement->closeCursor();

                setFav();
            } else {
                echo "<div class='alert alert-danger'>Error: login before updating favorites.</div>";
            }
        }
    }

    function setFav() {
        global $restaurant_name;
        global $user_email;
        require('connect-db.php');
        $query = "SELECT restaurant FROM favsRestaurant WHERE email=:email"; 
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $user_email);
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
    
    function updateFav() {
        if (!empty($_GET['updateFav']) && isset($_SESSION['username'])) {
            echo "inline";
            return "inline";
        } else {
            echo "none";
            return "none";
        }
    }
?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content = "width=device-width, height=device-height, initial-scale=1">
        <meta name="author" content="Emily Lin (ezl9uu)">
        <meta name="description" content="The restaurant page for HoosHungry"> 
        <title>Restaurant</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/restaurant-style.css" />
    </head>

    <body>
        <!-- Added by Susan -->
        <!-- This button sends the user back home -->
        <script>
            function goBackHome(){
                window.location.href = "../php/login.php";
            }
        </script>
        <button id="homeBtn"class="btn btn-primary" onclick="goBackHome();">Home</button>


        <div class = "container" id="container1">
            <div class="row" id="row1">
                <div class="col-md-6">
                <?php 
                    $link = getPicture();
                    echo '<img src= "' .$link. '" >';
                   
                 ?>
                <!-- <img src= "?php getPicture(); ?" -->
                

                </div>
                <div class="col-md-6" id="col2">
                    <!-- <h1>Milan Indian Restaurant</h1> -->
                    <h1><?php echo $restaurant_name ?> Restaurant</h1>
                    <!-- Star Rating -->
                    <div class="ratingReviewTop" id="avgResRating">
                        <!-- total width = 105 px -->
                        <span>★★★★★</span>
                    </div>
                    <div class="ratingReviewBottom"><span>★★★★★</span></div>
                    <br><br>

                    <form name="fav" id="fav" method="POST" action = "restaurant-page.php?updateFav=yes&name=<?php echo $_SESSION['res_name'];?>">
                        <div>
                            <label class="btn btn-light" id="heartLabel" style="float:right;"> <!-- ref for button: https://getbootstrap.com/docs/4.0/components/buttons/-->
                                
                            <input type="checkbox" id="heartCheck" name="heart" style="opacity: 0; position: absolute;" onchange="document.getElementById('fav').submit();" > ♡ Favorite <!-- unicode symbol for heart: https://www.w3schools.com/charsets/ref_utf_symbols.asp -->
                            <!-- checkbox positioning ref: https://stackoverflow.com/questions/17979781/how-can-i-hide-a-checkbox-in-html -->
                            <!-- onchange ref: https://stackoverflow.com/questions/33393852/is-it-possible-to-submit-a-checkbox-form-without-submit-button-in-php -->
                            </label>
                        </div>
                    </form>
                    <p style='color: red; display: <?php updateFav(); ?>' >Favorites has been updated.</p> 
                    <p>Here is some information about the restaurant </p>
                </div>
            </div>

            <div>
                    <h2>Your Review</h2>
                    <br>
                    <p><i>Click on a star to leave a rating. 1 = lowest, 5 = highest.</i></p> 
                    <!-- https://stackoverflow.com/questions/8118266/integrating-css-star-rating-into-an-html-form -->
                    <form id="review-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="ratingUser">
                            <span><input type="radio" name="rating" id="str1" class="unchecked" value="1" onclick="selectStar(this.id)"><label for="str1" id="str1-label">★</label></span>
                            <span><input type="radio" name="rating" id="str2" class="unchecked" value="2" onclick="selectStar(this.id)"><label for="str2" id="str2-label">★</label></span>
                            <span><input type="radio" name="rating" id="str3" class="unchecked" value="3" onclick="selectStar(this.id)"><label for="str3" id="str3-label">★</label></span>
                            <span><input type="radio" name="rating" id="str4" class="unchecked" value="4" onclick="selectStar(this.id)"><label for="str4" id="str4-label">★</label></span>
                            <span><input type="radio" name="rating" id="str5" class="unchecked" value="5" onclick="selectStar(this.id)"><label for="str5" id="str5-label">★</label></span>
                        </div>
                        
                        <!-- Star rating error message -->
                        <div id="star-msg" class="feedback"></div>
                        <br><br>

                        <!-- Reference: https://getbootstrap.com/docs/4.1/components/forms/ -->
                        <!-- TEXT BOX/FORM FOR REVIEW -->
                        <textarea class="form-control" name="review-box" id="review" rows="10" cols="100" placeholder="Write your review here"></textarea>
                        <br>
                        <!-- Text box error message -->
                        <div id="review-msg" class="feedback" value=<?php if (isset($_POST['confirm-msg'])) echo $_POST['confirm-msg'] ;?>></div>
                        <!-- Submit button -->
                        <button type="submit" name="reviewSubmit" class="btn btn-primary" value="Submit" style="float: right;" onclick="return validateReview()">Submit</button>
                    </form>
            </div>
        </div>
    
    <?php 
        addReviewHTML(); 
        avgStars();
        setFav();
    ?>

    <script src="../js/restaurant.js"></script>
    </body>
</html>

