<?php

$gameId = $_SESSION['gameId'];

if (isset($special_island)) {
    //loop through positions on the special island

    //get possible positions for this certain special island
    //loop through these positions for shit


} else {
    if (isset($positionId)) {
        $query = 'SELECT * FROM placements NATURAL JOIN units WHERE (gameId = ?) AND (positionId = ?)';
        $query = $db->prepare($query);
        $query->bind_param("ii", $gameId, $positionId);
        $query->execute();
        $results = $query->get_result();
        $num_results = $results->num_rows;
        if ($num_results > 0) {
            for ($i=0; $i < $num_results; $i++) {
                $r= $results->fetch_assoc();
                $unitName = $r['unitName'];
                $placementId = $r['placementId'];
                echo "<div class='".$unitName." game_piece' data-placementId='".$placementId."'></div>";
            }
        }
    }
}

unset($positionId);
unset($special_island);