<?php
    session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Testing Title</title>
    <link rel="stylesheet" type="text/css" href="style_welcome.css">
    <script>
        var time_to_wait = 250;
        var intUpdate;
        var gameId = <?php echo '"'.$_SESSION['gameId'].'"'; ?>;
        var team = <?php echo '"'.$_SESSION['team'].'"'; ?>;
        
        intUpdate=window.setTimeout("keep_waiting()", time_to_wait);

        function keep_waiting() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    var response = this.responseText;
                    if (response == "start_game") {
                        clearTimeout(intUpdate);
                        start_game();
                    }
                }
            };
            xmlhttp.open("GET", "player_synch.php?gameId=" + gameId + "&team=" + team, true);
            xmlhttp.send();
            intUpdate=window.setTimeout("keep_waiting()", time_to_wait);
        }

        function start_game() {
            window.open("phase_movetroops.php", "_self")
        }
    </script>
</head>

<body onload="keep_waiting()">
<h1>Island Rush Loading Pages</h1>
<nav>
    <a href="./home.php">Home</a>
    <a class="active" href="./game_login.php">Play the Game</a>
    <a style="float:right" href="./admin_login.php">Admin</a>
</nav>
</body>

</html>


