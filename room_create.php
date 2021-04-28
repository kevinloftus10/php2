<?php 
include("connect.php");

	
	$result = $db->query("SELECT * FROM confRoom");
	printf("Select returned %d rows.<br>", $result->num_rows);
	echo $result->rows;
	while($row = $result->fetch_assoc()) {
		echo "<br> room_number: " . $row["room_number"] . " location: " . $row["location"] . "<br>";
	}
?>