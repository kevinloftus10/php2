<?php

function OpenCon() {

	$db = new mysqli ('localhost', 'root', '', 'kevlof2_ei');
	if ($db->connect_error) {
		echo "<p>Error: Could not connect to database.</p>";
		exit;
	}

	return $db;
}

function CloseCon($con) {
	$con->close();
}

?>    