<?php
session_start();
include("db.php");

$placementId = $_REQUEST['placementId'];
$positionId = $_REQUEST['positionId'];

$query = 'UPDATE placements SET positionId = ? WHERE (placementId = ?)';
$query = $db->prepare($query);
$query->bind_param("ii", $positionId, $placementId);
$query->execute();

//TODO: change movement names in sql table to shorter?
//TODO: possibly change phase into a integer?....(figure out what are the phase names? (easier as numbers))
$movementFromPosition = $_REQUEST['oldpositionId'];
$movementGameId = $_SESSION['gameId'];
$movementTurn = $_SESSION['gameTurn'];
$movementPhase = $_SESSION['gamePhase'];

$query = 'INSERT INTO movements (movementFromPosition, movementNowPlacement, movementGameId, movementTurn, movementPhase) VALUES(?, ?, ?, ?, ?)';
$query = $db->prepare($query);
$query->bind_param("iiiis", $movementFromPosition, $placementId, $movementGameId, $movementTurn, $movementPhase);
$query->execute();

