<?php
include("connect.php");

function SignUp( $obj ) {

if( !isset($obj["username"]) || !isset($obj["name"]) || !isset($obj["password"]) || !isset($obj["email"]) || !isset($obj["phoneNumber"])){
    return false;
}

$query = "INSERT INTO user_reg (username, name, password, email, phoneNumber) VALUES (?, ?, ?, ?, ?)";
$db = OpenCon();

$stmt = $db->prepare($query);
$stmt->bind_param('sssss', $obj["username"], $obj["name"], $obj["password"], $obj["email"], $obj["phoneNumber"]);
$stmt->execute();

CloseCon($db);

if ($stmt->affected_rows >0) {
    return true;
} else {
    return false;
}

}

function GetUsers($username) {
$statement = null;

$db = OpenCon();

if ($username == null){
    $statement = $db->query("SELECT * FROM user_reg");
} else {
    $statement = $db->query(sprintf("SELECT * FROM user_reg WHERE username = '%s'", $db->real_escape_string($username)));
}

CloseCon($db);

if(!$statement) {
    return false;
}

$resultArray = array();
$index = 0;
while($row = $statement->fetch_object()) {
    $tempArr = [];
    $tempArr['username'] = $row->username;
    $tempArr['name'] = $row->name;
    $tempArr['email'] = $row->email;
    $tempArr['phoneNumber'] = $row->phoneNumber;
    $resultArray[$index] = $tempArr;
    $index++;
}

return $resultArray;

}

function UpdateUser( $obj ) {

if( !isset($obj["username"]) || !isset($obj["name"]) || !isset($obj["password"]) || !isset($obj["email"]) || !isset($obj["phoneNumber"])){
    return false;
}


$db = OpenCon();
$statement = $db->query(
    sprintf("UPDATE user_reg SET name = %s, password = %s, email = %s, phoneNumber = %s WHERE username = %s",
    $db->real_escape_string($obj['name']), $db->real_escape_string($obj['email']), $db->real_escape_string($obj['phoneNumber']), $db->real_escape_string($obj['username']) 
    )
);
CloseCon($db);

return $statement;

}

function DeleteUser( $id ) {

if($id == null) {
    return false;
}

$db = OpenCon();

$statement = $db->query(
    sprintf("DELETE FROM user_reg WHERE username = '%s'",
    $db->real_escape_string($id)));

CloseCon($db);

if(!$statement) {
    return false;
}

return true;

}
?>