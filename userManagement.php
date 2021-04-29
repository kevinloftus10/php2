<?php 
include("connect.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

// Create User 
if($RequestMethod == "PUT") {

    parse_str(file_get_contents("php://input"),$post_vars);

    if( !isset($post_vars["username"]) || !isset($post_vars["name"]) || !isset($post_vars["password"]) || !isset($post_vars["email"]) || !isset($post_vars["phoneNumber"])){
        return;
    }

    $obj = [];
    $obj["username"] = $post_vars["username"];
    $obj["name"] = $post_vars["name"];
    $obj["password"] = $post_vars["password"];
    $obj["email"] = $post_vars["email"];
    $obj["phoneNumber"] = $post_vars["phoneNumber"];

    echo SignUp($obj);


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

    if( !isset($_POST["username"]) || !isset($_POST["name"]) || !isset($_POST["password"]) || !isset($_POST["email"]) || !isset($_POST["phoneNumber"])){
        return;
    }
    
    $obj = [];
    $obj["username"] = $_POST["username"];
    $obj["name"] = $_POST["name"];
    $obj["password"] = $_POST["password"];
    $obj["email"] = $_POST["email"];
    $obj["phoneNumber"] = $_POST["phoneNumber"];

    echo UpdateUser($obj);

}

// Delete User
if($RequestMethod == "DELETE") {

}

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
        echo "<p>User information submitted successfully!</p>";
        return true;
    } else {
        echo "<p>An error has occured. <br / Please try again later.</p>";
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
        sprintf("UPDATE user_reg SET name = '%s', password = %s, email = %s, phoneNumber = %s WHERE username = %s",
        $db->real_escape_string($obj['name']), $db->real_escape_string($obj['email']), $db->real_escape_string($obj['phoneNumber']), $db->real_escape_string($obj['username']) 
        )
    );
    CloseCon($db);

    return $statement;

}

function DeleteUser( $id ) {
    
}

?>