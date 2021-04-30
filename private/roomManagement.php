<?php
include("connect.php");

function GetRoom( $id ) {
    $statement = null;

    // Open connection to the database
    $db = OpenCon();

    // Check to see if the requester is wanting a single room or all of them
    if($id != null) {
        $statement = $db->query(
            sprintf("SELECT * FROM confRoom WHERE room_number = %s",
            $db->real_escape_string($id)));
    }else {
        $statement = $db->query("SELECT * FROM confRoom");
    }

    // Close connection
    CloseCon($db);

    // Check if the query successed
    if(!$statement) {
        return false;
    }

    // Build the json array
    $resultArray = array();
    $index = 0;
    while($row = $statement->fetch_object()) {
        $tempArr = [];
        $tempArr['room_number'] = $row->room_number;
        $tempArr['location'] = $row->location;
        $tempArr['capacity'] = $row->capacity;
        $resultArray[$index] = $tempArr;
        $index++;
    }

    return $resultArray;
}

function DeleteRoom( $id ) {

    if($id == null) {
        return false;
    }

    $db = OpenCon();

    $statement = $db->query(
        sprintf("DELETE FROM confRoom WHERE room_number = %s",
        $db->real_escape_string($id)));

    CloseCon($db);

    if(!$statement) {
        return false;
    } 

    return true;
}

function CreateRoom( $obj ) {

    if( !isset($obj["room_number"]) || !isset($obj["location"]) || !isset($obj["capacity"]) ) {
        return false;
    }

    if( $obj["room_number"] == '' || $obj["location"] == '' || $obj["capacity"] == '' ) {
        return false;
    }

    $query = "INSERT INTO confRoom (room_number, location, capacity) VALUES (?, ?, ?)";
	
    $db = OpenCon();

    $stmt = $db->prepare($query);
	$stmt->bind_param('ssi', $obj["room_number"], $obj["location"], $obj["capacity"]);
    $stmt->execute();

    CloseCon($db);

    if ($stmt->affected_rows > 0) {
		echo "<p>User information submitted successfully!</p>";
        return true;
	} else {
		echo "<p>An error has occured. <br/> 
		Please try again later.</p>";
        return false;
	}

}

function UpdateRoom( $obj ) {

    if( !isset($obj["room_number"]) || !isset($obj["location"]) || !isset($obj["capacity"]) ) {
        return null;
    }

    $db = OpenCon();
    $statement = $db->query(
        sprintf("UPDATE confRoom SET location = '%s', capacity = %s WHERE room_number = %s",
        $db->real_escape_string($obj['location']), $db->real_escape_string($obj['capacity']), $db->real_escape_string($obj['room_number'])
        )
    );
    CloseCon($db);

    return $statement;
}
?>