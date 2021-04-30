
<?php

	include ("../../private/roomManagement.php");

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


<?php

	foreach( GetRoom(null) as $val ) {
		echo $val["room_number"];
	}
	

?>

<form action="/action_page.php">
  <label for="appt">Select a time:</label>
  <input type="time" id="appt" name="appt">
  <input type="submit">
</form>

</body>

</html>