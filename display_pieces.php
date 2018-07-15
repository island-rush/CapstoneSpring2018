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
            $containerPos = $r['positionId'];
            $trans = $r['transportId'];
            $placementId = $r['placementId'];
            //TODO: don't echo a non-transport with the trans set (these will get echo'd inside of a trans)

            if ($trans == 999999) {
                echo "<div class='".$unitName." game_piece' data-trans='".$trans."' data-unitName='".$unitName."' data-moves='".$unitMoves."' ";

                // other pieces don't do stuff when you click them (or they take the parent click (hideall probably))
                //possibly other methods that are specific to this? (does dropping change for a transport div / container?)
                if ($unitName == "transport") {
                    echo "onclick='make_visible(event, this, 2)' ondragenter='start_hover_timer2(event, this); skipclear = 3;'";
                }

                echo "data-placementId='".$placementId."' draggable='true' ondragstart='drag(event, this)'>";

                if ($unitName == "transport") {
                    echo "<div class='transportContainer' data-containerPos='".$containerPos."' ondragleave='check_prevent_popup(event)' ondragover='allowDrop(event)' ondrop='drop2(event, this); skipdrop1 = 4;'>";

                    $query = 'SELECT * FROM placements WHERE (gameId = ?) AND (transportId = ?)';
                    $query = $db->prepare($query);
                    $query->bind_param("ii", $gameId, $placementId);
                    $query->execute();
                    $results = $query->get_result();
                    $num_results = $results->num_rows;
                    if ($num_results > 0) {
                        for ($i=0; $i < $num_results; $i++) {
                            echo "<div class='".$unitName." game_piece' data-trans='".$trans."' data-unitName='".$unitName."' data-moves='".$unitMoves."' ";
                            echo "data-placementId='".$placementId."' draggable='true' ondragstart='drag(event, this)'>";
                            echo "</div>";

                        }
                    }

                    echo "</div>";
                }

                echo "</div>";
            }



        }
    }
}
unset($positionId);