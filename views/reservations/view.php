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

        $startTime = new DateTime($val['start_time']);
        $endTime = new DateTime($val['end_time']);

        $dif = $endTime->diff($startTime);

        echo "Date: " . $val["date"] . " Start Time: " . $val['start_time'] . " Length: " . $dif->format("%h hour(s), %i minutes(s)") . " User: " . $val['username'] . " Room #:" . $val['room_number'] . "</br>";
    }

?>

    </body>

</html>