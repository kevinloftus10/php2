<?php
include ("../../private/roomManagement.php");
include ("../../private/reservationManagement.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

$arrayToPrint = null;

if($RequestMethod == "GET") {
    $arrayToPrint = GetReservations(null);
}

if($RequestMethod == "POST") {
    if($_POST['select'] == "Future") {
        if($_POST['roomId'] == "null") {
            $arrayToPrint = GetReservations(null);
        }else {
            $arrayToPrint = GetReservations($_POST['roomId']);
        }
    }else {
        if($_POST['roomId'] == "null") {
            $arrayToPrint = GetAllReservations(null);
        }else {
            $arrayToPrint = GetAllReservations($_POST['roomId']);
        }
    }
}
?>

<html>

    <head>
        <style>
            .ele {
                width: 150px;
                border-width: 1px;
                border-style: solid;
                border-color: grey;
                padding: 8px;
                border-radius: 10px;
                float: left;
                margin: 8px;
            }

            .ele div {
                margin: 2px;
            }

        </style>
    </head>

    <body>

    <form action="" method="POST">

  <label for="roomId">Please Select a room:</label>
<select name="roomId" id="roomId">
	
	<?php

	foreach( GetRoom(null) as $val ) {
		echo "<option value='" . $val["room_number"] . "'>" . $val["room_number"] . " @ " . $val["location"] . "</option>";
	}
	

	?>
    <option value="null" selected>All Rooms</options>

</select>

    <div> Event Date Selection </div>
    </br>
    <input type="radio" id="viewSelected" name="select" value="Future" checked="checked">
    <label for="Future">Select Future Events</label><br />
    <input type="radio" id="viewAll" name="select" value="All">
    <label for="All">Select All Events</label><br />
</br>
  <input type="submit">
</form>

<?php

    foreach( $arrayToPrint as $val ) {
        echo buildHTMLElement($val);
    }

    function buildHTMLElement($obj) {

        $startTime = new DateTime($obj['start_time']);
        $endTime = new DateTime($obj['end_time']);

        $dif = $startTime->diff($endTime);

        $currentDay = new DateTime("NOW");

        return "<div class='ele'> " .
            "<div class='date'> Date: " . $obj['date'] . "</div>" .
            "<div class='room'> Room #: " . $obj['room_number'] . "</div>" .
            "<div class='user'> Creator: " . $obj['username'] . "</div>" .
            "<div class='start_time'> Start Time: " . $obj["start_time"] . "</div>" . 
            "<div class='length'> Meeting Length: </br>". $dif->format("%h hour(s), %i minutes(s)") . "</div>" . 
            "</div>";
    } 
?>
    </body>

</html>