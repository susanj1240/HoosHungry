<?php
//Author: Susan Jang
//Shows the favorite restaurants of the user

require("connect-db.php");
global $db;


$user = $_SESSION['username'];

$query = "select * from favsRestaurant where email= '$user' ";

$statement = $db->prepare($query);

echo "
<div class='container' id='favorite'>
    <h3 >Favorites <i class='fa fa-heart'></i></h3>
    <div class='container'>   
        <div class='list'>";

$statement->execute();

$output ="";
while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    $output .= '
        <a  href='.$row["link"].' target="_blank">
            <div class="block"  style="background-image: url('.$row["image"].');">
            </div>
        </a>
    ';
}

echo $output;

echo " </div>
</div>";

$statement->closeCursor();

?>