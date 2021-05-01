
<?php

include ("../../private/roomManagement.php");
include ("../../private/reservationManagement.php");
include ("../../private/userManagement.php");

include ("../../templates/header.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

$reservation = GetReservationsById($_GET["revId"]);

if($reservation == null) {
    //TODO handle later
}

$error = false;

if($RequestMethod == "POST") {

    $obj = [];
    $obj["reservationID"] = $_GET["revId"];
    $obj["username"] = $_POST["organizer"];
    $obj["room_number"] = $_POST["room"];
    $obj["date"] = $_POST["date"];
    $obj["start_time"] = $_POST["start_time"];
    $obj["end_time"] = $_POST["end_time"];

    if(UpdateReservation($obj)) {
        header( "Location: " . getUrl() . "views/reservations/view.php" );
    }else {
        $error = true;
    }
}
?>

<!doctype html>
<html lang ="en">
<head>
    <meta charset="utf-8">
    <title>Room Reservation</title>
    <style type="text/css">
        fieldset {
        width: 75%;
        border: 2px solid #cccccc;
        }

        label {
        float: left;
        text-align: left;
        font-weight: bold;
        }

        input {
        border: 1px solid #000;
        padding: 3px;
        }

        td {
            padding: 12px;
        }

    </style>

</head>

<body>

    <h3>Update reservation:</h3>
    <form action="" method="POST">
        
        <table>
            <tr>
                <td>Please Select a room:</td>
                <td>
                    <select name="room" id="room" value='<?php echo $reservation["room_number"]; ?>'>
                        <?php
                        foreach( GetRoom(null) as $val ) {
                            echo "<option value='" . $val["room_number"] . "'>" . $val["room_number"] . " @ " . $val["location"] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Select Date:</td>
                <td><input type="date" id="date" name="date" value='<?php echo $reservation["date"]; ?>'></td>
            </tr>

              <tr>
                <td>Start Time:</td>
                <td><input type="time" id="time" name="start_time" value='<?php echo $reservation["start_time"]; ?>'></td>
            </tr>

            <tr>
                <td>End Time:</td>
                <td><input type="time" id="time" name="end_time" value='<?php echo $reservation["end_time"]; ?>'></td>
            </tr>

            <tr>
                <td>Organizer:</td>
                <td>
                    <select name="organizer" value='<?php echo $reservation["username"]; ?>'>
                        <?php
                        foreach( GetUsers(null) as $val ) {
                            echo "<option value='" . $val['username'] . "'>" . $val['username'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            
            <tr>
                <td><b>(user's password required)</b></td>
                <td><input type="password" value="example"/></td>
            </tr>
        </table>

        </br>
        </br>
        <input type="submit">
    </form>
    
    <?php 
        if($error) {
            echo "<strong>Please check that: </br> All fields are filled out </br> User's password is correct </br> You aren't double booking a room </br> and scheduling during the weekend or non business hours (8 am - 5 pm)";
        }
    ?>

</body>

</html>