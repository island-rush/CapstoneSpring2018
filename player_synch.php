<?php
$gameId = $_REQUEST['gameId'];
$team = $_REQUEST['team'];
include("db.php");
$query = 'SELECT * FROM games WHERE (gameId = ?)';
$query = $db->prepare($query);
$query->bind_param("i", $gameId);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();
$gameTurn = $r['gameTurn'];
$gamePhase = $r['gamePhase'];
$gameBlueJoined = $r['gameBlueJoined'];
$gameRedJoined = $r['gameRedJoined'];

if ($team == "red") {
    if ($gameRedJoined == 0) {
        $query = 'UPDATE games SET gameRedJoined=1 WHERE (gameId = ?)';
        $query = $db->prepare($query);
        $query->bind_param("i", $gameId);
        $query->execute();
    }
    if ($gameBlueJoined == 1) {
        echo "start_game";
        exit();
    } else {
        echo "keep_waiting";
        exit();
    }
} else {
    if ($gameBlueJoined == 0) {
        $query = 'UPDATE games SET gameBlueJoined=1 WHERE (gameId = ?)';
        $query = $db->prepare($query);
        $query->bind_param("i", $gameId);
        $query->execute();
    }
    if ($gameRedJoined == 1) {
        echo "start_game";
        exit();
    } else {
        echo "keep_waiting";
        exit();
    }
}

$results->free();
$db->close();