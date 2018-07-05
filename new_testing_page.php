<?php
    session_start();
    $gameId = $_SESSION['gameId'];
    $team = $_SESSION['team'];

    $query = 'SELECT * FROM games WHERE gameId = '.$gameId;
    $query = $db->prepare($query);
    $query->execute();
    $results = $query->get_result();
    $r= $results->fetch_assoc();
    $gameTurn = $r['gameTurn'];
    $gamePhase = $r['gamePhase']
    //check if database knows player has joined
    //tell database that this team has joined (gameBlueJoined = 1)
    //check if both players are joined
    //display board based upon the gameId?(loading page or all ajax?)
    //do logic based upon the turn of the game
    //javascript to check moves?
        //or something else to check game logic....
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Login to Island Rush</title>
    <link rel="stylesheet" type="text/css" href="style_welcome.css">
    <script>
        var time_to_wait = 250;
        var intUpdate;
        intUpdate=window.setTimeout("check_for_update()", time_to_wait);

        function check_for_update() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    var response = this.responseText;
                    if (response == "update") {
                        cool_function();
                    }
                }
            };
            xmlhttp.open("GET", "event_handler_2.php", true);
            xmlhttp.send();
            intUpdate=window.setTimeout("check_for_update()", time_to_wait);
        }

        function cool_function(button_value) {
            clearTimeout(intUpdate);
            var xmlhttp2 = new XMLHttpRequest();
            xmlhttp2.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("coolnew_id").innerHTML = this.responseText;
                }
            };
            xmlhttp2.open("GET", "event_handler.php?button=" + button_value, true);
            xmlhttp2.send();
            intUpdate=window.setTimeout("check_for_update()", time_to_wait);
        }
    </script>
</head>

<body>
<h1>Island Rush</h1>
<nav>
    <a href="./home.html">Home</a>
    <a class="active" href="./game_login.php">Play the Game</a>
    <a href="new_testing_page.php">Testing Spencer's Shit</a>
    <a style="float:right" href="./admin_login.php">Admin</a>
</nav>


<button id="coolnew_id" onclick="cool_function(document.getElementById('coolnew_id').innerHTML)">Loading...</button>


</body>

</html>


