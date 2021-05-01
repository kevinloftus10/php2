<?php 
    $error = null;

    $RequestMethod = $_SERVER["REQUEST_METHOD"];
	
	if($RequestMethod == "POST") {
		include("../../private/userManagement.php");
        
        $obj = [];
        $obj['username'] = $_POST["username"];
        $obj['name'] = $_POST['name'];
        $obj['password'] = $_POST['password'];
        $obj['email'] = $_POST['email'];
        $obj['phoneNumber'] = $_POST['phoneNumber'];

        if(SignUp($obj)) {
            $error = false;
        }else {
            $error = true;
        }
	}

    include ("../../templates/header.php");
?>

<html>

    <head>

    <style>
        td {
            padding: 8px;
        }
    </style>

    </head>

    <body>

    <form action="" method="POST">

    <table>
        <tr>
            <th>Create a User:</th>
            <th></th>
        </tr>
        
        <tr>
            <td>Username:</td>
            <td><input type="input" id="username" name="username"></td>
        </tr>
        
        <tr>
            <td>Name:</td>
            <td><input type="input" id="name" name="name"></td>
        </tr>

        <tr>
            <td>Password:</td>
            <td><input type="input" id="password" name="password"></td>
        </tr>

        <tr>
            <td>Email:</td>
            <td><input type="input" id="email" name="email"></td>
        </tr>

        <tr>
            <td>Phone Number:</td>
            <td><input type="input" id="phoneNumber" name="phoneNumber"></td>
        </tr>
    </table>

    <input type="submit">
    </form>

    <?php

        if($error) {
            echo "<strong>Please check your room number</strong>";
        }

    ?>

    </body>


</html>