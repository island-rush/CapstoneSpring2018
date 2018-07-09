<?php
session_start();
include("db.php");
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
            // TODO: make this better with taking out numbers...you know...parallel fucking shit
            if (element.id === "special_island1") {
                document.getElementById("bigblock1").style.visibility = "visible";
            } else if (element.id === "special_island2") {
                document.getElementById("bigblock2").style.visibility = "visible";
            } else if (element.id === "special_island3") {
                document.getElementById("bigblock3").style.visibility = "visible";
            } else if (element.id === "special_island4") {
                document.getElementById("bigblock4").style.visibility = "visible";
            } else if (element.id === "special_island5") {
                document.getElementById("bigblock5").style.visibility = "visible";
            } else if (element.id === "special_island6") {
                document.getElementById("bigblock6").style.visibility = "visible";
            } else if (element.id === "special_island7") {
                document.getElementById("bigblock7").style.visibility = "visible";
            } else if (element.id === "special_island8") {
                document.getElementById("bigblock8").style.visibility = "visible";
            } else if (element.id === "special_island9") {
                document.getElementById("bigblock9").style.visibility = "visible";
            } else if (element.id === "special_island10") {
                document.getElementById("bigblock10").style.visibility = "visible";
            } else if (element.id === "special_island11") {
                document.getElementById("bigblock11").style.visibility = "visible";
            } else if (element.id === "special_island12") {
                document.getElementById("bigblock12").style.visibility = "visible";
            }
        }

        function drag(event) {
            event.dataTransfer.setData("placementId", event.target.getAttribute("data-placementId"));
        }

        function drop(event, element) {
            event.preventDefault();
            var placementId = event.dataTransfer.getData("placementId");
            element.appendChild(document.querySelector("[data-placementId='" + placementId + "']"));
            var newposition = event.target.getAttribute("data-positionId");

            //check valid move here, and if it is valid, update_piece_placement
            // TODO: check validity of moves and adjust function call below inside the if

            update_piece_placement(placementId, newposition);

            //do stuff for database updating
            //have the placementid from data?
            //have the new positionid from the target?
        }

        function allowDrop(event) {
            event.preventDefault();
        }

        function update_piece_placement(placement, position) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "update_position.php?placementId=" + placement + "&positionId=" + position, true);
            xmlhttp.send();
        }

    </script>
</head>
<body>
<!--TODO: redo the entire board in php? (maybe not)-->
<!--TODO: how to re-store / save the new positions into the database....-->
<div id="game_board" onmouseleave="hideall_big()">
    <div class="grid">
        <div class="gridblockLeftBig" onclick="hideall_big()">
            <?php $special_island = 13; include("display_pieces.php"); ?>
        </div>
        <div class="gridblock" data-positionId="1" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">
            <?php $positionId = 1; include("display_pieces.php"); ?>
        </div>
        <div class="gridblock" data-positionId="2" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">
            <?php $positionId = 2; include("display_pieces.php"); ?>
        </div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island1" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island2" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island3" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblockRightBig" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island4" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblockEmptyLeft" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island5" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island6" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island7" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island5" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island8" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island9" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island10" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island11" onclick="make_big(event, this)"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" onclick="hideall_big()"></div>
        <div class="gridblock" id="special_island12" onclick="make_big(event, this)"></div>
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
        <div id="bigblock1" class="bigblock bigblock3x3"></div>
        <div id="bigblock2" class="bigblock bigblock3x3"></div>
        <div id="bigblock3" class="bigblock bigblock3x3"></div>
        <div id="bigblock4" class="bigblock bigblock3x3"></div>
        <div id="bigblock5" class="bigblock"></div>
        <div id="bigblock6" class="bigblock bigblock3x3"></div>
        <div id="bigblock7" class="bigblock bigblock3x3"></div>
        <div id="bigblock8" class="bigblock bigblock3x3"></div>
        <div id="bigblock9" class="bigblock bigblock3x3"></div>
        <div id="bigblock10" class="bigblock bigblock3x3"></div>
        <div id="bigblock11" class="bigblock bigblock3x3"></div>
        <div id="bigblock12" class="bigblock bigblock3x3"></div>
    </div>
</div>

</body>
</html>