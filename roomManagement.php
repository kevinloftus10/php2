<?php 
include("connect.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];


// Create Room 
if($RequestMethod == "POST") {
    echo "Posted!";
}

// Get the Room(s) - either room id or null to return all the rooms
if($RequestMethod == "GET") {
    
    $statement = null;

    if(isset($_GET["id"])) {
        $statement = $db->query(
            sprintf("SELECT * FROM confRoom WHERE room_number = %s",
            $db->real_escape_string($_GET["id"])));
    }else {
        $statement = $db->query("SELECT * FROM confRoom");
    }

    if(!$statement) {
        echo "Error!";
        return;
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

    echo json_encode($resultArray); // Parse to JSON and print.
}

// Update Room (requires room id and updates)
if($RequestMethod == "UPDATE") {

}

// Delete Room (requires room id)
if($RequestMethod == "DELETE") {

}

?>