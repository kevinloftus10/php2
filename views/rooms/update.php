<?php 
    $error = null;
	
    include("../../private/roomManagement.php");
    include("../../templates/header.php");

    $room = GetRoom($_GET["roomId"]);

    $RequestMethod = $_SERVER["REQUEST_METHOD"];
	
	if($RequestMethod == "POST") {
        include("../../private/reservationManagement.php");

        $obj = [];
        $obj['room_number'] = $_POST["room_num"];
        $obj['location'] = $_POST['location'];
        $obj['capacity'] = $_POST['capacity'];

        if(UpdateRoom($obj)) {
            header("Location: " . getUrl() . "views/rooms/view.php");       
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
    <input type="input" id="room_num" name="room_num" value='<?php echo $room[0]["room_number"]; ?>'>
</br>
    <label for="location">Room Location:</label>
    <input type="input" id="location" name="location" value='<?php echo $room[0]["location"]; ?>'>
</br>
    <label for="capacity">Room Capacity:</label>
    <input type="input" id="capacity" name="capacity" value='<?php echo $room[0]["capacity"]; ?>'>

</br>
    <input type="submit">
    </form>

    <?php

        if($error) {
            echo "<strong>Please confirm fields</strong>";
        }

    ?>

    </body>


</html>