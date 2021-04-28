<?php 

$RequestMethod = $_SERVER["REQUEST_METHOD"];


// Create Room 
if($RequestMethod == "POST") {
    echo "Posted!";
}

// Get the Room(s) - either room id or null to return all the rooms
if($RequestMethod == "GET") {
    
}

// Update Room (requires room id and updates)
if($RequestMethod == "UPDATE") {

}

// Delete Room (requires room id)
if($RequestMethod == "DELETE") {

}

?>