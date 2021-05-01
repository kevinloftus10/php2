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
        $arrayToPrint = GetReservations($_POST['roomId']);
    }else {
        $arrayToPrint = GetAllReservations($_POST['roomId']);    
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

    <input type="radio" id="viewSelected" name="select" value="Future">
    <label for="Future">Select Future Events</label><br />
    <input type="radio" id="viewAll" name="select" value="All">
    <label for="All">Select All Events</label><br />

</select>
</br>
  <input type="submit">
</form>

<?php

    foreach( $arrayToPrint as $val ) {
        echo "Date: " . $val["date"] . " Start time: " . $val['start_time'] . " End time: " . $val["end_time"] . " User: " . $val['username'] . " Room #:" . $val['room_number'] . "</br>";
    }

?>

    </body>

</html>