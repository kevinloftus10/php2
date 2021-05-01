<?php



include_once("connect.php");

$obj = [];
$obj["username"] = "bailey";
$obj["room_number"] = "10";
$obj["date"] = "2021-02-03";
$obj["start_time"] = "11:30";
$obj["end_time"] = "11:50";

//var_dump (CreateReservation($obj));


function CreateReservation( $obj ) {

    if(!verify($obj)) {
        return false;
    }
 
    $query = "INSERT INTO reservations (username, room_number, date, start_time, end_time) VALUES (?, ?, ?, ?, ?)";
    $db = OpenCon();
    
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $obj["username"], $obj["room_number"], $obj["date"], $obj["start_time"], $obj["end_time"]);
    $stmt->execute();
    
    CloseCon($db);

    return true;
}


function GetAllReservations( $confRoomId ){

    $statement = null;

    // Open connection to database
    $db = OpenCon();

    $currentTime = new DateTime("NOW");

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

    usort($resultArray, "compareReservationDates");


    return $resultArray;


}

function GetReservations( $confRoomId ) {

    $statement = null;

    // Open connection to database
    $db = OpenCon();

    $currentTime = new DateTime("NOW");

    // Check to see if the requester is a single reservation or multiple
    if($confRoomId != null) {
        $statement = $db->query(
            sprintf("SELECT * FROM reservations WHERE room_number = %s AND date > '" . $currentTime->format( 'Y-m-d' ) . "'",
            $db->real_escape_string($confRoomId)));
    }else {
        $statement = $db->query("SELECT * FROM reservations WHERE date > '" . $currentTime->format( 'Y-m-d' ) . "'");
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

    usort($resultArray, "compareReservationDates");


    return $resultArray;


}

function compareReservationDates($Obj, $ObjToCompare) {

    $difFromObj = new DateTime($Obj['date'] . "T" . $Obj['start_time']);

    $difFromObjToCompare =  new DateTime($ObjToCompare['date'] . "T" . $ObjToCompare['start_time']);

    return ($difFromObj < $difFromObjToCompare) ? -1 : 1;

}

function UpdateReservation( $obj ) {

    if(!verify($obj)) {
        return false;
    }

}

function DeleteReservationByRoom( $roomId ) {

    if($roomId == null) {
        return false;
    }

    $db = OpenCon();

    $result = $db->query(sprintf("DELETE FROM reservations WHERE room_number = %s", 
    $db->real_escape_string($roomId)));

    CloseCon($db);

    if(!$result) {
        return false;
    }

    return true;

}

function verify($obj) {
    if(!isset($obj["username"]) || !isset($obj["room_number"]) || !isset($obj["date"]) || !isset($obj["start_time"]) || !isset($obj["end_time"])) {
        return false;
    }

    $workHourStart = new DateTime($obj['date'] . "T" . "08:00");
    $workHourEnd = new DateTime($obj['date'] . "T" . "17:00");

    $startTime = new DateTime($obj['date'] . "T" . $obj['start_time']);
    $endTime = new DateTime($obj['date'] . "T" . $obj['end_time']);

    if($startTime < $workHourStart || $startTime > $workHourEnd 
      || $endTime < $workHourStart || $endTime > $workHourEnd) {
          echo "test";
        return false;
    }

    $db = OpenCon();

    $result = $db->query(
        sprintf("SELECT COUNT(*) FROM reservations WHERE room_number = %s AND date = %s AND (start_time BETWEEN %s AND %s OR end_time BETWEEN %s AND %s)",
        $db->real_escape_string($obj["room_number"]), 
        $db->real_escape_string($obj["date"]), 
        $db->real_escape_string($obj["start_time"]),
        $db->real_escape_string($obj["end_time"]), 
        $db->real_escape_string($obj["start_time"]),
        $db->real_escape_string($obj["end_time"])
    ));
        
    CloseCon($db);

        
    return $result;
}

?>