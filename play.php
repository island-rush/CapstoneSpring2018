<!-- play.php is the primary page for playing the game   -->
<!-- Created by Jack Kulp and Chris Darcy, May 2018   -->
<?php
 header("location:phase_movetroops.php")
    // retrieve session information
    session_start();

    // // verify gameId and team are set
    // if(!isset($_SESSION['team']) || !isset($_SESSION['gameId'])){
    //     header("location:home.html?err=4");
    //     exit;
    // }

    // $team = (isset($_SESSION['team']))?$_SESSION['team']:'';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Island Rush - Play</title>
    <link rel="stylesheet" type="text/css" href="style_welcome.css">
</head>
<body>
    <h2>Waiting For Other Player</h2>
    <p> This is a loading screen to wait for two players to connect to the same game</p>
    <a href="home.html">To return back to the home screen</a>
    
</body>
</html>