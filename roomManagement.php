<?php 
include("connect.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];


// Create Room 
if($RequestMethod == "PUT") {
    
    if( !isset($_POST["room_number"]) || !isset($_POST["location"]) || !isset($_POST["capacity"]) ) {
        return "Error!";
    }

    $obj = [];
    $obj["room_number"] = $_POST["room_number"];
    $obj["location"] = $_POST["location"];
    $obj["capacity"] = $_POST["capacity"];

    echo CreateRoom($obj);
}

// Get the Room(s) - either room id or null to return all the rooms
if($RequestMethod == "GET") {

    if(isset($_GET['id'])) {
        echo json_encode(GetRoom($_GET['id']));
    }else {
        echo json_encode(GetRoom(null));
    }
}

// Update Room (requires room id and updates)
if($RequestMethod == "POST") {

    if( !isset($_POST["room_number"]) || !isset($_POST["location"]) || !isset($_POST["capacity"]) ) {
        echo "Error!";
        return;
    }

    $obj = [];
    $obj["room_number"] = $_POST["room_number"];
    $obj["location"] = $_POST["location"];
    $obj["capacity"] = $_POST["capacity"];

    echo UpdateRoom($obj);

}

// Delete Room (requires room id)
if($RequestMethod == "DELETE") {

    if(!isset($_GET["id"])) {
        echo "Error!";
        return;
    }

    echo DeleteRoom($_GET['id']);
}

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
        $db->real_escape_string($_GET["id"])));

    CloseCon($db);

    if(!$statement) {
        return false;
    } 

    return true;
}

function CreateRoom( $obj ) {

    // Make sure everything required is there.
    if( !isset($obj["room_number"]) || !isset($obj["location"]) || !isset($obj["capacity"]) ) {
        return null;
    }

    // Insert into prepared statement here.
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
    
    // bool to check if it was inserted

    // if it wasn't because they have duplicate room number return false;

    // After return true;
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