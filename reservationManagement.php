<?php 
include("connect.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

// Create Reservation
if($RequestMethod == "POST") {
    echo "Posted!";
}

// Get the Reservation(s) by room and/or time
if($RequestMethod == "GET") {
    
}

// Update Reservation
if($RequestMethod == "UPDATE") {

}

// Delete Reservation
if($RequestMethod == "DELETE") {

}



?>