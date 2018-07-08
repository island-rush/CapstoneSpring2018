<?php
session_start();

include("db.php");

$gameId = $_SESSION['gameId'];

if (isset($special_island)) {
    //loop through positions on the special island

    //get possible positions for this certain special island
    //loop through these positions for shit







} else {
    if (isset($positionId)) {
        $query = 'SELECT * FROM placements WHERE (gameId = ?) AND (positionId = ?)';
        $query = $db->prepare($query);
        $query->bind_param("ii", $gameId, $positionId);
        $query->execute();
        $results = $query->get_result();

        $num_results = $results->num_rows;

        if ($num_results == 1) {
            $r = $results->fetch_assoc();
            //big size sprite
        } else if ($num_results == 2) {
            $r = $results->fetch_assoc();
            //medium sized sprites
            $r = $results->fetch_assoc();

        } else if ($num_results == 3) {
            $r = $results->fetch_assoc();
            //small sized sprites
            $r = $results->fetch_assoc();

            $r = $results->fetch_assoc();

        } else {
            //fuck em
        }

        if ($num_results > 0) {
            for ($i=0; $i < $num_results; $i++) {
                $r= $results->fetch_assoc();


            }
        }
    }
}


unset($positionId);
unset($special_island);