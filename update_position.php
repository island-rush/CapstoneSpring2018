<?php
include("db.php");

$placementId = $_REQUEST['placementId'];
$positionId = $_REQUEST['positionId'];

$query = 'UPDATE placements SET temporaryPositionId = ? WHERE (placementId = ?)';
$query = $db->prepare($query);
$query->bind_param("ii", $positionId, $placementId);
$query->execute();


