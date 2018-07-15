<?php
session_start();
include("db.php");

$gameId = $_SESSION['gameId'];

//TODO: think about making the game faster by dropping first, then if not valid, move it back? (more responsive game) (maybe my computer is just slow with running everything) (also old)

//TODO: make sure matrix works by testing spots can't move to?
//TODO: update move from 119? (don't want that to count as a move?)(create with 1 extra move?) (1 more in table UnitMoves)

$placementId = $_REQUEST['placementId'];
$newPos = $_REQUEST['newPos'];
$newCurrentMoves = $_REQUEST['newmoves'];
$oldtrans = $_REQUEST['oldtrans'];
$newtrans = $_REQUEST['newtrans'];
$oldPos = $_REQUEST['oldPos'];


//for troops going along with a transport
//data-trans stays the same
//position updates in the placements table

//find out if transport (select from placement table and get the unit name?)(with a join)
//if it is, need to find out all pieces that have this placementId in their transportId (in placements table)
//for each of those pieces, update in the database the positionId of them
//TODO: and gameId? (everything inside the same game, turn, phase)
$query = 'SELECT * FROM placements NATURAL JOIN units WHERE placementId = ?';
$query = $db->prepare($query);
$query->bind_param("i", $placementId);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();
$unitName = $r['unitName'];

if ($unitName == "transport") {
    //get all placements that have the transportId = this placementId
    //update their positions to be the position of the placement...not changing transId or moves (same moves inside transport...still inside of it)
    $query = 'SELECT * FROM placements WHERE (gameId = ?) AND (transportId = ?)';
    $query = $db->prepare($query);
    $query->bind_param("ii", $gameId, $placementId);
    $query->execute();
    $results = $query->get_result();
    $num_results = $results->num_rows;
    if ($num_results > 0) {
        for ($i=0; $i < $num_results; $i++) {
            $r = $results->fetch_assoc();
            $apiece = $r['placementId'];
            $query = 'UPDATE placements SET positionId = ? WHERE (placementId = ?)';
            $query = $db->prepare($query);
            $query->bind_param("ii", $newPos, $apiece);
            $query->execute();
        }
    }
}
//TODO: make sure transports can't go into transports (or whatever)(other logic for what can fit in it)



$query = 'UPDATE placements SET positionId = ?, currentMoves = ?, transportId = ? WHERE (placementId = ?)';
$query = $db->prepare($query);
//the trans is set to null, because this update_position is called from a non-transport container...so still not in a transport
$query->bind_param("iiii", $newPos, $newCurrentMoves, $newtrans,  $placementId);
$query->execute();

//TODO: change movement names in sql table to shorter?
//TODO: possibly change phase into a integer?....(figure out what are the phase names? (easier as numbers))
$movementGameId = $_SESSION['gameId'];
$movementTurn = $_SESSION['gameTurn'];
$movementPhase = $_SESSION['gamePhase'];
$movementCost = $_SESSION['dist'][$newPos-1][$oldPos-1];

$query = 'INSERT INTO movements (movementFromPosition, movementNowPlacement, movementFromTransport, movementCost, movementGameId, movementTurn, movementPhase) VALUES(?, ?, ?, ?, ?, ?, ?)';
$query = $db->prepare($query);
$query->bind_param("iiiiiis", $oldPos, $placementId, $oldtrans, $movementCost, $movementGameId, $movementTurn, $movementPhase);
$query->execute();


