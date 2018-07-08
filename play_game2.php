<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Main Game Title</title>
    <link rel="stylesheet" type="text/css" href="style_board2.css">
    <script type="text/javascript">
        function hideall_big() {
            var x = document.getElementsByClassName("bigblock");
            var i;
            for (i = 0; i < x.length; i++) {
                x[i].style.visibility = "hidden";
            }
        }

        function make_big(ev, element) {
            ev.preventDefault();
            hideall_big();
            if (element.id == "special_island10") {
                document.getElementById("bigblock10").style.visibility = "visible";
            }
        }
    </script>
</head>
<body>

<div id="game_board">
    <div class="grid">
        <div class="gridblockLeftBig" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" id="special_island1" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblockRightBig" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblockEmptyLeft" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" id="special_island10" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock2" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div id="bigblock1" class="bigblock"></div>
        <div id="bigblock2" class="bigblock"></div>
        <div id="bigblock3" class="bigblock"></div>
        <div id="bigblock4" class="bigblock"></div>
        <div id="bigblock5" class="bigblock"></div>
        <div id="bigblock6" class="bigblock"></div>
        <div id="bigblock7" class="bigblock"></div>
        <div id="bigblock8" class="bigblock"></div>
        <div id="bigblock9" class="bigblock"></div>
        <div id="bigblock10" class="bigblock"></div>
        <div id="bigblock11" class="bigblock"></div>
        <div id="bigblock12" class="bigblock"></div>
    </div>
</div>

</body>
</html>