<?php
include ("../../private/roomManagement.php");

include ("../../private/reservationManagement.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

$user = null;
$error = null;

if($RequestMethod == "GET") {
    if(isset($_GET["username"])) {
        //$user = $_GET["username"];
    } else {
        // TO DO Redirect..
    }
}

if($RequestMethod == "POST") {
    foreach(array_keys( $_POST ) as $val) {
        DeleteRoom($val);
        DeleteReservationByRoom($val);
    }
}

include ("../../templates/header.php");

?>

<html>

<head>

<style>

    tr {
        padding: 8px;
    }

    td, th {
        padding: 8px;
    }

</style>

</head>
<body>

<h1>Which rooms would you like to delete?</h1>

<form action="" method="POST">
    
    <table>

        <tr>
            <th>Select</th>
            <th>Room #:</th>
            <th>Location:</th>
            <th>Capcity:</th>
        </tr>

    <?php

        foreach(GetRoom(null) as $val) {
            echo buildTableElement($val);
        }

        function buildTableElement($obj) {
            return "<tr><td><input type='checkbox' name='". 
            $obj["room_number"] ."'></td><td>" . 
            $obj["room_number"] . "</td><td>" . 
            $obj["location"] . "</td><td>" . 
            $obj["capacity"] . "</td></tr>"; 
        }


    ?>

    </table>

    <input type="submit" />
</form>

</body>


</html>