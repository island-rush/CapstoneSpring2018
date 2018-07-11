<?php
include("db.php");

//get these values from the button's to create them? (or session variables for game/team... (119 may be hardcoded here?)
//may want to not hardcode 119 here for clean coding practices, may create another space for pieces to go?
$gameId = 1;
$unitId = 6;
$teamId = 'red';
$positionId = 119;

//also get this from the button
$unitName = 'test_piece';

$query = 'INSERT INTO placements (gameId, unitId, teamId, positionId) VALUES(?, ?, ?, ?)';
$query = $db->prepare($query);
$query->bind_param("iisi", $gameId, $unitId, $teamId, $positionId);
$query->execute();

$query = 'SELECT LAST_INSERT_ID()';
$query = $db->prepare($query);
$query->execute();
$results = $query->get_result();
$num_results = $results->num_rows;
$r= $results->fetch_assoc();
$newPlacementId = $r['LAST_INSERT_ID()'];
echo "<div class='".$unitName." game_piece' data-placementId='".$newPlacementId."' draggable='true' ondragstart='drag(event, this)'></div>";

//TODO: check for errors on all of these
