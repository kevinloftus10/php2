<?php

include ("../../private/roomManagement.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];
$arrayToPrint = null;

if($RequestMethod == "GET") {
    $arrayToPrint = GetRoom(null);
}

include ("../../templates/header.php");

?>

<html>
    <head> 

    <style>
        td {
            padding: 10px;
        }
    </style>

    </head>
       <body>

        <a href='<?php echo getUrl() . "views/rooms/add.php" ?>'>Add Room</a>

        </br>
        </br>

        <table>
            <tr>
                <th>Room #:</th>
                <th>Location:</th>
                <th>Capacity:</th>
                <th>Edit:</th>
                <th>Delete:</th>
            </tr>

           <?php


            foreach( $arrayToPrint as $val ) { 
                echo buildTableElement($val);
            }

            function buildTableElement($obj) {
                return "<tr><td>" . $obj["room_number"] . 
                       "</td><td>" . $obj["location"] . 
                       "</td><td>" . $obj["capacity"] . "</td> " .
                       "<td> <a href='" . getUrl() . "views/rooms/update.php?roomId=" . $obj["room_number"] . "'>Edit</a></td>" . 
                       "<td> <a href='" . getUrl() . "views/rooms/delete.php?roomId=" . $obj["room_number"] . "'>Delete</a></td>" . 
                       "</tr>";
            }

           ?>
        </table>
    </body> 
</html>