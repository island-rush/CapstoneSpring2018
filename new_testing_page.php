<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Login to Island Rush</title>
    <link rel="stylesheet" type="text/css" href="style_welcome.css">
    <script>
        var intUpdate;

        intUpdate=window.setTimeout("cool_function()", 1000);

        function cool_function() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("coolnew_id").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "event_handler.php?question=life&answer=42", true);
            xmlhttp.send();
            intUpdate=window.setTimeout("cool_function()", 1000);
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

<button onclick="cool_function()"><span id="coolnew_id">DEFAULT VALUE</span></button>


</body>

</html>


