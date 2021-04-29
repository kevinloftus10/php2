<?php 
include("connect.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

// Create User 
if($RequestMethod == "PUT") {
    echo "Posted!";
}

// Get the User(s)
if($RequestMethod == "GET") {
    
}

// Update User
if($RequestMethod == "POST") {

}

// Delete User
if($RequestMethod == "DELETE") {

}

function SignUp( $obj ) {

}

function GetUsers() {

}

function UpdateUser( $obj ) {

}

function DeleteUser( $id ) {
    
}

?>