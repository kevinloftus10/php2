
<?php

	include ("../../private/roomManagement.php");
	include ("../../private/reservationManagement.php");
	include ("../../private/userManagement.php");

	$RequestMethod = $_SERVER["REQUEST_METHOD"];
	
	if($RequestMethod == "POST") {
		echo "POSTED";
	}

	include ("../../templates/header.php");

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
			
		  	<label for="room">Please Select a room:</label></br>
			
			<select name="room" id="room">
				<?php
				foreach( GetRoom(null) as $val ) {
					echo "<option value='" . $val["room_number"] . "'>" . $val["room_number"] . " @ " . $val["location"] . "</option>";
				}
			
			
				?>
			</select>
			
			</br>
			</br>
			
			<label>Select a time:</label>
			</br>
			  	<input type="date" id="date" name="date">
				<input type="time" id="time" name="time">
			</br>
			</br>

			<label>Organizer:</label>
			</br>
			<select>
				<?php
				foreach( GetUsers(null) as $val ) {
					echo "<option value='" . $val['username'] . "'>" . $val['username'] . "</option>";
				}
				?>
			</select>

			</br>
			</br>
			<label>(user's password required)</label></br>
			<input type="password" value="example"/>
				
			</br>
			</br>
			<input type="submit">
		</form>
		
	</body>

</html>