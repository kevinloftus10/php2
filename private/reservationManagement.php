<?php



include_once("connect.php");

$obj = [];
$obj["username"] = "bailey";
$obj["room_number"] = "10";
$obj["date"] = "2021-02-03";
$obj[""]


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

function DeleteReservation( $id ) {

}

function verify($obj) {
    if(!isset($obj["username"]) || !isset($obj["room_number"]) || !isset($obj["date"]) || !isset($obj["start_time"]) || !isset($obj["end_time"])) {
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

    if(!$result) {
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    $count = $row["count(*)"];
    
    if($count > 0) {
        // There is already a valid reservation
        return false;
    }
        
    return true;
}

?>