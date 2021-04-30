<?php 
    $error = null;

    $RequestMethod = $_SERVER["REQUEST_METHOD"];
	
	if($RequestMethod == "POST") {
		include("../../private/roomManagement.php");
        
        $obj = [];
        $obj['room_number'] = $_POST["room_num"];
        $obj['location'] = $_POST['location'];
        $obj['capacity'] = $_POST['capacity'];

        if(CreateRoom($obj)) {
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

    <label for="room">Create a conference room:</label>
</br>

    <label for="room_num">Room Number:</label>
    <input type="input" id="room_num" name="room_num">
</br>
    <label for="location">Room Location:</label>
    <input type="input" id="location" name="location">
</br>
    <label for="capacity">Room Capacity:</label>
    <input type="input" id="capacity" name="capacity">


    <input type="submit">
    </form>

    <?php

        if($error) {
            echo "<strong>Please check your room number</strong>";
        }

    ?>

    </body>


</html>