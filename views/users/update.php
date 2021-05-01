<?php 
    include("../../private/userManagement.php");
    include("../../templates/header.php");
      
    $error = null;
    
    $RequestMethod = $_SERVER["REQUEST_METHOD"];
	
    $user = GetUsers($_GET["username"]);

    if($user == null) {
        exit();
    }

	if($RequestMethod == "POST") {

        if(!isset($_POST["pass"])) {
            //TODO 
        }

        if(CheckPassword($_GET["username"], $_POST["pass"])) {
            $obj = [];
            $obj['username'] = $_GET["username"];
            $obj['name'] = $_POST['name'];
            $obj['email'] = $_POST['email'];
            $obj['password'] = $_POST['pass'];
            $obj['phoneNumber'] = $_POST['phoneNumber'];

            if(UpdateUser($obj)) {
                header( "Location: " . getUrl() . "views/users/view.php" );
            }else {
                $error = true;
            }

        }else {
            $error = true;
        }   
	}
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
            <th>Update:</th>
            <th></th>
        </tr>
        
        <tr>
            <td>Name:</td>
            <td><input type="input" id="name" name="name" value='<?php echo $user[0]['name']; ?>'></td>
        </tr>

        <tr>
            <td>Email:</td>
            <td><input type="input" id="email" name="email" value='<?php echo $user[0]['email']; ?>'></td>
        </tr>

        <tr>
            <td>Phone Number:</td>
            <td><input type="input" id="phoneNumber" name="phoneNumber" value='<?php echo $user[0]['phoneNumber']; ?>' ></td>
        </tr>
        
        <tr>
            <td>Current Password:</td>
            <td><input type="password" id="pass" name="pass" value="example"></td>
        </tr>
        
    </table>

    <input type="submit">
    </form>

    <?php

        if($error) {
            echo "<strong>Error, please check fields</strong>";
        }

    ?>

    </body>


</html>