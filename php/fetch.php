<?php
//Author: Susan Jang
//Allows Live search of restaurants - Uses Ajax

//reference: https://www.webslesson.info/2016/03/ajax-live-data-search-using-jquery-php-mysql.html
require("connect-db.php");
global $db;

$output = '';
if(isset($_POST["query"]))
{
 $search = $_POST["query"];
 $query = "
  SELECT * FROM restaurants 
  WHERE name LIKE '%".$search."%'
 ";
}
else
{ 
    $query = "
    SELECT * FROM restaurant ORDER BY name
    ";
}

$statement = $db->prepare($query);

if($statement->execute()){
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
    $output .= '
    <li class="column">
        <a href='.$row["link"].' target="_blank">
            <div class="block"  style="background-image: url('.$row["image"].');">
            </div>
        </a>
    </li>';
    }
    echo $output;
} else{
    //
}





$statement->closeCursor();
?>