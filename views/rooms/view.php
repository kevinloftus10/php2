<?php

include ("../../private/roomManagement.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];
$arrayToPrint = null;

if($RequestMethod == "GET") {
    $arrayToPrint = GetRoom(null);
}

?>

<html>
    <head> </head>
       <body>
           <?php
            foreach( $arrayToPrint as $val ) { 
            echo $val["room_number"] . " location; " . $val["location"] . "</br>"; 
            }
           ?>
            </br>
            </br>
            <a href="./add.php">Add Room</a></br>
            <a href="./update.php">Update Room</a></br>
            <a href="./delete.php">Delete Room</a></br>

       </body> 
</html>