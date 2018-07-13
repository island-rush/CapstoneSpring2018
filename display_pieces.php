<?php
$gameId = $_SESSION['gameId'];
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
            $unitMoves = $r['currentMoves'];
            $placementId = $r['placementId'];
            echo "<div class='".$unitName." game_piece' data-unitName='".$unitName."' data-moves='".$unitMoves."' ";

            // other pieces don't do stuff when you click them (or they take the parent click (hideall probably))
            if ($unitName == "transport") {
                echo "onclick='make_visible(event, this)' ";
            }

            echo "data-placementId='".$placementId."' draggable='true' ondragstart='drag(event, this)'>";
            if ($unitName == "transport") {
                echo "<div class='transportContainer' draggable='false'></div>";
            }
            echo "</div>";
        }
    }
}
unset($positionId);