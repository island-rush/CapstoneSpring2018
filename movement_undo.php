<?php
session_start();
include("db.php");

//TODO: this page (among others) should use more error checking...???

$movementGameId = $_SESSION['gameId'];
$movementTurn = $_SESSION['gameTurn'];
$movementPhase = $_SESSION['gamePhase'];

//TODO: only this game, turn, phase...
$query = 'SELECT * FROM movements ORDER BY movementId DESC LIMIT 0, 1';
$query = $db->prepare($query);
//$query->bind_param("iis", $movementGameId, $movementTurn, $movementPhase);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();

$movementId = $r['movementId'];
$movementFromPosition = $r['movementFromPosition'];
$movementNowPlacement = $r['movementNowPlacement'];

$query = 'SELECT * FROM placements WHERE placementId = ?';
$query = $db->prepare($query);
$query->bind_param("i", $movementNowPlacement);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();

$nowPosition = $r['positionId'];

$query = 'UPDATE placements SET positionId = ? WHERE (placementId = ?)';
$query = $db->prepare($query);
$query->bind_param("ii", $movementFromPosition, $movementNowPlacement);
$query->execute();

$query = 'DELETE FROM movements WHERE movementId = ?';
$query = $db->prepare($query);
$query->bind_param("i", $movementId);
$query->execute();

$arr = array('placementId' => $movementNowPlacement, 'oldPositionId' => $nowPosition, 'newPositionId' => $movementFromPosition);
echo json_encode($arr);
