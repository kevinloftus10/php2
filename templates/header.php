<?php



function getUrl() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . "/Github/php2/";

}

?>

<html>

    <style>
        body {
            margin: 0px;
            padding: 0px;
            font-family: sans-serif;
        }

        nav{
            background-color: grey;
        }
        nav ul {
            padding: 0;
            margin: 0;
            margin-left: 10px;
            list-style: none;
            position: relative;
        }
        nav ul li{
            display: inline-block;
            background-color: grey;
        }
        nav a{
            display: block;
            padding: 0 10px;
            color: #fff;
            line-height: 60px;
            font-size: 20px;
            text-decoration: none;
        }
        
        nav ul ul {
            display: none;
            position: absolute;
            top: 60px;
        }
        
        nav a:hover{
            background-color: #000000;
        }
        
        nav ul li:hover > ul {
            display: inherit;
        }
        
        nav ul ul li{
            width: 170px;
            float: none;
            display: list-item;
            position: relative;
        
        }
        
        nav ul ul ul li {
            position: relative;
            top: -60px;
            left: 170px;
        }
        
        li > a::after { content: '...';}
        li > a:only-child::after {
            content: '';
        }

        #hContainer {

            margin-bottom: 60px;

        }

    </style>

<head>

</head>

<body>

    <div id="hContainer">

        <nav>
            <ul>
                <li><a href="<?php echo getUrl() . "views/reservations/view.php"; ?>">Reservations</a>

                </li>

                <li><a href="<?php echo getUrl() . "views/rooms/view.php"; ?>">Rooms</a>

                </li>

                <li><a href="<?php echo getUrl() . "views/users/view.php"; ?>">Users</a>


                </li>

            </ul>

        </nav>
    </div>

    <div style ="width: 90%;margin-left: auto;margin-right: auto;"