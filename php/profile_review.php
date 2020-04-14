<?php
//Author: Susan Jang
//Shows the reviews that the author wrote

require("connect-db.php");
global $db;


$user = $_SESSION['username'];

$query = "select * from reviewInfo where user= '$user' ";

$statement = $db->prepare($query);

echo "
<div class='container' id='review'>
        <h3>Your Reviews <i class='fa fa-pencil'></i> </h3>

        <div class='reviewGroup'>
            <div class='row'>";

$statement->execute();

$output ="";
while($row = $statement->fetch(PDO::FETCH_ASSOC)){
    //get the image of restaurant
    $restaurant = $row["restaurant"];
    $query2 = "select image from restaurants where name= '$restaurant' ";
    $statement2 = $db->prepare($query2);
    $statement2->execute();
    $link = $statement2->fetch(PDO::FETCH_ASSOC);

    $output .= '
    <a href="../php/restaurant-page.php">
                        <div class="card" style="width: 18rem;margin-right: 20px;">
                            <img src="'.$link["image"].'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Review 1</p>
                            </div>
                        </div>
                    </a>
';
}

echo $output;

echo " </div>
</div>";

$statement->closeCursor();
$statement2->closeCursor();


?>