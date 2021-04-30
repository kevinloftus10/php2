<?php

include("connect.php");

function CreateReservation( $obj ) {

    if(!isset($obj["username"]) || !isset($obj["room_number"]) || !isset($obj["date"]) || !isset($obj["start_time"]) || !isset($obj["end_time"])) {
        return false;
    }

    

}

function GetReservations( $confRoomId ) {

    $statement = null;

    // Open connection to database
    $db = OpenCon();

    // Check to see if the requester is a single reservation or multiple
    if($confRoomId != null) {
        $statement = $db->query(
            sprintf("SELECT * FROM reservations WHERE room_number = %s",
            $db->real_escape_string($confRoomId)));
    }else {
        $statement = $db->query("SELECT * FROM reservations");
    }

 
    // Close the connection
    CloseCon($db);

    if(!$statement) {
        return false;
    }

    // Build the json array
    $resultArray = array();
    $index = 0;
    while($row = $statement->fetch_object()) {
        $tempArr = [];
        $tempArr['reservationID'] = $row->reservationID;
        $tempArr['username'] = $row->username;
        $tempArr['room_number'] = $row->room_number;
        $tempArr['date'] = $row->date;
        $tempArr['start_time'] = $row->start_time;
        $tempArr['end_time'] = $row->end_time;
        $resultArray[$index] = $tempArr;
        $index++;
    }

    return $resultArray;


}

function UpdateReservation( $obj ) {


}

function DeleteReservation( $id ) {

}
?>