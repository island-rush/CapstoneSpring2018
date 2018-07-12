<?php

$query = 'SELECT * FROM units';
$query = $db->prepare($query);
$query->execute();
$results = $query->get_result();
$num_results = $results->num_rows;

$arr = array();

if ($num_results > 0) {
    for ($i=0; $i < $num_results; $i++) {
        $r= $results->fetch_assoc();
        $unitName = $r['unitName'];
        $unitMoves = $r['unitMoves'];
        $arr[$unitName] = $unitMoves;
    }
}

echo json_encode($arr);

//echo 5;