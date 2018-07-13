<?php
session_start();
include("db.php");
//TODO: what happens when try to undo but no moves have been made? (yet)

//TODO: this page (among others) should use more error checking...???

$movementGameId = $_SESSION['gameId'];
$movementTurn = $_SESSION['gameTurn'];
$movementPhase = $_SESSION['gamePhase'];

//TODO: only this game, turn, phase...
$query = 'SELECT * FROM movements ORDER BY movementId DESC LIMIT 0, 1';
$query = $db->prepare($query);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();

$movementId = $r['movementId'];
$movementCost = $r['movementCost'];
$movementFromPosition = $r['movementFromPosition'];
$movementNowPlacement = $r['movementNowPlacement'];

$query = 'SELECT * FROM placements WHERE placementId = ?';
$query = $db->prepare($query);
$query->bind_param("i", $movementNowPlacement);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();

$nowPosition = $r['positionId'];
$currentMoves = $r['currentMoves'];
$newCurrentMoves = $currentMoves + $movementCost;

$query = 'UPDATE placements SET positionId = ?, currentMoves = ? WHERE (placementId = ?)';
$query = $db->prepare($query);
$query->bind_param("iii", $movementFromPosition, $newCurrentMoves, $movementNowPlacement);
$query->execute();

$query = 'DELETE FROM movements WHERE movementId = ?';
$query = $db->prepare($query);
$query->bind_param("i", $movementId);
$query->execute();

$arr = array('placementId' => $movementNowPlacement, 'oldPositionId' => $nowPosition, 'newPositionId' => $movementFromPosition, 'movementCost' => $movementCost);
echo json_encode($arr);
