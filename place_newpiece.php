<?php
include("db.php");

//TODO: possibly make this more with display_pieces, since both echo a piece div...but different php code?

//get these values from the button's to create them? (or session variables for game/team... (119 may be hardcoded here?)
//may want to not hardcode 119 here for clean coding practices, may create another space for pieces to go?
$gameId = 1;
$unitId = 6;
//get unit moves
$unitMoves = 5;
//unit trans?
$trans = 999999;

$teamId = 'red';
$positionId = 119;

//also get this from the button
$unitName = 'test_piece';

$query = 'INSERT INTO placements (gameId, unitId, teamId, transportId, currentMoves, positionId) VALUES(?, ?, ?, ?, ?, ?)';
$query = $db->prepare($query);
$query->bind_param("iisiii", $gameId, $unitId, $teamId, $trans, $unitMoves, $positionId);
$query->execute();

//TODO: what would happen if you try to trash a transport piece with (container in it) and or pieces in it (probably doesn't delete the pieces inside of it from database...)

$query = 'SELECT LAST_INSERT_ID()';
$query = $db->prepare($query);
$query->execute();
$results = $query->get_result();
$num_results = $results->num_rows;
$r= $results->fetch_assoc();
$newPlacementId = $r['LAST_INSERT_ID()'];
//TODO: need container to be placed inside if it is a transport
echo "<div class='".$unitName." game_piece' data-trans='".$trans."' data-unitName='".$unitName."' data-moves='".$unitMoves."' data-placementId='".$newPlacementId."' draggable='true' ondragstart='drag(event, this)'></div>";

//TODO: check for errors on all of these

