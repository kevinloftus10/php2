<?php 
include("../private/userManagement.php");

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

    if(!isset($_GET["id"])) {
        echo "Error!";
        return;
    }

    echo DeleteUser($_GET["id"]);

}

?>