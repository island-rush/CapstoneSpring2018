<?php

include("db.php");

$query = 'SELECT * FROM test_table WHERE testId = 2';
$query = $db->prepare($query);
$query->execute();
$results = $query->get_result();
$r= $results->fetch_assoc();
$update_value = $r['testValue'];
if ($update_value == "no_update") {
    echo "do not update";
} else {
    echo "update";
}

$results->free();
$db->close();
