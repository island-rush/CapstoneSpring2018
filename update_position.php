<?php
session_start();
include("db.php");

//TODO: make sure matrix works by testing spots can't move to?
//TODO: update move from 119? (don't want that to count as a move?)(create with 1 extra move?) (1 more in table UnitMoves)

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
$movementCost = $_SESSION['dist'][$positionId][$movementFromPosition];

$query = 'INSERT INTO movements (movementFromPosition, movementNowPlacement, movementCost, movementGameId, movementTurn, movementPhase) VALUES(?, ?, ?, ?, ?, ?)';
$query = $db->prepare($query);
$query->bind_param("iiiiis", $movementFromPosition, $placementId, $movementCost, $movementGameId, $movementTurn, $movementPhase);
$query->execute();

