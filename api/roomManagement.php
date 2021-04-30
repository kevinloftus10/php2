<?php 

include("../private/roomManagement.php");

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

?>