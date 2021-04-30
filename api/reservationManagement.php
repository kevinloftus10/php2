<?php 
include("connect.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

// Create Reservation
if($RequestMethod == "PUT") {
    echo "Posted!";
}

// Get the Reservation(s) by room and/or time
if($RequestMethod == "GET") {
    
}

// Update Reservation
if($RequestMethod == "POST") {

}

// Delete Reservation
if($RequestMethod == "DELETE") {

}

function CreateReservation( $obj ) {

}

function GetReservations( $confRoomId ) {

}

function UpdateReservation( $obj ) {


}

function DeleteReservation( $id ) {

}

?>