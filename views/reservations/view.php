<?php

    include("../../private/reservationManagement.php");

?>
<html>

    <head>
    </head>

    <body>

    <a href="../rooms/add.php">Add conference room</a>
    <a href="./add.php">Add reservation</a>

    <div id="schedule">

        <?php
            $reservations = GetReservations(null);

            
        ?>

    </div>


    </body>

</html>

