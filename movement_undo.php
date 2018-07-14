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
$movementFromTransport = $r['movementFromTransport'];

$query = 'SELECT * FROM placements WHERE placementId = ?';
$query = $db->prepare($query);
$query->bind_param("i", $movementNowPlacement);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();

$nowPosition = $r['positionId'];
$nowtrans = $r['transportId'];
//special things to do if it was inside of a transport?
$currentMoves = $r['currentMoves'];
$newCurrentMoves = $currentMoves + $movementCost;

$query = 'UPDATE placements SET positionId = ?, currentMoves = ?, transportId = ? WHERE (placementId = ?)';
$query = $db->prepare($query);
$query->bind_param("iiii", $movementFromPosition, $newCurrentMoves, $movementFromTransport, $movementNowPlacement);
$query->execute();

$query = 'DELETE FROM movements WHERE movementId = ?';
$query = $db->prepare($query);
$query->bind_param("i", $movementId);
$query->execute();

$arr = array('placementId' => $movementNowPlacement, 'fromtrans' => $nowtrans, 'oldPositionId' => $nowPosition, 'newPositionId' => $movementFromPosition, 'movementCost' => $movementCost, 'totrans' => $movementFromTransport);
echo json_encode($arr);
