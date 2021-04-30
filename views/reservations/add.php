
<?php

	include ("../../private/roomManagement.php");

	$RequestMethod = $_SERVER["REQUEST_METHOD"];
	
	if($RequestMethod == "POST") {
		echo "POSTED";
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
		
		</style>
		
</head>

<body>




<form action="" method="POST">

  <label for="room">Please Select a room</label>
<select name="room" id="room">
	
	<?php

	foreach( GetRoom(null) as $val ) {
		echo "<option value='" . $val["room_number"] . "'>" . $val["room_number"] . " @ " . $val["location"] . "</option>";
	}
	

	?>
</select>
</br>
  <label for="appt">Select a time:</label>
  <input type="time" id="appt" name="appt">
  <input type="submit">
</form>

</body>

</html>