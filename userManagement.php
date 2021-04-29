<?php 
include("connect.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

// Create User 
if($RequestMethod == "PUT") {
    echo "Posted!";
}

// Get the User(s)
if($RequestMethod == "GET") {
    if(isset($_GET['username'])) {
        echo json_encode(GetUsers($_GET['username']));
    }else {
        echo json_encode(GetUsers(null));
    }
}

// Update User
if($RequestMethod == "POST") {

}

// Delete User
if($RequestMethod == "DELETE") {

}

function SignUp( $obj ) {

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

}

function DeleteUser( $id ) {
    
}

?>