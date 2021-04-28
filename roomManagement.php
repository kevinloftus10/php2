<?php 
include("connect.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];


// Create Room 
if($RequestMethod == "POST") {
    echo "Posted!";
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
if($RequestMethod == "UPDATE") {

}

// Delete Room (requires room id)
if($RequestMethod == "DELETE") {

    if(!isset($_GET["id"])) {
        echo "Error!";
        return;
    }

    $statement = $db->query(
        sprintf("DELETE FROM confRoom WHERE room_number = %s",
        $db->real_escape_string($_GET["id"])));

    if(!$statement) {
        echo "Error!";
    }else {
        echo "Done!";
    }
}

function GetRoom( $id ) {
    $statement = null;

    $db = OpenCon();

    if($id != null) {
        $statement = $db->query(
            sprintf("SELECT * FROM confRoom WHERE room_number = %s",
            $db->real_escape_string($id)));
    }else {
        $statement = $db->query("SELECT * FROM confRoom");
    }

    if(!$statement) {
        echo "Error!";
        return json_encode(null);
    }

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

    CloseCon($db);

    return $resultArray; // Parse to JSON and print.
}

?>