<?php 
include("../private/reservationManagement.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

// Create Reservation
if($RequestMethod == "PUT") {
    echo "Posted!";
}

// Get the Reservation(s) by room and/or time
if($RequestMethod == "GET") {
    
    $result = null;

    if(isset($_GET["roomID"])) {
        $result = GetReservations($_GET["roomID"]);
    }else {
        $result = GetReservations(null);
    }

    echo json_encode($result);
}

// Update Reservation
if($RequestMethod == "POST") {

}

// Delete Reservation
if($RequestMethod == "DELETE") {

}


?>