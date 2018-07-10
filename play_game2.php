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
        var hovertimer;
        var bigblockvisible = "false";  //used in check_prevent_popup (prevent if not already visible)

        function hideall_big() {
            var x = document.getElementsByClassName("bigblock");
            var i;
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            bigblockvisible = "false";
        }

        function make_big(ev, element) {
            ev.preventDefault();  //this perhaps not needed, which would remove event parameter
            hideall_big();
            if (element.id === "special_island1") {document.getElementById("bigblock1").style.display = "block";
            } else if (element.id === "special_island2") {document.getElementById("bigblock2").style.display = "block";
            } else if (element.id === "special_island3") {document.getElementById("bigblock3").style.display = "block";
            } else if (element.id === "special_island4") {document.getElementById("bigblock4").style.display = "block";
            } else if (element.id === "special_island5") {document.getElementById("bigblock5").style.display = "block";
            } else if (element.id === "special_island6") {document.getElementById("bigblock6").style.display = "block";
            } else if (element.id === "special_island7") {document.getElementById("bigblock7").style.display = "block";
            } else if (element.id === "special_island8") {document.getElementById("bigblock8").style.display = "block";
            } else if (element.id === "special_island9") {document.getElementById("bigblock9").style.display = "block";
            } else if (element.id === "special_island10") {document.getElementById("bigblock10").style.display = "block";
            } else if (element.id === "special_island11") {document.getElementById("bigblock11").style.display = "block";
            } else if (element.id === "special_island12") {document.getElementById("bigblock12").style.display = "block";}
            bigblockvisible = "true";
        }

        function drag(event) {
            //function set inside "display_pieces.php"
            event.dataTransfer.setData("placementId", event.target.getAttribute("data-placementId"));
        }

        function drop(event, element) {
            event.preventDefault();
            var placementId = event.dataTransfer.getData("placementId");
            element.appendChild(document.querySelector("[data-placementId='" + placementId + "']"));
            var newposition = event.target.getAttribute("data-positionId");
            // TODO: check validity of moves and adjust function call below inside the if
            update_piece_placement(placementId, newposition);
        }

        function allowDrop(event, element) {
            event.preventDefault();
            if (event.target.getAttribute("draggable") == "true") {
                event.dataTransfer.dropEffect = "none";  // can't drop into itself
            } else {
                event.dataTransfer.dropEffect = "all";
            }
        }

        function start_hover_timer(event, element) {
            event.preventDefault();
            clearTimeout(hovertimer);
            hovertimer = setTimeout(function() { make_big(event, element);}, 1000);
        }

        function clear_hover_timer(event, element) {
            event.preventDefault();
            clearTimeout(hovertimer);
            hovertimer = setTimeout(function() { hideall_big();}, 1000);
        }

        function check_prevent_popup(event, element) {
            event.preventDefault();
            if (bigblockvisible === "false") {
                clearTimeout(hovertimer);
            }
        }

        function update_piece_placement(placement, position) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "update_position.php?placementId=" + placement + "&positionId=" + position, true);
            xmlhttp.send();
        }

    </script>
</head>
<body onload="hideall_big()">
<!--TODO: redo the entire board in php? (maybe not)-->
<!--TODO: how to re-store / save the new positions into the database....-->
<div id="game_board" onmouseleave="hideall_big()">
    <div class="grid">
        <div class="gridblockLeftBig" ondragenter="clear_hover_timer(event, this)" onclick="hideall_big()">
            <div class="gridblockTiny" id="pos13a" data-positionId="56" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 56; include("display_pieces.php"); ?></div>
            <div class="gridblockTiny" id="pos13b" data-positionId="57" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 57; include("display_pieces.php"); ?></div>
            <div class="gridblockTiny" id="pos13c" data-positionId="58" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 58; include("display_pieces.php"); ?></div>
            <div class="gridblockTiny" id="pos13d" data-positionId="59" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 59; include("display_pieces.php"); ?></div>
<!--            <div class="gridblockTiny" id="pos13e" data-positionId="60" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 60; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos13f" data-positionId="61" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 61; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos13g" data-positionId="62" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 62; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos13h" data-positionId="63" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 63; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos13i" data-positionId="64" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 64; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos13j" data-positionId="65" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 65; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="1" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 1; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="2" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 2; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="3" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 3; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="4" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 4; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="5" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 5; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="6" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 6; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="7" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 7; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="8" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 8; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="9" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 9; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island1" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="10" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 10; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="11" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 11; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island2" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="12" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 12; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island3" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="13" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 13; include("display_pieces.php"); ?></div>
        <div class="gridblockRightBig" ondragenter="clear_hover_timer(event, this)" onclick="hideall_big()">
<!--            <div class="gridblockTiny" id="pos14a" data-positionId="66" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 66; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos14b" data-positionId="67" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 67; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos14c" data-positionId="68" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 68; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos14d" data-positionId="69" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 69; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos14e" data-positionId="70" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 70; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos14f" data-positionId="71" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 71; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos14g" data-positionId="72" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 72; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos14h" data-positionId="73" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 73; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos14i" data-positionId="74" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 74; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos14j" data-positionId="75" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 75; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div class="gridblock" data-positionId="14" ondragenter="clear_hover_timer(event, this)" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 14; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="15" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 15; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="16" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 16; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island4" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="17" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 17; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="18" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 18; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="19" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 19; include("display_pieces.php"); ?></div>
        <div class="gridblockEmptyLeft" ondragenter="clear_hover_timer(event, this)" onclick="hideall_big()"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="20" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 20; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="21" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 21; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="22" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 22; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island5" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="23" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 23; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="24" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 24; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="25" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 25; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island6" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="26" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 26; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="27" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 27; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island7" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="28" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 28; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island5" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="29" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 29; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island8" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="30" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 30; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="31" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 31; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="32" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 32; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="33" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 33; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="34" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 34; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="35" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 35; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="36" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 36; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island9" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="37" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 37; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="38" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 38; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island10" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="39" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 39; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="40" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 40; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="41" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 41; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island11" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="42" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 42; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="43" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 43; include("display_pieces.php"); ?></div>
        <div class="gridblock" id="special_island12" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event, this)" ondragenter="start_hover_timer(event, this)"></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="44" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 44; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="45" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 45; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="46" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 46; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="47" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 47; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="48" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 48; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="49" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 49; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="50" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 50; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="51" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 51; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="52" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 52; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="53" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 53; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="54" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 54; include("display_pieces.php"); ?></div>
        <div class="gridblock" ondragenter="clear_hover_timer(event, this)" data-positionId="55" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 55; include("display_pieces.php"); ?></div>
        <div id="bigblock1" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
            <div class="gridblockTiny" id="pos1a" data-positionId="76" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 76; include("display_pieces.php"); ?></div>
            <div class="gridblockTiny" id="pos1b" data-positionId="77" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)"><?php $positionId = 77; include("display_pieces.php"); ?></div>
<!--            <div class="gridblockTiny" id="pos1c" data-positionId="78" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 78; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos1d" data-positionId="79" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 79; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock2" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos2a" data-positionId="80" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 80; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos2b" data-positionId="81" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 81; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos2c" data-positionId="82" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 82; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos2d" data-positionId="83" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 83; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock3" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos3a" data-positionId="84" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 84; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos3b" data-positionId="85" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 85; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos3c" data-positionId="86" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 86; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock4" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos4a" data-positionId="87" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 87; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos4b" data-positionId="88" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 88; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos4c" data-positionId="89" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 89; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos4d" data-positionId="90" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 90; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock5" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos5a" data-positionId="91" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 91; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos5b" data-positionId="92" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 92; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos5c" data-positionId="93" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 93; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos5d" data-positionId="94" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 94; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock6" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos6a" data-positionId="95" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 95; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos6b" data-positionId="96" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 96; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos6c" data-positionId="97" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 97; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock7" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos7a" data-positionId="98" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 98; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos7b" data-positionId="99" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 99; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos7c" data-positionId="100" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 100; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock8" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos8a" data-positionId="101" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 101; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos8b" data-positionId="102" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 102; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos8c" data-positionId="103" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 103; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock9" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos9a" data-positionId="104" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 104; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos9b" data-positionId="105" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 105; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos9c" data-positionId="106" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 106; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos9d" data-positionId="107" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 107; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock10" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos10a" data-positionId="108" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 108; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos10b" data-positionId="109" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 109; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos10c" data-positionId="110" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 110; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos10d" data-positionId="111" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 111; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock11" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos11a" data-positionId="112" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 112; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos11b" data-positionId="113" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 113; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos11c" data-positionId="114" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 114; include("display_pieces.php"); ?><!--</div>-->
        </div>
        <div id="bigblock12" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
<!--            <div class="gridblockTiny" id="pos12a" data-positionId="115" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 115; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos12b" data-positionId="116" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 116; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos12c" data-positionId="117" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 117; include("display_pieces.php"); ?><!--</div>-->
<!--            <div class="gridblockTiny" id="pos12d" data-positionId="118" onclick="hideall_big()" ondragover="allowDrop(event, this)" ondrop="drop(event, this)">--><?php //$positionId = 118; include("display_pieces.php"); ?><!--</div>-->
        </div>
    </div>
</div>

</body>
</html>