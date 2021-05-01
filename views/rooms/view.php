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
            padding: 8px;
        }
    </style>

    </head>
       <body>
        <table>
            <tr>
                <th>Room #:</th>
                <th>Location:</th>
                <th>Capacity:</th>
            </tr>

           <?php


            foreach( $arrayToPrint as $val ) { 
                echo buildTableElement($val);
            }

            function buildTableElement($obj) {
                return "<tr><td>" . $obj["room_number"] . 
                       "</td><td>" . $obj["location"] . 
                       "</td><td>" . $obj["capacity"] . "</td></tr>";
            }

           ?>
        </table>
    </body> 
</html>