<?php
    include("../../private/userManagement.php");


    
    include("../../templates/header.php");
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

        <table>
            <tr>
                <th>Username:</th>
                <th>Name:</th>
                <th>Email:</th>
                <th>Phone #:</th>
                <th>Delete</th>
            </tr>

           <?php


            foreach( GetUsers(null) as $val ) { 
                echo buildTableElement($val);
            }

            function buildTableElement($obj) {
                return "<tr>" .
                       "<td>" . $obj["username"] . 
                       "</td><td>" . $obj["name"] . 
                       "</td><td>" . $obj["email"] . "</td>" .
                       "<td>" . $obj["phoneNumber"] . "</td>" .
                       "<td><a href='" .  getUrl() . "/views/users/delete.php?username=" . $obj["username"] . "'> Delete</a>" .
                       "</tr>";
            }

           ?>
        </table>

    </body>

</html>