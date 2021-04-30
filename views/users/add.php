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
?>

<html>

    <head>

    </head>

    <body>

    <form action="" method="POST">

    <label for="room">Create a User:</label>
</br>

    <label for="username">Username:</label>
    <input type="input" id="username" name="username">
</br>
    <label for="name">Name:</label>
    <input type="input" id="name" name="name">
</br>
    <label for="password">Password:</label>
    <input type="input" id="password" name="password">
</br>
    <label for="email">Email:</label>
    <input type="input" id="email" name="email">
</br>
    <label for="phoneNumber">Phone Number:</label>
    <input type="input" id="phoneNumber" name="phoneNumber">


    <input type="submit">
    </form>

    <?php

        if($error) {
            echo "<strong>Please check your room number</strong>";
        }elseif(!$error){
            // window.location = next page
            header('Location: https://www.google.com');
        } 

    ?>

    </body>


</html>