<?php 
include("connect.php");

	$db = OpenCon();
	$result = $db->query("SELECT * FROM confRoom");
	printf("Select returned %d rows.<br>", $result->num_rows);
	echo $result->rows;
	while($row = $result->fetch_assoc()) {
		echo "<br> room_number: " . $row["room_number"] . " location: " . $row["location"] . "<br>";
	}
	CloseCon($db);
?>