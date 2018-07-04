<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Login to Island Rush</title>
    <link rel="stylesheet" type="text/css" href="style_welcome.css">
    <script>
        var time_to_wait = 1000;
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
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("coolnew_id").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "event_handler.php?button=" + button_value, true);
            xmlhttp.send();
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


<button id="coolnew_id" onclick="clearTimeout(intUpdate); cool_function(document.getElementById('coolnew_id').innerHTML)">Loading...</button>


</body>

</html>


