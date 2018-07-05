<?php
    // retrieve session information
    session_start();

    // verify gameId and team are set
    // if(!isset($_SESSION['team']) || !isset($_SESSION['gameId'])){
    //     header("location:home.html?err=4");
    //     exit;
    // }

    // $team = (isset($_SESSION['team']))?$_SESSION['team']:'';
    $cash = 10000;  //TODO: WHAT THE FUCK IS THIS SHIT
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buy Troops Phase</title>
	<link rel="stylesheet" type="text/css" href="style_board.css">
	<script type="text/javascript">
		var SOLDIER_MOVE_LIMIT = 1;
		var TRANSPORT_MOVE_LIMIT = 4;
		var soldier = {x:0, y:0, moves: 0};
		var transport = {x:0, y:0, moves: 0};

		function allowDrop(ev) {
		    ev.preventDefault();
		}

		function drag(ev) {
		    ev.dataTransfer.setData("text", ev.target.id);
		}

		function drop(ev) {
			ev.preventDefault();
		    var data = ev.dataTransfer.getData("text");
		    var target = ev.target;

			if( data == "transport" && target.getAttribute("id").includes("sea") ){
				// check move counts.
				var move = countMoves(transport.x, transport.y, target.getAttribute("x"), target.getAttribute("y"));
			    console.log("Transport is trying to move " + move);
			    if( transport.x == 0 || move + transport.moves <= TRANSPORT_MOVE_LIMIT){
			    	if(transport.x != 0) transport.moves += move;
				    ev.target.appendChild(document.getElementById(data));
				    transport.x = target.getAttribute("x");
				    transport.y = target.getAttribute("y");
				    console.log("Transport location updated to: " + transport.x + ", " + transport.y + ".");
			    	console.log("Transport moves left: " + (TRANSPORT_MOVE_LIMIT - transport.moves));
				} //end of if(moves)
			}//end of if(transport)
			if( data == "transport" && target.getAttribute("id").includes("sea") ){
				// check move counts.
				var move = countMoves(transport.x, transport.y, target.getAttribute("x"), target.getAttribute("y"));
			    console.log("Transport is trying to move " + move);
			    if( transport.x == 0 || move + transport.moves <= TRANSPORT_MOVE_LIMIT){
			    	if(transport.x != 0) transport.moves += move;
				    ev.target.appendChild(document.getElementById(data));
				    transport.x = target.getAttribute("x");
				    transport.y = target.getAttribute("y");
				    console.log("Transport location updated to: " + transport.x + ", " + transport.y + ".");
			    	console.log("Transport moves left: " + (TRANSPORT_MOVE_LIMIT - transport.moves));
				} //end of if(moves)
			}//end of if(transport)
		}

		/* Count the moves between two grid locations, where a diagonal move counts as 1. */
		function countMoves(xi, yi, xf, yf){
			var move_count = 0;
			var dx = Math.abs(xf-xi);
			var dy = Math.abs(yf-yi);
			while(dx > 0 && dy > 0){
				dx --;
				dy --;
				move_count ++;
			}
			return move_count + dx + dy;
		}

		/* Reset the individual piece's move counts.  */
		function resetMoves() {
			soldier.moves = 0;
			transport.moves = 0;
		}
	</script>
</head>
<body>
	<h1>Island Rush</h1>
	<p>####INSTRUCTIONS####</p>
	<div class="sidepanel">
		<div class="troops">
			<!-- Troops that we need to place. Figure this out using php  -->
		</div>
	</div>
	<div class="game_board">
		<div class="grid">
			<div class="gridblock" y=1 x=1  id="land"     ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=2  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=3  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=4  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=5  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=6  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=7  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=8  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=9  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=10 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=1 x=11 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=1  id="land"     ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=2  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=3  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=4  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=5  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=6  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=7  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=8  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=9  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=10 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=2 x=11 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=1  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=2  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=3  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=4  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=5  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=6  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=7  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=8  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=9  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=10 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=3 x=11 id="land"     ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=1  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=2  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=3  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=4  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=5  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=6  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=7  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=8  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=9  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=10 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=4 x=11 id="land"     ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=1  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=2  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=3  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=4  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=5  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=6  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=7  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=8  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=9  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=10 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=5 x=11 id="land"     ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=1  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=2  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=3  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=4  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=5  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=6  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=7  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=8  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=9  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=10 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=6 x=11 id="land"     ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=1  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=2  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=3  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=4  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=5  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=6  id="sea land" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=7  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=8  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=9  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=10 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=7 x=11 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=1  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=2  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=3  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=4  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=5  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=6  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=7  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=8  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=9  id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=10 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
			<div class="gridblock" y=8 x=11 id="sea"      ondrop="drop(event)" ondragover="allowDrop(event)"></div>
		</div>
	</div>


</body>
</html>