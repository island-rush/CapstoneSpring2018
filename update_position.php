<?php
session_start();
include("db.php");

//TODO: think about making the game faster by dropping first, then if not valid, move it back? (more responsive game) (maybe my computer is just slow with running everything) (also old)

//TODO: make sure matrix works by testing spots can't move to?
//TODO: update move from 119? (don't want that to count as a move?)(create with 1 extra move?) (1 more in table UnitMoves)

$placementId = $_REQUEST['placementId'];
$positionId = $_REQUEST['newPos'];
$newCurrentMoves = $_REQUEST['newmoves'];

$query = 'UPDATE placements SET positionId = ?, currentMoves = ? WHERE (placementId = ?)';
$query = $db->prepare($query);
$query->bind_param("iii", $positionId, $newCurrentMoves, $placementId);
$query->execute();

//TODO: change movement names in sql table to shorter?
//TODO: possibly change phase into a integer?....(figure out what are the phase names? (easier as numbers))
$movementFromPosition = $_REQUEST['oldPos'];
$movementGameId = $_SESSION['gameId'];
$movementTurn = $_SESSION['gameTurn'];
$movementPhase = $_SESSION['gamePhase'];
$movementCost = $_SESSION['dist'][$positionId-1][$movementFromPosition-1];

$query = 'INSERT INTO movements (movementFromPosition, movementNowPlacement, movementCost, movementGameId, movementTurn, movementPhase) VALUES(?, ?, ?, ?, ?, ?)';
$query = $db->prepare($query);
$query->bind_param("iiiiis", $movementFromPosition, $placementId, $movementCost, $movementGameId, $movementTurn, $movementPhase);
$query->execute();

