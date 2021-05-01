<?php 

include("../../private/userManagement.php");

$RequestMethod = $_SERVER["REQUEST_METHOD"];

$user = null;
$error = null;

if($RequestMethod == "GET") {
    if(isset($_GET["username"])) {
        //$user = $_GET["username"];
    } else {
        // TO DO Redirect..
    }
}

if($RequestMethod == "POST") {

    if(!isset($_GET["username"])) {
        // TO DO Redirect ..
    }

    if(CheckPassword($_GET["username"], $_POST["pass"])) {
        DeleteUser($_GET["username"]);
        // TO DO Redirect..
    }else {
        $error = "Error";
    }
}

?>

<html>

    <head>
    </head>

    <body>

        <div style="margin-left: auto; margin-right: auto; width:20%;">
            
            <div style="text-align: center; margin: 10px;">
                Confirm Password to <span style="color: RED">(DELETE ACCOUNT) </span>
            </div>
        
            <form action="" method="POST">
                
                <input type="password" style="width: 100%;" id="pass" name="pass">
                <input type="submit" style=" width:100%; margin-top: 8px;">
            </form>

            <div style="text-align: center;">
                <?php 
                    if($error == "Error") {
                        echo "Check Password";
                    }
                ?>
            </div>

        </div>

    </body>

</html>