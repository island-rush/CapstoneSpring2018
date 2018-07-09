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
            ev.preventDefault();  //this perhaps not needed, which would remove event parameter
            hideall_big();
            if (element.id === "special_island1") {document.getElementById("bigblock1").style.visibility = "visible";
            } else if (element.id === "special_island2") {document.getElementById("bigblock2").style.visibility = "visible";
            } else if (element.id === "special_island3") {document.getElementById("bigblock3").style.visibility = "visible";
            } else if (element.id === "special_island4") {document.getElementById("bigblock4").style.visibility = "visible";
            } else if (element.id === "special_island5") {document.getElementById("bigblock5").style.visibility = "visible";
            } else if (element.id === "special_island6") {document.getElementById("bigblock6").style.visibility = "visible";
            } else if (element.id === "special_island7") {document.getElementById("bigblock7").style.visibility = "visible";
            } else if (element.id === "special_island8") {document.getElementById("bigblock8").style.visibility = "visible";
            } else if (element.id === "special_island9") {document.getElementById("bigblock9").style.visibility = "visible";
            } else if (element.id === "special_island10") {document.getElementById("bigblock10").style.visibility = "visible";
            } else if (element.id === "special_island11") {document.getElementById("bigblock11").style.visibility = "visible";
            } else if (element.id === "special_island12") {document.getElementById("bigblock12").style.visibility = "visible";}
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
            if (event.target.getAttribute("draggable") == "true") {
                event.dataTransfer.dropEffect = "none";  // can't drop into itself
            } else {
                event.dataTransfer.dropEffect = "all";
            }
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
        <div class="gridblock" data-positionId="1" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 1; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="2" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 2; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="3" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 3; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="4" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 4; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="5" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 5; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="6" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 6; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="7" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 7; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="8" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 8; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="9" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 9; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island1" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="10" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 10; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="11" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 11; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island2" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="12" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 12; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island3" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="13" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 13; include("display_pieces.php"); ?></div>
        <div class="gridblockRightBig" onclick="hideall_big()">
            <?php $special_island = 13; include("display_pieces.php"); ?>
        </div>
        <div class="gridblock" data-positionId="14" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 14; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="15" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 15; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="16" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 16; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island4" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="17" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 17; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="18" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 18; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="19" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 19; include("display_pieces.php"); ?></div>
        <div class="gridblockEmptyLeft" onclick="hideall_big()"></div>
        <div class="gridblock" data-positionId="20" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 20; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="21" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 21; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="22" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 22; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island5" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="23" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 23; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="24" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 24; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="25" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 25; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island6" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="26" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 26; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="27" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 27; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island7" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="28" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 28; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island5" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="29" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 29; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island8" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="30" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 30; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="31" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 31; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="32" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 32; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="33" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 33; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="34" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 34; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="35" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 35; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="36" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 36; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island9" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="37" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 37; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="38" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 38; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island10" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="39" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 39; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="40" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 40; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="41" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 41; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island11" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="42" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 42; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="43" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 43; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island12" onclick="make_big(event, this)"></div>
        <div class="gridblock" data-positionId="44" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 44; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="45" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 45; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="46" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 46; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="47" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 47; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="48" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 48; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="49" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 49; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="50" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 50; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="51" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 51; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="52" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 52; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="53" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 53; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="54" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 54; include("display_pieces.php"); ?></div>
        <div class="gridblock" data-positionId="55" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 55; include("display_pieces.php"); ?></div>
        <div id="bigblock1" class="bigblock bigblock3x3"></div>
        <div id="bigblock2" class="bigblock bigblock3x3"></div>
        <div id="bigblock3" class="bigblock bigblock3x3"></div>
        <div id="bigblock4" class="bigblock bigblock3x3"></div>
        <div id="bigblock5" class="bigblock bigblock3x3"></div>
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