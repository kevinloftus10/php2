<?php 
include("connect.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

// Create User 
if($RequestMethod == "POST") {
    echo "Posted!";
}

// Get the User(s)
if($RequestMethod == "GET") {
    
}

// Update User
if($RequestMethod == "UPDATE") {

}

// Delete User
if($RequestMethod == "DELETE") {

}



?>