<?php
include("db.php");

//get these values from the button's to create them? (or session variables for game/team... (119 may be hardcoded here?)
//may want to not hardcode 119 here for clean coding practices, may create another space for pieces to go?
$gameId = 1;
$unitId = 6;
$teamId = 'red';
$positionId = 119;

$query = 'INSERT INTO placements (gameId, unitId, teamId, positionId) VALUES(?, ?, ?, ?)';
$query = $db->prepare($query);
$query->bind_param("iisi", $gameId, $unitId, $teamId, $positionId);
$query->execute();

//TODO: check for errors on all of these

