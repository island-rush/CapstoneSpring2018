<?php
session_start();
include("db.php");
include("readexcel.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style_board2.css">
    <script type="text/javascript">
        var hovertimer;
        var bigblockvisible = "true";  //used in check_prevent_popup (prevent if not already visible)
        var skip = "no";
        var skipclear = 2; //2 is don't skip, 3 is skip TODO: change these and other weird shit
        var skipdrop1 = 8; //8 is don't skip, 4 is skip

        var unitsMoves = <?php include("unit_moves.php"); ?>;

        function hideall_big() {
            clearTimeout(hovertimer);
            if (bigblockvisible === "true" && skip === "no") {
                var x = document.getElementsByClassName("bigblock");
                var i;
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }

                var y = document.getElementsByClassName("transportContainer");
                var z;
                for (z = 0; z < y.length; z++) {
                    y[z].style.display = "none";
                    //TODO: make sure the zIndex is good, (default value matches this...etc)
                    y[z].style.zIndex = 25;
                }

                bigblockvisible = "false";
            }
            skip = "no";
        }

        //TODO: make this the main make_big function, and put bigblocks within the special islands?
        function make_visible(ev, element, num) {
            ev.preventDefault();
            hideall_big();
            element.firstElementChild.style.display = "block";
            element.style.zIndex = 100;
            element.firstElementChild.style.zIndex = 200;
            //make all of the children higher index?
            // var children = element.childNodes;
            // var x;
            // for (x = 0; x < children.length; x++) {
            //     children[x].style.zIndex = 150;
            // }



            bigblockvisible = "true";
            if (num === 4) {
                skip = "no";
            } else {
                skip = "yes";
            }
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
            event.dataTransfer.setData("positionId", event.target.parentNode.getAttribute("data-positionId"));
            event.dataTransfer.setData("oldtrans", event.target.getAttribute("data-trans"));
            event.dataTransfer.setData("moves", event.target.getAttribute("data-moves"));
        }

        function drop(event, element) {
            //TODO: check that it isn't a full spot (limit number of pieces in a square (4 or 9 for squareness simplicity)
            event.preventDefault();
            if (skipdrop1 === 8) {
                var placementId = event.dataTransfer.getData("placementId");
                var newPos = event.target.getAttribute("data-positionId");
                var oldPos = event.dataTransfer.getData("positionId");
                var moves = event.dataTransfer.getData("moves");
                var oldtrans = event.dataTransfer.getData("oldtrans");
                var newtrans = 999999;  //still null because not dropped into a container
                // TODO: check validity of moves and adjust ajax php function call below inside the if
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        var answer = this.responseText;
                        if (answer !== "false") {
                            var xmlhttp2 = new XMLHttpRequest();
                            //TODO: This may be good as GET instead of POST
                            // alert(placementId);
                            // alert(newPos);
                            // alert(oldPos);
                            // alert(moves);
                            // alert(oldtrans);
                            // alert(newtrans);
                            xmlhttp2.open("POST", "update_position.php?placementId=" + placementId + "&newPos=" + newPos + "&oldPos=" + oldPos + "&newmoves=" + answer + "&oldtrans=" + oldtrans + "&newtrans=" + newtrans, true);
                            xmlhttp2.send();
                            element.appendChild(document.querySelector("[data-placementId='" + placementId + "']"));
                            document.querySelector("[data-placementId='" + placementId + "']").setAttribute("data-moves", answer);
                            //if transport, update data-positionId of container (its only child)
                            var gamepiece = document.querySelector("[data-placementId='" + placementId + "']");
                            var unitName = gamepiece.getAttribute("data-unitName");
                            if (unitName === "transport") {
                                gamepiece.firstChild.setAttribute("data-containerPos", element.getAttribute("data-positionId"));
                            }
                        }
                    }
                };
                xmlhttp.open("POST", "checkvalid.php?newPos=" + newPos + "&oldPos=" + oldPos + "&moves=" + moves, true);
                xmlhttp.send();
            }
            skipdrop1 = 8;
        }

        // TODO: make drop1 and drop2 the same, only difference now is the newtrans doesnt get set to null (and appending?)
        function drop2(event, element) {
            event.preventDefault();
            var placementId = event.dataTransfer.getData("placementId"); //piece that moved
            // var transportPiece = event.target.parentNode;
            var newPos =  event.target.parentNode.parentNode.getAttribute("data-positionId"); //where is it moving to (get from the parent?)(getting from grid)
            var oldPos = event.dataTransfer.getData("positionId"); //where did it move from (put this into the movement for undo)
            var moves = event.dataTransfer.getData("moves");  //moves left for the piece (same)
            var oldtrans = event.dataTransfer.getData("oldtrans");  //oldtrans that was on it (put this into the movement for undo)
            var newtrans = event.target.parentNode.getAttribute("data-placementId");  //what to set inside the placement of moved piece (as new trans)

            //movement has the placementId (of piece), oldPosition, oldTransId, moves, placementId (of trans)

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    var answer = this.responseText;
                    if (answer !== "false") {
                        var xmlhttp2 = new XMLHttpRequest();
                        //TODO: This may be good as GET instead of POST
                        xmlhttp2.open("POST", "update_position.php?placementId=" + placementId + "&newPos=" + newPos + "&oldPos=" + oldPos + "&newmoves=" + answer + "&oldtrans=" + oldtrans + "&newtrans=" + newtrans, true);
                        xmlhttp2.send();
                        element.appendChild(document.querySelector("[data-placementId='" + placementId + "']"));
                        document.querySelector("[data-placementId='" + placementId + "']").setAttribute("data-moves", answer);
                        document.querySelector("[data-placementId='" + placementId + "']").setAttribute("data-trans", newtrans);
                    }
                }
            };
            xmlhttp.open("POST", "checkvalid.php?newPos=" + newPos + "&oldPos=" + oldPos + "&moves=" + moves, true);
            xmlhttp.send();

            //ajax request to the checkvalid.php?newPos..oldpos...moves...
            //if valid move
                //ajax to update_position with placementId of troop, newpos/oldpos, newmoves, and new transportId/old tranportId?
                //document append the troop to the container within the transport (it has the transport id)(from event?)
        }

        // function reset_moves() {
        //     var copyUnitsMoves = unitsMoves;
        //     var allpieces = document.getElementsByClassName("gamepiece");
        //     // alert(allpieces);
        //     var i;
        //     for (i = 0; i < allpieces.length; i++) {
        //         var unitName = allpieces[i].getAttribute("data-unitName");
        //         // alert(copyUnitsMoves[unitName]);
        //         allpieces[i].setAttribute("data-moves", copyUnitsMoves[unitName]);
        //     }
        //     // alert("gothere,hellow");
        //     //TODO: reset in the database as well? (is this functionality even needed / button needed?) (undo does this)
        //     //reset in the database as well...
        //     //ajax to php file here
        // }

        function allowDrop(event) {
            event.preventDefault();
            if (event.target.getAttribute("draggable") == "true") {
                event.dataTransfer.dropEffect = "none";  // can't drop into itself...need to learn more about how this works (could break things?...since idk)
            } else {
                event.dataTransfer.dropEffect = "all";
            }
        }

        function start_hover_timer(event, element) {
            event.preventDefault();
            clearTimeout(hovertimer);
            hovertimer = setTimeout(function() { make_big(event, element);}, 1000);
        }

        function start_hover_timer2(event, element) {
            event.preventDefault();
            // alert("dragged over");
            clearTimeout(hovertimer);
            hovertimer = setTimeout(function() {make_visible(event, element, 4)}, 1000);
        }

        // TODO: may make one of these functions island depended, so doesnt reset each time when enter 2 seperate special islands waiting for 3rd to close
        function clear_hover_timer(event) {
            event.preventDefault();
            if (skipclear === 2) {
                clearTimeout(hovertimer);
                hovertimer = setTimeout(function() { hideall_big();}, 1000);
            }
            skipclear = 2;
        }

        function check_prevent_popup(event) {
            event.preventDefault();
            if (bigblockvisible === "false") {
                clearTimeout(hovertimer);
            }
        }

        function create_piece_placement(event) {
            event.preventDefault();
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    var response = this.responseText;
                    var parent = document.querySelector("[data-positionId='119']");
                    parent.innerHTML += response;
                }
            };
            xmlhttp.open("GET", "place_newpiece.php", true);
            xmlhttp.send();
        }

        //TODO: this only called once, possibly just move this into the call itself on the body
        function hidecover(event) {
            //this messes it up? (not sure why, but don't need it for now...not testing cross browser stuff)
            // event.preventDefault();
            document.getElementById("cover").style.visibility = "hidden"
        }

        function throwaway(event, trashbox) {
            //TODO: doesn't handle pieces within the transport and shit, or it might...idk no testing has happened
            event.preventDefault();
            //TODO: add logic to not throw away pieces already placed onto the board...(undo for those...)(check event/add more details to event if needed)
            var placementId = event.dataTransfer.getData("placementId");
            var xmlhttp = new XMLHttpRequest();
            //TODO: This may be good as GET instead of POST
            xmlhttp.open("POST", "delete_piece.php?placementId=" + placementId, true);
            xmlhttp.send();
            //TODO: there are better ways of deleting elements from html... (try to get it on 1 line)
            trashbox.appendChild(document.querySelector("[data-placementId='" + placementId + "']"));
            trashbox.removeChild(document.querySelector("[data-placementId='" + placementId + "']"));
        }

        function undo_movement(event) {
            event.preventDefault();
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    var decoded = JSON.parse(this.responseText);
                    var gamepiece = document.querySelector("[data-placementId='" + decoded.placementId + "']");
                    var move2 = parseInt(gamepiece.getAttribute("data-moves"));
                    var update_move = move2 + decoded.movementCost;
                    gamepiece.setAttribute("data-moves", update_move);
                    var fromtrans = decoded.fromtrans;
                    var totrans = decoded.totrans;
                    gamepiece.setAttribute("data-trans", totrans);
                    //if the fromtrans was not null, need to remove it from the container (id = fromtrans)
                    if (fromtrans !== 999999) {
                        //remove from container
                        var container = document.querySelector("[data-placementId='" + fromtrans + "']").firstChild;
                        container.removeChild(gamepiece);
                    } else {
                        //remove from gridblock
                        document.querySelector("[data-positionId='" + decoded.oldPositionId + "']").removeChild(gamepiece);
                    }
                    //if the totrans was not null, need to add it to the container (id = totrans)
                    if (totrans !== 999999) {
                        var container = document.querySelector("[data-placementId='" + totrans + "']").firstChild;
                        container.appendChild(gamepiece);
                    } else {
                        document.querySelector("[data-positionId='" + decoded.newPositionId + "']").appendChild(gamepiece);
                    }
                }
            };
            xmlhttp.open("GET", "movement_undo.php", true);
            xmlhttp.send();
        }

        function test_function() {
            alert('<?php echo $_SESSION["dist"][25][83] ?>');
        }
    </script>
</head>
<body onload="hideall_big(); hidecover(event);">
    <div id="side_panel">
        <div class="subside_panel" id="top_panel">
            <button onclick="create_piece_placement(event)">Create a New Piece</button>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="119" ondragover="allowDrop(event)" ondrop="drop(event, this)">
                <?php $positionId = 119; include("display_pieces.php"); ?>
            </div>
            <div id="trashbox" class="gridblock" ondragover="allowDrop(event)" ondrop="throwaway(event, this)"></div>
        </div>
        <div class="subside_panel" id="middle_panel">
            Phase2<br>
            <button onclick="undo_movement(event)">Undo a movement</button>
<!--            <button onclick="reset_moves()">Rest Moves for all pieces</button>-->
        </div>
        <div class="subside_panel" id="bottom_panel">Other</div>
    </div>

    <div id="game_board" onmouseleave="hideall_big()">
        <div class="grid">
            <div id="cover"></div>
            <div class="gridblockLeftBig" ondragenter="clear_hover_timer(event)" onclick="hideall_big()">
                <div class="gridblockTiny" id="pos13a" data-positionId="56" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 56; include("display_pieces.php"); ?></div>
                <div class="gridblockTiny" id="pos13b" data-positionId="57" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 57; include("display_pieces.php"); ?></div>
                <div class="gridblockTiny" id="pos13c" data-positionId="58" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 58; include("display_pieces.php"); ?></div>
                <div class="gridblockTiny" id="pos13d" data-positionId="59" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 59; include("display_pieces.php"); ?></div>
    <!--            <div class="gridblockTiny" id="pos13e" data-positionId="60" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 60; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos13f" data-positionId="61" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 61; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos13g" data-positionId="62" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 62; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos13h" data-positionId="63" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 63; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos13i" data-positionId="64" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 64; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos13j" data-positionId="65" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 65; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="1" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 1; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="2" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 2; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="3" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 3; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="4" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 4; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="5" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 5; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="6" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 6; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="7" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 7; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="8" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 8; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="9" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 9; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island1" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="10" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 10; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="11" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 11; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island2" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="12" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 12; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island3" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="13" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 13; include("display_pieces.php"); ?></div>
            <div class="gridblockRightBig" ondragenter="clear_hover_timer(event)" onclick="hideall_big()">
                <div class="gridblockTiny" id="pos14a" data-positionId="66" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 66; include("display_pieces.php"); ?></div>
                <div class="gridblockTiny" id="pos14b" data-positionId="67" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 67; include("display_pieces.php"); ?></div>
    <!--            <div class="gridblockTiny" id="pos14c" data-positionId="68" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 68; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos14d" data-positionId="69" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 69; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos14e" data-positionId="70" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 70; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos14f" data-positionId="71" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 71; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos14g" data-positionId="72" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 72; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos14h" data-positionId="73" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 73; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos14i" data-positionId="74" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 74; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos14j" data-positionId="75" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 75; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div class="gridblock" data-positionId="14" ondragenter="clear_hover_timer(event)" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 14; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="15" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 15; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="16" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 16; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island4" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="17" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 17; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="18" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 18; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="19" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 19; include("display_pieces.php"); ?></div>
            <div class="gridblockEmptyLeft" ondragenter="clear_hover_timer(event)" onclick="hideall_big()"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="20" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 20; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="21" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 21; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="22" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 22; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island5" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="23" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 23; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="24" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 24; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="25" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 25; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island6" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="26" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 26; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="27" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 27; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island7" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="28" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 28; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island5" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="29" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 29; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island8" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="30" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 30; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="31" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 31; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="32" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 32; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="33" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 33; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="34" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 34; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="35" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 35; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="36" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 36; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island9" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="37" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 37; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="38" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 38; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island10" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="39" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 39; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="40" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 40; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="41" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 41; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island11" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="42" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 42; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="43" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 43; include("display_pieces.php"); ?></div>
            <div class="gridblock" id="special_island12" onclick="make_big(event, this)" ondragleave="check_prevent_popup(event)" ondragenter="start_hover_timer(event, this)"></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="44" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 44; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="45" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 45; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="46" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 46; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="47" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 47; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="48" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 48; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="49" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 49; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="50" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 50; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="51" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 51; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="52" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 52; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="53" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 53; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="54" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 54; include("display_pieces.php"); ?></div>
            <div class="gridblock" ondragenter="clear_hover_timer(event)" data-positionId="55" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 55; include("display_pieces.php"); ?></div>
<!--            TODO: seriously refactor to put this inside of the special_islands once mastered uninheriting of functions between child and parent-->
            <div id="bigblock1" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
                <div class="gridblockTiny" id="pos1a" data-positionId="76" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 76; include("display_pieces.php"); ?></div>
                <div class="gridblockTiny" id="pos1b" data-positionId="77" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)"><?php $positionId = 77; include("display_pieces.php"); ?></div>
    <!--            <div class="gridblockTiny" id="pos1c" data-positionId="78" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 78; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos1d" data-positionId="79" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 79; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock2" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos2a" data-positionId="80" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 80; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos2b" data-positionId="81" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 81; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos2c" data-positionId="82" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 82; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos2d" data-positionId="83" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 83; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock3" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos3a" data-positionId="84" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 84; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos3b" data-positionId="85" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 85; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos3c" data-positionId="86" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 86; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock4" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos4a" data-positionId="87" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 87; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos4b" data-positionId="88" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 88; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos4c" data-positionId="89" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 89; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos4d" data-positionId="90" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 90; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock5" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos5a" data-positionId="91" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 91; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos5b" data-positionId="92" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 92; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos5c" data-positionId="93" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 93; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos5d" data-positionId="94" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 94; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock6" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos6a" data-positionId="95" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 95; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos6b" data-positionId="96" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 96; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos6c" data-positionId="97" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 97; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock7" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos7a" data-positionId="98" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 98; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos7b" data-positionId="99" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 99; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos7c" data-positionId="100" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 100; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock8" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos8a" data-positionId="101" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 101; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos8b" data-positionId="102" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 102; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos8c" data-positionId="103" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 103; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock9" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos9a" data-positionId="104" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 104; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos9b" data-positionId="105" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 105; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos9c" data-positionId="106" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 106; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos9d" data-positionId="107" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 107; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock10" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos10a" data-positionId="108" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 108; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos10b" data-positionId="109" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 109; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos10c" data-positionId="110" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 110; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos10d" data-positionId="111" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 111; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock11" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos11a" data-positionId="112" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 112; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos11b" data-positionId="113" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 113; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos11c" data-positionId="114" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 114; include("display_pieces.php"); ?><!--</div>-->
            </div>
            <div id="bigblock12" class="bigblock bigblock3x3" ondragenter="clearTimeout(hovertimer);">
    <!--            <div class="gridblockTiny" id="pos12a" data-positionId="115" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 115; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos12b" data-positionId="116" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 116; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos12c" data-positionId="117" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 117; include("display_pieces.php"); ?><!--</div>-->
    <!--            <div class="gridblockTiny" id="pos12d" data-positionId="118" onclick="hideall_big()" ondragover="allowDrop(event)" ondrop="drop(event, this)">--><?php //$positionId = 118; include("display_pieces.php"); ?><!--</div>-->
            </div>
        </div>
    </div>

</body>
</html>